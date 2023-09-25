// Wait for the DOM content to be fully loaded before executing JavaScript
document.addEventListener('DOMContentLoaded', function () {
    // Select all elements with the class 'deleteuserBtn' and store them in deleteButtons
    const deleteButtons = document.querySelectorAll('.deleteuserBtn');

    // Iterate through each 'deleteuserBtn' element
    deleteButtons.forEach(function (button) {
        // Add a click event listener to each 'deleteuserBtn'
        button.addEventListener('click', function (e) {
            // Display a confirmation dialog to the user with a specified message
            const confirmed = confirm("Do you want to delete this user?");
            
            // If the user clicks 'Cancel' in the dialog, prevent the default form submission
            if (!confirmed) {
                e.preventDefault(); // Prevent form submission if not confirmed
            }
        });
    });
});
