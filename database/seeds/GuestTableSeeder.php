<?php

use Illuminate\Database\Seeder;
use App\Guest;
class GuestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list = [
            [
                'username'      => 'arya',
                'phone_number'  => '085678345789',
                'description'   => 'Technical Service',
            ],
            [
                'username'      => 'Ryo',
                'phone_number'  => '085678685709',
                'description'   => 'Programmer Freelance',
            ],
        ];
        $n=1;
        foreach ($list as $key => $value) {
            $list=Guest::create($value);
            $n++;
        }
    }
}
