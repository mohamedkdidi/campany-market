<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Companie;
use App\Exchange;
use App\Stock;

class CompanieController extends Controller
{
    public function index()
    {
        return response()
            ->json([
                'model' => Companie::with('stock')->filterPaginateOrder()
            ]);
    }

    public function create()
    {
        return response()
            ->json([
                'form' => Companie::initialize(),
                'option' => [
                    'stocks' => Stock::orderBy('name')->get()
                ]
            ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            /*    
            'name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            */
        ]);

        $data = $request->except('items');

        $items = [];
        
        foreach($request->items as $item) {
            $items[] = new Exchange($item);
        }

        $companie = Companie::create($data);

        $companie->items()
            ->saveMany($items);

        return response()
            ->json([
                'saved' => true
            ]);
    }

    public function show($id)
    {
        $companie = Companie::with('stock', 'items')->findOrFail($id);

        return response()
            ->json([
                'model' => $companie,
                'option' => [
                    'stocks' => Stock::orderBy('name')->get()
                ]
            ]);
    }

    public function edit($id)
    {
        $companie = Companie::with('items')->findOrFail($id);

        return response()
            ->json([
                'form' => $companie,
                'option' => [
                    'stocks' => Stock::orderBy('name')->get()
                ]
            ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
        ]);

        $companie = Companie::findOrFail($id);

        $data = $request->except('items');
        $items = [];
        $itemIds = [];

        foreach($request->items as $item) {

            if(isset($item['id'])) {
                // update the item
                Exchange::whereId($item['id'])
                    ->whereCompanieId($companie->id)
                    ->update($item);
                $itemIds[] = $item['id'];
            } else {
                $items[] = new Exchange($item);
            }
        }



        $companie->update($data);

        // delete removed items

        if(count($itemIds)) {
            Exchange::whereCompanieId($companie->id)
                ->whereNotIn('id', $itemIds)
                ->delete();
        }

        if(count($items)) {
            $companie->items()
                ->saveMany($items);
        }

        return response()
            ->json([
                'saved' => true
            ]);
    }

    public function destroy($id)
    {
        $companie = Companie::findOrFail($id);

        Exchange::whereCompanieId($companie->id)
            ->delete();

        $companie->delete();

        return response()
            ->json([
                'deleted' => true
            ]);
    }
}
