const header = document.querySelector('.header');
const nav = document.querySelector('.nav');
const links = document.querySelectorAll('.header__nav__link');
// navbar responsive
(function () {
    let button = $('#header__icon')
    let sidebarOpened = false;

    button.on('click', function (evt) {
        evt.preventDefault();
        evt.stopPropagation();
        sidebarOpened = true;
        $('body').toggleClass('with--sidebar')
    })

    document.body.addEventListener('click', function () {
        if (sidebarOpened) {
            document.body.classList.remove('with--sidebar')
            header.style.opacity = "100%";
            links.forEach(link => {
                link.style.color = "white";
            });
        }
    })
})()

// navbar
window.onscroll = function () {
    if (document.documentElement.scrollTop > 200) {
        header.style.background = "#e44c2e";
        header.style.opacity = "80%";
        header.style.transitionDuration = "1s";
        // header.style.padding = "10px";
        links.forEach(link => {
            link.style.color = "white";
            link.addEventListener("mouseover", function (evt) {
                evt.target.style.color = "white"
                setTimeout(function () {
                    evt.target.style.color = "blue";
                },500);
            }, false);
            link.addEventListener("mouseout", function (evt) {
                evt.target.style.color = "white"
                setTimeout(function () {
                    evt.target.style.color = "white";
                },500);
            }, false);
        })
    } else {
        header.style.background = "transparent";
        header.style.transitionDuration = "1s";
        // header.style.padding = "30px";
        header.style.opacity = "100%";
        links.forEach(link => {
            link.style.color = "black";
            link.addEventListener("mouseover", function (evt) {
                evt.target.style.color = "black"
                setTimeout(function () {
                    evt.target.style.color = "blue";
                },500);
            }, false);
            link.addEventListener("mouseout", function (evt) {
                evt.target.style.color = "black"
                setTimeout(function () {
                    evt.target.style.color = "black";
                },500);
            }, false);
        })
    }
}