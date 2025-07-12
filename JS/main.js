// Handles page loading and navigation
const wireframeContainer = document.getElementById('wireframeContainer');

function loadPage(pageName) {
  if (pages[pageName]) {
    wireframeContainer.innerHTML = pages[pageName];
    window.scrollTo(0, 0);
  } else {
    wireframeContainer.innerHTML = `<div class="text-center text-red-500 py-20">Page not found: ${pageName}</div>`;
  }
}

// Load default page
loadPage('productListing');

