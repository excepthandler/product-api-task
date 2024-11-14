<?php

namespace App\Controller;

use App\Application\Product\DiscountService;
use App\Application\Product\DTO\ProductDTO;
use App\Application\Product\ProductService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class ProductController extends AbstractController
{
    public function __construct(
        private readonly ProductService $productService,
        private readonly DiscountService $discountService,
    ) {
    }

    /**
     * @throws Exception
     */
    #[Route('/products', name: 'get_products', methods: ['GET'])]
    public function get(Request $request): JsonResponse
    {
        $category = $request->query->get('category');
        $products = array_slice($this->productService->getProducts($category), 0, 5); // Must return at most 5 elements.
        $productsDTO = [];

        foreach ($products as $product) {
            $this->discountService->applyBestDiscount($product);

            $productsDTO[] = new ProductDTO($product);
        }

        return $this->json($productsDTO);
    }
}