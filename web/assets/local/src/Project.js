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

    updateNavbar() {
        const navbarBrand = document.querySelector("nav.navbar")
        if (window.scrollY > 0) {
            navbarBrand.classList.add("reduce")
        } else {
            navbarBrand.classList.remove("reduce")
        }
    }
}