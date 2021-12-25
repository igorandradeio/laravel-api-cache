<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    protected $entity;

    public function __construct(Category $category)
    {
        $this->entity = $category;
    }

    public function getAllCategories()
    {
        return $this->entity->get();
    }

    public function createNewCategory(array $data)
    {
        return $this->entity->create($data);
    }

    public function getCategoryByUuid(string $uuid)
    {
        return $this->entity->where('uuid', $uuid)->firstOrFail();
    }

    public function deleteCategoryByUuid(string $uuid)
    {
        $category = $this->getCategoryByUuid($uuid);

        return $category->delete();
    }

    public function updateCategoryByUuid(string $uuid, array $data)
    {
        $category = $this->getCategoryByUuid($uuid);

        return $category->update($data);
    }
}
