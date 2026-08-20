import { useEffect, useRef } from "react";
import './Dialog.css';

interface DialogProps {
  title: string;
  isOpen: boolean;
  onClose: () => void;
  children: React.ReactNode;
}

export default function Dialog({ title, isOpen, onClose, children }: DialogProps) {
  const dialogRef = useRef<HTMLDialogElement | null>(null);

  useEffect(() => {
    const dialogElement = dialogRef.current;
    if (!dialogElement) return;

    if (isOpen) {
      if (!dialogElement.open) {
        dialogElement.showModal();
      }
    } else {
      if (dialogElement.open) {
        dialogElement.close();
      }
    }
  }, [isOpen]);

  // Handle native backdrop click or Escape key
  const handleBackdropClick = (event: React.MouseEvent<HTMLDialogElement>) => {
    if (event.target === dialogRef.current) {
      onClose();
    }
  };

  return (
    <dialog
      ref={dialogRef}
      className="custom-dialog"
      onClick={handleBackdropClick}
      onCancel={onClose}
    >
      <div className="dialog-header">
        <h2 className="dialog-title">{title}</h2>
        <button type="button" className="dialog-close-btn" onClick={onClose}>
          &times;
        </button>
      </div>
      <div className="dialog-body">{children}</div>
    </dialog>
  );
}