<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use App\Models\Tikets;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $data = array(
            [
            'tgl_berangkat' => "2024-09-11 10:00:00",
            "tujuan" => "Jakarta",
            "asal" => "Nusantara",
            "nama_penumpang" => "Sang Pisang",
            'no_kursi' => "B18"
            ],
            [
                'tgl_berangkat' => "2024-09-29 10:00:00",
                "tujuan" => "Los Santos",
                "asal" => "Bojong Santos",
                "nama_penumpang" => "Alfa",
                'no_kursi' => "B19"
            ]

    );
    
    // Tikets::insert($data);

    }
}
