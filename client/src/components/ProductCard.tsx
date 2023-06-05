/* eslint-disable @typescript-eslint/no-unused-vars */
import { FC } from "react";
import Card from "react-bootstrap/Card";
import FormCheckInput from "react-bootstrap/FormCheckInput"
import type { Product } from "../types";
import type { AttributeObject } from "../types/Product";

interface ProductCardProps {
    data: Product;
    isSelected: (sku: string) => boolean;
    handleSelect: (sku: string) => void; 
}
 
const ProductCard: FC<ProductCardProps> = ({ data, isSelected, handleSelect }) => {
    const { sku, name, price, attribute } = data as Product;
    const attributeKey = Object.keys(attribute).toString();

    const capitalise = (string: string) => {
        return string.charAt(0).toUpperCase() + string.slice(1)
    }

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
                    { capitalise(attributeKey) }
                    : { attribute[attributeKey as keyof AttributeObject] }
                </Card.Text>
            </Card.Body>
        </Card>
     );
}
 
export default ProductCard;