// Handle form submission dynamically
document.getElementById('package-filter-form').addEventListener('submit', function (event) {
    event.preventDefault(); // Prevent form submission
    var countryFilter = document.getElementById('country-filter').value;
    var url = new URL(window.location.href);

    if(countryFilter) {
        url.searchParams.set('country-filter', countryFilter);
    } else if (url.searchParams.has('country-filter')) {
        url.searchParams.delete('country-filter'); // Remove tp_page from the URL
    }

    // Check if country filter is selected and tp_page is present in the URL
    if (url.searchParams.has('tp_page')) {
        url.searchParams.delete('tp_page'); // Remove tp_page from the URL
    }

    // Check if the 'redirectValue' is not empty
    if (travelPackagesFilter.redirectValue && travelPackagesFilter.redirectValue !== "") {
        window.location.href = travelPackagesFilter.redirectValue + "?" + url.searchParams.toString();
    } else {
        window.location.href = url.href;
    }
});
  