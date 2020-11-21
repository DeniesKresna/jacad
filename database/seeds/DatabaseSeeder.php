<?php

use App\Models\AcademyRegistrant;
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
            CategoriesTableSeeder::class,
            TagsTableSeeder::class,
            BlogsTableSeeder::class,
            BlogTagTableSeeder::class,
            LocationsTableSeeder::class,
            JobsTableSeeder::class,
            SectorsTableSeeder::class,
            JobSectorTableSeeder::class,
            AcademiesTableSeeder::class,
            AcademyTagTableSeeder::class,
            AcademyRegistrantsTableSeeder::class,
            AskCareersTableSeeder::class,
            StudentAmbassadorsTableSeeder::class
        ]);
    }
}
