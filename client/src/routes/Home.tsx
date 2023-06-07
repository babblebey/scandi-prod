/* eslint-disable @typescript-eslint/no-empty-interface */
import { FC, useContext } from 'react';
import Container from "react-bootstrap/Container";
import Row from "react-bootstrap/Row";
import Navbar from "react-bootstrap/Navbar";
import Nav from "react-bootstrap/Nav";
import Button from "react-bootstrap/Button";
import Spinner from "react-bootstrap/Spinner";
import Alert from "react-bootstrap/Alert";
import PlusIcon from "../icons/PlusIcon";
import TrashIcon from "../icons/TrashIcon";
import ProductCard from "../components/ProductCard";
import { MainContext } from "../context/MainContext";
import { Link } from "react-router-dom";
import type { Product, AppContext } from "../types";

interface HomeProps {
    
}

const Home: FC<HomeProps> = () => {
    const { 
        products, 
        isProductsLoading, 
        isProductsError,
        isSelected, 
        handleSelectProduct, 
        handleDelete 
    } = useContext(MainContext) as AppContext;

    return ( 
        <>
            <Navbar bg="white" className="mb-3 py-0" sticky="top">
                <Container className="nav-container" fluid="md">
                    <Navbar.Brand>
                        <Link to={'/'}>
                            ScandiProd
                        </Link>
                    </Navbar.Brand>
                    <Navbar.Toggle aria-controls="navbarScroll" />
                    <Nav>
                        {/* Delete Button */}
                        <Button variant="danger" className="me-4"
                            onClick={() => handleDelete()}
                        >
                            <TrashIcon />
                            <span>
                                MASS DELETE 
                            </span>
                        </Button>

                        <Link to={'/add-product'}>
                            <Button>
                                <PlusIcon />
                                <span>
                                    ADD
                                </span>
                            </Button>
                        </Link>
                    </Nav>    
                </Container>
            </Navbar>

            <Container fluid="md" className="main">
                { isProductsLoading ? (
                    // Products is Loading - Render Spinner
                    <Row className="loading-wrapper justify-content-center align-content-center">
                        <Spinner animation="border" variant="primary" />
                    </Row>
                ) : 
                    // Products stops loading - Checks for error?
                    isProductsError ? (
                        // Product Found Error - Render Alert
                        <Row className="error-wrapper justify-content-center align-content-center">
                            <Alert variant="danger">
                                An error occured while retrieving products!
                            </Alert>
                        </Row>
                    ) : 
                        // Products has no error - Checks if products are in response?
                        (products.length) ? (
                            // Products - There are products in response - Render Products
                            <Row lg="4" md="3" sm="2" xs="1">
                                { products.map((data: Product, i: number) => (
                                    <ProductCard key={i} data={data} isSelected={isSelected} handleSelect={handleSelectProduct}/>
                                )) }
                            </Row>
                        ) : (
                            // No Products - There are no products found in response - Render Alert
                            <Row className="info-wrapper justify-content-center align-content-center">
                                <Alert variant="info">
                                    No products found!
                                </Alert>
                            </Row>
                        )
                }
            </Container>
        </>
     );
}
 
export default Home;
