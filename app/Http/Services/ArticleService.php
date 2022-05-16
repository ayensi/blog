<?php

namespace App\Http\Services;

use App\Http\Contracts\IArticleService;
use App\Http\Repositories\ArticleRepository;

class ArticleService implements IArticleService
{
    private $articleRepository;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function sortArticlesByRating(){
        return $this->articleRepository->sortArticlesByRating();
    }

    public function findById($id)
    {
        return $this->articleRepository->findById($id);
    }

    public function findByCategoryId($id)
    {
        return $this->articleRepository->findByCategoryId($id);
    }
    public function all()
    {
        return $this->articleRepository->all();
    }
    public function new($request)
    {
        $this->articleRepository->new($request);
    }
    public function update($request)
    {
        $this->articleRepository->update($request);
    }
    public function destroy($id)
    {
        $this->articleRepository->destroy($id);
    }

    public function searchByKeyword($keyword)
    {
        return $this->articleRepository->searchByKeyword($keyword);
    }
}
