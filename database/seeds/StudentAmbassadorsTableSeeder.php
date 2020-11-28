<?php

use Illuminate\Database\Seeder;

use App\Models\StudentAmbassador;

class StudentAmbassadorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
    public function run()
    {
        $seeds= [
            [
                'email' => 'jsa1@mail.com',
                'name' => 'Student 1',
                'age' => 1,
                'address' => 'Jl. Ngagel 1',
                'university' => 'Kampoes 1',
                'faculty' => 'Teknik',
                'major' => 'Informatika',
                'phone' => '123',
                'line_id' => 'line/jsa',
                'ig_link' => 'ig/jsa',
                'linkedIn_link' => 'linkend-in/jsa1',
                'status' => 1
            ],

            [
                'email' => 'jsa2@mail.com',
                'name' => 'Student 2',
                'age' => 2,
                'address' => 'Jl. Ngagel 2',
                'university' => 'Kampoes 2',
                'faculty' => 'Teknik',
                'major' => 'Informatika',
                'phone' => '123',
                'line_id' => 'line/jsa',
                'ig_link' => 'ig/jsa',
                'linkedIn_link' => 'linkend-in/jsa2',
                'status' => 0
            ],

            [
                'email' => 'jsa3@mail.com',
                'name' => 'Student 3',
                'age' => 3,
                'address' => 'Jl. Ngagel 3',
                'university' => 'Kampoes 3',
                'faculty' => 'Teknik',
                'major' => 'Informatika',
                'phone' => '123',
                'line_id' => 'line/jsa',
                'ig_link' => 'ig/jsa',
                'linkedIn_link' => 'linkend-in/jsa3',
                'status' => 1
            ],

            [
                'email' => 'jsa4@mail.com',
                'name' => 'Student 4',
                'age' => 4,
                'address' => 'Jl. Ngagel 4',
                'university' => 'Kampoes 4',
                'faculty' => 'Teknik',
                'major' => 'Informatika',
                'phone' => '123',
                'line_id' => 'line/jsa',
                'ig_link' => 'ig/jsa',
                'linkedIn_link' => 'linkend-in/jsa4',
                'status' => 0
            ],

            [
                'email' => 'jsa5@mail.com',
                'name' => 'Student 5',
                'age' => 5,
                'address' => 'Jl. Ngagel 5',
                'university' => 'Kampoes 5',
                'faculty' => 'Teknik',
                'major' => 'Informatika',
                'phone' => '123',
                'line_id' => 'line/jsa',
                'ig_link' => 'ig/jsa',
                'linkedIn_link' => 'linkend-in/jsa5',
                'status' => 1
            ]
        ];

        foreach ($seeds as $key => $seeds) {
            StudentAmbassador::create($seeds);
        }
    }
}
