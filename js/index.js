function nextWelcome(pageNumber) {
  document.querySelectorAll('.welcome').forEach(w => {
    w.classList.remove('active');
    w.classList.add('hidden');
  });
  const page = document.getElementById('welcome' + pageNumber);
  page.classList.remove('hidden');
  setTimeout(() => page.classList.add('active'), 50);
}

function prevWelcome(pageNumber) {
  nextWelcome(pageNumber);
}
