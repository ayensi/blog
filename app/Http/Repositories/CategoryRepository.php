<?php

namespace App\Http\Repositories;

use App\Models\Category;

class CategoryRepository
{
    public function all(){
        return Category::all();
    }
    public function findById($id){
        return Category::find($id);
    }
    public function new($request){
        $category = new Category();
        $category->category_name = $request->name;
        if($request->isSubCategory != null)
            if($request->isSubCategory!=false){
                $category->parent_id = $request->parentCategory;
            }
        $category->save();
    }
    public function update($request){
        $category = Category::find($request->id);

        $category->category_name = $request->name;

        $category->save();
    }
    public function destroy($id){
        $category = Category::find($id);
        $category->delete();
    }
}
