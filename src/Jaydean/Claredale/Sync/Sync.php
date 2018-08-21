<?php

namespace Jaydean\Claredale\Sync;

use Jaydean\Claredale\Sync\Objects\Category;
use Jaydean\Claredale\Sync\Objects\Product;
use Jaydean\Claredale\Sync\Objects\Brand;
use Jaydean\Claredale\Sync\Objects\Manufacturer;

use GuzzleHttp\Client;

class Sync
{

    private $endpoint = 'http://sync.claredale.com.au/json';

    private $token;

    /**
     * @var \Jaydean\Claredale\Sync\EventManager
     */
    private $eventManager;

    /**
     * @param string $token
     * @param \Jaydean\Claredale\Sync\EventManager $eventManager
     */
    public function __construct($token, &$eventManager)
    {
        $this->setToken($token);
        $this->eventManager = $eventManager;
    }

    /**
     * @returns array
     * @throws \Exception
     */
    public function start()
    {
        if ($this->token === null) {
            throw new \BadMethodCallException('$token must be a string');
        }

        $client = new Client();

        /**
         * @var \GuzzleHttp\Message\Response $response
         */
        $response = $client->request('GET', $this->endpoint, [
            'query' => ['token' => $this->token]
        ]);

        if ($response->getStatusCode() == 200) {
            $content = $response->getBody()->getContents();
            $data = json_decode($content, true);
            return $this->parseData($data);
        } else {
            throw new \Exception('Invalid status code given', 404);
        }
    }

    private function parseData($data)
    {
        if (!is_array($data)) {
            throw new \BadMethodCallException('$data must be an array');
        }

        $categoryCache = [];
        $brandCache = [];
        $manufacturerCache = [];

        $products = $data['products'];
        foreach ($products as $product) {
            if (!isset($categoryCache[$product['categoryId']])) {
                $categoryCache[$product['categoryId']] = new Category($product['categoryId'], $product['categoryName']);
                $this->eventManager->dispatchEvent('getCategory', [$categoryCache[$product['categoryId']]]);
            }

            if (isset($categoryCache[$product['subCategoryId']])) {
                $category = $categoryCache[$product['subCategoryId']];
            } else {
                $category = new Category(
                    $product['subCategoryId'],
                    $product['subCategoryName'],
                    $categoryCache[$product['categoryId']]
                );
                $categoryCache[$product['subCategoryId']] = $category;
                $this->eventManager->dispatchEvent('getCategory', [$category]);
            }

            if (!isset($brandCache[$product['brandId']])) {
                $brandCache[$product['brandId']] = new Brand($product['brandId'], $product['brandName'], $product['manufacturerId']);
                $this->eventManager->dispatchEvent('getBrand', [$brandCache[$product['brandId']]]);
            }

            if (!isset($manufacturerCache[$product['manufacturerId']])) {
                $manufacturerCache[$product['manufacturerId']] = new Manufacturer(
                    $product['manufacturerId'],
                    $product['manufacturerName']
                );
                $this->eventManager->dispatchEvent('getManufacturer', [$manufacturerCache[$product['manufacturerId']]]);
            }

            $product['category'] = $category;
            $product['brand'] = $brandCache[$product['brandId']];
            $product['manufacturer'] = $manufacturerCache[$product['manufacturerId']];
            $productObject = new Product($product);

            $this->eventManager->dispatchEvent('getProduct', [$productObject]);
        }

        return $products;
    }

    /**
     * @param string $token
     */
    public function setToken($token)
    {
        if (!is_string($token)) {
            throw new \BadMethodCallException('$token must be a string');
        }
        $this->token = $token;
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param string $endpoint
     */
    public function setEndpoint($endpoint)
    {
        if (!is_string($endpoint)) {
            throw new \BadMethodCallException('$endpoint must be a string');
        }
        $this->endpoint = $endpoint;
    }

    /**
     * @return string
     */
    public function getEndpoint()
    {
        return $this->endpoint;
    }
}
