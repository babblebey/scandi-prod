<?php
namespace Src\Controllers;

use Src\Handlers\ProductHandler;

class ProductController {
    const STATUS_CODE_200 = 'HTTP/1.1 200 OK';
    const STATUS_CODE_201 = 'HTTP/1.1 201 Created';
    const STATUS_CODE_204 = 'HTTP/1.1 204 No Content';
    const STATUS_CODE_404 = 'HTTP/1.1 404 Not Found';

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

        $this->$productHandle = new ProductHandler($db);
    }

    /**
     * Handles All Requests by Methods (GET | POST | DELETE)
     *
     * @uses getAllProducts()
     * @uses addProduct()
     * @uses deleteProduct()
     * @uses notFoundResponse()
     * 
     * @return object Response Object
     */
    public function handleRequest() {

    }

    /**
     * Gets All Product from DB
     * 
     * @uses \ProductHandler::findAll()
     * @uses noContentResponse()
     *
     * @return object Response Object Body with 'All Products' | 'Null' and Status Code '200 - OK' | '204 No Content'
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
     * @param array $payload 
     * @return object Response Object Body with Success Message and Status Code '201 - Created'
     */
    private function addProduct(array $payload) {

    }

    /**
     * Deletes Specified Product(s) from DB
     * 
     * @uses \ProductHandler::delete()
     * @uses okResponse()
     *
     * @param array $skus
     * @return object
     */
    private function deleteProduct(array $skus) {

    }

    /**
     * Checks If all Product Fields are present in payload
     * 
     * @param array $payload 
     * @return boolean True or False
     */
    private function validateProductPayload(array $payload) {

    }

    /**
     * Sets Response Body to Success Meesage and Status Code Header to '200 - OK'
     *
     * @return object OK Response Object
     */
    private function okResponse() {

    }

    /**
     * Sets Response Body to 'Null' and Status Code Header to '204 - No Content'
     *
     * @return object No Content Response Object
     */
    private function noContentResponse() {

    }

    /**
     * Sets Response Body to 'Invalid' and Status Code Header to '422'
     *
     * @return object Uprocessable Entity Response Object
     */
    private function unproccesableEntityResponse() {

    }

    /**
     * Sets Response Body to 'Null' and Status Code Header to '404 - Not Found'
     *
     * @return object Not Found Response Object
     */
    private function notFoundResponse() {

    }
}