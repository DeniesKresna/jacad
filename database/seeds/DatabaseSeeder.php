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
            MentorsTableSeeder::class,
            BlogsTableSeeder::class,
            AcademiesTableSeeder::class,
            AcademyPeriodsTableSeeder::class,
            AskCareersTableSeeder::class,
            //MentoringTableSeeder::class,
            JobsTableSeeder::class,
            //StudentAmbassadorsTableSeeder::class
            TagsTableSeeder::class,
            CategoriesTableSeeder::class,
            SectorsTableSeeder::class,
            LocationsTableSeeder::class,
            CouponsTableSeeder::class
        ]);
    }
}
