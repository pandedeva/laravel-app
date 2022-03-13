<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use \App\Models\Post;
use \App\Models\User;

class PostController extends Controller
{
  public function index()
  {
    // kosongkan dulu titlenya, lalu isikan apapun yang di klik
    $title = '';
    if (request('category')) {
      $category = Category::firstWhere('slug', request('category'));
      $title = ' in ' . $category->name;
    }

    if (request('author')) {
      $author = User::firstWhere('username', request('author'));
      $title = ' by ' . $author->name;
    }

    return view('posts.index', [
      "title" => "All Posts" . $title,
      // ambil semua data post, lalu urutkan dari yang terbaru, lalu kalau ada search tampilkan
      "posts" => Post::latest()->filter(request(['search', 'category', 'author']))->paginate(7)->withQueryString()
    ]);
  }

  public function show(Post $post)
  {
    return view('posts.post', [
      "title" => "Single Post",
      "post" => $post
    ]);
  }
}
