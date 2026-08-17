import React, { useEffect, useState } from 'react';
import { DefaultApi, Configuration } from './api-client';
import { ApiConfig as api } from './ApiConfig';
import ProductPane from './Product/ProductPane';

export default function App() {
  const [product, setProduct] = useState([]);

  useEffect(() => {
    api.getProductsAll()
      .then(r => setProduct(r.data))
      .catch(console.error);
  }, []);

  return (
    <div>
      {product.map(p => (
        <ProductPane key={p.id} product={p} />
      ))}
    </div>
  );
}