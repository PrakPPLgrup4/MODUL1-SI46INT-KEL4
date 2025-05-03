document.addEventListener("DOMContentLoaded", function () {
  fetch("../nav/psylopnav.html")
      .then(response => response.text())
      .then(data => {
          document.getElementById("navbar").innerHTML = data;
      })
      .catch(error => console.error("Error loading the navigation bar:", error));
});
