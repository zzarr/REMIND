function windowScroll() {
    var navbar = document.getElementById("navbar-custom");
    if (document.body.scrollTop >= 50 || document.documentElement.scrollTop >= 50) {
        navbar?.classList.add("nav-sticky");
    } else {
        navbar?.classList.remove("nav-sticky");
    }
}

feather.replace();
window.addEventListener("scroll", (e) => {
    e.preventDefault();
    windowScroll();
});

// Handle Tab Navigation
var triggerTabList = [].slice.call(document.querySelectorAll("#tab-menu a"));
triggerTabList.forEach(function (tab) {
    var tabInstance = new bootstrap.Tab(tab);
    tab.addEventListener("click", function (e) {
        e.preventDefault();
        tabInstance.show();
        document.body.classList.remove("enlarge-menu");
    });
});

// Handle Collapse in Navbar
var collapses = document.querySelectorAll(".navbar-nav .collapse");
collapses.forEach((collapse) => {
    var collapseInstance = new bootstrap.Collapse(collapse, { toggle: false });
    collapse.addEventListener("show.bs.collapse", (e) => {
        e.stopPropagation();
        let parentCollapse = collapse.parentElement.closest(".collapse");
        if (parentCollapse) {
            parentCollapse.querySelectorAll(".collapse").forEach((childCollapse) => {
                let instance = bootstrap.Collapse.getInstance(childCollapse);
                if (instance !== collapseInstance) instance.hide();
            });
        }
    });

    collapse.addEventListener("hide.bs.collapse", (e) => {
        e.stopPropagation();
        collapse.querySelectorAll(".collapse").forEach((childCollapse) => {
            bootstrap.Collapse.getInstance(childCollapse).hide();
        });
    });
});

// Toggle Menu
try {
    document.getElementById("togglemenu").addEventListener("click", function (e) {
        e.preventDefault();
        document.body.classList.toggle("enlarge-menu");
    });
} catch (e) {}

// Handle Screen Resize
function handleResize() {
    if (window.screen.width < 1025) {
        document.body.classList.add("enlarge-menu", "enlarge-menu-all");
    } else if (window.screen.width < 1340) {
        document.body.classList.remove("enlarge-menu-all");
        document.body.classList.add("enlarge-menu");
    }
}

handleResize();
window.addEventListener("resize", handleResize);

// Activate Menu Item
function activateMenu() {
    document.querySelectorAll(".menu-body a").forEach(function (link) {
        var currentUrl = window.location.href.split(/[?#]/)[0];
        if (link.href === currentUrl) {
            link.classList.add("active");
            let parent = link.parentNode;
            parent.classList.add("menuitem-active");
            parent.querySelector(".nav-link")?.setAttribute("aria-expanded", "true");

            let grandparent = parent.parentNode.parentNode;
            grandparent.classList.add("show");
            grandparent.parentNode.classList.add("menuitem-active");
            grandparent.parentNode.querySelector(".nav-link")?.setAttribute("aria-expanded", "true");
        }
    });
}

activateMenu();

// Handle Dropdowns
var dropdowns = document.querySelectorAll(".dropup, .dropend, .dropdown, .dropstart");
var events = ["click"];

dropdowns.forEach((dropdown) => {
    var trigger = dropdown.querySelector("[data-bs-toggle='dropdown']");
    if (trigger) {
        trigger.addEventListener(events[0], function (e) {
            toggleDropdown(e, dropdown);
        });
    } else {
        hideDropdowns(dropdown);
    }
});

function toggleDropdown(event, dropdown) {
    var menu = dropdown.querySelector(".dropdown-menu");
    if (menu) {
        event.preventDefault();
        event.stopPropagation();
        document.querySelectorAll(".dropdown-menu").forEach((otherMenu) => {
            if (otherMenu !== menu) {
                otherMenu.classList.remove("show");
            }
        });
        menu.classList.add("show");
    }
}

function hideDropdowns(dropdown) {
    var subMenus = dropdown.querySelectorAll(".dropdown-menu");
    subMenus.forEach((subMenu) => subMenu.classList.remove("show"));
}

// Mobile Menu Toggle
function toggleMenu() {
    document.getElementById("mobileToggle").classList.toggle("open");
    var nav = document.getElementById("navigation");
    nav.style.display = nav.style.display === "block" ? "none" : "block";
}

document.querySelectorAll("#navigation li a").forEach(function (link) {
    var currentUrl = window.location.href.split(/[?#]/)[0];
    if (link.href === currentUrl) {
        link.classList.add("active");
        let parent = link.parentNode.parentNode;
        parent.classList.add("active");
        parent.querySelector(".nav-link")?.classList.add("active");
        let grandparent = parent.parentNode.parentNode;
        grandparent.classList.add("active");
    }
});

document.querySelector(".navbar-toggle")?.addEventListener("click", function (e) {
    e.target.classList.toggle("open");
});
