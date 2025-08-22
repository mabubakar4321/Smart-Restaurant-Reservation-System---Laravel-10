<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{

    public function create(){
        return view('AdminDashboard.tables.create');
    }
 public function index()
    {
        $tables = Table::all();
        return view('AdminDashboard.tables.index',compact('tables'));
    }

    public function store(Request $request){
         $request->validate([
            'name' => 'required|unique:tables',
            'capacity' => 'required|integer|min:1',
        ]);

          Table::create($request->all());

        return redirect()->route('index')->with('success', 'Table created successfully.');
    }


    public function destroy($id)
    {
        $table=Table::find($id);
        $table->delete();
        return redirect()->route('index')->with('success', 'Table deleted successfully.');
    }


    public function edit($id){
        $table=Table::find($id);
          return view('AdminDashboard.tables.edit', compact('table'));
    }


    public function update(Request $request , $id){
$table=Table::find($id);

 $request->validate([
            'name' => 'required|unique:tables,name,',
            'capacity' => 'required|integer|min:1',
        ]);

          $table->update($request->all());
      return redirect()->route('index')->with('success', 'Table updated successfully.');
    }
    }

