<?php
namespace Src\Controllers;

use Src\Handlers\ProductHandler;

class ProductController {
    const STATUS_CODE_200 = 'HTTP/1.1 200 OK';
    const STATUS_CODE_201 = 'HTTP/1.1 201 Created';
    const STATUS_CODE_204 = 'HTTP/1.1 204 No Content';
    const STATUS_CODE_404 = 'HTTP/1.1 404 Not Found';
    const STATUS_CODE_405 = 'HTTP/1.1 405 Method Not Allowed';
    const STATUS_CODE_422 = 'HTTP/1.1 422 Uprocessable Entity';

    private $db;
    private $requestMethod;
    private $payload;
    private $productHandle;
    
    /**
     * @uses \ProductHandler::__construct()
     */
    public function __construct($db, $requestMethod, $payload) {
        $this->db = $db;
        $this->requestMethod = $requestMethod;
        $this->payload = $payload;

        $this->productHandle = new ProductHandler($db);
    }

    /**
     * Handles All Requests by Methods (GET | POST | DELETE), attaching appropriate method/productHandler function 
     *
     * @uses getAllProducts()
     * @uses addProduct()
     * @uses deleteProduct()
     * @uses methodNotAllowedResponse()
     * @uses header() HTTP Header @see @link https://www.php.net/manual/en/function.header.php
     * 
     * @return void
     */
    public function handleRequest() {
        switch ($this->requestMethod) {
            case 'GET':
                $response = $this->getAllProducts();
                break;
            
            case 'POST':
                $response = $this->addProduct($this->payload);
                break;
            
            case 'DELETE':
                $response = $this->deleteProduct($this->payload);
                break;
            
            case 'OPTIONS': 
                break;

            default:
                $response = $this->methodNotAllowedResponse('no support for '.$this->requestMethod.' request method');
                break;
        }

        header($response['statusCode']);
        echo $response['body'];
    }

    /**
     * Gets All Product from DB
     * 
     * @uses \ProductHandler::findAll()
     * @uses okResponse()
     *
     * @return array Response Object Body with an array of products and Status Code '200 - OK'
     */
    private function getAllProducts() {
        $products = $this->productHandle->findAll();
        return $this->okResponse($products);
    }

    /**
     * Adds a Product to DB
     * 
     * @uses \ProductHandler::insert()
     * @uses validatePayload()
     * @uses createdResponse()
     *
     * @param mixed $payload 
     * @return array Response Object Body with Success Message and Status Code '201 - Created'
     */
    private function addProduct($payload) {
        $isValidPayload = $this->validatePayload($payload, 'insert');
        if (!$isValidPayload) {
            return $this->unproccesableEntityResponse();
        }
        $productDetails = json_decode($payload, true);
        $this->productHandle->insert($productDetails);
        return $this->createdResponse();
    }

    /**
     * Deletes Specified Product(s) from DB
     * 
     * @uses \ProductHandler::delete()
     * @uses unproccesableEntityResponse()
     * @uses notFoundResponse()
     * @uses okResponse()
     *
     * @param mixed $payload
     * @return array
     */
    private function deleteProduct($payload) {
        $isValidPayload = $this->validatePayload($payload, 'delete');
        if (!$isValidPayload) {
            return $this->unproccesableEntityResponse();
        }
        extract(json_decode($payload, true));
        $result = $this->productHandle->delete($skus);
        if (!$result) {
            return $this->notFoundResponse('one or more product(s) not found');
        }
        return $this->okResponse();
    }

    /**
     * Checks If payload's values are present and/or in correct datatype
     * 
     * @uses \ProductHandler::find()
     * @uses extract()
     * @uses json_decode()
     * 
     * @param mixed $payload  
     * @param string $action
     * @return boolean True or False
     */
    private function validatePayload($payload, $action) {
        extract(json_decode($payload, true));
        switch ($action) {
            case 'insert':
                $isValidSKU = isset($sku) && is_string($sku) && !$this->productHandle->find($sku);
                $isValidName = isset($name) && is_string($name);
                $isValidPrice = isset($price) && (is_integer($price) || is_float($price));
                $isValidAttribute = isset($attribute) && is_string($attribute);
                $isValidProductType = isset($type) && in_array($type, ['Book', 'Furniture', 'DVD'], true);

                if (!$isValidSKU || !$isValidName || !$isValidPrice || !$isValidAttribute || !$isValidProductType) {
                    return false;
                }
                break;

            case 'delete':
                if (!isset($skus) || !is_array($skus)) {
                    return false;
                }
                break;
            
            default:
                return false;
                break;
        }
        return true;
    }

    /**
     * Sets Response Body to Success Meesage and Status Code Header to '200 - OK'
     *
     * @param array|object|mixed $data optional
     * @param string $message optional
     * @return array OK Response Object
     */
    private function okResponse($data = [], $message = 'success') {
        $response['statusCode'] = self::STATUS_CODE_200;
        $response['body'] = json_encode([
            'message' => $message,
            'data' => $data
        ]);
        return $response;
    }

    /**
     * Sets Response Body to Success Message and Status Code Header to '201 - Created'
     *
     * @param array|object|mixed $data optional
     * @param string $message optional
     * @return array Created Response Object
     */
    private function createdResponse($data = [], $message = 'product added successfully') {
        $response['statusCode'] = self::STATUS_CODE_201;
        $response['body'] = json_encode([
            'message' => $message,
            'data' => $data
        ]);
        return $response;
    }

    /**
     * Sets Response Body to empty array and Status Code Header to '204 - No Content'
     * 
     * @param null $data optional
     * @param string $message optional
     * @return array No Content Response Object
     */
    private function noContentResponse($data = [], $message = 'no products found') {
        $response['statusCode'] = self::STATUS_CODE_204;
        $response['body'] = json_encode([
            'message' => $message, 
            'data' => $data
        ]);
        return $response;
    }

    /**
     * Sets Response Body to 'error message' and Status Code Header to '422'
     *
     * @param string $message optional
     * @return array Uprocessable Entity Response Object
     */
    private function unproccesableEntityResponse($message = 'invalid payload') {
        $response['statusCode'] = self::STATUS_CODE_422;
        $response['body'] = json_encode([
            'error' => $message
        ]);
        return $response;
    }

    /**
     * Sets Response Body to 'error message' and Status Code Header to '404 - Not Found'
     *
     * @param string $message optional
     * @return array Not Found Response Object
     */
    private function notFoundResponse($message = 'not found') {
        $response['statusCode'] = self::STATUS_CODE_404;
        $response['body'] = json_encode([
            'error' => $message
        ]);
        return $response;
    }

    /**
     * Sets Response Body to 'error message' and Status Code Header to '405 - Method Not Allowed'
     *
     * @param string $message optional
     * @return array Method Not Allowed Response Object
     */
    private function methodNotAllowedResponse($message = 'method not allowed') {
        $response['statusCode'] = self::STATUS_CODE_405;
        $response['body'] = json_encode([
            'error' => $message
        ]);
        return $response;
    }
}