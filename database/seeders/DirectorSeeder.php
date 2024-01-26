<?php
namespace Database\Seeders;

use App\Models\Director;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DirectorSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Director::create(
            [
                'image' => null,
                'content' => null
            ]
        );


    }
}
