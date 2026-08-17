import Dialog from '../../../Shared/Dialog';

const EditProductDialog = ({ product, onSave, isOpen, onClose}) => {
    
    function editProduct() {
        product.name = 'Updated name from edit';
        onSave(product);
    }

    return (
        <Dialog title="Title of Dialog" isOpen={isOpen} onClose={onClose}>
            <p>This is standard HTML with dynamic React content.</p>
            <button onClick={() => {
                editProduct();
            }}>Click Me</button>
        </Dialog>
    )
}

export default EditProductDialog;