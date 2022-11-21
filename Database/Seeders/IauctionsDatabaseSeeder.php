<?php

namespace Modules\Iauctions\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class IauctionsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(IauctionsModuleTableSeeder::class);
        // $this->call("OthersTableSeeder");
    }
}
