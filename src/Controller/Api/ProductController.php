<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\Uuid;

use App\Service\ProductService;


#[Route('/products')]
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
}
