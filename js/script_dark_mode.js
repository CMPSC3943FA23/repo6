// To toggle and save dark mode
const darkModeButton = document.querySelector("#dark-mode-button")
const darkModeIcon = document.querySelector("#dark-mode-icon")
const mainNavbar = document.querySelector("#main-navbar")

// Immediately set dark mode if it is enabled
if (localStorage.getItem("darkMode") == "true") {
    document.querySelector("html").setAttribute("data-bs-theme", "dark")
    darkModeIcon.classList.remove("bi-lightbulb")
    darkModeIcon.classList.add("bi-lightbulb-off")
    mainNavbar.classList.remove("navbar-light")
    mainNavbar.classList.remove("bg-light")
    mainNavbar.classList.add("navbar-dark")
    mainNavbar.classList.add("bg-dark")
}

// Toggle dark mode with the button
darkModeButton.addEventListener("click", function() {
    if (localStorage.getItem("darkMode") == "true") {
        localStorage.setItem("darkMode", "false")
        document.querySelector("html").setAttribute("data-bs-theme", "light")
        darkModeIcon.classList.remove("bi-lightbulb-off")
        darkModeIcon.classList.add("bi-lightbulb")
        mainNavbar.classList.remove("navbar-dark")
        mainNavbar.classList.remove("bg-dark")
        mainNavbar.classList.add("navbar-light")
        mainNavbar.classList.add("bg-light")
    }
    else {
        localStorage.setItem("darkMode", "true")
        document.querySelector("html").setAttribute("data-bs-theme", "dark")
        darkModeIcon.classList.remove("bi-lightbulb")
        darkModeIcon.classList.add("bi-lightbulb-off")
        mainNavbar.classList.remove("navbar-light")
        mainNavbar.classList.remove("bg-light")
        mainNavbar.classList.add("navbar-dark")
        mainNavbar.classList.add("bg-dark")
    }
})