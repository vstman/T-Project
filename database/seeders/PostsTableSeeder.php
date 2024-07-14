<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Örnek veriler oluşturmak için DB facade'ini kullanabiliriz
        for ($i = 1; $i <= 50; $i++) {
            DB::table('posts')->insert([
                'user_id' => 1, // Kullanıcı ID'si buraya eklenecek
                'title' => 'Örnek Başlık ' . $i,
                'content' => 'Örnek içerik ' . $i . '...',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        // Daha fazla post eklemek isterseniz buraya devam edebilirsiniz

        // Seeder başarıyla çalıştığında bir mesaj yazdıralım
        $this->command->info('Posts table seeded!');
    }
}
