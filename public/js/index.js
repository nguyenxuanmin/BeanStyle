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
            $(this).find('.dropdown-content').stop(true, true).slideDown(350);
        },
        function () {
            const $dropdown = $(this).find('.dropdown-content');
            $dropdown.stop(true, true).slideUp(350);
        }
    );

    $('#itemMenuMobile').click(function() {
        $("#header").addClass("show-menu");
    });

    $('#itemHideMenu').click(function() {
        $("#header").removeClass("show-menu");
    });

    $('.toggle').on('click', function (e) {
        e.preventDefault();

        const $icon = $(this);
        const $submenu = $icon.next('ul.sub-menu');

        if ($submenu.length) {
            $submenu.slideToggle(200);
            if ($icon.hasClass('fa-angle-right')) {
                $icon.removeClass('fa-angle-right').addClass('fa-chevron-down');
            } else {
                $icon.removeClass('fa-chevron-down').addClass('fa-angle-right');
            }
        }
    });
    $('.category-navbar li i').on('click', function (e) {
        e.preventDefault();
        const iconCategory = $(this);
        const subCategory = iconCategory[0].nextElementSibling;
        const parentIconCategory = iconCategory[0].parentElement;
        const isHidden = subCategory.style.maxHeight === '0px' || subCategory.style.maxHeight === '';
        if (isHidden) {
            subCategory.style.maxHeight = subCategory.scrollHeight + 'px';
            iconCategory[0].classList.remove('fa-plus');
            iconCategory[0].classList.add('fa-minus');
            parentIconCategory.classList.add('active');
        } else {
            subCategory.style.maxHeight = '0px';
            iconCategory[0].classList.remove('fa-minus');
            iconCategory[0].classList.add('fa-plus');
            parentIconCategory.classList.remove('active');
        }
    });
    if ($('.my-slider').length) {
        $('.my-slider').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            nextArrow:
                '<div class="slick-arrow slick-next"><i class="fa-solid fa-right-long"></i></div>',
            prevArrow:
                '<div class="slick-arrow slick-prev"><i class="fa-solid fa-left-long"></i></div>',
            autoplay: true,
            arrows: true,
            autoplaySpeed: 5000
        });
    }

    if ($('.my-product').length) {
        $(".my-product").slick({
            slidesToShow: 5,
            slidesToScroll: 1,
            nextArrow:
                '<div class="slick-arrow slick-next"><i class="fa fa-chevron-right" aria-hidden="true"></i></div>',
            prevArrow:
                '<div class="slick-arrow slick-prev"><i class="fa fa-chevron-left" aria-hidden="true"></i></div>',
            autoplay: true,
            arrows: true,
            autoplaySpeed: 5000,
            responsive: [
                {
                breakpoint: 1026,
                    settings: {
                        slidesToShow: 3
                    }
                },
                {
                breakpoint: 992,
                    settings: {
                        slidesToShow: 2
                    }
                },
                {
                breakpoint: 600,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });
    }

    if ($('.my-adv').length) {
        $(".my-adv").slick({
            slidesToShow: 2,
            slidesToScroll: 1,
            autoplay: true,
            arrows: false,
            autoplaySpeed: 4000,
            responsive: [
                {
                breakpoint: 1026,
                    settings: {
                        slidesToShow: 2
                    }
                },
                {
                breakpoint: 992,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });
    }

    if ($('.my-blog').length) {
        $(".my-blog").slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            nextArrow:
                '<div class="slick-arrow slick-next"><i class="fa fa-chevron-right" aria-hidden="true"></i></div>',
            prevArrow:
                '<div class="slick-arrow slick-prev"><i class="fa fa-chevron-left" aria-hidden="true"></i></div>',
            autoplay: false,
            arrows: true,
            infinite: false,
            responsive: [
                {
                breakpoint: 1026,
                    settings: {
                        slidesToShow: 3
                    }
                },
                {
                breakpoint: 992,
                    settings: {
                        slidesToShow: 2
                    }
                },
                {
                breakpoint: 600,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });
    }
});