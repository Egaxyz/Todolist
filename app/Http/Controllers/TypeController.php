<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function index(){
        return inertia('Type/Type', [
            'type'=>Type::all()
        ]
            );
    }
    public function create(){
        return inertia('Type/Create', [
            'type'=>Type::all()
        ]);
    }
    public function store(Request $request){
        $request->validate([
            'name'=>'required',
            'description'=>'required',
        ]);
        Type::create($request->all());
        return redirect()->route('type.index')->with('success', 'Type created successfully');
    }
    public function edit($id){
        $type = Type::findOrFail($id);
        return inertia('Type/Create', [
            'editType'=>$type
        ]);
    }
    public function update(Request $request, Type $type, $id){
        $request->validate([
            'name'=>'required',
            'description'=>'required',
        ]);
        $type = Type::findOrFail($id);
        $type->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('type.index')->with('success', 'Type updated successfully');
    }
    public function destroy($id){
        $type = Type::find($id);
        if (!$type) {
            return redirect()->route('type.index')->with('error', 'Type not found');
        }
        $type->delete();
        
        return redirect()->route('type.index')->with('success', 'Type deleted successfully');
    }
}