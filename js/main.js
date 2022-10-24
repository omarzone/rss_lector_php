const exampleModal = document.getElementById('exampleModal');
exampleModal.addEventListener('show.bs.modal', event => {
  // Button that triggered the modal
  const button = event.relatedTarget;
  // Extract info from data-bs-* attributes
  const title = button.getAttribute('data-title');
  const content = button.getAttribute('data-content');
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  // Update the modal's content.
  const modalTitle = exampleModal.querySelector('.modal-title');
  const modalBody = exampleModal.querySelector('.modal-body');

  modalTitle.textContent = title;
  modalBody.append(content);
  console.log(content);
})
