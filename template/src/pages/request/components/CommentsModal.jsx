import React, { useState, useEffect } from 'react';
import { Modal, Button, Form } from 'react-bootstrap';
import { X, Send, MessageCircle } from 'react-feather';
import { useComments } from '../hooks/useComments';

const CommentsModal = ({ show, onHide, application }) => {
  const { comments, isLoading, isSubmitting, fetchComments, createComment } = useComments(application?.id);
  const [newComment, setNewComment] = useState('');

  useEffect(() => {
    if (show && application) {
      fetchComments(application.id);
    }
  }, [show, application]);

  const handleSubmitComment = async (e) => {
    e.preventDefault();
    if (!newComment.trim()) return;

    await createComment(application.id, newComment.trim());
    setNewComment('');
  };

  const formatDate = (dateString) => {
    return new Date(dateString).toLocaleString('es-ES', {
      year: 'numeric',
      month: 'short',
      day: 'numeric',
      hour: '2-digit',
      minute: '2-digit'
    });
  };

  if (!application) return null;

  return (
    <Modal show={show} onHide={onHide} size="lg" centered>
      <Modal.Header className="d-flex justify-content-between align-items-center">
        <Modal.Title>
          <MessageCircle className="me-2" size={20} />
          Comentarios - Solicitud #{application.id}
        </Modal.Title>
        <Button variant="link" onClick={onHide} className="p-0">
          <X size={24} />
        </Button>
      </Modal.Header>
      <Modal.Body>
        <div className="mb-3">
          <h6 className="text-muted">Tipo de Solicitud: {application.apply_type}</h6>
        </div>

        {/* Lista de comentarios */}
        <div className="comments-list mb-4" style={{ maxHeight: '400px', overflowY: 'auto' }}>
          {isLoading ? (
            <div className="text-center p-3">
              <div className="spinner-border text-primary" role="status">
                <span className="visually-hidden">Cargando comentarios...</span>
              </div>
            </div>
          ) : comments.length === 0 ? (
            <div className="text-center p-4 text-muted">
              <MessageCircle size={48} className="mb-2 opacity-50" />
              <p>No hay comentarios para esta solicitud.</p>
              <small>Sé el primero en agregar un comentario.</small>
            </div>
          ) : (
            comments.map((comment, index) => (
              <div key={comment.id || index} className="comment-item mb-3 p-3 border rounded bg-light">
                <div className="d-flex justify-content-between align-items-start mb-2">
                  <strong className="text-primary">
                    {comment.created_by?.name || comment.createdBy?.name || 'Usuario'}
                  </strong>
                  <small className="text-black">
                    {formatDate(comment.created_at)}
                  </small>
                </div>
                <p className="mb-0 text-black">{comment.description}</p>
              </div>
            ))
          )}
        </div>

        {/* Formulario para nuevo comentario */}
        <Form onSubmit={handleSubmitComment}>
          <div className="border-top pt-3">
            <h6 className="mb-3">Agregar Comentario</h6>
            <Form.Group className="mb-3">
              <Form.Control
                as="textarea"
                rows={3}
                placeholder="Escribe tu comentario aquí..."
                value={newComment}
                onChange={(e) => setNewComment(e.target.value)}
                disabled={isSubmitting}
              />
            </Form.Group>
            <div className="d-flex justify-content-end">
              <Button
                type="submit"
                variant="primary"
                disabled={!newComment.trim() || isSubmitting}
              >
                {isSubmitting ? (
                  <>
                    <span className="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                    Enviando...
                  </>
                ) : (
                  <>
                    <Send size={16} className="me-2" />
                    Enviar Comentario
                  </>
                )}
              </Button>
            </div>
          </div>
        </Form>
      </Modal.Body>
      <Modal.Footer>
        <Button variant="secondary" onClick={onHide}>
          Cerrar
        </Button>
      </Modal.Footer>
    </Modal>
  );
};

export default CommentsModal;
