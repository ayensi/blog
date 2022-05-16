<?php

namespace App\Http\Services;

use App\Http\Contracts\ICategoryService;
use App\Http\Repositories\CategoryRepository;

class CategoryService implements ICategoryService
{
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function all()
    {
        return $this->categoryRepository->all();
    }

    public function findById($id)
    {
        return $this->categoryRepository->findById($id);
    }
    public function new($request)
    {
        $this->categoryRepository->new($request);
    }
    public function update($request)
    {
        $this->categoryRepository->update($request);
    }
    public function destroy($id)
    {
        $this->categoryRepository->destroy($id);
    }
}
