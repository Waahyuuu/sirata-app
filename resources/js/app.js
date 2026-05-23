import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;
Alpine.start();

window.addEventListener("load", function () {
    const skeleton = document.getElementById("skeleton");
    const skeletonFooter = document.getElementById("skeleton-footer");
    const content = document.getElementById("content");
    const contentFooter = document.getElementById("content-footer");

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
        if (skeleton) skeleton.style.display = "none";
        if (skeletonFooter) skeletonFooter.style.display = "none";

        if (content) content.classList.remove("hidden");
        if (contentFooter) contentFooter.classList.remove("hidden");
    }, delay);

    const backToTop = document.getElementById("back-to-top");
    const formSection = document.querySelector(".form-section");

    if (backToTop) {
        window.addEventListener("scroll", function () {
            if (!formSection) {
                if (window.scrollY > 300) {
                    backToTop.classList.remove(
                        "opacity-0",
                        "pointer-events-none",
                    );
                    backToTop.classList.add(
                        "opacity-100",
                        "pointer-events-auto",
                    );
                } else {
                    backToTop.classList.add("opacity-0", "pointer-events-none");
                    backToTop.classList.remove(
                        "opacity-100",
                        "pointer-events-auto",
                    );
                }

                return;
            }

            if (window.scrollY > formSection.offsetTop + 100) {
                backToTop.classList.remove("opacity-0", "pointer-events-none");
                backToTop.classList.add("opacity-100", "pointer-events-auto");
            } else {
                backToTop.classList.add("opacity-0", "pointer-events-none");
                backToTop.classList.remove(
                    "opacity-100",
                    "pointer-events-auto",
                );
            }
        });

        backToTop.addEventListener("click", function () {
            window.scrollTo({
                top: 0,
                behavior: "smooth",
            });
        });
    }

    const faqItems = document.querySelectorAll(".faq-item");

    faqItems.forEach((item) => {
        const btn = item.querySelector(".faq-question");
        const content = item.querySelector(".faq-content");
        const icon = item.querySelector(".faq-icon");

        if (!btn || !content) return;

        content.style.height = "0px";
        content.style.overflow = "hidden";
        content.style.transition = "height 0.35s ease, padding 0.35s ease";

        btn.addEventListener("click", () => {
            const isOpen = item.classList.contains("active");

            faqItems.forEach((i) => {
                const c = i.querySelector(".faq-content");
                const ic = i.querySelector(".faq-icon");

                i.classList.remove("active");

                if (c) c.style.height = "0px";
                if (ic) ic.style.transform = "rotate(0deg)";

                // khusus mata
                const eyeOpen = i.querySelector(".eye-open");
                const eyeClosed = i.querySelector(".eye-closed");

                if (eyeOpen) {
                    eyeOpen.classList.remove("hidden");
                    eyeOpen.classList.add("block");
                }
                if (eyeClosed) {
                    eyeClosed.classList.add("hidden");
                    eyeClosed.classList.remove("block");
                }
            });

            if (!isOpen) {
                item.classList.add("active");

                const maxHeight = 500;
                const fullHeight = Math.min(content.scrollHeight, maxHeight);

                content.style.height = fullHeight + "px";

                if (icon) icon.style.transform = "rotate(180deg)";

                // khusus mata
                const currentEyeOpen = item.querySelector(".eye-open");
                const currentEyeClosed = item.querySelector(".eye-closed");

                if (currentEyeOpen && currentEyeClosed) {
                    currentEyeOpen.classList.remove("block");
                    currentEyeOpen.classList.add("hidden");

                    currentEyeClosed.classList.remove("hidden");
                    currentEyeClosed.classList.add("block");
                }
            }
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("#sirata form");
    const btn = document.getElementById("btnCari");
    const overlay = document.getElementById("loadingOverlay");

    if (form) {
        form.addEventListener("submit", function (e) {
            e.preventDefault();

            if (overlay) {
                overlay.classList.remove("hidden");
            }

            if (btn) {
                btn.disabled = true;
                btn.innerText = "Mencari...";
            }

            setTimeout(() => {
                form.submit();
            }, 300);
        });
    }
});

document.addEventListener("DOMContentLoaded", () => {
    const reveals = document.querySelectorAll(
        ".reveal-right, .reveal-left, .reveal-up"
    );

    function animateOnScroll() {
        const triggerBottom = window.innerHeight * 0.85;

        reveals.forEach((el) => {
            const top = el.getBoundingClientRect().top;
            const bottom = el.getBoundingClientRect().bottom;

            if (top < triggerBottom && bottom > 0) {
                el.classList.add("show");
            } else {
                // reset biar replay
                el.classList.remove("show");
            }
        });
    }

    window.addEventListener("scroll", animateOnScroll);

    animateOnScroll();
});