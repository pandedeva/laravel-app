<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DashboardPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.posts.index', [
          "title" => "My Posts",
          // mengambil postingan yang hanya dibuat oleh user yang login
          "posts" => Post::where('user_id', auth()->user()->id)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // untuk menampilkan view tambah data nya
    public function create()
    {
      return view('dashboard.posts.create', [
        "title" => "Create Post",
        "categories" => Category::all()
      ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // untuk proses tambah data nya
    public function store(Request $request)
    {
      // validasi data
      $validatedData = $request->validate([
        'title' => 'required|max:255',
        'slug' => 'required|unique:posts',
        'category_id' => 'required',
        'image' => 'image|file|max:2048',
        'body' => 'required'
      ]);

      // validasi kalau user menginputkan gambar
      if ($request->file('image') == true) {
        $validatedData['image'] = $request->file('image')->store('post-images');
      }

      // ambil user_id
      $validatedData['user_id'] = auth()->user()->id;
      // ambil excerpt
      $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 200);

      // hubungkan ke dbs, lalu create
      Post::create($validatedData);

      // pindah ke halaman my posts setelah success di tambahkan
      return redirect('/dashboard/posts')->with('success', 'New post has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    // untuk menampilkan detail post
    public function show(Post $post)
    {
      // agar tidak bisa melihat dan mengubah post buatan author lain
      if ($post->author->id !== auth()->user()->id) {
        abort(403);
      }
   
      return view('dashboard.posts.show', [
        "title" => "Detail Post",
        'post' => $post
      ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    // untuk menampilkan view edit data
    public function edit(Post $post)
    {
      // agar tidak bisa melihat dan mengubah post buatan author lain
      if ($post->author->id !== auth()->user()->id) {
        abort(403);
      }
   
      return view('dashboard.posts.edit', [
        "title" => "Edit Post",
        "post" => $post,
        "categories" => Category::all()
      ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    // untuk proses edit data nya
    public function update(Request $request, Post $post)
    {
      // validasi data
      $rules =[
        'title' => 'required|max:255',
        'category_id' => 'required',
        'image' => 'image|file|max:2048',
        'body' => 'required'
      ];

      // jika slug yang baru tidak sama dengan slug yang lama
      if ($request->slug != $post->slug) {
        // slug diisi required|unique:posts
        $rules['slug'] = 'required|unique:posts';
      }

      // jika rulesnya sudah lolos
      $validatedData = $request->validate($rules);

      // validasi kalau user menginputkan gambar
      if ($request->file('image') == true) {
        if ($request->oldImage) {
          // hapus gambar lama
          Storage::delete($request->oldImage);
        }
        // simpan gambar baru
        $validatedData['image'] = $request->file('image')->store('post-images');
      }

      // ambil user_id
      $validatedData['user_id'] = auth()->user()->id;
      // ambil excerpt
      $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 200);

      // mengupdate datanya
      Post::where('id', $post->id)
          ->update($validatedData);

      // pindah ke halaman my posts setelah success di tambahkan
      return redirect('/dashboard/posts')->with('success', 'Post has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    // untuk menghapus data
    public function destroy(Post $post)
    {
      if ($post->image) {
        // hapus gambar lama
        Storage::delete($post->image);
      }
      
      // hapus data post berdasarkan id
      Post::destroy($post->id);

      // pindah ke halaman my posts setelah success di dihapus
      return redirect('/dashboard/posts')->with('success', 'Post has been deleted!');
    }

    public function checkSlug(Request $request)
    {
      $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
      return response()->json(['slug' => $slug]);
    }
}
