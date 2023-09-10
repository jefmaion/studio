<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'Crédito'],
            ['name' => 'Débito', ],
            ['name' => 'Dinheiro'],
            ['name' => 'Pix'],
        ];

        foreach($data as $item) {
            PaymentMethod::create($item);
        }
    }
}
