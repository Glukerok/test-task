<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ads = [
            [
                'id' => 1,
                'title' => 'Это тоже исходный код!',
                'desc' => 'Что происходит?',
                'price' => 200,
                'photos' => [
                    'https://image.shutterstock.com/image-photo/software-source-code-programming-on-600w-634574354.jpg',
                    'https://static01.nyt.com/images/2022/04/04/multimedia/15ai-nocode/15ai-nocode-mobileMasterAt3x.jpg',
                ],
            ],
        ];


        foreach ($ads as $ad) {
            DB::table('ads')->insert([
                'id' => $ad['id'],
                'title' => $ad['title'],
                'price' => $ad['price'],
                'desc' => $ad['desc'] ?? null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            foreach ($ad['photos'] as $photo) {
                DB::table('photos')->insert([
                    'url' => $photo,
                    'is_preview' => ($ad['photos'][0] == $photo) ? 1 : 0,
                    'ad_id' => $ad['id'],
                ]);
            }
        }
    }
}
