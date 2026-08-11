function showTab(tabId) {
  document.querySelectorAll('.tab').forEach(t => {
    t.classList.add('hidden');
    t.classList.remove('active');
  });
  const tab = document.getElementById(tabId);
  tab.classList.remove('hidden');
  tab.classList.add('active');
}
