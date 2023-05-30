/* eslint-disable @typescript-eslint/no-unused-vars */
import { FC } from "react";
import Card from "react-bootstrap/Card";
import FormCheckInput from "react-bootstrap/FormCheckInput"

interface ProductCardProps {
    data?: object
}
 
const ProductCard: FC<ProductCardProps> = ({ data }) => {
    { data }

    return ( 
        <Card className="text-center">
            <Card.Body>
                <FormCheckInput 
                    type="checkbox"
                    className="delete-checkbox"
                />
                <Card.Text>
                    PRODUCT-SKU-HERE
                </Card.Text>
                <Card.Title>
                    Card Title
                </Card.Title>
                <Card.Text>
                    20.00
                </Card.Text>
                <Card.Text>
                    Attribute: Value
                </Card.Text>
            </Card.Body>
        </Card>
     );
}
 
export default ProductCard;