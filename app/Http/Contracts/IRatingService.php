<?php

namespace App\Http\Contracts;

interface IRatingService
{
    public function rate($id,$rating);
}
