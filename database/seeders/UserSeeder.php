<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seedAdminUsers= [
            [
                'id'=>1,
                'name'=>'Ad Ministrator',
                'email'=>'admin@example.com',
                'email_verified_at'=>now(),
                'password'=>Hash::make('Password1'),
                'created_at'=>now(),
                'timezone'=>'Australia/Perth',
            ],
            [
                'id'=>5,
                'name'=>'Karl Pery',
                'email'=>'karl@example.com',
                'email_verified_at'=>now(),
                'password'=>Hash::make('Password1'),
                'created_at'=>now(),
                'timezone'=>'Australia/Perth',
            ],
            ];
        $role = Role::findByName('admin');
        $permissions = Permission::pluck('id','id')->all(); //Giving all permissions to admin user
        $role->syncPermissions($permissions);
        foreach($seedAdminUsers as $seedAdminUser){
            $user = User::create($seedAdminUser);
            $user->assignRole($role);
        }

        $seedManagerUser =
            [
                'id'=>6,
                'name'=>'Adrian Gould',
                'email'=>'adrian.gould@example.com',
                'email_verified_at'=>now(),
                'password'=>Hash::make('Password1'),
                'created_at'=>now(),
                'timezone'=>'Australia/Perth',
            ];

        $managerPermissionList = [
            'user-list',
            'user-delete',
            'user-edit',
            'track-list',
            'track-edit',
            'track-create',
            'track-delete',
            'genre-list',
            'genre-edit',
            'genre-create',
            'genre-delete',
            'playlist-list',
            'playlist-create',
            'playlist-edit',
            'playlist-delete',
        ];
        $permissions = Permission::all()
            ->whereIn('name', $managerPermissionList)
            ->pluck('id','id');
        $role = Role::findByName('manager');
        $role->syncPermissions($permissions);
        $user = User::create($seedManagerUser);
        $user->assignRole($role);


        $seedAstroUsers = [
            [
                'id'=>10,
                'name'=>'Eileen Dover',
                'email'=>'eileen.dover@example.com',
                'email_verified_at'=>now(),
                'password'=>Hash::make('Password1'),
                'created_at'=>now(),
                'timezone'=>'Australia/Perth',
            ],
            [
                'id'=>11,
                'name'=>"Jacque d'Carre",
                'email'=>'jacques.dcarre@example.com',
                'email_verified_at'=>now(),
                'password'=>Hash::make('Password1'),
                'created_at'=>now(),
                'timezone'=>'Australia/Perth',
            ],
            [
                'id'=>12,
                'name'=>"Russell Leaves",
                'email'=>'russell.leaves@example.com',
                'email_verified_at'=>now(),
                'password'=>Hash::make('Password1'),
                'created_at'=>now(),
                'timezone'=>'Australia/Perth',
            ],
            [
                'id'=>13,
                'name'=>"Iavana Vinn",
                'email'=>'ivanna.vinn@example.com',
                'email_verified_at'=>now(),
                'password'=>Hash::make('Password1'),
                'created_at'=>now(),
                'timezone'=>'Australia/Perth',
            ],
            [
                'id'=>14,
                'name'=>"Win Doh",
                'email'=>'wind.doh@example.com',
                'email_verified_at'=>now(),
                'password'=>Hash::make('Password1'),
                'created_at'=>now(),
                'timezone'=>'Australia/Perth',
            ],
        ];

        $permissionAstroUser = [
            'playlist-list',
            'playlist-create',
            'playlist-edit',
            'playlist-delete',
            'user-list',
            'user-edit',
        ];

        $role = Role::findByName('astronaut');
        $permissions = Permission::all()
            ->whereIn('name',$permissionAstroUser)
            ->pluck('id','id');
        $role->syncPermissions($permissions);
        foreach ($seedAstroUsers as $astroUser){
            $user = User::create($astroUser);
            $user->assignRole($role);
        }
    }
}
