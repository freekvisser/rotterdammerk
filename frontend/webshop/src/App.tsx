import { useEffect, useState } from 'react';
import { ApiConfig as api } from './ApiConfig';
import ProductPane from './Product/ProductPane';
import { Product } from './api-client/api';

export default function App() {
  const [products, setProducts] = useState<Product[]>([]);

  useEffect(() => {
    api.getProductsAll()
      .then(r => setProducts(r.data))
      .catch(console.error);
  }, []);

  return (
    <div>
      {products.map(p => (
        <ProductPane key={p.id} product={p} />
      ))}
    </div>
  );
}