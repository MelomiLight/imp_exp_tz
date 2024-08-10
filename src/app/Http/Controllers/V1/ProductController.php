<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImportExcelRequest;
use App\Http\Resources\ProductsResource;
use App\Imports\ProductsImport;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    private ProductService $service;

    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

    public function importExcel(ImportExcelRequest $request): JsonResponse
    {
        try {
            Excel::import(new ProductsImport(), $request->file('excel'));
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json(['message' => 'success'], Response::HTTP_OK);
    }

    public function index(): AnonymousResourceCollection
    {
        $products = Product::with('additional_info', 'uploads')->paginate(10);

        return ProductsResource::collection($products);
    }

    public function show(Product $product): ProductsResource
    {
        $product->load('additional_info', 'uploads');

        return new ProductsResource($product);
    }
}
