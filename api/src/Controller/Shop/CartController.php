<?php

namespace App\Controller\Shop;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use Nelmio\ApiDocBundle\Attribute\Model;
use OpenApi\Attributes as OA;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use App\Service\CookieService;
use App\Service\CartService;
use App\Entity\CartItem;
use App\Models\AddToCartArgs;



#[Route('shop/cart')]
class CartController extends AbstractController
{
    private CookieService $cookieService;
    private CartService $cartService;

    public function __construct(CookieService $cookieService, CartService $cartService)
    {
        $this->cookieService = $cookieService;
        $this->cartService = $cartService;
    }

    #[Route('/add', name: 'add-to-cart', methods: ['POST'])]
    #[OA\RequestBody(
        description: 'Cart item to add',
        required: true,
        content: new OA\JsonContent(ref: new Model(type: AddToCartArgs::class))
    )]
    #[OA\Response(
        response: 200,
        description: 'Adds a product to the cart and returns the updated cart items',
        content: new OA\JsonContent(
            type: 'object',
            properties: [
                new OA\Property(property: 'message', type: 'string'),
                new OA\Property(property: 'cartItems', type: 'array', items: new OA\Items(
                    type: 'object',
                    properties: [
                        new OA\Property(property: 'id', type: 'string'),
                        new OA\Property(property: 'productId', type: 'string'),
                        new OA\Property(property: 'quantity', type: 'integer'),
                    ]
                )),
            ]
        )
    )]
    public function addToCart(Request $request, #[MapRequestPayload] AddToCartArgs $args): JsonResponse
    {
        $response = $this->cookieService->readOrSetCookie($request);
        $sessionId = $response->headers->getCookies()[0]->getValue();

        $cartItems = $this->cartService->readOrSetCart($sessionId, $args);

        $items = array_map(fn($i) => [
            'id' => $i->getId(),
            'productId' => $i->getProductId(),
            'quantity' => $i->getQuantity(),
        ], $cartItems);

        $response->setData(['message' => 'Cart created', 'cartItems' => $items]);

        return $response;
    }

    #[Route('/test', name: 'test-filling', methods: ['POST'])]
    public function testFilling(Request $request, #[MapRequestPayload] AddToCartArgs $args): JsonResponse
    {
        $response = $this->cookieService->readOrSetCookie($request);
        
        $response->setData(['message' => 'Cart created', 'providedArgs' => $args]);

        return $response;
    }
}
