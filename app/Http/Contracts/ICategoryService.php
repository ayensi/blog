<?php

namespace App\Http\Contracts;

interface ICategoryService
{
    public function findById($id);
    public function all();
    public function new($request);
    public function update($request);
    public function destroy($id);
}
