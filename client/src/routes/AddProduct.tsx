/* eslint-disable @typescript-eslint/no-empty-interface */
import { FC } from 'react';
import Container from "react-bootstrap/Container";
import Navbar from "react-bootstrap/Navbar";
import Nav from "react-bootstrap/Nav";
import Button from "react-bootstrap/Button";
import CheckIcon from "../icons/CheckIcon";
import CancelIcon from "../icons/CancelIcon";
import { Link } from "react-router-dom";

interface AddProductProps {
    
}
 
const AddProduct: FC<AddProductProps> = () => {
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
                    <Nav className="me-auto page-title d-none d-sm-block">
                        Add New Product
                    </Nav>
                    <Nav>
                        <Link to={'/'}>
                            <Button variant="danger" className="me-4">
                                <CancelIcon />
                                <span className="d-none d-md-flex">
                                    Cancel
                                </span>
                            </Button>
                        </Link>
                        <Button>
                            <CheckIcon />
                            <span>
                                Save
                            </span>
                        </Button>
                    </Nav>    
                </Container>
            </Navbar>
        </>
     );
}
 
export default AddProduct;