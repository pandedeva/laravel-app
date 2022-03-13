<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class Post extends Model
{
    use HasFactory, Sluggable;

    // protected $fillable = ['title', 'excerpt', 'body']; // ini yang boleh diisi, sisanya tidak
    protected $guarded = ['id']; //ini yang tidak boleh diisi, sisanya boleh
    protected $with = ['category', 'author'];

    // fitur pencarian
    public function scopeFilter($query, array $filters)
    {
      // functionnya bisa dijalankan ketiganya

      // kalau didalam $filters ada search, jalankan functionnya, kalau tidak ada false
      $query->when($filters['search'] ?? false, function($query, $search) {
        return $query->where(function($query) use ($search) {
             $query->where('title', 'like', '%' . $search . '%')
                   ->orWhere('body', 'like', '%' . $search . '%');
         });
     });

      // versi callback function
      $query->when($filters['category'] ?? false, function($query, $category) {
        return $query->whereHas('category', function($query) use($category) {
          $query->where('slug', $category);
        });
      });

      // versi arrow functionnya
      $query->when($filters['author'] ?? false, fn($query, $author) =>
        $query->whereHas('author', fn($query) => 
          $query->where('username', $author)
        )
      );

    }

    public function category()
    {
      // satu post hanya memiliki satu category
      return $this->belongsTo(Category::class);
    }
    
    public function author()
    {
      // satu post hanya dimiliki oleh satu user
      return $this->belongsTo(User::class, 'user_id');
    }

    // setiap route otomatis mencari slug, karna sudah dibuat defaultnya
    public function getRouteKeyName()
    {
      return 'slug';
    }

    public function sluggable(): array
    {
      return [
       'slug' => [
          'source' => 'title'
        ]
      ];
    }
}
