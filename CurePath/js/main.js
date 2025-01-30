const hamburgerButton = document.getElementById("hamburger-button");
const navbarMenu = document.getElementById("navbar-menu");

hamburgerButton.addEventListener("click", () => {
    navbarMenu.style.display = navbarMenu.style.display === "none" ? "block" : "none";
});
//phone
const hamburgerButtonn = document.getElementById("hamburger-buttonn");
const navbarMenuu = document.getElementById("navbar-menuu");

hamburgerButtonn.addEventListener("click", () => {
    navbarMenuu.style.display = navbarMenuu.style.display === "none" ? "block" : "none";
});

let slideIndex = 1;
showSlides(slideIndex);

// foto + - 
function plusSlides(n) {
    showSlides(slideIndex += n);
}

function showSlides(n) {
    let slides = document.getElementsByClassName("mySlides");
    if (n > slides.length) {
        slideIndex = 1
    }
    if (n < 1) {
        slideIndex = slides.length
    }
    for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    slides[slideIndex - 1].style.display = "block";
}