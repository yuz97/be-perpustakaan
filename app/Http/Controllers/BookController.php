<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buku = Book::with('category')->paginate(5);
        return response()->json([
            'message' => 'data berhasil ditampilkan',
            'data' => BookResource::collection($buku)
        ]);

    }

    public function table(Request $request){

        $title = 'Daftar Buku';
        $books = Book::with('category')->when(request()->has('keyword'),function($query)use($request){
                $query->where('title','LIKE',"%{$request->keyword}%")->orWhere('release_year','LIKE',"%{$request->keyword}%");
        })->paginate(5);
        return view('buku.index',compact('title','books'));
    }

    public function searchBook(Request $request){
        $title = 'Daftar Buku';
        $books = DB::table('books')
        ->where('title',$request->judul)
        ->whereBetween('release_year',[$request->mintahun,$request->maxtahun])->orderBy('release_year','desc')->paginate(5);
        return view('buku.index',compact('title','books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get()->pluck('name','id');
        return view('buku.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $validator = Validator::make($request->all(),[
        'title'  => 'required|unique:books,title',
        'release_year' => 'required',
        'price' => 'required',
        'total_page' => 'required',
        'category_id' => 'required'
       ]);

       if($validator->fails()){
            return response()->json([
                'status' =>false,
                'errors' => $validator->errors()->toArray(),
            ],422);
       }

       $data = $request->except('image_url');
        //gambar default
       $image = 'books/default.jpeg';
       if($request->hasFile('image_url')){
            $image =  $request->file('image_url')->store('books');
       }
       $data['image_url'] = $image ;

       //total halaman dan tebal buku
      if($data['total_page'] <= 100){
        $data['thickness'] = 'tipis';
      }else if($data['total_page'] >= 100 && $data['total_page'] <= 200){
        $data['thickness'] = 'sedang';
      }else{
        $data['thickness'] = 'tebal';
      }



      $buku = Book::create($data);

      return response()->json([
           'status' => true,
           'message' => 'buku berhasil ditambahkan',
           'data' => $buku
      ]);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return view('buku.detail',compact('book'));
        // return new BookResource($book);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $book = Book::with('category')->where('id',$book->id)->first();
        $categories = Category::get()->pluck('name','id');
        return view('buku.edit',compact('book','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(BookRequest $request, Book $book)
    {
        $data = $request->except('image_url');
        //jika gambar di update ganti gambar baru jika tidak ambil gambar lama
         $image = $book->image_url;
         $defaultImg = '/books/default.jpeg';
        if($request->hasFile('image_url')){
            if($image != $defaultImg ){

                Storage::disk()->delete($book->image_url);
            }
             $image =  $request->file('image_url')->store('books');
        }
        $data['image_url'] =  $image;

        //total halaman dan tebal buku
        if($request->has('total_page')){
            if($data['total_page'] <= 100){
                $data['thickness'] = 'tipis';
              }else if($data['total_page'] >= 100 && $data['total_page'] <= 200){
                $data['thickness'] = 'sedang';
              }else{
                $data['thickness'] = 'tebal';
            }
        }

         $book->update($data);
         return back()->with('message','buku berhasil diupdate');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $defaultImg = '/books/default.jpeg';

        if($book->image_url != $defaultImg){
            Storage::disk()->delete($book->image_url);
        }

        $book->delete();
        return redirect()->route('book.index');
    }
}
