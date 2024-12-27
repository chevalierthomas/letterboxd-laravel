<?php

namespace App\Policies;

use App\Models\Review;
use App\Models\User;

class ReviewPolicy
{
    /**
     * Détermine si l'utilisateur peut mettre à jour une critique.
     */
    public function update(User $user, Review $review)
    {
        // L'utilisateur peut mettre à jour sa propre critique uniquement.
        return $user->id === $review->user_id;
    }
}
