<?php

use Illuminate\Database\Seeder;

class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('guru')->insert([
            ['nama' => 'Suparjo',
             'telepon' => '081234567891',
             'alamat' => 'Sorong',
             'created_at' => \Carbon\Carbon::now()
            ],
            ['nama' => 'Naisha',
             'telepon' => '081234567892',
             'alamat' => 'Sorong',
             'created_at' => \Carbon\Carbon::now()
            ],
            ['nama' => 'Andra',
             'telepon' => '081234567893',
             'alamat' => 'Sorong',
             'created_at' => \Carbon\Carbon::now()
            ]
        ]);
    }
}
