<?php

namespace Database\Seeders;

use App\Http\Controllers\CountryController;
use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country:: factory(50)->create();
    }
}
