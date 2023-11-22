<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Discounts;
use App\Models\MaterialCategory;
use App\Models\MaterialStok;
use App\Models\Type;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $user = User::factory()->create([
            'name' => 'Admin',
            'phone' => '+998941050405',
        ]);

        $user1 = User::factory()->create([
            'name' => 'Hr',
            'phone' => '+998941050406',
        ]);
        Role::create(['name' => 'super_admin']);
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'bugalter']);
        Role::create(['name' => 'kassir']);
        Role::create(['name' => 'ishlab_chiqaruvchi']);
        Role::create(['name' => 'hr']);
        Role::create(['name' => 'logist_manager']);
        Role::create(['name' => 'sklad_manager']);
        Role::create(['name' => 'sotuv_manager']);

        // User
        Permission::create(['name' => 'user.list']);
        Permission::create(['name' => 'user.show']);
        Permission::create(['name' => 'user.create']);
        Permission::create(['name' => 'user.update']);
        Permission::create(['name' => 'user.delete']);

        // Customer
        Permission::create(['name' => 'customer.list']);
        Permission::create(['name' => 'customer.show']);
        Permission::create(['name' => 'customer.create']);
        Permission::create(['name' => 'customer.update']);
        Permission::create(['name' => 'customer.delete']);

        // Firms
        Permission::create(['name' => 'firms.list']);
        Permission::create(['name' => 'firms.show']);
        Permission::create(['name' => 'firms.create']);
        Permission::create(['name' => 'firms.update']);
        Permission::create(['name' => 'firms.delete']);

        Type::create(['name' => 'Avans']);
        Type::create(['name' => 'Oylik']);
        Type::create(['name' => 'KPI']);
        Type::create(['name' => 'Boshqa']);

        Unit::create(['name' => 'T']);
        Unit::create(['name' => 'KG']);
        Unit::create(['name' => 'GR']);
        Unit::create(['name' => 'M']);
        Unit::create(['name' => 'SM']);
        Unit::create(['name' => 'MM']);

        // Material_Category



        $user->assignRole('super_admin');
        $user->assignRole('admin');
        $user->assignRole('bugalter');
        $user->assignRole('kassir');
        $user->assignRole('ishlab_chiqaruvchi');
        $user->assignRole('hr');
        $user->assignRole('logist_manager');
        $user->assignRole('sklad_manager');
        $user->assignRole('sotuv_manager');

        $user1->assignRole('super_admin');
        $user1->assignRole('admin');
        $user1->assignRole('bugalter');
        $user1->assignRole('kassir');
        $user1->assignRole('ishlab_chiqaruvchi');
        $user1->assignRole('hr');
        $user1->assignRole('logist_manager');
        $user1->assignRole('sklad_manager');
        $user1->assignRole('sotuv_manager');

        $permissions = Permission::all();
        $user->syncPermissions($permissions);

        MaterialStok::create([
            'name' => 'Ombor 1',
            'user_id' => 2,
            'status' => 1,
        ]);
        $user1->syncPermissions($permissions);
        
        Discounts::create(['name' => '10']);
        Discounts::create(['name' => '20']);
        Discounts::create(['name' => '30']);
        Discounts::create(['name' => '30']);
    }
}
