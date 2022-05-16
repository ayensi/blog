<?php

namespace App\Http\Services;

use App\Http\Contracts\IRatingService;
use App\Http\Repositories\RatingRepository;

class RatingService implements IRatingService
{
    private $ratingRepository;

    public function __construct(RatingRepository $ratingRepository)
    {
        $this->ratingRepository = $ratingRepository;
    }

    public function rate($id,$rating)
    {
        $this->ratingRepository->rate($id,$rating);
    }
}
