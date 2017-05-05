<?php

namespace App\Policies;

use App\User;
use App\Feed;
use Illuminate\Auth\Access\HandlesAuthorization;

class FeedPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the feed.
     *
     * @param  \App\User  $user
     * @param  \App\Feed  $feed
     * @return mixed
     */
    public function update(User $user, Feed $feed)
    {
        return $user->id === $feed->author_id;
    }

}
