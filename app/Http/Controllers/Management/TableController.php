<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Table; 

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tables = Table::all();
        return view('management.table', ['slot' => ''])->with('tables', $tables);  
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('management.createTable', ['slot' => '']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:tables|max:255']);
        $table = new Table();
        $table->name = $request->name;
        
        $table->save();

        $request->session()->flash('status', 'Table '. $request->name. ' is created successfully');

        return redirect('/management/table');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $table = Table::find($id);
        return view('management.editTable', ['slot' => ''])->with('table', $table); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(['name' => 'required|unique:tables|max:255']);
        $table = Table::find($id);
        $table->name = $request->name;

        $table->save();

        $request->session()->flash('status', 'The table has been updated to '. $request->name. ' successfully');

        return redirect('/management/table');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Table::destroy($id);
        Session()->flash('status', 'The table has been deleted successfully');

        return redirect('/management/table');
    }
}
