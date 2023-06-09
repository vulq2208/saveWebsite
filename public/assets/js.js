document.addEventListener("DOMContentLoaded", function () {
    var headerContainerScroll = document.querySelector(".header-container");
    var iconSearchOpen = document.querySelector(".btn-icon__search");
    var itemListMenu = document.querySelectorAll(".menu__right-list__item");
    var formSearch = document.querySelector(".general-search__form");
    var classContainerHTML = document.querySelector(".js");
    var iconSearchNone = document.querySelector(".btn-icon__search");
    var iconCloseSearch = document.querySelector(".general-close__input_icon");

    iconSearchOpen.addEventListener("click", function () {
        formSearch.classList.add("open-form__search");
        classContainerHTML.classList.add("open");
        iconSearchNone.style.display = "none";
        for (var i = 1; i < itemListMenu.length; i++) {
            itemListMenu[i].style.display = "none";
        }
    });

    iconCloseSearch.addEventListener("click", function () {
        formSearch.classList.remove("open-form__search");
        classContainerHTML.classList.remove("open");
        iconSearchNone.style.display = "block";
        for (var i = 1; i < itemListMenu.length; i++) {
            itemListMenu[i].style.display = "block";
        }
    });
});

window.addEventListener("scroll", function () {
    var headerContainerScroll = document.querySelector(".header-container");
    // var headerMenu = document.querySelector(".header-menu");
    var iconSearchOpen = document.querySelector(".btn-icon__search");
    var itemListMenu = document.querySelectorAll(".menu__right-list__item");
    var formSearch = document.querySelector(".general-search__form");
    var classContainerHTML = document.querySelector(".js");
    var iconSearchNone = document.querySelector(".btn-icon__search");
    var iconCloseSearch = document.querySelector(".general-close__input_icon");

    var utilityUl = document.querySelector(".utility-nav__list");
    var liHeaderMenuBottom = document.querySelector(".utility-nav__list__item");
    var ulHeaderMenuRight = document.querySelector(".header__menu__right-list");

    var headerMenuScroll = document.querySelector(".header-menu");
    var headerMenuRight = document.querySelector(".header__menu__right");
    var parentElement = headerMenuRight.parentElement;

    var scrollPosition = window.scrollY;
    if (scrollPosition > 100) {
        headerContainerScroll.classList.add("header-container__scroll");
        parentElement.insertBefore(headerMenuScroll, headerMenuRight);
        liHeaderMenuBottom.style.listStyle = "none";
        for (var i = 1; i < itemListMenu.length; i++) {
            itemListMenu[i].style.display = "none";
        }
        headerMenuRight.appendChild(liHeaderMenuBottom);
    } else {
        headerContainerScroll.classList.remove("header-container__scroll");
        headerContainerScroll.appendChild(headerMenuScroll);
        utilityUl.appendChild(liHeaderMenuBottom);
        for (var i = 1; i < itemListMenu.length; i++) {
            itemListMenu[i].style.display = "block";
        }
        liHeaderMenuBottom.style.listStyle = "";
    }
});
