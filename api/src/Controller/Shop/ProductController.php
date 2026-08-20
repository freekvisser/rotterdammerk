<?php

namespace App\Controller\Shop;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use Nelmio\ApiDocBundle\Attribute\Model;
use OpenApi\Attributes as OA;
use Ramsey\Uuid\Uuid;

use App\Service\ProductService;
use App\Entity\Product; 


#[Route('shop/products')]
class ProductController extends AbstractController
{
    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }


    #[Route('/find/{id}', name: 'products_find', methods: ['GET'])]
    public function show(EntityManagerInterface $entityManager, string $id): JsonResponse
    {
        $product = $this->productService->findProductById($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        return $this->json([
            'id' => $product->getId(),
            'name' => $product->getName(),
            'description' => $product->getDescription(),
        ]);
    }
    #[Route('/listall', name: 'products_all', methods: ['GET'])]
    #[OA\Response(
        response: 200,
        description: 'Returns all list of all stored products',
        content: new OA\JsonContent(
            type: 'array',
            items: new OA\Items(ref: new Model(type: Product::class))
        )
    )]
    public function listAll(EntityManagerInterface $entityManager): JsonResponse
    {
        $products = $this->productService->getAllProducts();

        return $this->json($products);
    }
}
