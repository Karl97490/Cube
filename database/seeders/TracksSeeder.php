<?php

namespace Database\Seeders;

use App\Models\Track;
use Illuminate\Database\Seeder;

class TracksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seedTracks = [
            [
                'id'=>1,
                'artist'=>'Jean Michel Jarre',
                'album'=>'Oxygene',
                'genre'=>'Electronic',
                'name'=>'Oxygene(Part I)',
                'length'=>7.39,
                'year'=>'1977',
            ],
            [
                'id'=>2,
                'artist'=>'AllttA',
                'album'=>'Facing Giants',
                'genre'=>'Hip Hop',
                'name'=>'More Better (fg. II) [feat. 20syl & Mr. J Medeiros]',
                'length'=>2.57,
                'year'=>'1977',
            ],
            [
                'id'=>3,
                'artist'=>'Tangerine Dream',
                'album'=>'Rubycon',
                'genre'=>'Electronic',
                'name'=>'Rubycon, Part I',
                'length'=>17.19,
                'year'=>'1975',
            ],
        ];
        foreach ($seedTracks as $seed){
            Track::create($seed);
        }
    }
}
