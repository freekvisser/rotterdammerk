import React, { useEffect, useState } from 'react';
import { ApiConfig as api } from '../../ApiConfig';
import './ProductOverview.css';
import ProductPane from '../ProductPane/ProductPane';
import EditProductDialog from './EditProduct/EditProductDialog';

const ProductOverview = () => {
    const [products, setProducts] = useState([])
    const [selectedProduct, setSelectedProduct] = useState(null)

    useEffect(() => {
        api.getProductFindall()
        .then(r => setProducts(r.data))
        .catch(console.error);
    }, [])

    function updateProduct(updatedProduct){
        setProducts(products.map(p => p.id === updatedProduct.id ? updatedProduct : p));
    }


    return (
        <div>
            <div className="product-container">
                {products.map(p => (
                    <div onClick={() => setSelectedProduct(p)} key={p.id} >
                        <ProductPane 
                            class="product-panel" 
                            product={p} 
                        />
                    </div>
                ))}
            </div>

            <EditProductDialog 
                product={selectedProduct}
                onSave={updateProduct}
                isOpen={Boolean(selectedProduct)}
                onClose={() => setSelectedProduct(null)}
            />
        </div>
    )
}

export default ProductOverview;