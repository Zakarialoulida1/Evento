import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

function toggleDropdown() {
    var dropdownMenu = document.getElementById("hs-dropdown-menu");
    if (dropdownMenu.classList.contains("hidden")) {
        dropdownMenu.classList.remove("hidden");
    } else {
        dropdownMenu.classList.add("hidden");
    }
}

