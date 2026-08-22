import './Loader.css';

const Loader = ({isLoading}: {isLoading: boolean}) => {
    return (
        <div className="loader" style={{display: isLoading ? 'flex' : 'none'}}>
            <div className="loader__spinner"></div>
        </div>
    )
}

export default Loader;