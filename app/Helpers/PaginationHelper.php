<?php

namespace App\Helpers;

use Illuminate\Pagination\LengthAwarePaginator;

class PaginationHelper
{
    public static function paginate($data, $perPage = 10)
    {
        $collection = collect($data);

        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        $currentItems = $collection->slice(
            ($currentPage - 1) * $perPage,
            $perPage
        )->values();

        return new LengthAwarePaginator(
            $currentItems,
            $collection->count(),
            $perPage,
            $currentPage,
            [
                'path' => request()->url(),
                'query' => request()->query(),
            ]
        );
    }
}