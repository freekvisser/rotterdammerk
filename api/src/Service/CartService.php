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

use App\Repository\CartRepository;

use App\Service\CartItemService;
use App\Models\AddToCartArgs;


class CartService
{
    public function __construct(
        private CartRepository $cartRepository,
        private CartItemService $cartItemService,
        private EntityManagerInterface $entityManager
    ) {}


    public function readOrSetCart(string $sessionId, AddToCartArgs $args): array
    {
        $cart = $this->cartRepository->getBySessionId($sessionId);

        if (!$cart) {
            $cart = new Cart();
            $cartId = Uuid::uuid7()->toString();
            $cart->setId($cartId);
            $cart->setSessionId($sessionId);
            $cart->setCreated(new \DateTime());
            $cart->setExpiresAt((new \DateTime())->modify('+30 minutes'));
            $this->cartRepository->save($cart);
        }

        //MOCK AREA
        $cartItems = $this->cartItemService->readOrSetCartItems($cart->getId(), $args);


        return $cartItems;
    }
}
