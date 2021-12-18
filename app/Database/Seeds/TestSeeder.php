<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TestSeeder extends Seeder
{
    public function run()
    {
        $this->call('AngkatanSeeder');
        $this->call('JalurSeeder');
        $this->call('JurusanSeeder');
        $this->call('MetodePembayaranSeeder');
        $this->call('SemesterSeeder');
        $this->call('SesiKuliahSeeder');
        $this->call('UserSeeder');
    }
}
