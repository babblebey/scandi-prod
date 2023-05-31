/* eslint-disable @typescript-eslint/no-unused-vars */
import { FC } from "react";
import Card from "react-bootstrap/Card";
import FormCheckInput from "react-bootstrap/FormCheckInput"
import type { Product } from "../types";

interface ProductCardProps {
    data: Product;
}
 
const ProductCard: FC<ProductCardProps> = ({ data }) => {
    const { sku, name, price } = data;

    // console.log(data);

    return ( 
        <Card className="text-center">
            <Card.Body>
                <FormCheckInput 
                    type="checkbox"
                    className="delete-checkbox"
                />
                <Card.Text>
                    { sku }
                </Card.Text>
                <Card.Title>
                    { name }
                </Card.Title>
                <Card.Text>
                    { price }
                </Card.Text>
                <Card.Text>
                    Attribute: Value
                </Card.Text>
            </Card.Body>
        </Card>
     );
}
 
export default ProductCard;