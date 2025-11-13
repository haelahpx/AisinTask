<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('data')->insert([
            [
                'user_id' => 1,
                'data_name'=> 'Sample Image',
                'type' => 'document',
                'status' => 'approved',
                'data_url' => 'https://www.aisin-asean.com/application/files/cache/thumbnails/58ced1bc706b565157016ed504968f0e.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'data_name' => 'Sample Image',
                'type' => 'image',
                'status' => 'pending',
                'data_url' => 'https://www.aisin-asean.com/application/files/cache/thumbnails/58ced1bc706b565157016ed504968f0e.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
