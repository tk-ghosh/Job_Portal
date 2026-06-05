document.addEventListener('DOMContentLoaded', function() {
  const modal = document.getElementById('blogModal');
  const modalTitle = document.getElementById('modalTitle');
  const modalDate = document.getElementById('modalDate');
  const modalContent = document.getElementById('modalContent');
  const closeBtn = document.querySelector('.close-modal');

  document.querySelectorAll('.read-more-btn').forEach(btn => {
    btn.addEventListener('click', function() {
      modalTitle.textContent = this.dataset.title;
      modalDate.textContent = this.dataset.date;
      modalContent.innerHTML = this.dataset.content.replace(/\n/g, '<br>');
      modal.style.display = 'block';
    });
  });

  if (closeBtn) {
    closeBtn.addEventListener('click', () => { modal.style.display = 'none'; });
  }

  window.addEventListener('click', (e) => {
    if (e.target === modal) modal.style.display = 'none';
  });
});
