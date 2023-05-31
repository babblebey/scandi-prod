import type Product from "./Product"

export default interface AppContext {
    products: Product[], 
    selectedProductSKUs: string[], 
    isProductsLoading: boolean,
    isProductsError: boolean,
    isSelected: (sku: string) => boolean, 
    handleSelectProduct: (sku: string) => void, 
    handleDelete: () => void
}