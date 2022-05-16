<?php

namespace App\Http\Repositories;

use App\Models\Rating;

class RatingRepository
{
    public function rate($id,$rating){
        Rating::updateOrCreate(
            ['article_id' => $id, 'user_id' => auth()->id()],
            ['rating' => $rating]
        );
    }
}
