<?php

namespace App\Models;

use OpenApi\Attributes as OA;
use Symfony\Component\Serializer\Annotation\Groups;

class AddToCartArgs
{
    public string $productId;
    public string $quantity;
    public string $size;
}