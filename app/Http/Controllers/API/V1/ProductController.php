<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\Product\CreateRequest;
use App\Http\Requests\API\V1\Product\DeleteRequest;
use App\Http\Requests\API\V1\Product\GetRequest;
use App\Http\Requests\API\V1\Product\IndexRequest;
use App\Http\Requests\API\V1\Product\UpdateRequest;
use App\Http\Resources\API\V1\Product\ProductResource;
use App\Models\Product;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class ProductController extends Controller
{

    /**
     * Get all products.
     *
     * @param IndexRequest $request
     * @return AnonymousResourceCollection
     */
    public function index(IndexRequest $request): AnonymousResourceCollection
    {
        return ProductResource::collection(Product::paginate());
    }

    /**
     * Creates a product.
     *
     * @param CreateRequest $request
     * @return ProductResource
     */
    public function create(CreateRequest $request): ProductResource
    {
        return new ProductResource(Product::create($request->validated()));
    }

    /**
     * Get a product by ID.
     *
     * @param GetRequest $request
     * @return ProductResource
     */
    public function get(GetRequest $request): ProductResource
    {
        return new ProductResource(Product::find($request['id']));
    }

    /**
     * Updates a product by ID.
     *
     * @param UpdateRequest $request
     * @return ProductResource
     */
    public function update(UpdateRequest $request): ProductResource
    {
        return new ProductResource(Product::updateOrCreate([
            'id' => $request['id'],
        ], $request->validated()));
    }

    /**
     * Deletes a product by ID.
     *
     * @param DeleteRequest $request
     * @return Response
     */
    public function delete(DeleteRequest $request): Response
    {
        Product::find($request['id'])->destroy();
        return response()->noContent();
    }
}