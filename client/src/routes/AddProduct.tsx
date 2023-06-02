/* eslint-disable @typescript-eslint/no-empty-interface */
import { FC, useState } from 'react';
import Container from "react-bootstrap/Container";
import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";
import Navbar from "react-bootstrap/Navbar";
import Nav from "react-bootstrap/Nav";
import Button from "react-bootstrap/Button";
import Form from "react-bootstrap/Form";
import InputGroup from "react-bootstrap/InputGroup";
import CheckIcon from "../icons/CheckIcon";
import CancelIcon from "../icons/CancelIcon";
import { Link } from "react-router-dom";
import type { FormEvent, ChangeEvent } from 'react';
import type { ProductType } from "../types/Product";

interface AddProductProps {
    
}
 
const AddProduct: FC<AddProductProps> = () => {
    const [productType, setProductType] = useState<ProductType>();

    const handleSubmit = (e: FormEvent) => {
        e.preventDefault();

        // Testing Submit Action
        console.log('Form Submitted!');
    }

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
                        <Button form="product_form" type="submit">
                            <CheckIcon />
                            <span>
                                Save
                            </span>
                        </Button>
                    </Nav>    
                </Container>
            </Navbar>

            <Container fluid="md">
                <Form id="product_form" className="px-2" onSubmit={(e) => handleSubmit(e)}>
                    {/* Product SKU */}
                    <Row>
                        <Form.Label htmlFor="sku">SKU</Form.Label>
                        <Form.Control
                            type="text"
                            id="sku"
                            aria-label="Product SKU"
                        />
                    </Row>

                    {/* Product Name */}
                    <Row>
                        <Form.Label htmlFor="name">Name</Form.Label>
                        <Form.Control
                            type="text"
                            id="name"
                            aria-label="Product Name"
                        />
                    </Row>

                    {/* Products Price */}
                    <Row>
                        <Form.Label htmlFor="price">Price</Form.Label>
                        <InputGroup>
                            <InputGroup.Text>$</InputGroup.Text>
                            <Form.Control
                                type="number"
                                min={0}
                                id="price"
                                aria-label="Product Amount (in dollars)"
                            />
                        </InputGroup>
                    </Row>

                    {/* Product Type Switcher */}
                    <Row>
                        <Form.Label htmlFor="productType">Product Type</Form.Label>
                        <Form.Select id="productType" 
                            defaultValue="" 
                            onChange={(e: ChangeEvent<HTMLSelectElement>) => {
                                setProductType(e.target.value as ProductType)
                            } }
                        >
                            <option value="" disabled>Select Product Type</option>
                            <option value="Book">Book</option>
                            <option value="DVD">DVD</option>
                            <option value="Furniture">Furniture</option>
                        </Form.Select>
                    </Row>

                    {/* Attribute for ProductType - Book */}
                    { (productType === "Book") && (
                        <Row>
                            <Form.Label htmlFor="weight">Weight</Form.Label>
                            <InputGroup>
                                <Form.Control
                                    type="number"
                                    min={0}
                                    id="weight"
                                    aria-label="Book Weight (in kilograms)"
                                    aria-describedby="weightDescriptionBlock"
                                />
                                <InputGroup.Text>Kilograms (KG)</InputGroup.Text>
                            </InputGroup>
                            <Form.Text id="weightDescriptionBlock" muted>
                                Please, provide Book's weight in kilograms (KG).
                            </Form.Text>
                        </Row>
                    ) }
                    
                    {/* Attribute for ProductType - DVD */}
                    { (productType === "DVD") && (
                        <Row>
                            <Form.Label htmlFor="size">Size</Form.Label>
                            <InputGroup>
                                <Form.Control
                                    type="number"
                                    min={0}
                                    id="size"
                                    aria-label="DVD Size (in megabytes)"
                                    aria-describedby="sizeDescriptionBlock"
                                />
                                <InputGroup.Text>Megabytes (MB)</InputGroup.Text>
                            </InputGroup>
                            <Form.Text id="sizeDescriptionBlock" muted>
                                Please, provide DVD's size in megabytes (MB).
                            </Form.Text>
                        </Row>
                    ) }

                    {/* Attribute for ProductType - Furniture */}
                    { (productType === "Furniture") && (
                        <Row>
                            <Form.Label htmlFor="size">Dimension</Form.Label>
                            <Row lg="3" md="2" sm="1" xs="1" className="p-0 m-0">
                                <Col className="pb-lg-0 pb-3 pe-lg-4 px-0">
                                    <InputGroup>
                                        <InputGroup.Text id="heightDescriptionBlock">
                                            Height
                                        </InputGroup.Text>
                                        <Form.Control
                                            type="number"
                                            min={0}
                                            id="height"
                                            aria-label="Furniture Height"
                                            aria-describedby="heightDescriptionBlock"
                                        />
                                    </InputGroup>
                                </Col>
                                <Col className="pb-lg-0 pb-3 pe-lg-4 px-0">
                                    <InputGroup>
                                        <InputGroup.Text id="widthDescriptionBlock">
                                            Width
                                        </InputGroup.Text>
                                        <Form.Control
                                            type="number"
                                            min={0}
                                            id="width"
                                            aria-label="Furniture Width"
                                            aria-describedby="widthDescriptionBlock"
                                            />
                                    </InputGroup>
                                </Col>
                                <Col className="px-0">
                                    <InputGroup>
                                        <InputGroup.Text id="lengthDescriptionBlock">
                                            Length
                                        </InputGroup.Text>
                                        <Form.Control
                                            type="number"
                                            min={0}
                                            id="length"
                                            aria-label="Furniture Length"
                                            aria-describedby="lengthDescriptionBlock"
                                        />
                                    </InputGroup>
                                </Col>
                            </Row>
                            <Form.Text id="sizeDescriptionBlock" muted>
                                Please, provide Furniture's dimension in Height x Width x Length (HxWxL).
                            </Form.Text>
                        </Row>
                    ) }
                </Form>
            </Container>
        </>
     );
}
 
export default AddProduct;