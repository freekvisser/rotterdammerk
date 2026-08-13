import React, { useEffect, useState } from 'react';
import { DefaultApi, Configuration } from './api-client';

export default function App() {
  const [product, setProduct] = useState(null);

  useEffect(() => {
    const api = new DefaultApi(new Configuration({ basePath: 'http://localhost:8000' }));
    api.getProductsFind('019fe5d2-e848-707f-b187-6d37f0ae2dde')
      .then(r => setProduct(r.data))
      .catch(console.error);
  }, []);

  return <div>{product ? product.name : 'Loading...'}</div>;
}