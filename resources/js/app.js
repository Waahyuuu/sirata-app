import "./bootstrap";

// load skeleton
window.addEventListener("load", function () {
    const skeleton = document.getElementById("skeleton");
    const skeletonfooter = document.getElementById("skeleton-footer");
    const content = document.getElementById("content");
    const contentfooter = document.getElementById("content-footer");

    let delay = 1000;

    if (navigator.connection) {
        const type = navigator.connection.effectiveType;
        console.log("Network type:", type);

        switch (type) {
            case "slow-2g":
            case "2g":
                delay = 3000;
                break;
            case "3g":
                delay = 2000;
                break;
            case "4g":
                delay = 1000;
                break;
            case "5g":
                delay = 700;
                break;
            default:
                delay = 1000;
        }
    }

    setTimeout(function () {
        skeleton.style.display = "none";
        skeletonfooter.style.display = "none";
        content.classList.remove("hidden");
        contentfooter.classList.remove("hidden");
    }, delay);
});

// Back Top
const backToTop = document.getElementById("back-to-top");
const formSection = document.querySelector(".form-section");

window.addEventListener("scroll", function () {
    if (!formSection) return;

    if (window.scrollY > formSection.offsetTop + 100) {
        // fade in
        backToTop.classList.remove("opacity-0", "pointer-events-none");
        backToTop.classList.add("opacity-100", "pointer-events-auto");
    } else {
        // fade out
        backToTop.classList.add("opacity-0", "pointer-events-none");
        backToTop.classList.remove("opacity-100", "pointer-events-auto");
    }
});

// scroll ke atas
backToTop.addEventListener("click", function () {
    window.scrollTo({
        top: 0,
        behavior: "smooth",
    });
});

// accordion
const faqItems = document.querySelectorAll(".faq-item");

faqItems.forEach(item => {

    const btn = item.querySelector(".faq-question");
    const content = item.querySelector(".faq-content");

    btn.addEventListener("click", () => {

        const isOpen = item.classList.contains("active");

        // tutup semua
        faqItems.forEach(i => {
            i.classList.remove("active");
            i.querySelector(".faq-content").style.height = "0px";
        });

        // buka yang diklik
        if (!isOpen) {
            item.classList.add("active");
            content.style.height = content.scrollHeight + "px";
        }

    });

});
