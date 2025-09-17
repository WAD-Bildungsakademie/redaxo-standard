/**
 * Author: Stefan Haack (https://shaack.com)
 * Date: 2025-07-23
 */

import {DomUtils} from "cm-web-modules/src/utils/DomUtils.js";
import {CoreUtils} from "cm-web-modules/src/utils/CoreUtils.js";

export class Project {
    constructor() {
        DomUtils.onDocumentReady(() => {
            const debouncedNavbarScrollReduce = CoreUtils.debounce(this.reduceNavbarOnScroll.bind(this), 10, true)
            window.addEventListener("scroll", () => {
                debouncedNavbarScrollReduce()
            })
            this.reduceNavbarOnScroll()
            this.makeCke5TablesResponsive()
            this.slideInEffect()
            this.transformSmartActionLinks()
            this.mobileNavigationClickHandling()
            DomUtils.openExternalLinksBlank()
        })
    }


    /**
     * For tables, generated with the backend editor.
     */
    makeCke5TablesResponsive() {
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

    mobileNavigationClickHandling() {
        // Handle dropdown toggle behavior for mobile navigation
        const dropdownToggles = document.querySelectorAll('.navbar-nav .dropdown-toggle');

        dropdownToggles.forEach(function(toggle) {
            toggle.addEventListener('click', function() {
                // Close all other open dropdowns
                dropdownToggles.forEach(function(otherToggle) {
                    if (otherToggle !== toggle) {
                        const otherDropdown = otherToggle.nextElementSibling;
                        if (otherDropdown && otherDropdown.classList.contains('show')) {
                            otherDropdown.classList.remove('show');
                            otherToggle.classList.remove('show');
                            otherToggle.setAttribute('aria-expanded', 'false');
                        }
                    }
                });
            });
        });

        // Also handle Bootstrap's dropdown events
        const navElement = document.getElementById('navbarNav');
        if (navElement) {
            navElement.addEventListener('show.bs.dropdown', function(e) {
                // Close all other dropdowns when a new one is about to show
                const allDropdowns = navElement.querySelectorAll('.dropdown-menu.show');
                allDropdowns.forEach(function(dropdown) {
                    if (dropdown !== e.target.nextElementSibling) {
                        dropdown.classList.remove('show');
                        const toggle = dropdown.previousElementSibling;
                        if (toggle) {
                            toggle.classList.remove('show');
                            toggle.setAttribute('aria-expanded', 'false');
                        }
                    }
                });
            });
        }
    }

    slideInEffect() {
        const targets = document.querySelectorAll('.slide-in, .slide-in-left, .slide-in-right');
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

    reduceNavbarOnScroll() {
        const navbarBrand = document.querySelector("nav.navbar")
        const secondLevelNav = document.querySelector(".second-level-nav")
        if (window.scrollY > 0) {
            navbarBrand.classList.add("reduce")
            secondLevelNav.classList.add("reduce")
        } else {
            navbarBrand.classList.remove("reduce")
            secondLevelNav.classList.remove("reduce")
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

}