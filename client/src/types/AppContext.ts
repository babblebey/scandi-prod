import type Product from "./Product"

export default interface AppContext {
    products: Product[], 
    selectedProductSKUs: string[], 
    isSelected: (sku: string) => boolean, 
    handleSelectProduct: (sku: string) => void, 
    handleDelete: () => void
}