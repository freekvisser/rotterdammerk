import './ProductPane.css';

export default function ProductPane({ product }) {
  return (
    <div className="product-card">
      <div className="product-image-container">
        {product?.imageUrl ? (
          <img 
            src={product.imageUrl} 
            alt={product.name} 
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