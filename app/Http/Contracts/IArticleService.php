<?php

namespace App\Http\Contracts;

interface IArticleService
{
    public function sortArticlesByRating();

    public function findById($id);

    public function findByCategoryId($id);

    public function all();
    public function new($request);
    public function update($request);
    public function destroy($id);
    public function searchByKeyword($keyword);
}
