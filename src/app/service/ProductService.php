<?php

namespace Api\service;

use Api\repository\ProductRepository;
use Exception;
use Psr\Container\ContainerInterface;
use Slim\Container;

class ProductService
{
    /** @var Container $container */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    function createProduct(array $productInfo)
    {
        /** @var ProductRepository $productRepository */
        $productRepository = $this->container->get("ProductRepository");

        $rawProduct = array(
            "productName" => $productInfo["name"],
            "productPrice" => $productInfo["price"],
            "productQuantity" => $productInfo["quantity"]
        );

        try{
            $id = $productRepository->save($rawProduct);
            return $productRepository->findById($id);
        }catch(Exception $e)
        {
            return $e->getMessage();
        }
    }
}