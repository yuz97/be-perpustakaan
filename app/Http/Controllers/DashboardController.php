<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){

        $categories = Category::get()->count();
        $books = Book::get()->count();
        return view('dashboard.index',compact('categories','books'));
    }
}
