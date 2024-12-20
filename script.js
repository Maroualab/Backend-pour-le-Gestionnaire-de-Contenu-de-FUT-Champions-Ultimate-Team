// Function to open the popup and set the form action based on the action type (add or edit)
function openPopup(action, id = null) {
    document.getElementById('popup').style.display = 'block';
    const form = document.getElementById('popupForm');

    // Set the form action URL based on the action type
    form.action = action === 'add' ? form.dataset.addUrl : form.dataset.updateUrl;

    // Clear all input fields
    form.querySelectorAll('input, select').forEach(input => input.value = '');

    // If the action is edit, fetch the data for the specific entry and populate the form fields
    if (action === 'edit') {
        fetch(form.dataset.getUrl + id)
            .then(response => response.json())
            .then(data => {
                for (const key in data) {
                    if (form.querySelector(`[name="${key}"]`)) {
                        form.querySelector(`[name="${key}"]`).value = data[key];
                    }
                }
            })
            .catch(error => console.error('Error fetching data:', error));
    }
}

// Function to close the popup
function closePopup() {
    document.getElementById('popup').style.display = 'none';
}

// Function to delete an entry after confirmation
function deleteEntry(url) {
    if (confirm('Are you sure you want to delete this entry?')) {
        window.location.href = url;
    }
}

// Function to show the selected dashboard and hide others
function showDashboard(type) {
    // Remove the active class from all sidebar links
    document.querySelectorAll('.sidebar a').forEach(a => a.classList.remove('active'));

    // Add the active class to the selected sidebar link
    document.querySelector(`.sidebar a[onclick="showDashboard('${type}')"]`).classList.add('active');

    // Hide all dashboard contents
    document.querySelectorAll('#content > div').forEach(div => div.style.display = 'none');

    // Show the selected dashboard content
    document.getElementById(`${type}Dashboard`).style.display = 'block';
}
