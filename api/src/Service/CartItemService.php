<?php

namespace App\Service;

use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;


use App\Entity\Cart;
use App\Entity\CartItem;

use App\Repository\CartItemRepository;

use App\Models\AddToCartArgs;



class CartItemService
{
    public function __construct(
        private CartItemRepository $cartItemRepository,
        private EntityManagerInterface $entityManager
    ) {}


    public function readOrSetCartItems(string $cartId, AddToCartArgs $addedItem): array
    {        
        $existingItems = $this->cartItemRepository->findByProductId($addedItem->productId);

        if ($existingItems) {
            $existingItem = $existingItems[0];
            $existingItem->setQuantity($existingItem->getQuantity() + (int)$addedItem->quantity);
            $this->cartItemRepository->save($existingItem);

            $cartItems = $this->cartItemRepository->findByCartId($cartId);

            return $cartItems;
        }

        $cartItem = new CartItem();
        $cartItemId = Uuid::uuid7()->toString();
        $cartItem->setId($cartItemId);
        $cartItem->setCartId($cartId);
        $cartItem->setProductId($addedItem->productId);
        $cartItem->setQuantity((int)$addedItem->quantity);
        $this->cartItemRepository->save($cartItem);

        $cartItems = $this->cartItemRepository->findByCartId($cartId);

        return $cartItems;
    }
}
