import type Product from "./Product"
import type { SetStateAction } from "react";

export default interface AppContext {
    products: Product[], 
    selectedProductSKUs: string[], 
    isProductsLoading: boolean,
    isProductsError: boolean,
    isSelected: (sku: string) => boolean, 
    handleSelectProduct: (sku: string) => void, 
    handleDelete: () => void,
    isSKU: IsSKUValid,
    setIsSKU: (value: SetStateAction<IsSKUValid>) => void,
    validateSKU: (sku: string) => boolean
}

export interface IsSKUValid {
    valid: boolean|undefined, 
    invalid: boolean|undefined
}