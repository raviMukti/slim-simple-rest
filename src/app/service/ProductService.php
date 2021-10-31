<?php

namespace Api\service;

use Api\repository\ProductRepository;
use Exception;
use Psr\Container\ContainerInterface;
use Slim\Container;
use Slim\Http\Message;

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
            "productQuantity" => $productInfo["qty"]
        );

        try{
            $id = $productRepository->save($rawProduct);
            return $productRepository->findById($id);
        }catch(Exception $e)
        {
            return $e->getMessage();
        }
    }

    function findById(int $id)
    {
        /** @var ProductRepository $productRepository */
        $productRepository = $this->container->get('ProductRepository');

        try {
            return $productRepository->findById($id);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    

    function deleteById(int $id)
    {
        /** @var ProductRepository $productRepository */
        $productRepository = $this->container->get('ProductRepository');

        try {
            return $productRepository->delete($id);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function findAll()
    {
        /** @var ProductRepository $productRepository */
        $productRepository = $this->container->get('ProductRepository');

        try {
            return $productRepository->findAll();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}