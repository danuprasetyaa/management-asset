// Toggle sidebar
const sidebar = document.getElementById('sidebar');
const toggleButton = document.getElementById('toggleSidebar');
const menuHome = document.querySelectorAll('.sidebar ul li');

toggleButton.addEventListener('click', () => {
    sidebar.classList.toggle('active');
});

menuHome.forEach ( item =>{
    item.addEventListener('click', () => {
        sidebar.classList.remove('active');
    });
});
 

document.addEventListener("DOMContentLoaded", function () {
        const submenuLinks = document.querySelectorAll(".nav-item.has-submenu > .nav-link");

        submenuLinks.forEach(function (link) {
            link.addEventListener("click", function (e) {
                e.preventDefault();
                this.parentElement.classList.toggle("open");
            });
        });

        // Auto-open submenu if one of its links is active
        document.querySelectorAll(".submenu a").forEach(function (submenuLink) {
            if (submenuLink.classList.contains("active")) {
                submenuLink.closest(".has-submenu").classList.add("open");
            }
        });
    });



