<?php

namespace App\Models;

use OpenApi\Attributes as OA;
use Symfony\Component\Serializer\Annotation\Groups;

class ProductDto
{
    public function __construct(
        public string $id,
        public string $name,
        public ?string $description = null
    ) {}
}