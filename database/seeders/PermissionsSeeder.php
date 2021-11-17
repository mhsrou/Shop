<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Support\Facades\Hash;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $role_super_admin = Role::create(['name' => 'super_admin']);

        /**
         * @var $role_admin Role
         */

        $role_admin = Role::create(['name' => 'admin']);

        /**
         * @var $role_writer Role
         */

        $role_writer = Role::create(['name' => 'writer']);

        /**
         * @var $role_shop_owner Role
         */

        $role_shop_owner = Role::create(['name' => 'shop_owner']);

        /**
         * @var $role_customer Role
         */

        $role_customer = Role::create(['name' => 'customer']);


        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'delete users']);

        Permission::create(['name' => 'create products']);
        Permission::create(['name' => 'edit products']);
        Permission::create(['name' => 'delete products']);
        Permission::create(['name' => 'publish products']);

        $role_admin->givePermissionTo('create users');
        $role_admin->givePermissionTo('edit users');
        $role_admin->givePermissionTo('delete users');
        $role_admin->givePermissionTo('publish products');
        $role_admin->givePermissionTo('create products');
        $role_admin->givePermissionTo('delete products');
        $role_admin->givePermissionTo('edit products');

        $role_writer->givePermissionTo('edit products');
        $role_writer->givePermissionTo('delete products');

        $role_shop_owner->givePermissionTo('create products');

        /**
         * @var $user User
         */

        $user = User::create([
            'name' => 'Super Admin',
            'email' => 'super_admin@example.com',
            'password' => Hash::make('12345678'),
        ]);

        $user->assignRole($role_super_admin);


        $user2 = User::create([
            'name' => 'Super Writer',
            'email' => 'super_writer@example.com',
            'password' => Hash::make('12345678'),
        ]);

        $user2->assignRole($role_writer);

        $users = User::factory()
            ->count(10)
            ->create();

        foreach($users as $user) {
            $user->assignRole($role_customer);
        }
    }
}
