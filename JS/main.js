document.addEventListener("DOMContentLoaded", function () {
  const fetchButton = document.getElementById("fetchDataBtn");
  const resultContainer = document.getElementById("result");

  fetchButton.addEventListener("click", function () {
    fetch("main.php")
      .then(response => {
        if (!response.ok) {
          throw new Error("Network response was not ok");
        }
        return response.text();
      })
      .then(data => {
        resultContainer.innerHTML = data;
      })
      .catch(error => {
        resultContainer.innerHTML = "Error: " + error.message;
      });
  });
});
loadpage = () => {
  const xhr = new XMLHttpRequest();
  xhr.open("GET", "PhP/productListing.php", true);
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      document.getElementById("content").innerHTML = xhr.responseText;
    }
  };
  xhr.send();
} 