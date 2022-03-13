<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Post;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      User::create([
          'name' => 'admin',
          'username' => 'admin',
          'email' => 'admin@admin.com',
          'password' => bcrypt('123')
        ]);
      
      User::create([
          'name' => 'Pande Deva',
          'username' => 'pandedeva_',
          'email' => 'devapande66@gmail.com',
          'password' => bcrypt('deva319345')
        ]);

        // User::create([
        //   'name' => 'Aprilia',
        //   'email' => 'april@gmail.com',
        //   'password' => bcrypt('54321')
        // ]);

        
        User::factory(5)->create();

        Category::create([
          'name' => 'Web Programming',
          'slug' => 'web-programming'
        ]);

        Category::create([
          'name' => 'Data Science',
          'slug' => 'data-science'
        ]);

        Category::create([
          'name' => 'UI/UX',
          'slug' => 'ui-ux'
        ]);

        Category::create([
          'name' => 'Personal',
          'slug' => 'personal'
        ]);

        Post::factory(20)->create();

        // Post::create([
        //   'title' => 'Judul Pertama',
        //   'slug' => 'judul-pertama',
        //   'excerpt' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Tempora explicabo alias tempore amet laboriosam cumque iste ullam exercitationem',
        //   'body' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Tempora explicabo alias tempore amet laboriosam cumque iste ullam exercitationem eligendi saepe, earum impedit fugiat facere. Iusto, commodi molestias? Temporibus eaque beatae amet laboriosam ullam nesciunt deserunt atque. Sed amet commodi placeat sint quis voluptate incidunt quo distinctio eum, veniam facilis expedita doloremque ex, tempore odit rerum. In sequi ipsum aut maiores inventore dicta saepe ad nostrum doloribus nihil exercitationem deleniti neque iste placeat delectus, quo voluptate molestiae ipsa at, recusandae, omnis vero eos similique atque. Fugit dolorem doloribus, facere expedita magni quos assumenda, ipsam eum debitis doloremque iusto provident, voluptatem perspiciatis.',
        //   'category_id' => 1,
        //   'user_id' => 1
        // ]);

        // Post::create([
        //   'title' => 'Judul Kedua',
        //   'slug' => 'judul-kedua',
        //   'excerpt' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Tempora explicabo alias tempore amet laboriosam cumque iste ullam exercitationem',
        //   'body' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Tempora explicabo alias tempore amet laboriosam cumque iste ullam exercitationem eligendi saepe, earum impedit fugiat facere. Iusto, commodi molestias? Temporibus eaque beatae amet laboriosam ullam nesciunt deserunt atque. Sed amet commodi placeat sint quis voluptate incidunt quo distinctio eum, veniam facilis expedita doloremque ex, tempore odit rerum. In sequi ipsum aut maiores inventore dicta saepe ad nostrum doloribus nihil exercitationem deleniti neque iste placeat delectus, quo voluptate molestiae ipsa at, recusandae, omnis vero eos similique atque. Fugit dolorem doloribus, facere expedita magni quos assumenda, ipsam eum debitis doloremque iusto provident, voluptatem perspiciatis.',
        //   'category_id' => 1,
        //   'user_id' => 1
        // ]);

        // Post::create([
        //   'title' => 'Judul Ketiga',
        //   'slug' => 'judul-ketiga',
        //   'excerpt' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Tempora explicabo alias tempore amet laboriosam cumque iste ullam exercitationem',
        //   'body' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Tempora explicabo alias tempore amet laboriosam cumque iste ullam exercitationem eligendi saepe, earum impedit fugiat facere. Iusto, commodi molestias? Temporibus eaque beatae amet laboriosam ullam nesciunt deserunt atque. Sed amet commodi placeat sint quis voluptate incidunt quo distinctio eum, veniam facilis expedita doloremque ex, tempore odit rerum. In sequi ipsum aut maiores inventore dicta saepe ad nostrum doloribus nihil exercitationem deleniti neque iste placeat delectus, quo voluptate molestiae ipsa at, recusandae, omnis vero eos similique atque. Fugit dolorem doloribus, facere expedita magni quos assumenda, ipsam eum debitis doloremque iusto provident, voluptatem perspiciatis.',
        //   'category_id' => 2,
        //   'user_id' => 1
        // ]);

        // Post::create([
        //   'title' => 'Judul Ke Empat',
        //   'slug' => 'judul-ke-empat',
        //   'excerpt' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Tempora explicabo alias tempore amet laboriosam cumque iste ullam exercitationem',
        //   'body' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Tempora explicabo alias tempore amet laboriosam cumque iste ullam exercitationem eligendi saepe, earum impedit fugiat facere. Iusto, commodi molestias? Temporibus eaque beatae amet laboriosam ullam nesciunt deserunt atque. Sed amet commodi placeat sint quis voluptate incidunt quo distinctio eum, veniam facilis expedita doloremque ex, tempore odit rerum. In sequi ipsum aut maiores inventore dicta saepe ad nostrum doloribus nihil exercitationem deleniti neque iste placeat delectus, quo voluptate molestiae ipsa at, recusandae, omnis vero eos similique atque. Fugit dolorem doloribus, facere expedita magni quos assumenda, ipsam eum debitis doloremque iusto provident, voluptatem perspiciatis.',
        //   'category_id' => 2,
        //   'user_id' => 2
        // ]);

    }
}
