<?php

namespace App\Services;

use App\Repositories\CategoryRepository;

class CategoryServices
{
    private $categoryRepository;

    public function __construct
    (
        CategoryRepository $categoryRepository
    )
    {
        $this->categoryRepository = $categoryRepository;
    }
    public function getAll(array $fields)
    {
        return $this->categoryRepository->getAll($fields);
    }
    public function getById(int $id, array $fields)
    {
        return $this->categoryRepository->getById($id, $fields ?? ['*']);
    }
    public function create(array $data)
    {
        if (isset($data['photo']) && $data['photo'] instanceof UploadedFile)
        {
            $data['photo'] = $this->uploadPhoto($data['photo']);
        }
        return $this->categoryRepository->create($data);
    }

    public function update(int $id, array $data)
    {
        $fields = ['id', 'photo'];
        $category = $this->categoryRepository->getById($id, $fields);

        if (isset($data['photo']) && $data['photo'] instanceof UploadedFile)
        {
            if (!empty($category->photo))
            {
                $this->deletePhoto($category->photo);
            }
           $data['photo'] = $this->uploadPhoto($data['photo']);
        }
        return $this->categoryRepository->update($id, $data);
    }

    public function delete(int $id)
    {
        $fields = ['id', 'photo'];

        $category = $this->categoryRepository->getById($id, $fields);
        if ($category->photo)
        {
            $this-->deletePhoto($category->photo);
        }
        $this->categoryRepository->delete($id);
    }

    private function deletePhoto(string $photoPath)
    {
        return $photo->store('categories', 'public');
    }

    private function deletePhoto(string $photoPath)
    {
        $relativePath = 'categoris/' . basename($photoPath);
        if (Storage::disk('public')->exists($relativePath)) {
            Storage::disk('public')->delete($relativePath);
        }
    }
}
