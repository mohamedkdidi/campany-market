<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;

class ProfileController extends Controller
{
    public function index()
    {
        $profile = Profile::findOrFail(1);
        
                return response()
                    ->json([
                        'model' => $profile
                    ]);

    }
    public function show($id)
    {
        $profile = Profile::findOrFail($id);

        return response()
            ->json([
                'model' => $profile
            ]);
    }
    public function create()
    {   
        return response()
            ->json([
                'form' => Profile::findOrFail(1),
            ]);
    }
    public function save()
    {
        return response()
            ->json([
                'form' => Profile::initialize(),
                'option' => []
            ]);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'address' => 'required'
        ]);
        //
        $profile = Profile::findOrFail(1);
        
        $data = $request->except('items');
        $items = [];

        
        $profile->update($data);
            
        return response()
            ->json([
                'saved' => true
            ]);
    }

    public function update(Request $request)
    {   
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'address' => 'required'
        ]);
               
        $profile = Profile::findOrFail(1);

        $data = $request->except('items');
        $items = [];

        
        $profile->update($data);

        return response()
            ->json([
                'saved' => true
            ]);
    }

}
