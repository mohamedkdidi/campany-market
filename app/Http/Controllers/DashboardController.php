<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dashboard;
use App\Campanie;
use App\Exchange;
use App\Stock;

class DashboardController extends Controller
{
    public function index()
    {
        return response()
            ->json([
                'form' => Exchange::all()
            ]);
    }

    public function create()
    {   
        return response()
            ->json([
                'form' => Stock::initialize(),
                'exchange' => Exchange::initialize()
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

}
