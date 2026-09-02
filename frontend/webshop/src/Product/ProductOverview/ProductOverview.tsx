import { useEffect, useState } from 'react';
import { ApiConfig as api } from '../../ApiConfig';
import ProductPane from './ProductPane/ProductPane';
import { Product } from '../../api-client/api';
import './ProductOverview.css';
import ProductModal from './ProductModal/ProductModal';

const ProductOverview = () => {
        const [products, setProducts] = useState<Product[]>([]);
        const [selectedProduct, setSelectedProduct] = useState<Product | null>(null);
        const [selectedSize, setSelectedSize] = useState<string>('M');

        useEffect(() => {
                api.getProductsAll()
                        .then(r => setProducts(r.data))
                        .catch(console.error);
        }, []);

        useEffect(() => {
            const onKey = (e: KeyboardEvent) => { if (e.key === 'Escape') setSelectedProduct(null); };
            if (selectedProduct) window.addEventListener('keydown', onKey);
            return () => window.removeEventListener('keydown', onKey);
        }, [selectedProduct]);

        const openProduct = (p: Product) => {
            const defaultSize = (p as any).sizes?.[0] ?? 'M';
            setSelectedSize(defaultSize);
            setSelectedProduct(p);
        };
        const closeModal = () => { setSelectedProduct(null); setSelectedSize('M'); };

        return (
                <div className="product-overview">
                    <div className="product-grid">
                        {products.map(p => (
                                <ProductPane key={p.id} product={p} onSelect={openProduct} />
                        ))}
                    </div>

                    <ProductModal selectedProduct={selectedProduct} closeModal={closeModal} />

                </div>
        );
}

export default ProductOverview;