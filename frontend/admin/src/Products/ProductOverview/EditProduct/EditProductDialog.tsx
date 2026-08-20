import Dialog from '../../../Shared/Dialog.tsx';
import './EditProductDialog.css';

interface EditProductDialogProps {
    product: any;
    onSave: (product: any) => void;
    isOpen: boolean;
    onClose: () => void;
}

const EditProductDialog = ({ product, onSave, isOpen, onClose }: EditProductDialogProps) => {
    function onSubmit(e: React.FormEvent<HTMLFormElement>) {
        e.preventDefault();

        const form = e.target as HTMLFormElement;
        const formData = new FormData(form);

        const name = formData.get("name");
        const description = formData.get("description");

        product.name = name;
        product.description = description;

        onSave(product);

        onClose();

    }

    return (
        <Dialog title="Edit product" isOpen={isOpen} onClose={onClose}>
            <div className="edit-product-dialog__content">
                <div className="edit-product-dialog__image-block">
                    <div className="edit-product-dialog__image-placeholder">
                        <span className="edit-product-dialog__image-icon">⌂</span>
                    </div>
                    <button type="button" className="edit-product-dialog__import-button">
                        Import image
                    </button>
                </div>

                <form onSubmit={onSubmit} key={product ? product.id : ''} className="edit-product-dialog__form">
                    <label>Product name</label>
                    <input defaultValue={product ? product.name : ''} name="name" />
                    <label>Product description</label>
                    <input defaultValue={product ? product.description : ''} name="description" />
                    <button type="submit" className="edit-product-dialog__submit-button">Save changes</button>
                </form>
            </div>
        </Dialog>
    )
}

export default EditProductDialog;