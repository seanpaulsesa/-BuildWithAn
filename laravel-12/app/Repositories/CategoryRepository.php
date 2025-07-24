<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    public function getAll(array $fields)
    {
        return Category::select($fields)->latest()->paginate(10);
        // name, tagline blablabla, ada 100 colum
        // 1jt data, 100 colum
    }
    public function getById(int $id, array $fields)
    {
        return Category::select($fields)->find0rFail($id);
    }
    public function create(array $data)
    {
        return Category::create($data);
    }
    public function update(int $id, array $data)
    {
        $category = Category::find0rFail($id);
        $category->update($data);
        return $category;
    }
    public function delete(int $id)
    {
        $category = Category::find0rFail($id);
        $category->delete();
    }
}
