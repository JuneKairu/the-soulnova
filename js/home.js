function toggleDropdown(id) {
  const dropdown = document.getElementById(id);
  dropdown.classList.toggle('hidden');
}

function loadTab(file) {
  fetch(`tabs/${file}.html`)
    .then(response => response.text())
    .then(html => {
      document.getElementById("tabContent").innerHTML = html;

      // Load topic-specific CSS if exists
      const topic = file.split('-')[0]; // e.g., morse, binary
      const link = document.createElement("link");
      link.rel = "stylesheet";
      link.href = `css/${topic}.css`;
      document.head.appendChild(link);

      // Load topic-specific JS if exists
      const script = document.createElement("script");
      script.src = `js/${topic}.js`;
      document.body.appendChild(script);
    });
}
