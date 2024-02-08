<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::get();
        return response()->json([
            'message' => 'data kategori berhasil ditampilkan',
            'data' => CategoryResource::collection($category)
        ],200);
    }


    public function table(){
        $title = "Daftar kategori";
        $categories = Category::paginate(5);
        return view('category.index',compact('categories','title'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $validator =  Validator::make($request->all(),[
            'name' => 'required|unique:categories,name'
       ]);

       if($validator->fails()){
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->toArray()
            ],422);
       }

       $data =  Category::create([
            'name' => $request->name
        ]);

       return response()->json([
            'status' => true,
            'message' => 'kategori berhasil ditambahkan',
            'data' => new CategoryResource($data)
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
      return view('category.detail',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $category->update([
            'name' => $request->name
        ]);
        return redirect()->route('category.index')->with('message','kategori berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
       $category->delete();
        return redirect()->route('category.index')->with('message','kategori berhasil dihapus');
    }
}
