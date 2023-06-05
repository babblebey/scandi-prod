export default interface Product {
    type:        ProductType;
    sku:         string;
    name:        string;
    price:       number;
    attribute:   AttributeObject;
}

export type ProductType = "Book" | "DVD" | "Furniture";

export type AttributeObject = {
    weight: string;
    size?: undefined;
    dimension?: undefined;
} | {
    size: string;
    weight?: undefined;
    dimension?: undefined;
} | {
    dimension: string;
    weight?: undefined;
    size?: undefined;
} | null