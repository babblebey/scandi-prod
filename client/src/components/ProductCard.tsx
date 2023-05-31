/* eslint-disable @typescript-eslint/ban-types */
/* eslint-disable @typescript-eslint/no-unused-vars */
import { FC } from "react";
import Card from "react-bootstrap/Card";
import FormCheckInput from "react-bootstrap/FormCheckInput"
import type { Product } from "../types";

interface ProductCardProps {
    data: Product;
    isSelected: Function;
    handleSelect: Function; 
}
 
const ProductCard: FC<ProductCardProps> = ({ data, isSelected, handleSelect }) => {
    const { sku, name, price } = data as Product;

    // console.log(data);

    return ( 
        <Card className="text-center">
            <Card.Body>
                <FormCheckInput 
                    type="checkbox"
                    className="delete-checkbox"
                    checked={isSelected(sku)}
                    onChange={() => handleSelect(sku)}
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