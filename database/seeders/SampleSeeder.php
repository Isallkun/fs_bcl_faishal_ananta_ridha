<?php

namespace Database\Seeders;

use App\Models\Armada;
use App\Models\Pengiriman;
use App\Models\Pemesanan;
use App\Models\Checkin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SampleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample armadas
        $armadas = [
            [
                'nomor_armada' => 'ARM001',
                'jenis_kendaraan' => 'Truck Besar',
                'kapasitas' => 5000,
                'status' => 'tersedia',
            ],
            [
                'nomor_armada' => 'ARM002',
                'jenis_kendaraan' => 'Truck Sedang',
                'kapasitas' => 3000,
                'status' => 'tersedia',
            ],
            [
                'nomor_armada' => 'ARM003',
                'jenis_kendaraan' => 'Van',
                'kapasitas' => 1000,
                'status' => 'tidak tersedia',
            ],
        ];

        foreach ($armadas as $armadaData) {
            Armada::create($armadaData);
        }

        // Create sample pengirimans
        $pengirimans = [
            [
                'nomor_pengiriman' => 'SHIP001',
                'tanggal_pengiriman' => now()->addDays(1),
                'asal' => 'Jakarta',
                'tujuan' => 'Bandung',
                'status' => 'tertunda',
                'detail_barang' => 'Elektronik dan peralatan kantor',
                'armada_id' => 1,
            ],
            [
                'nomor_pengiriman' => 'SHIP002',
                'tanggal_pengiriman' => now()->addDays(2),
                'asal' => 'Surabaya',
                'tujuan' => 'Malang',
                'status' => 'perjalanan',
                'detail_barang' => 'Bahan makanan dan minuman',
                'armada_id' => 2,
            ],
        ];

        foreach ($pengirimans as $pengirimanData) {
            Pengiriman::create($pengirimanData);
        }

        // Create sample checkins
        $checkins = [
            [
                'armada_id' => 1,
                'lat' => -6.200000,
                'lng' => 106.816666,
            ],
            [
                'armada_id' => 2,
                'lat' => -7.250000,
                'lng' => 112.750000,
            ],
        ];

        foreach ($checkins as $checkinData) {
            Checkin::create($checkinData);
        }
    }
}
