/* eslint-disable @typescript-eslint/no-explicit-any */
/* eslint-disable @typescript-eslint/no-empty-interface */
import { FC, useState, useContext } from 'react';
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
import { Link, useNavigate } from "react-router-dom";
import { MainContext } from "../context/MainContext";
import type { FormEvent, ChangeEvent } from 'react';
import type { AppContext, ProductFormInput } from "../types";

interface AddProductProps {
    
}
 
const AddProduct: FC<AddProductProps> = () => {
    const { validateSKU, isSKU, setIsSKU, handleSubmit } = useContext(MainContext) as AppContext;
    const navigate = useNavigate();
    const [formInput, setFormInput] = useState<ProductFormInput>({
        sku: '',
        name: '',
        price: '',
        productType: '',
        weight: '',
        size: '',
        height: '',
        width: '',
        length: '',
    });

    const handleSubmitProduct = (e: FormEvent) => {
        // Stop Page Reloading
        e.preventDefault();

        // Call Submit Handler -> Then Run Navigation Callback; route to products list on product addition
        handleSubmit(formInput, () => navigate('/'));
    }

    // Form Change Handler
    const handleChange = (e: ChangeEvent, value: any) => {
        const field = e.target.id;
        setFormInput({ ...formInput, [field]: value });
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
                        <Button form="product_form" type="reset" variant="danger" className="me-4"
                            onClick={() => {
                                setIsSKU({valid: undefined, invalid: undefined});
                                navigate('/');
                            }}
                        >
                            <CancelIcon />
                            <span className="d-none d-md-flex">
                                Cancel
                            </span>
                        </Button>
                        <Button form="product_form" type="submit">
                            <CheckIcon />
                            <span>
                                Save
                            </span>
                        </Button>
                    </Nav>    
                </Container>
            </Navbar>

            <Container fluid="md" className="main">
                <Form id="product_form" className="px-2" onSubmit={(e) => handleSubmitProduct(e)}>
                    {/* Product SKU */}
                    <Row>
                        <Form.Label htmlFor="sku">SKU</Form.Label>
                        <Form.Control
                            type="text"
                            id="sku"
                            required
                            value={formInput?.sku}
                            aria-label="Product SKU"
                            isInvalid={isSKU.invalid}
                            isValid={isSKU.valid}
                            onChange={e => handleChange(e, e.target.value)}
                            onBlur={e => validateSKU(e.target.value)}
                        />
                        <Form.Control.Feedback type="invalid">
                            This SKU already exist for another product, please enter a different SKU
                        </Form.Control.Feedback>
                        <Form.Control.Feedback type="valid">
                            SKU looks good!
                        </Form.Control.Feedback>
                    </Row>

                    {/* Product Name */}
                    <Row>
                        <Form.Label htmlFor="name">Name</Form.Label>
                        <Form.Control
                            type="text"
                            id="name"
                            required
                            value={formInput?.name}
                            aria-label="Product Name"
                            onChange={e => handleChange(e, e.target.value)}
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
                                step={0.01}
                                id="price"
                                required
                                value={formInput?.price}
                                aria-label="Product Amount (in dollars)"
                                onChange={e => handleChange(e, e.target.value)}
                            />
                        </InputGroup>
                    </Row>

                    {/* Product Type Switcher */}
                    <Row>
                        <Form.Label htmlFor="productType">Product Type</Form.Label>
                        <Form.Select id="productType" 
                            defaultValue="" 
                            onChange={(e) => setFormInput({ ...formInput, productType: e.target.value })}
                            required
                            aria-label="Product Type"
                        >
                            <option value="" disabled>Select Product Type</option>
                            <option value="Book">Book</option>
                            <option value="DVD">DVD</option>
                            <option value="Furniture">Furniture</option>
                        </Form.Select>
                    </Row>

                    {/* Attribute for formInput?.productType - Book */}
                    { (formInput?.productType === "Book") && (
                        <Row>
                            <Form.Label htmlFor="weight">Weight</Form.Label>
                            <InputGroup>
                                <Form.Control
                                    type="number"
                                    min={0}
                                    step={0.01}
                                    id="weight"
                                    required
                                    value={formInput?.weight}
                                    aria-label="Book Weight (in kilograms)"
                                    aria-describedby="weightDescriptionBlock"
                                    onChange={e => handleChange(e, e.target.value)}
                                />
                                <InputGroup.Text>Kilograms (KG)</InputGroup.Text>
                            </InputGroup>
                            <Form.Text id="weightDescriptionBlock" muted>
                                Please, provide Book's weight in kilograms (KG).
                            </Form.Text>
                        </Row>
                    ) }
                    
                    {/* Attribute for formInput?.productType - DVD */}
                    { (formInput?.productType === "DVD") && (
                        <Row>
                            <Form.Label htmlFor="size">Size</Form.Label>
                            <InputGroup>
                                <Form.Control
                                    type="number"
                                    min={0}
                                    step={0.01}
                                    id="size"
                                    required
                                    value={formInput?.size}
                                    aria-label="DVD Size (in megabytes)"
                                    aria-describedby="sizeDescriptionBlock"
                                    onChange={e => handleChange(e, e.target.value)}
                                />
                                <InputGroup.Text>Megabytes (MB)</InputGroup.Text>
                            </InputGroup>
                            <Form.Text id="sizeDescriptionBlock" muted>
                                Please, provide DVD's size in megabytes (MB).
                            </Form.Text>
                        </Row>
                    ) }

                    {/* Attribute for formInput?.productType - Furniture */}
                    { (formInput?.productType === "Furniture") && (
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
                                            step={0.01}
                                            id="height"
                                            required
                                            value={formInput?.height}
                                            aria-label="Furniture Height"
                                            aria-describedby="heightDescriptionBlock"
                                            onChange={e => handleChange(e, e.target.value)}
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
                                            step={0.01}
                                            id="width"
                                            required
                                            value={formInput?.width}
                                            aria-label="Furniture Width"
                                            aria-describedby="widthDescriptionBlock"
                                            onChange={e => handleChange(e, e.target.value)}
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
                                            step={0.01}
                                            id="length"
                                            required
                                            value={formInput?.length}
                                            aria-label="Furniture Length"
                                            aria-describedby="lengthDescriptionBlock"
                                            onChange={e => handleChange(e, e.target.value)}
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