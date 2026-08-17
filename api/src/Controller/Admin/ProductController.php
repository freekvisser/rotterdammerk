<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Nelmio\ApiDocBundle\Attribute\Model;
use OpenApi\Attributes as OA;


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

    #[Route('/findall', name: 'product_findall', methods: ['GET'])]
    public function findAllProducts(): JsonResponse
    {
        $products = $this->productService->getAllProducts();

        $productData = array_map(function ($product) {
            return [
                'id' => $product->getId(),
                'name' => $product->getName(),
                'description' => $product->getDescription(),
            ];
        }, $products);

        return $this->json($productData);
    }
}
