<?php

use Illuminate\Database\Seeder;

class MapelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('mapel')->insert([
            ['kode' => '001',
             'nama' => 'Matematika',
             'semester' => 'Ganjil',
             'created_at' => \Carbon\Carbon::now()
            ],
            ['kode' => '002',
             'nama' => 'Bahasa Indonesia',
             'semester' => 'Ganjil',
             'created_at' => \Carbon\Carbon::now()
            ]
        ]);
    }
}
