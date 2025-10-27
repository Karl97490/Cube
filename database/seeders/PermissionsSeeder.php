<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'track-list',
            'track-create',
            'track-edit',
            'track-delete',
            'playlist-list',
            'playlist-create',
            'playlist-edit',
            'playlist-delete',
            'genre-list',
            'genre-create',
            'genre-edit',
            'genre-delete',
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission],
            );
        }
    }
}
