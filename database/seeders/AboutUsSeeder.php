<?php
namespace Database\Seeders;

use App\Models\AboutUs;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AboutUsSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        AboutUs::create(
            [
                'about_us_content' => null
            ]
        );


    }
}
