<?php

namespace App\Helpers\Profile;

use App\Models\Profile;
use App\Models\Watchlist;

class ProfileOwnsThisWatchlist
{
    public static function check(Profile $profile, Watchlist $watchlist)
    {
        return $watchlist->profile == $profile;
    }
}
