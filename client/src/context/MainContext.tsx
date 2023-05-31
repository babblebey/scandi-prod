import { FC, useState, useEffect, createContext } from "react";
import axios from "axios";
import type { Product } from "../types";

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

    return (
        <MainContext.Provider 
            value={{
                products,
                isProductsLoading,
                isProductsError,
                selectedProductSKUs, setSelectedProductSKUs,
                handleDelete,
                handleSelectProduct,
                isSelected,
            }}
        >
            { children }
        </MainContext.Provider>
    )
}