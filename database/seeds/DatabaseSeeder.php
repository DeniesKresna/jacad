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
            MentorsTableSeeder::class,
            CompaniesTableSeeder::class,
            TagsTableSeeder::class,
            CategoriesTableSeeder::class,
            SectorsTableSeeder::class,
            LocationsTableSeeder::class,
            BlogsTableSeeder::class,
            BlogTagTableSeeder::class,
            AcademiesTableSeeder::class,
            AcademyTagTableSeeder::class,
            AcademyRegistrantsTableSeeder::class,
            AskCareersTableSeeder::class,
            MentoringTableSeeder::class,
            JobsTableSeeder::class,
            JobSectorTableSeeder::class,
            StudentAmbassadorsTableSeeder::class
        ]);
    }
}
