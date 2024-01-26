<?php
namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Socials;
use Illuminate\Support\Facades\Hash;

class SocialSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Socials::create(
            [
                'facebook' => null,
                'instagram' => null,
                'linkedin' => null,
                'x' => null,
                'email' => null,
                'phone' => null,
            ]
        );


    }
}
