<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CategorySeeder::class);        
        $this->call(ServiceSeeder::class);        
        $this->call(IndependentSeeder::class);        
        $this->call(IndependentServiceSeeder::class);        
    }
}
