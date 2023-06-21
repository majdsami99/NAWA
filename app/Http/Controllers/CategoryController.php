<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = category::all();

        return view('admin.categories.index', [
            'title' => 'Categories List',
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|max:255|min:3',
            //'ID'   =>  'nullable|int|exists:categories,id',
        ];

        $request->validate($rules);
        $category = new category();

        $category->name = $request->input('name');
        //$category->ID = $request->input('ID');
        $category->name = $request->input('name');



        $category->save();

        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(category $category)
    {
        $category = category::findOrFail($category->id);
        return view('admin.categories.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, category $category)
    {
        //
        $rules = [
            'name' => 'required|max:255|min:3',
            //'ID'   =>  'nullable|int|exists:categories,id',
        ];
        $messages= [
            
        ];

        $request->validate($rules);
        $category = category::findOrFail($category->id);
        $category->name = $request->input('name');
        $category->save();
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(category $category)
    {
        //
        category::destroy($category->id);
        return redirect()->route('categories.index');
    }
}
