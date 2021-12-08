<?php

namespace App\Services;
use App\Models\Category;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;

class ProductsSearchService
{
    public function search(Request $request, Category $category)
    {
        $query = $category->products()
            ->filterAttributes($request->get('attributes'))
            ->filterVariations($request->get('variations'))
            ->searchName($request->get('name'))
            ->orderByCustom($request->get('sort_by'));

        return $query->get();
    }
}
