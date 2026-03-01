<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\SharedAccommodation;
use App\Models\Category;
use App\Models\Membership;
use App\Models\Expense;
use App\Models\Payment;
use App\Models\Invitation;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $adminRole = Role::create(['name' => 'Admin']);
        $userRole = Role::create(['name' => 'Member']);

        User::factory()->create([
            'name' => 'System Admin',
            'email' => 'admin@accommodation.com',
            'password' => bcrypt('Mestry451'),
            'role_id' => $adminRole->id,
        ]);

        User::factory()->create([
            'name' => 'ElMehdi Cherkaoui',
            'email' => 'cherkaouim451@gmail.com',
            'password' => bcrypt('Mestry451'),
            'role_id' => $userRole->id,
        ]);

        $users = User::factory(6)->create([
            'password' => bcrypt('password123'),
            'role_id' => $userRole->id,
        ]);

        $accommodations = SharedAccommodation::factory(3)->create();

        $categories = Category::factory(5)->create([
            'shared_accommodation_id' => $accommodations->first()->id,
        ]);

        Membership::factory(12)->create([
            'user_id' => $users->first()->id,
            'shared_accommodation_id' => $accommodations->first()->id,
        ]);

        $expenses = Expense::factory(20)->create([
            'user_id' => $users->first()->id,
            'shared_accommodation_id' => $accommodations->first()->id,
            'category_id' => $categories->first()->id,
        ]);

        Payment::factory(20)->create([
            'shared_accommodation_id' => $accommodations->first()->id,
            'expense_id' => $expenses->first()->id,
            'receiver_user_id' => $users->first()->id,
        ]);

        Invitation::factory(6)->create([
            'shared_accommodation_id' => $accommodations->first()->id,
        ]);
    }
}
