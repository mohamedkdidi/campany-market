<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stock;

class StockController extends Controller
{
    public function index()
    {
        return response()
            ->json([
                'model' => Stock::filterPaginateOrder()
            ]);
    }

    public function create()
    {
        return response()
            ->json([
                'form' => Stock::initialize(),
                'option' => []
            ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required'
        ]);

        $stock = Stock::create($request->all());

        return response()
            ->json([
                'saved' => true
            ]);
    }

    public function show($id)
    {
        $stock = Stock::findOrFail($id);

        return response()
            ->json([
                'model' => $stock
            ]);
    }

    public function edit($id)
    {
        $stock = Stock::findOrFail($id);

        return response()
            ->json([
                'form' => $stock,
                'option' => []
            ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required'
        ]);

        $stock = Stock::findOrFail($id);
        $stock->update($request->all());

        return response()
            ->json([
                'saved' => true
            ]);
    }

    public function destroy($id)
    {
        $stock = Stock::findOrFail($id);

        // TODO: delete stock's invoices first

        $stock->delete();

        return response()
            ->json([
                'deleted' => true
            ]);
    }
}
