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
        // $this->call(UsersTableSeeder::class);
        DB::table('categories')->delete();
        DB::table('categories')->insert(['name' => 'Uncategorized', 'slug'=>'uncategorized']);

        DB::table('sources')->update([ 'cat_id' => DB::table('categories')->first()->id ]);
    }
}
