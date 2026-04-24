<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\SearchProducts;
use App\Data\Inertia\CategoryData;
use App\Data\Inertia\ProductPreviewData;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Response;

final class ProductSearchController extends Controller
{
    public function __invoke(Request $request): Response
    {
        $products = app(SearchProducts::class)->handle(
            query: $request->query('q', ''),
            categoryId: $request->query('category'),
        );

        return inertia('Product/Search', [
            'products'   => inertia()->scroll(fn () => ProductPreviewData::collect($products)),
            'categories' => fn () => CategoryData::collect(Category::all()),
        ]);
    }
}
