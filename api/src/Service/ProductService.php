<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\Uuid;

use App\Repository\ProductRepository;
use App\Repository\StockRepository;
use App\Entity\Product;
use App\Entity\Stock;


class ProductService
{
    public function __construct(
        private ProductRepository $productRepository,
        private StockRepository $stockRepository,
        private EntityManagerInterface $entityManager
    ) {
    }

    public function findProductById($id)
    {
        return $this->productRepository->find($id);
    }

    public function createProduct(){
        $productId = Uuid::uuid7()->toString();

        $product = new Product();
        $product->setId($productId);
        $product->setName('Heavyweight Tee');
        $product->setDescription('A heavy t-shirt for heavy people');

        $stock = new Stock();
        $stock->setProductId($productId);
        $stock->setAmount(100);

        $this->entityManager->persist($product);
        $this->entityManager->persist($stock);
        $this->entityManager->flush();

        return $productId;
    }
}
