import './ProductPane.css';
import { Product } from '../../api-client/api';

interface ProductPaneProps {
  product: Product;
}

export default function ProductPane({ product }: ProductPaneProps) {
  return (
    <div className="product-card">
      <div className="product-image-container">
        {false ? (
          <img 
            src={'product.imageUrl'} 
            alt={product.name || undefined} 
            className="product-image" 
          />
        ) : (
          <div className="product-image-placeholder">
            <span>No Image</span>
          </div>
        )}
      </div>
      <div className="product-content">
        <h3 className="product-title">{product?.name}</h3>
        <p className="product-description">{product?.description}</p>
      </div>
    </div>
  );
}