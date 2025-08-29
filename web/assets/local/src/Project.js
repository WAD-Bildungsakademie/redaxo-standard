/**
 * Author: Stefan Haack (https://shaack.com)
 * Date: 2025-07-23
 */

import {DomUtils} from "cm-web-modules/src/utils/DomUtils.js";

export class Project {
    constructor() {
        DomUtils.onDocumentReady(() => {
            DomUtils.openExternalLinksBlank()
            window.addEventListener("scroll", () => {
                this.updateNavbar()
            })
            this.updateNavbar()
            this.makeTablesResponsive()
            this.closeBootstrapNavigationAfterClick()
            this.slideInEffect()
            this.transformSmartActionLinks()
            DomUtils.openExternalLinksBlank()
        })
    }

    makeTablesResponsive() {
        const figures = document.querySelectorAll("figure.table")
        figures.forEach((figure) => {
            const wrapper = document.createElement("div")
            wrapper.classList.add("table-responsive")
            figure.parentNode.insertBefore(wrapper, figure)
            wrapper.appendChild(figure)
        })
    }

    closeBootstrapNavigationAfterClick() {
        const navLinks = document.querySelectorAll(".navbar-nav .nav-link")
        const navbarCollapse = document.querySelector(".navbar-collapse")

        navLinks.forEach((link) => {
            link.addEventListener("click", function () {
                if (navbarCollapse.classList.contains("show")) {
                    const bootstrapCollapse = bootstrap.Collapse.getInstance(navbarCollapse)
                    bootstrapCollapse.hide()
                }
            });
        });

    }

    slideInEffect() {
        const targets = document.querySelectorAll('img.slide-in, img.slide-in-left, img.slide-in-right');
        if (!targets.length) return;
        // Use IntersectionObserver for efficient viewport detection
        const observer = new IntersectionObserver((entries, obs) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('in-view');
                    // Remove this line if you want the animation every time it re-enters the viewport
                    obs.unobserve(entry.target);
                }
            });
        }, {
            root: null,
            threshold: 0.1,
            rootMargin: '0px 0px -10% 0px' // trigger a bit before fully in view
        });
        targets.forEach(el => observer.observe(el));
    }

    updateNavbar() {
        const navbarBrand = document.querySelector("nav.navbar")
        if (window.scrollY > 0) {
            navbarBrand.classList.add("reduce")
        } else {
            navbarBrand.classList.remove("reduce")
        }
    }

    transformSmartActionLinks() {
        // Find all links that end with '>'
        const links = document.querySelectorAll('a');
        links.forEach(link => {
            const text = link.textContent.trim();
            if (text.endsWith('>')) {
                // Remove the '>' and add the Bootstrap icon
                const newText = text.slice(0, -1).trim();
                link.innerHTML = `${newText} <i class="bi bi-arrow-right icon-animate icon-bold"></i>`;
                link.classList.add('smart-action-link');
            }
        });
    }

// Helper function to convert hex to RGB values
    hexToRgb(hex) {
        const result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
        return result ?
            `${parseInt(result[1], 16)}, ${parseInt(result[2], 16)}, ${parseInt(result[3], 16)}` :
            null;
    }

// Usage

}