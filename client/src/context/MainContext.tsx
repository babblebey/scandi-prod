import { FC, useState, useEffect, createContext } from "react";
import axios from "axios";
import type { Product } from "../types";

interface MainContextProviderProps {
    children: React.ReactElement
}

export const MainContext = createContext({});

export const MainContextProvider: FC<MainContextProviderProps> = ({ children }) => {
    const [selectedProductSKUs, setSelectedProductSKUs] = useState<string[]>([]);
    const [products, setProducts] = useState<Product[]>();

    useEffect(() => {
        // Make GET request to retrieve products
        axios.get('http://127.0.0.1:8000/products')
        .then(response => {
            setProducts(response.data.data);
        })
        .catch(error => {
            console.error('Error retrieving products:', error);
        });
    }, []);

    const handleDelete = (): void => {
        axios.delete('http://127.0.0.1:8000/products', {
            data: {
                skus: selectedProductSKUs
            }
        })
        .then(response => {
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
        })
        .catch(error => {
            console.error('Error deleting products:', error);
        });
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
                products, setProducts,
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