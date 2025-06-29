<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @if (!empty($company->favicon))
            <link rel="icon" href="{{asset('storage/company/favicon/'.$company->favicon)}}" type="favicon">
        @endif
        <title>@yield('title')</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
        <link rel="stylesheet" href="{{asset('css/index.css')}}"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    </head>
    <body>
        <div class="wrapper">
            @include('client.layout.header')
            <main>
                @yield('content')
            </main>
            @include('client.layout.footer')
        </div>
        <div id="scrollToTop"><i class="fa-solid fa-arrow-up"></i></div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="{{asset('js/index.js')}}"></script>
            <script>
                $(document).ready(function() {
                    if ($('#countdown').length) {
                        @if (!empty($company->sale_date))
                            var endDate = new Date("{{$company->sale_date->toIso8601String()}}");
                            function updateCountdown() {
                                var now = new Date();
                                var diff = endDate - now;

                                if (diff <= 0) {
                                    $('#countdown').html("<b>Đã kết thúc!</b>");
                                    return;
                                }

                                var days = Math.floor(diff / (1000 * 60 * 60 * 24));
                                var hours = Math.floor((diff / (1000 * 60 * 60)) % 24);
                                var minutes = Math.floor((diff / 1000 / 60) % 60);
                                var seconds = Math.floor((diff / 1000) % 60);

                                $('#countdownDays').text(days);
                                $('#countdownHours').text(String(hours).padStart(2, '0'));
                                $('#countdownMinutes').text(String(minutes).padStart(2, '0'));
                                $('#countdownSeconds').text(String(seconds).padStart(2, '0'));
                            }
                            updateCountdown();
                            setInterval(updateCountdown, 1000);
                        @else
                            $('#countdown').html("<b>Đã kết thúc!</b>");
                        @endif
                    }

                    if ($('.item-product-tab').length) {
                        function fetchProducts(status) {
                            $.ajax({
                                url: '{{route('ajax_all_product')}}',
                                method: 'GET',
                                data: { status: status },
                                success: function (html) {
                                    $('#allProduct').html(html);
                                    $(".my-all-product").slick({
                                        rows: 2,
                                        slidesPerRow: 5,
                                        nextArrow:
                                            '<div class="slick-arrow slick-next"><i class="fa fa-chevron-right" aria-hidden="true"></i></div>',
                                        prevArrow:
                                            '<div class="slick-arrow slick-prev"><i class="fa fa-chevron-left" aria-hidden="true"></i></div>',
                                        autoplay: true,
                                        arrows: true,
                                        autoplaySpeed: 5000,
                                        responsive: [
                                            {
                                            breakpoint: 1025,
                                                settings: {
                                                    slidesPerRow: 4,
                                                }
                                            },
                                            {
                                            breakpoint: 992,
                                                settings: {
                                                    slidesPerRow: 3,
                                                }
                                            },
                                            {
                                            breakpoint: 600,
                                                settings: {
                                                    slidesPerRow: 2,
                                                }
                                            }
                                        ]
                                    });
                                },
                                error: function (xhr, status, error) {
                                    console.error('Lỗi khi tải sản phẩm:', error);
                                }
                            });
                        }

                        fetchProducts('new');

                        $('.item-product-tab li').on('click', function () {
                            const status = $(this).data('status');
                            $('.item-product-tab li').removeClass('active');
                            $(this).addClass('active');
                            fetchProducts(status);
                        });
                    }
                });
            </script>
    </body>
</html>