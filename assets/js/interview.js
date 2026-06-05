function syncCalendar() {
  document.getElementById('calendar-sync').classList.remove('active');
  document.getElementById('availability').classList.add('active');
  alert('Calendar synced successfully! (demo mode)');
}

function bookInterview() {
  const date = document.getElementById('date-input').value;
  const time = document.getElementById('time-input').value;
  const error = document.getElementById('error-message');

  if (!date || !time) {
    error.style.display = 'block';
    return;
  }

  error.style.display = 'none';
  document.getElementById('confirmation-details').textContent = 'Interview scheduled for ' + date + ' at ' + time;
  document.getElementById('availability').classList.remove('active');
  document.getElementById('confirmation').classList.add('active');
}

function startOver() {
  document.getElementById('confirmation').classList.remove('active');
  document.getElementById('calendar-sync').classList.add('active');
  document.getElementById('date-input').value = '';
  document.getElementById('time-input').value = '';
}

document.addEventListener('DOMContentLoaded', function() {
  const dateInput = document.getElementById('date-input');
  if (dateInput) {
    const today = new Date().toISOString().split('T')[0];
    dateInput.setAttribute('min', today);
  }
});
