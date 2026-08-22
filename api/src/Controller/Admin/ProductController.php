<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Nelmio\ApiDocBundle\Attribute\Model;
use OpenApi\Attributes as OA;

use App\Entity\Product;
use App\Service\ProductService;

#[Route('/admin/product')]
class ProductController extends AbstractController
{
    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
    
    #[Route('/create', name: 'product_create', methods: ['GET'])]
    public function createProduct(): JsonResponse
    {
        $productId = $this->productService->createProduct();

        return $this->json(['id' => $productId]);
    }

    #[Route('/edit', name: 'product_edit', methods: ['POST'])]
    #[OA\RequestBody(
        description: 'Product object to edit',
        required: true,
        content: new OA\JsonContent(
            ref: new Model(type: Product::class)
        )
    )]
    #[OA\Response(
        response: 200,
        description: 'Returns status of the edit operation',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'success', type: 'boolean', example: true)
            ]
        )
    )]
    public function editProduct(
        #[MapRequestPayload] Product $product
    ): JsonResponse {
        $success = $this->productService->editProduct($product);

        return $this->json(['success' => $success]);
    }


    #[Route('/findall', name: 'product_findall', methods: ['GET'])]
    #[OA\Response(
        response: 200,
        description: 'Returns all list of all stored products',
        content: new OA\JsonContent(
            type: 'array',
            items: new OA\Items(ref: new Model(type: Product::class))
        )
    )]
    public function findAllProducts(): JsonResponse
    {
        $products = $this->productService->getAllProducts();

        return $this->json($products);
    }
}
