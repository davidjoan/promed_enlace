<?php

use Illuminate\Database\Seeder;

class UbigeoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::disableQueryLog();
        DB::table('ubigeo')->delete();
        Excel::load('/database/seeds/data/ubigeo.csv', function($reader) {
            $results = $reader->get();
            foreach($results as $result)
            {
                \Enlace\Ubigeo::create(array(
                    'code' => $result->code,
                    'name' => $result->name,
                    'department' => $result->department,
                    'province' => $result->province,
                    'district' => $result->district,
                ));
            }
        });
    }
}
