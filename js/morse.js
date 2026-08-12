function loadSubTab(file) {
  fetch(`tabs/${file}.html`)
    .then(response => response.text())
    .then(html => {
      document.getElementById("tabContent").innerHTML = html;
    });
}
