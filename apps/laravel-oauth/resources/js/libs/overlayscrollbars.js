// sidebar-scrollbars.js
import "overlayscrollbars/overlayscrollbars.css"; // pastikan import CSS juga
import { OverlayScrollbars } from "overlayscrollbars";

/**
 * Initialize OverlayScrollbars for sidebar
 */
export default function initSidebarScrollbars(selector = ".sidebar-wrapper") {
    document.addEventListener("DOMContentLoaded", () => {
        const sidebarWrapper = document.querySelector(selector);
        if (sidebarWrapper instanceof HTMLElement) {
            OverlayScrollbars(sidebarWrapper, {
                scrollbars: {
                    theme: "os-theme-light",
                    autoHide: "leave",
                    clickScroll: true,
                },
            });
        }
    });
}
