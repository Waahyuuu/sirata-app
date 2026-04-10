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
            });

            if (!isOpen) {
                item.classList.add("active");

                const maxHeight = 500;
                const fullHeight = Math.min(content.scrollHeight, maxHeight);

                content.style.height = fullHeight + "px";

                if (icon) icon.style.transform = "rotate(180deg)";
            }
        });
    });
});
