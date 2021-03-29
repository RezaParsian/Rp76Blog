<?php

namespace Database\Seeders;

use App\Models\Info;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("infos")->insert([
            [
                Info::KEY => "social_media",
                Info::VALUE => json_encode([
                    "telegram" => "reza_atom",
                    "whatsapp" => "09174811484",
                    "instagram" => "rp_1376",
                    "website" => "https://rp76.ir",
                    "email" => "rezaparsian76@gmail.com"
                ])
            ],
            [
                Info::KEY => "programming_skill",
                Info::VALUE => json_encode([
                    "C#" => "90%",
                    "Php" => "80%",
                    "Html, Css, Js" => "75%",
                ])
            ]
        ]);

        DB::table("user_infos")->insert([
            [
                "user_id" => 1,
                "info_id" => 1
            ],
            [
                "user_id" => 1,
                "info_id" => 2
            ]            
        ]);
    }
}
