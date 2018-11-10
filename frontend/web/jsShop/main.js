function initSliders() {
    /* start related products slider */
    var swiperRelated = new Swiper('.swiper-container', {
        direction: 'horizontal',
        slidesPerView: 3,
        effect: 'slide',
        spaceBetween: 10,
        // autoplay: {
        //     delay: 4000
        // },
        navigation: {
            nextEl: '.related-item-next',
            prevEl: '.related-item-prev'
        }
        //loop: true
    });
    var allSlides  = $('.swiper-wrapper .swiper-slide').length,
        showSlides = swiperRelated.params.slidesPerView;
    $('.related-item-prev').addClass('disable');
    if (allSlides <= showSlides) {
        $('.related-item-next, .related-item-prev').addClass('disable');
    }
    swiperRelated.on('slideChange', function() {
        if (this.realIndex > 0) {
            $('.related-item-prev').removeClass('disable');
        }
        else {
            $('.related-item-prev').addClass('disable');
        }
        if ((this.realIndex + 3) === allSlides) {
            $('.related-item-next').addClass('disable');
        }
        else {
            $('.related-item-next').removeClass('disable');
        }
    });
    /* /end related products slider */

}
function refreshHeaderCart() {
    $.ajax({
        url: $('.shopping-item').data('refresh-url'),
        type: 'POST',
        dataType: 'html',
    }).done(function(data) {
        $('#cart-header').html(data);
    }).fail(function(err) {
        alert('Ошибка обновления козрины в хедере');
        console.log(err);
    });

}
function cartHandlers() {
    /* добавление в корзину из деталки */
    $('form[name=ADD_TO_CART]').on('submit', function(e) {
        e.preventDefault();
        var data = $(this).serialize();
        $.ajax({
            url: $(this).attr('action'),
            type: 'GET',
            data: data,
            dataType: 'html',
            async: true
        }).done(function(data) {
            $.fancybox.open(data, {
                width: 800,
                height: 500,
                autoSize: false,
                autoResize: false
            });

            refreshHeaderCart();
        }).fail(function(err) {
            console.log(err);
            alert('Ошибка ajax запроса добавления товара в корзину!');
        });
    });

    /* добавление в корзину из каталога */
    $('.product-option-shop .add_to_cart_button').on('click', function(e) {
        e.preventDefault();
        $.get($(this).attr('href'), {id: $(this).data('id'), quantity: $(this).data('quantity')}, function(data) {
            $.fancybox.open(data, {
                width: 800,
                height: 500,
                autoSize: false,
                autoResize: false
            });
            refreshHeaderCart();
        }, 'html');
    });

    /* удаление из корзины */
    $('.product-remove a.remove').on('click', function() {
        $.ajax({
            url: location.href + location.search,//'/frontend/web/cart/show-cart/',
            type: 'POST',
            dataType: 'html',
            context: $(this),
            data: {
                'id': $(this).data('id'),
                'del': true
            }
        }).done(function(data) {
            /* try catch для ситуации, когда приходит пусой json ответ от сервера (корзина пуста = в сессии ничего нет) */
            try {
                var arrRefreshFileds = JSON.parse(data);
                $('table.shop_table.cart tbody').html(arrRefreshFileds[0]);
                $('.cart_totals table tbody').html(arrRefreshFileds[1]);

                cartHandlers();
                /* меняем данные в корзине хедера */
                refreshHeaderCart();
                /* / */

            }
            catch (err) {
                /* поидее это костыль для случая, когда удаляем последний элемент из корзины, нужно подумать как сделать по-другому */
                $('table.shop_table.cart').remove();
                $('.cart_totals').remove();
                $('.woocommerce').prepend('<h2 class="sidebar-title">Ваша корзина пуста</h2>');

                cartHandlers();
                /* меняем данные в корзине хедера */
                refreshHeaderCart();
                /* / */
            }
        }).fail(function(err) {
            console.log(err);
            alert('Ошибка ajax запроса удаления товаров из корзины!');
        });
    });

    /* обработчик обновления корзины */
    $('input[name=update_cart]').on('click', function(e) {
        var data = $(this).closest('form').serialize(),
            url  = $(this).data('href-update');
        //console.log(data);
        e.preventDefault();
        $.ajax({
            url: url,
            type: 'POST',
            data: data
        }).done(function(data) {
            /* не используем try catch потому что стоит ограничение на уменьшение товара в корзине не меньше 1 */
            var arrRefreshFileds = JSON.parse(data);
            $('#cart-form table tbody').html(arrRefreshFileds[0]);
            $('.cart_totals table tbody').html(arrRefreshFileds[1]);

            cartHandlers();
            refreshHeaderCart();
        }).fail(function() {
            alert('Ошибка обновления корзины');
        });
    });

    /* TODO: исправить в корзине сабмит на ссылку и прописать для нее стили */
    $('input[name=proceed]').on('click', function(e) {
        e.preventDefault();
        var href = $(this).data('href-order');
        location.href = href;
    });
}
jQuery(document).ready(function($){

/* custom scripts START */

    //accordeon menu-left(catalog)
    $('.section-item').accordion({
        //event: 'click',
        active: false,
        collapsible: true,
        heightStyle: true,
        beforeActivate: function(event, ui) {
            if (ui.newHeader.hasClass('last')) {
                $.each($('.ui-state-active'), function() {
                    $(this).removeClass('ui-state-active');
                });
                ui.newHeader.toggleClass('ui-state-active');
                return false;
            }
        }
    });

    var elementsMenu = $('.catalog-sections h3');
    /*if ($.cookie('category') != null) {
        $.each(elementsMenu, function() {
            if ($.cookie('category') == $(this).data('id')) {
                $(this).siblings('div').show();
            }
        });
    }*/

    elementsMenu.on('click', function() {
        //$.cookie('category', $(this).data('id'));
        var href = $(this).find('a').attr('href');
        $.each(elementsMenu, function() {
            if ($(this).hasClass('ui-state-active')) {
                $(this).removeClass('ui-state-active');
            }
        });
        $(this).addClass('ui-state-active');
        if ($(this).hasClass('last')) {
            location.href = href;
        }
    });

    /* отправление формы поиска. (формируем url не формой, а urlManager-ом для того, что бы прменялись правила роутов)  */
    $('form#search').on('submit', function(e) {
        e.preventDefault();
        location.href = $(this).attr('action') + $(this).find('input[name=q]').val() + '/';
    });

    initSliders();

    // $('.add_to_cart_button').fancybox({
    //     type: 'ajax',
    //     ajax: {
    //         url:  $('form[name=ADD_TO_CART]').attr('action'),
    //         data: $('form[name=ADD_TO_CART]').serialize()
    //     }
    // });

    /* добавление в корзину рекомендованных товаров и последних просмотренных товаров */
    $('.single-product .add-to-cart-link').on('click', function(e) {
        e.preventDefault();
        $.get($(this).attr('href'), {}, function(data) {
            $.fancybox.open(data, {
                width: 800,
                height: 500,
                autoSize: false,
                autoResize: false
            });
            refreshHeaderCart();
        }, 'html');
    });

    /* быстрый просмотр */
    $('.single-product .view-details-link').on('click', function(e) {
        e.preventDefault();
        $.get($(this).attr('href'), {quickView: 'Y'}, function(data) {
            $.fancybox.open(data, {
                width: 800,
                height: 500,
                autoSize: false,
                autoResize: false
            });
            cartHandlers();
        }, 'html');
    });

    var orderSuccess = $('#catalog-href').data('order-success');
    if (orderSuccess) {
        $.get($('#catalog-href').data('load-modal'), {}, function(data) {
            $.fancybox.open(data, {
                width: 500,
                height: 300,
                autoSize: false,
                autoResize: false
            });
        });

    }

    cartHandlers();

/* custom scripts END */

    // jQuery sticky Menu
    
	$(".mainmenu-area").sticky({topSpacing:0});

	/* main page slider  Latest Products (widget MainLatestProducts) */
    var latestProd = $('.product-carousel');
    latestProd.on('initialized.owl.carousel', function(e) {
        if (e.item.count < e.page.size ) {
            $(this).find('.owl-prev, .owl-next').addClass('navigation-inactive');
        }
    }).on('change.owl.carousel', function(e) {
        /* some code for change event */
    }).owlCarousel({
        loop:true,
        nav:true,
        margin:20,
        navText: ['<i class="fa fa-chevron-left" aria-hidden="true"></i>', '<i class="fa fa-chevron-right" aria-hidden="true"></i>'],
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
            },
            600:{
                items:3,
            },
            1000:{
                items:5,
            }
        }
    });
    /* /Latest Products (widget MainLatestProducts) */

    jQuery('.related-products-carousel').owlCarousel({
        loop:true,
        nav:true,
        margin:20,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
            },
            600:{
                items:2,
            },
            1000:{
                items:2,
            },
            1200:{
                items:3,
            }
        }
    });
    
    $('.brand-list').owlCarousel({
        loop:true,
        nav:true,
        margin:20,
        responsiveClass:true,
        navText: ['<i class="fa fa-chevron-left" aria-hidden="true"></i>', '<i class="fa fa-chevron-right" aria-hidden="true"></i>'],
        responsive:{
            0:{
                items:1,
            },
            600:{
                items:3,
            },
            1000:{
                items:4,
            }
        }
    });
    
    
    // Bootstrap Mobile Menu fix
    $(".navbar-nav li a").click(function(){
        $(".navbar-collapse").removeClass('in');
    });    
    
    // jQuery Scroll effect
    $('.navbar-nav li a, .scroll-to-up').bind('click', function(event) {
        var $anchor = $(this);
        var headerH = $('.header-area').outerHeight();
        $('html, body').stop().animate({
            scrollTop : $($anchor.attr('href')).offset().top - headerH + "px"
        }, 1200, 'easeInOutExpo');

        event.preventDefault();
    });    
    
    // Bootstrap ScrollPSY
    $('body').scrollspy({ 
        target: '.navbar-collapse',
        offset: 95
    })      
});

