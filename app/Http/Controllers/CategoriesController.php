<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoriesController extends Controller
{
  public function index()
  {
    return view('categories.index', [
      'title' => 'Post Categories',
      'categories' => Category::all()
    ]);
  }
}
