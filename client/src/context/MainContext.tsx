import { FC, useState, useEffect, createContext } from "react";
import axios from "axios";
import type { Product } from "../types";
import type { IsSKUValid } from "../types/AppContext";

interface MainContextProviderProps {
    children: React.ReactElement
}

// Create Context
export const MainContext = createContext({});

// Create Context Provider
export const MainContextProvider: FC<MainContextProviderProps> = ({ children }) => {
    const [selectedProductSKUs, setSelectedProductSKUs] = useState<string[]>([]);
    const [products, setProducts] = useState<Product[]>([]);
    const [isProductsError, setIsProductsError] = useState<boolean>(false);
    const [isProductsLoading, setIsProductsLoading] = useState<boolean>(false);
    const [isSKU, setIsSKU] = useState<IsSKUValid>({
        valid: undefined, invalid: undefined
    });

    // Fetching All Products
    useEffect(() => {
        (async (): Promise<void> => {
            try {
                // Start Loading Products
                setIsProductsLoading(true);

                // Make GET request to retrieve Products
                const response = await axios.get('http://127.0.0.1:8000/products');
                const data = await response.data.data;

                // Set Response data to Products
                setProducts(data);

                // Stop Loading Products
                setIsProductsLoading(false);
            } catch (error) {
                // Set Error
                setIsProductsError(true);
                
                // Stop Loading Products
                setIsProductsLoading(false);
                console.error('Error retrieving products: ', error);
            }
        })();
    }, []);

    // Product Delete Handler
    const handleDelete = async (): Promise<void> => {
        try {
            const config = { data: { skus: selectedProductSKUs } };
            const response = await axios.delete('http://127.0.0.1:8000/products', config );
            
            // If response is OK
            if (response.status === 200) {
                // Filter delected products from products using selectedProductSKUs
                const updatedProducts = products?.filter(
                    product => !selectedProductSKUs.includes(product.sku)
                );

                // Reset selectedProductSKUs to empty array
                setSelectedProductSKUs([]);

                // update products with filtered - updatedProducts
                setProducts(updatedProducts);
            } else {
                throw new Error(response.data.error);
            }
        } catch (error) {
            console.error('Error deleting products:', error);
        }
    }

    // Product Select Handler
    const handleSelectProduct = (sku: string): void => {
        // Create a Copy
        const updatedSelectedProductSKUs = [...selectedProductSKUs];

        // Check if the productSKU is already selected - return the index in array or -1
        const index = updatedSelectedProductSKUs.findIndex(
            currentSelectedProductSKU => currentSelectedProductSKU === sku
        );

        // ProductSKU is 
        if (index < 0) {
            // ---not selected, add it to the selection
            updatedSelectedProductSKUs.push(sku);
        } else {
            // ---already selected, remove it from the selection
            updatedSelectedProductSKUs.splice(index, 1);
        }
        // Set New 
        setSelectedProductSKUs(updatedSelectedProductSKUs);
    }

    // Check If Product is Seleted
    const isSelected = (sku: string): boolean => {
        return selectedProductSKUs.includes(sku);
    }

    // Product SKU Validation
    const validateSKU = (sku: string): void|boolean => {
        // If no value is in SKU
        if (!sku.length) return;

        // If SKU Value is already exist in another product - set invalid and return false
        if (products.some((product: Product) => product.sku.toLowerCase() === sku.trim().toLowerCase())) {
            setIsSKU({valid: false, invalid: true});
            return false; 
        }

        // SKUis unique - set valid and return true
        setIsSKU({valid: true, invalid: false});
        return true;
    }

    return (
        <MainContext.Provider 
            value={{
                products,
                isProductsLoading,
                isProductsError,
                selectedProductSKUs,
                handleDelete,
                handleSelectProduct,
                isSelected,
                isSKU, setIsSKU,
                validateSKU
            }}
        >
            { children }
        </MainContext.Provider>
    )
}