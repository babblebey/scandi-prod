/* eslint-disable @typescript-eslint/no-empty-interface */
import { FC, useContext } from 'react';
import Container from "react-bootstrap/Container";
import Row from "react-bootstrap/Row";
import Navbar from "react-bootstrap/Navbar";
import Nav from "react-bootstrap/Nav";
import Button from "react-bootstrap/Button";
import PlusIcon from "../icons/PlusIcon";
import TrashIcon from "../icons/TrashIcon";
import ProductCard from "../components/ProductCard";
import { MainContext } from "../context/MainContext";
import { Product, AppContext } from "../types";

interface HomeProps {
    
}

const Home: FC<HomeProps> = () => {
    const { products, selectedProductSKUs, isSelected, handleSelectProduct, handleDelete } = useContext(MainContext) as AppContext;

    return ( 
        <>
            <Navbar bg="white" className="mb-3 py-0" sticky="top">
                <Container className="nav-container py-3">
                    <Navbar.Brand>
                        Product List
                    </Navbar.Brand>
                    <Navbar.Toggle aria-controls="navbarScroll" />
                    <Nav>
                        { !!(selectedProductSKUs?.length) && (
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
                    { products && products.map((data: Product, i: number) => (
                        <ProductCard key={i} data={data} isSelected={isSelected} handleSelect={handleSelectProduct}/>
                    )) }
                </Row>
            </Container>
        </>
     );
}
 
export default Home;
