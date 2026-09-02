import { Product } from '../../api-client/api';
import './ProductPane.css';

interface ProductPaneProps {
  product: Product;
  onSelect?: (product: Product) => void;
}

export default function ProductPane({ product, onSelect }: ProductPaneProps ) {
  const handleClick = () => onSelect && onSelect(product);
  const description = (product as any).description;
  const price = (product as any).price;

  return (
    <div className="product-pane" onClick={handleClick} role="button" tabIndex={0}>
      <div className="product-image" aria-hidden="true">No image</div>
      <div className="product-body">
        <h3 className="product-name">{product.name}</h3>
        <p className="product-desc">{description ?? 'No description available.'}</p>
        <div className="product-footer">
          <span className="product-price">{price ? `€${price}` : '—'}</span>
        </div>
      </div>
    </div>
  );
}