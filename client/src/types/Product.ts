export default interface Product {
    type:        ProductType;
    sku:         string;
    name:        string;
    price:       number;
    attribute:   object;
}

export type ProductType = "Book" | "DVD" | "Furniture";