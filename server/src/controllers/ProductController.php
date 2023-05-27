<?php
namespace Src\Controllers;

use Src\Handlers\ProductHandler;

class ProductController {
    const STATUS_CODE_200 = 'HTTP/1.1 200 OK';
    const STATUS_CODE_201 = 'HTTP/1.1 201 Created';
    const STATUS_CODE_204 = 'HTTP/1.1 204 No Content';
    const STATUS_CODE_404 = 'HTTP/1.1 404 Not Found';
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
     * Handles All Requests by Methods (GET | POST | DELETE)
     *
     * @uses getAllProducts()
     * @uses addProduct()
     * @uses deleteProduct()
     * @uses notFoundResponse()
     * @uses header() HTTP Header @see @link https://www.php.net/manual/en/function.header.php
     * 
     * @return void
     */
    public function handleRequest() {

    }

    /**
     * Gets All Product from DB
     * 
     * @uses \ProductHandler::findAll()
     * @uses noContentResponse()
     *
     * @return array Response Object Body with 'All Products' | 'Null' and Status Code '200 - OK' | '204 No Content'
     */
    private function getAllProducts() {

    }

    /**
     * Adds Product to DB
     * 
     * @uses \ProductHandler::insert()
     * @uses validateProductPayload()
     * @uses okResponse()
     *
     * @param mixed $payload 
     * @return array Response Object Body with Success Message and Status Code '201 - Created'
     */
    private function addProduct($payload) {

    }

    /**
     * Deletes Specified Product(s) from DB
     * 
     * @uses \ProductHandler::delete()
     * @uses okResponse()
     *
     * @param array $skus
     * @return array
     */
    private function deleteProduct(array $skus) {

    }

    /**
     * Checks If all Product Fields are present, and are of correct datatype in payload
     * 
     * @param mixed $payload  
     * @return boolean True or False
     */
    private function validateProductPayload($payload) {
        $isValidSKU = isset($payload->sku) && is_string($payload->sku);
        $isValidName = isset($payload->name) && is_string($payload->name);
        $isValidPrice = isset($payload->price) && (is_integer($payload->price) || is_float($payload->price));
        $isValidAttribute = isset($payload->attribute) && is_string($payload->attribute);

        if (!$isValidSKU || !$isValidName || !$isValidPrice || !$isValidAttribute) {
            return false;
        }
        return true;
    }

    /**
     * Sets Response Body to Success Meesage and Status Code Header to '200 - OK'
     *
     * @return array OK Response Object
     */
    private function okResponse() {
        $response['statusCode'] = self::STATUS_CODE_200;
        $response['body'] = json_encode([
            'message' => 'success'
        ]);
        return $response;
    }

    /**
     * Sets Response Body to 'Null' and Status Code Header to '204 - No Content'
     *
     * @return array No Content Response Object
     */
    private function noContentResponse() {
        $response['statusCode'] = self::STATUS_CODE_204;
        $response['body'] = json_encode([
            'message' => 'no products found', 
            'data' => null
        ]);
        return $response;
    }

    /**
     * Sets Response Body to 'Invalid' and Status Code Header to '422'
     *
     * @return array Uprocessable Entity Response Object
     */
    private function unproccesableEntityResponse() {
        $response['statusCode'] = self::STATUS_CODE_422;
        $response['body'] = json_encode([
            'error' => 'invalid payload'
        ]);
        return $response;
    }

    /**
     * Sets Response Body to 'Null' and Status Code Header to '404 - Not Found'
     *
     * @return array Not Found Response Object
     */
    private function notFoundResponse() {
        $response['statusCode'] = self::STATUS_CODE_404;
        $response['body'] = json_encode([
            'error' => 'not found'
        ]);
        return $response;
    }
}