<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Companie;
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
                'form' => companie::initialize(),
                'option' => [
                    'stock' => Stock::orderBy('name')->get()
                ]
            ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'stock_id' => 'required|exists:stocks,id',
            'title' => 'required',
            'entered_date' => 'required|date_format:Y-m-d',
            'entered_time' => 'required|date_time:hh:mm',
            'items.*.price' => 'required|numeric|min:0'
        ]);

        $data = $request->except('items');

        $items = [];

        $companie = Companie::create($data);

        $companie->items()
            ->saveMany($items);

        return response()
            ->json([
                'saved' => true
            ]);
    }

    public function show($id = 0)
    {
        $companie = Companie::with('stock', 'items')->findOrFail($id);

        return response()
            ->json([
                'model' => $companie
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
            'stock_id' => 'required|exists:stocks,id',
            'title' => 'required',
            'entered_date' => 'required|date_format:Y-m-d',
            'entered_time' => 'required|date_time:hh:mm',
            'items.*.price' => 'required|numeric|min:0'
        ]);

        $companie = Companie::findOrFail($id);

        $data = $request->except('items');
        $items = [];
        $itemIds = [];

        foreach($request->items as $item) {
            if(isset($item['id'])) {
                // update the item
                CompanieItem::whereId($item['id'])
                    ->whereCompanieId($companie->id)
                    ->update($item);
                $itemIds[] = $item['id'];
            } else {
                $items[] = new CompanieItem($item);
            }
        }

        $companie->update($data);

        // delete removed items

        if(count($itemIds)) {
            CompanieItem::whereCompanieId($companie->id)
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

}
