import { ProductType } from "./Product"

export default interface ProductFormInput {
    name: string
    price: '' | number 
    sku: string
    productType: string | ProductType
    size: '' | number 
    weight: '' | number 
    height: '' | number 
    width: '' | number 
    length: '' | number 
}