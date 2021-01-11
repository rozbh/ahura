let topbar = document.querySelector('.topbar');
if (topbar) {
    topbar.first_height = document.getElementById('topbar').offsetHeight;
    document.getElementById("ah_body").style.paddingTop = topbar.first_height + "px";
    document.body.classList.add('ah_body');
    window.onscroll = function () { scrollFunction() };
}
function scrollFunction() {
    let height;
    if (document.body.scrollTop > 0 || document.documentElement.scrollTop > 0) {
        topbar.classList.add('scrolled-topbar');
        document.body.classList.add('scrolled_padding');
        document.body.classList.remove('ah_body');
        height = document.getElementById('topbar').offsetHeight;
    } else {
        document.body.classList.add('ah_body');
        topbar.classList.remove('scrolled-topbar');
        document.body.classList.remove('scrolled_padding');
        height = topbar.first_height;
    }
    document.getElementById("ah_body").style.paddingTop = height + "px";
}