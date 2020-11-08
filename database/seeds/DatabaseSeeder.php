<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            ProfilesTableSeeder::class,
            RolesTableSeeder::class, 
            RoleUserTableSeeder::class,
            CompaniesTableSeeder::class,
            JobsTableSeeder::class,
            SectorsTableSeeder::class,
            JobSectorTableSeeder::class,
            CategoriesTableSeeder::class,
            AcademiesTableSeeder::class,
            AskCareersTableSeeder::class
        ]);
    }
}
