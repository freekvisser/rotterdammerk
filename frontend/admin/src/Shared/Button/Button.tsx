import './Button.css';

interface ButtonProps {
    onClick?: () => void;
    title: string;
    type: string;
    submit?: boolean;
}

const Button = ({ onClick, title, type, submit = false }: ButtonProps) => {
    var className = '';
    switch (type) {
        case 'primary':
            className = 'button--primary';
            break;
        case 'secondary':
            className = 'button--secondary';
            break;
        case 'cancel':
            className = 'button--cancel';
            break;
        default:
            className = 'button--default';
    }

    return (
        <button type={submit ? "submit" : "button"} onClick={onClick} className={`button ${className}`}>
            {title}
        </button>
    );
};

export default Button;