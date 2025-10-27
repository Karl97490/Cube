<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    use HasFactory;
    protected $fillable = [
        'artist',
        'album',
        'genre',
        'name',
        'length',
        'year',
    ];

    public function playlist(){
        return $this->belongsToMany(Playlist::class, 'playlists_tracks', 'track_id',
        'playlist_id');
    }
}
