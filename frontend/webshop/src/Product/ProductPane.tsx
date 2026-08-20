import { Product } from '../api-client/api';

interface ProductPaneProps {
  product: Product;
}

export default function ProductPane({ product }: ProductPaneProps ) {
  return (
    <div>
        <p>{ product.id }</p>
        <p>{ product.name }</p>
        <br />
    </div>
    );
}