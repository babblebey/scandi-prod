/* eslint-disable @typescript-eslint/no-empty-interface */
import { FC, useState, useEffect } from 'react';
import Container from "react-bootstrap/Container";
import Row from "react-bootstrap/Row";
import Navbar from "react-bootstrap/Navbar";
import Nav from "react-bootstrap/Nav";
import Button from "react-bootstrap/Button";
import PlusIcon from "../icons/PlusIcon";
import TrashIcon from "../icons/TrashIcon";
import ProductCard from "../components/ProductCard";
import axios from "axios";

import type { Product } from "../types";

interface HomeProps {
    
}

const Home: FC<HomeProps> = () => {
    const [selectedProductSKUs, setSelectedProductSKUs] = useState<string[]>([]);
    const [products, setProducts] = useState<Product[]>();

    useEffect(() => {
        // Make GET request to retrieve products
        axios.get('http://127.0.0.1:8000/products')
        .then(response => {
            setProducts(response.data.data);
        })
        .catch(error => {
            console.error('Error retrieving products:', error);
        });
    }, []);

    const handleDelete = (): void => {
        axios.delete('http://127.0.0.1:8000/products', {
            data: {
                skus: selectedProductSKUs
            }
        })
        .then(response => {
            // If response is OK
            if (response.status === 200) {
                // Filter delected products from products using selectedProductSKUs
                const updatedProducts = products?.filter(
                    product => !selectedProductSKUs.includes(product.sku)
                );

                // Reset selectedProductSKUs to empty array
                setSelectedProductSKUs([]);

                // update products with filtered - updatedProducts
                setProducts(updatedProducts);
            } else {
                throw new Error(response.data.error);
            }
        })
        .catch(error => {
            console.error('Error deleting products:', error);
        });
    }

    // Product Select Handler
    const handleSelectProduct = (sku: string): void => {
        // Create a Copy
        const updatedSelectedProductSKUs = [...selectedProductSKUs];

        // Check if the productSKU is already selected - return the index in array or -1
        const index = updatedSelectedProductSKUs.findIndex(
            currentSelectedProductSKU => currentSelectedProductSKU === sku
        );

        // ProductSKU is 
        if (index < 0) {
            // ---not selected, add it to the selection
            updatedSelectedProductSKUs.push(sku);
        } else {
            // ---already selected, remove it from the selection
            updatedSelectedProductSKUs.splice(index, 1);
        }
        // Set New 
        setSelectedProductSKUs(updatedSelectedProductSKUs);
    }

    // Check If Product is Seleted
    const isSelected = (sku: string): boolean => {
        return selectedProductSKUs.includes(sku);
    }

    // console.log(selectedProductSKUs);

    return ( 
        <>
            <Navbar bg="white" className="mb-3 py-0" sticky="top">
                <Container className="nav-container py-3">
                    <Navbar.Brand>
                        Product List
                    </Navbar.Brand>
                    <Navbar.Toggle aria-controls="navbarScroll" />
                    <Nav>
                        { !!(selectedProductSKUs.length) && (
                            // Render Delete Button when a Product is selected
                            <Button variant="danger" className="me-4 shadow"
                                onClick={() => handleDelete()}
                            >
                                <TrashIcon />
                                <span>
                                    Mass Delete 
                                    <span className="ms-1 d-none d-lg-block">
                                        Selected Products
                                    </span> 
                                </span>
                            </Button>
                        ) }

                        <Button>
                            <PlusIcon />
                            <span>
                                Add 
                                <span className="ms-1 d-none d-lg-block">
                                    New Product
                                </span> 
                            </span>
                        </Button>
                    </Nav>    
                </Container>
            </Navbar>

            <Container>
                <Row lg="4" md="3" sm="2" xs="1">
                    { products && products.map((data, i) => (
                        <ProductCard key={i} data={data} isSelected={isSelected} handleSelect={handleSelectProduct}/>
                    )) }
                </Row>
            </Container>
        </>
     );
}
 
export default Home;
