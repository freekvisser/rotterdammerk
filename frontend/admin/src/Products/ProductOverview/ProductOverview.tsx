import { useEffect, useState } from 'react';
import { ApiConfig as api } from '../../ApiConfig.tsx';
import './ProductOverview.css';
import ProductPane from '../ProductPane/ProductPane.tsx';
import EditProductDialog from './EditProduct/EditProductDialog';
import { Product } from '../../api-client/api'

const ProductOverview = () => {
    const [products, setProducts] = useState<Array<Product>>([])
    const [selectedProduct, setSelectedProduct] = useState<Product | null>(null)

    useEffect(() => {
        api.getProductFindall()
        .then(r => setProducts(r.data))
        .catch(console.error);
    }, [])

    const updateProduct = (updatedProduct: Product) => {
        const updatedProductList : Array<Product> = products.map(p => p.id === updatedProduct.id ? updatedProduct : p)
        setProducts(updatedProductList);
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