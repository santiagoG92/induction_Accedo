<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleAndPermissionSeeder extends Seeder
{

    public function run()
    {
        $permissionsLibrarian = [
			'books.index',
			'books.show',
			'books.store',
			'books.update',
			'books.destroy',
			'categories.index',
			'categories.get-all',
			'categories.show',
			'categories.store',
			'categories.edit',
			'categories.update',
			'categories.destroy',
		];
		$permissionsAdmin = array_merge([
			'users.index',
			'users.create',
			'users.store',
			'users.edit',
			'users.update',
			'users.destroy',
		], $permissionsLibrarian);

       $admin= Role::create(['name' => 'admin']);
        $librarian=Role::create(['name' => 'librarian']);
        Role::create(['name' => 'user']);

        foreach ($permissionsAdmin as $permission) {
			$permission = Permission::create(['name' => $permission]);
			$admin->givePermissionTo($permission);
        }
        foreach ($permissionsLibrarian as $permission) {
			$permission = Permission::where(['name' => $permission])->first();
			$librarian->givePermissionTo($permission);
         }
}
}

