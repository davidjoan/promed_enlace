<?php

use Illuminate\Database\Seeder;

class EspecialidadTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::disableQueryLog();
        DB::table('especialidad')->delete();
        Excel::load('/database/seeds/data/especialidad.csv', function($reader) {
            $results = $reader->get();
            foreach($results as $result)
            {
                \Enlace\Especialidad::create(array(
                    'code' => $result->code,
                    'name' => $result->name,
                    'description' => $result->realname
                ));
            }
        });
    }
}
