import Dialog from '../../../Shared/Dialog.tsx';

interface EditProductDialogProps {
    product: any;
    onSave: (product: any) => void;
    isOpen: boolean;
    onClose: () => void;
}

const EditProductDialog = ({ product, onSave, isOpen, onClose }: EditProductDialogProps) => {
    
    function editProduct() {
        product.name = 'Updated name from edit';
        onSave(product);
    }

    function onSubmit(e: React.FormEvent<HTMLFormElement>) {
        e.preventDefault();

        const form = e.target as HTMLFormElement;
        const formData = new FormData(form);
        
        const name = formData.get("name");
        const description = formData.get("description");

        product.name = name;
        product.description = description;

        onSave(product);
    }



    return (
        <Dialog title="Title of Dialog" isOpen={isOpen} onClose={onClose}>
            <p>This is standard HTML with dynamic React content.</p>
            <form onSubmit={onSubmit} key={ product ? product.id : ''}>
                <label>Product name</label>
                <input defaultValue={product ? product.name : ''} name="name" />
                <label>Product description</label>
                <input defaultValue={product ? product.description : ''} name="description" />
                <button type="submit">Click Me</button>
            </form>
            
        </Dialog>
    )
}

export default EditProductDialog;