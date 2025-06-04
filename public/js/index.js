$(document).ready(function() {
    const header = $('#header');
    window.onscroll = function () {
        if (window.pageYOffset > 130) {
            header.addClass('header-fixed');
            $('#scrollToTop').fadeIn();
        } else {
            header.removeClass('header-fixed');
            $('#scrollToTop').fadeOut();
        }
    };

    $('#scrollToTop').click(function() {
        $('html, body').animate({ scrollTop: 0 }, 'smooth');
        return false;
    });

    const input = $('#inputSearch');
    const suggestBox = $('#resultSearch');

    input.on('focus', function () {
        suggestBox.show();
    });

    $(document).on('click', function (e) {
        if (!$(e.target).closest('.item-search').length) {
            suggestBox.hide();
        }
    });

    $('li:has(#displayDropdown)').hover(
        function () {
            $(this).find('.dropdown-content').stop(true, true).slideDown(200);
        },
        function () {
            const $dropdown = $(this).find('.dropdown-content');
            $dropdown.stop(true, true).slideUp(200);
        }
    );

    $('#itemMenuMobile').click(function() {
        $("#header").addClass("show-menu");
    });

    $('#itemHideMenu').click(function() {
        $("#header").removeClass("show-menu");
    });

    $('.my-slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        nextArrow:
            '<div class="slick-arrow slick-next"><i class="fa-solid fa-right-long"></i></div>',
        prevArrow:
            '<div class="slick-arrow slick-prev"><i class="fa-solid fa-left-long"></i></div>',
        autoplay: true,
        arrows: true,
        autoplaySpeed: 3000
    });
});