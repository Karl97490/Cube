<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class PlaylistsTracks extends Pivot
{
    protected $table = 'playlists_tracks';
    
}
