function showScreen(screenId) {
  document.querySelectorAll('aside nav button').forEach(b => b.classList.remove('active'));
  document.querySelectorAll('main section').forEach(s => s.classList.remove('active'));
  document.getElementById(screenId)?.classList.add('active');
  document.querySelector(`aside nav button[onclick*="${screenId}"]`)?.classList.add('active');
}

function submitComment(e) {
  e.preventDefault();
  const input = document.getElementById('commentInput');
  const container = document.getElementById('commentsContainer');
  if (input.value.trim()) {
    const p = document.createElement('p');
    p.className = 'comment';
    p.textContent = input.value;
    container.appendChild(p);
    input.value = '';
  }
}

document.addEventListener('DOMContentLoaded', function() {
  const commentForm = document.getElementById('commentForm');
  if (commentForm) {
    commentForm.addEventListener('submit', submitComment);
  }
});
