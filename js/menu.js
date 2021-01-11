function menuclick() {
    var x = document.getElementById("siteside");
    if (x.className === "siteside") {
        x.className += " sitesideopen";
    } else {
        x.className = "siteside";
    }
}
function mgmenuclick() {
    var x = document.getElementById("mgsiteside");
    if (x.className === "mgsiteside") {
        x.className += " mgsitesideopen";
    } else {
        x.className = "mgsiteside";
    }
}

jQuery(document).ready(function ($) {
    function close_search_modal() {
        let search_modal = $('.header-mode-2 .search-modal');
        search_modal.find('input[name=s]').val('');
        search_modal.find('#ajax_search_res').html('');
        search_modal.removeClass('show');
        $('body').removeClass('none_overflow');
    }
    // show search modal on header-mode-2
    $(document).on('click', '.header-mode-2 #action_search', function (e) {
        e.stopPropagation();
        e.preventDefault();
        $('body').addClass('none_overflow');
        $('.header-mode-2 .search-modal').addClass('show');
        $('.header-mode-2 .search-modal input[name=s]').focus();
    });
    $(document).on('click', '.header-mode-2 .search-modal .close', function (e) {
        close_search_modal();
    });
    $('.main-menu li.menu-item-has-children')
        .css({ cursor: "pointer" })
        .on('click', function (e) {
            if ($(window).width() < 1100) {
                e.preventDefault();
            }
            $(this).find('ul').toggle();
        });

    $('.topmenu li.menu-item-has-children>a')
        .css({ cursor: "pointer" })
        .on('click', function (e) {
            if ($(window).width() < 1100) {
                e.preventDefault();
            }
            let mw_this = $(this);
            let mw_menu = mw_this.next('ul');
            mw_menu.toggle();
        });
    $(document).on('click', '#mw_open_side_menu', function (e) {
        e.stopPropagation();
        e.preventDefault();
        if ($(window).width() > 1100) {
            // open menu in desktop
            $(".cats-list ul.menu").toggleClass('show_menu');
        } else {
            menuclick();
        }
    });
    $(document).on('click', '#mw_open_side_mgmenu', function (e) {
        e.stopPropagation();
        e.preventDefault();
        if ($(window).width() > 1100) {
            // open menu in desktop
            $(".cats-list ul.menu").toggleClass('show_menu');
        } else {
            mgmenuclick();
        }
    });
    $(document).on('keydown', '.header-mode-2 .search-modal', function (e) {
        if (e.which == 27) {
            close_search_modal();
        }
    });
    $(document).on('click', 'body', function (e) {
        let mw_mgmenu = $("#mgsiteside");
        if (mw_mgmenu.hasClass("mgsitesideopen")) {
            if (!$(e.target).closest('#mgsiteside').length && mw_mgmenu.is(':visible')) {
                mw_mgmenu.removeClass('mgsitesideopen');
            }
        }
        if (mw_mgmenu.hasClass('show_menu')) {
            if (!$(e.target).closest(mw_mgmenu.parent()).length) {
                mw_mgmenu.removeClass('show_menu');
            }
        }
    });
    $(document).on('click', 'body', function (e) {
        let mw_menu = $("#siteside"),
            mega_menu = $(".cats-list ul.menu");
        if (mw_menu.hasClass("sitesideopen")) {
            if (!$(e.target).closest('#siteside').length && mw_menu.is(':visible')) {
                mw_menu.removeClass('sitesideopen');
            }
        }
        if (mega_menu.hasClass('show_menu')) {
            if (!$(e.target).closest(mega_menu.parent()).length) {
                mega_menu.removeClass('show_menu');
            }
        }
        // check is header-mode-2 active
        if ($('#topbar.topbar').hasClass('header-mode-2')) {
            // check is search modal open
            if ($('.header-mode-2 .search-modal').hasClass('show')) {
                if (!$(e.target).closest($('.header-mode-2 .search-modal .search-form')).length) {
                    close_search_modal();
                }
            }
        }
    });

    $(document).on('click', '.cats-list-title', function (e) {
        let mw_menu = $('.cats-list > div ul.menu');
        if (mw_menu.hasClass('mw_open')) {
            mw_close_mega_section();
        } else {
            mw_open_mega_section();
        }
    });

    function mw_open_mega_section() {
        let mw_menu = $('.cats-list > div ul.menu');
        mw_menu.addClass('mw_open');
        mw_menu.slideDown();
    }
    function mw_close_mega_section()
    {
        let mw_menu = $('.cats-list > div ul.menu');
        mw_menu.removeClass('mw_open');
        mw_menu.slideUp();
    }
    $(document).on('click', '.cats-list li.menu-item-has-children>a', function (e) {
        if ($(window).width() <= 767) {
            e.preventDefault();
            $(this).next('ul').toggleClass('show_sub_menu');
        }
    });
    $(window).on('scroll', function () {
        if ($(document).scrollTop() > 300) {
            $("#goto-top").css('display', 'flex');
        } else {
            $("#goto-top").css('display', 'none');
        }
    });
    $(document).on('click', '#goto-top', function (e) {
        $("html, body").animate({ scrollTop: 0 });
    })
    $(document).on('click', '#mcart-stotal', function (e) {
        e.preventDefault();
    });
});

// Close Menu
var menu_close = document.getElementById('menu-close');
var menu = document.getElementById('siteside');
menu_close.addEventListener('click', function () {
    menu.classList.remove('sitesideopen');
});
// Close Menu