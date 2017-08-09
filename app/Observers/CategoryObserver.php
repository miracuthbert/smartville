<?php

namespace App\Observers;


use App\Models\v1\Shared\Category;

class CategoryObserver
{
    /**
     * Listen to the Category creating event.
     *
     * @param Category $category
     */
    public function creating(Category $category)
    {
        $prefix = $category->parent == 1 ? '' : $category->categorable->title . ' ';
        $category->slug = str_slug($prefix . $category->title);
    }
}