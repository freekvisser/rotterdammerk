import { useState } from 'react';
import './ProductModal.css';
import { Product } from '../../../api-client/api';

const ProductModal = ({ selectedProduct, closeModal }: { selectedProduct: Product; closeModal: () => void }) => {

    const [selectedSize, setSelectedSize] = useState<string>('M');
    
    return (  
        selectedProduct && 
        <div className="modal-overlay" onClick={closeModal}>
            <div className="modal" onClick={e => e.stopPropagation()}>
                <button className="modal-close" onClick={closeModal} aria-label="Close">×</button>
                <div className="modal-content">
                    <div className="modal-image" aria-hidden="true">Image</div>
                    <div className="modal-info">
                        <h2>{selectedProduct.name}</h2>
                        <p className="modal-desc">{(selectedProduct as any).description ?? 'No description available.'}</p>
                        <div className="modal-meta">
                            <div><strong>Price:</strong> {(selectedProduct as any).price ? `€${(selectedProduct as any).price}` : '—'}</div>
                            <div><strong>Sizes:</strong> {(selectedProduct as any).sizes ? (selectedProduct as any).sizes.join(' • ') : 'S • M • L • XL'}</div>
                            <div><strong>Stock:</strong> {(selectedProduct as any).stock ?? '—'}</div>
                        </div>
                        <div className="order-row">
                            <div className="size-picker">
                                {((selectedProduct as any).sizes ?? ['S','M','L','XL']).map((s: string) => (
                                    <button key={s} type="button" className={`size-button ${selectedSize === s ? 'selected' : ''}`} onClick={() => setSelectedSize(s)}>{s}</button>
                                ))}
                            </div>
                            <button className="order-button" onClick={() => console.log('Order', selectedProduct, selectedSize)}>Order</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    )
}

export default ProductModal;