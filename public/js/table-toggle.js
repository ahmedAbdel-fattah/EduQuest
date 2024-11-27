// Select all the toggle links
const toggleLinks = document.querySelectorAll('.toggle-link');

// Loop through each link and add an event listener
toggleLinks.forEach(link => {
    link.addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default anchor behavior
        const tableId = this.getAttribute('data-table'); // Get the table ID from data attribute
        const table = document.getElementById(tableId); // Select the corresponding table

        // Toggle the 'hidden' class to show/hide the table
        if (table.classList.contains('hidden')) {
            table.classList.remove('hidden');
            this.textContent = "Hide Students"; // Change the link text
        } else {
            table.classList.add('hidden');
            this.textContent = "View Students"; // Revert link text back
        }
    });
});
