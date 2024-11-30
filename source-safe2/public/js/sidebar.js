document.addEventListener('DOMContentLoaded', function() {
    const toggleButtons = document.querySelectorAll('.submenu-toggle');

    toggleButtons.forEach(button => {
        button.addEventListener('click', function() {
            const submenu = this.nextElementSibling; // Get the submenu (ul)
            const icon = this.querySelector('.submenu-icon'); // Get the icon

            // Toggle the display of the submenu
            submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';

            // Add/remove active class to rotate the icon
            this.classList.toggle('active');
        });
    });
});
