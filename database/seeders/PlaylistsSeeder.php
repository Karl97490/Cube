<?php

namespace Database\Seeders;

use App\Models\Playlist;
use Illuminate\Database\Seeder;

class PlaylistsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seedPlaylist = [
            [
                'id'=>1,
                'name'=>'Work',
                'user_id'=>1,
                'tracks'=>[1,2],
                'isPrivate'=>'True',
            ],
        ];
        foreach($seedPlaylist as $seed){
            $newPlaylistData = [
                'id'=>$seed['id'],
                'name'=>$seed['name'],
                'user_id'=>$seed['user_id'],
                'isPrivate'=>$seed['isPrivate'],
            ];
            $newPlaylist = Playlist::create($newPlaylistData);
            $tracks = $seed['tracks'];
            $newPlaylist->tracks()->attach($tracks);

        }
    }
}
