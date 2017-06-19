// SLIDE SHOW //
$('.main-slideshow').flexslider({
    animation: "slide",
    slideshowSpeed: 5000,
    controlNav: false
});


// TABS //
function activeTabs() {
        $('ul.tab-list').each(function () {
        var $active, $content, $links = $(this).find('a');
        $active = $($links.filter('[href="' + location.hash + '"]')[0] || $links[0]);
        $active.addClass('active');
        $content = $($active[0].hash);

        $links.not($active).each(function () {
            $(this.hash).hide();
        });

        $(this).on('click', 'a', function (e) {
            $active.removeClass('active');
            $content.hide();

            $active = $(this);
            $content = $(this.hash);

            $active.addClass('active');
            $content.show();

            e.preventDefault();
        });
    });
}

activeTabs()

// APPEND FAVORITE ICON 
$('.fave-icon').append('<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 80 80" enable-background="new 0 0 80 80" xml:space="preserve"><style>.style0{fill:	#FFFFFF;}</style><path class="fave-bg" d="M0 0h75c2.8 0 5 2.2 5 5v75L0 0z"/><path class="fave-star" d="M60.4 24.1l5.9 4.3l-2.3-7l5.9-4.2h-7.3L60.4 10l-2.3 7.2h-7.3l5.9 4.2l-2.3 7L60.4 24.1z"/></svg>');

// STICKY CART
$(window).load(function () {
    if ($('div').hasClass('sticky')) {
        var stickyTop = $('.sticky').offset().top - 30;
        var navTop = $('.body-nav-main').offset().top;
        var cartWidth = $('.sticky').width();
        var quickLinkWidth = $('.quicklink-container').width();
        var windowWidth = $(window).width();

        $(window).scroll(function () {
            if(windowWidth > 960) {
				var windowTop = 0;
				var top = 0;
				var cartHeight = $('#cartcontrol').height();
				var stopper = $(document).height() - $(window).height() - 120;
				var bannerHeight = 0;
				if($('div').hasClass('bogo-header')) {
					var bannerHeight = $('.bogo-header img').height() - 55;
				}
				
				if (windowWidth > 1024) {
					windowTop = $(window).scrollTop() + 56;
					top = $('.body-nav-main').height() + 30;
					
					if ($(window).scrollTop() > navTop) {
						$('.body-nav').css({position: 'fixed', top: 0});
					} else {
						$('.body-nav').css({position: 'relative'});
					}
					
				} else {
					windowTop = $(window).scrollTop() + 166;
					top = $('.header').height() + $('.userbar').height() + $('.body-nav-main').height() + 60;
				}
				
				if (stickyTop <= windowTop && windowTop <= stopper) {
					$('.sticky').css({position: 'fixed', top: top, width: cartWidth});
					$('.quicklink-container').css({position: 'fixed', top: top, width: quickLinkWidth});
				} else if (stickyTop < windowTop && windowTop > stopper){
					if (windowWidth > 1024) {
						$('.sticky').css({position: 'absolute', top: $(document).height() - $(window).height() - bannerHeight - 390, width: cartWidth});
					} else {
						$('.sticky').css({position: 'absolute', top: $(document).height() - $(window).height() - bannerHeight - 340, width: cartWidth});
					}
					
					$('.quicklink-container').css({position: 'fixed', top: top, width: quickLinkWidth});
				}else {
					$('.sticky').css({position: 'relative', top: 0});
					$('.quicklink-container').css({position: 'absolute', top: 0});
				}
			}
        });
    }
});

// TOGGLE MODAL
$(document).on('click', 'a[data-toggle*="toggle-"]', function (event) {
    var togglePanel = $(this).attr("data-toggle");

    if (togglePanel == 'toggle-login-form') {
        $('.overlay').load('/Account/Login/?time=' + new Date().getTime());
    }

    if (togglePanel == 'toggle-logout-form') {
        $('.overlay').load('/Account/Logout');
    }

    if (togglePanel == 'toggle-promotion-form') {
        var id = $(this).attr("data-id");
        $('.overlay').load('/Promotion/PromotionModal/' + id);
    }

    if (togglePanel == 'toggle-upsell') {
        $(this).attr("data-toggle", "");
        $(this).attr("href", "/Order/Review");
        event.preventDefault();
        $('.overlay').load('/Order/Upsell/?time=' + new Date().getTime());
    }

    if (togglePanel == 'toggle-promobogo') {
        $(this).attr("data-toggle", "");
        $(this).attr("href", "/Order/Review");
        event.preventDefault();
        $('.overlay').load('/Order/PromoBOGO/?time=' + new Date().getTime());
    }
    
    $('.overlay').removeClass('inactive');
    $('.overlay').addClass('active');
    $('body').addClass('modal-active');  
});

$(".cart-other").on('click', function (event) {
    var iid = $(this).data("iid");
    var mid = $(this).data("mid");
    var name = $(this).data("title");
    var nameth = $(this).data("nameth");
    var nameen = $(this).data("nameen");
    var price = $(this).data("price");
    var image = $(this).data("image");
    var cat = $(this).data("cat");

    $.ajax({
        url: "/Order/AddCartNormal",
        type: "POST",
        data: { ItemID: iid, ModID: mid, Name: removeHTML(name), Price: price, Image: image, NameTH: removeHTML(nameth), NameEN: removeHTML(nameen), Category: cat }
    })
    .success(function (partialViewResult) {
        $("#cartcontrol").html(partialViewResult);

        if (location.pathname == '/') {
            if (cat == 'Puff') {
                location.href = '/Product/Puff';
            }
            else if (cat == 'Pasta') {
                location.href = '/Product/Pasta';
            }
            else if (cat == 'Chicken') {
                location.href = '/Product/Chicken';
            }
            else {
                location.href = '/Product/Appetizer';
            }
        }
    })
    .error(function (result) {
        var AlertText = "";
        if (result.statusText == "Thai") {
            AlertText = "กรุณาเพิ่มพิซซ่าในตะกร้าเพื่อรับโปรโมชันนี้ (พิซซ่า 1 ถาด ต่อ 1 ชุดโปรโมชัน)";
        }
        else { AlertText = "Please add pizza to the basket to get this promotion (1 pizza per one set of promotion)"; }
        $('<div></div>').appendTo('body')  
          .html('<div>' + AlertText + '</div>')
          .dialog({
              modal: true,
              dialogClass: "no-close",
              zIndex: 10000,
              autoOpen: true,
              width: 'auto',
              resizable: false,
              buttons: {
                  Ok: function () {
                      $(this).dialog("close");
                  }
              },
              close: function (event, ui) {
                  $(this).remove();
              }
          });
    });
});

$(".cart-recent").on('click', function (event) {
    var id = $(this).data("id");

    $.ajax({
        url: "/Order/AddCartRecent",
        type: "POST",
        data: { OrderID: id, IsClearCart: "false" }
    })
    .done(function (partialViewResult) {
        $("#cartcontrol").html(partialViewResult);
    });
});

$(".cart-fav").on('click', function (event) {
    var id = $(this).data("id");
    var type = $(this).data("type");

    $.ajax({
        url: "/Order/AddCartFavorite",
        type: "POST",
        data: { ID: id, FavType: type, IsClearCart: "false" }
    })
    .done(function (partialViewResult) {
        $("#cartcontrol").html(partialViewResult);
    });
});

//META.fn: sortJSON
function sortJSON(data, key) {
    return data.sort(function (a, b) {
        var x = a[key];
        var y = b[key];
        return ((x < y) ? -1 : ((x > y) ? 1 : 0));
    });
}

$("#txtStore").focusin(function () {
    $.ajax({
        url: "/Order/GetStores",
        type: "POST",
        async: false
    })
    .done(function (result) {
        result2 = sortJSON(result, 'value');
        $("#txtStore").autocomplete({
            minLength: 0,
            source: result,
            select: function (event, ui) {
                $("#txtStore").val(ui.item.value);
                $("#Store").val(ui.item.id);
                $("#Store").trigger('change');
            }
        })
        .focus(function () {
            $(this).autocomplete("search");
        });
        //$("#streetsoi_id").html(result);
    });
});

function removeHTML(text) {
    cleanText = text.replace(/<\/?[^>]+(>|$)/g, "");
    return cleanText;
}

// TOGGLE MOBILE NAV
$('.openMobileNav').click(function(){
    $('.mobileNavToggle').children('a').toggleClass('hide');
    $('.main-nav').addClass('active');
    
    $('body').addClass('toggleNav');
    $('body').addClass('modal-active');
});

//TOGGLE MOBILE CART
$(document).on('click', '.mobile-cart-btn', function (e) {
    $('body').toggleClass('cartToggle');
    $('.cart-container').show();

    $('.openMobileNav').removeClass('hide');
    $('.closeMobileNav').addClass('hide');
    $('.main-nav').removeClass('active');

    $('body').removeClass('modal-active');
    $('body').removeClass('toggleNav');
})

$(document).on('click', 'body.cartToggle', function (e) {
    var container = $(".cart-container");

    if (!container.is(e.target) && container.has(e.target).length === 0) {
        container.hide();
        $('body').removeClass('cartToggle');
    }
})

// CLOSE MOBILE NAV
$('.closeMobileNav').click(function(){
    $('.mobileNavToggle').children('a').toggleClass('hide');
    $('.main-nav').removeClass('active');
    
    $('body').removeClass('modal-active');
    $('body').removeClass('toggleNav');
});

var initWidth = $(window).width();
var quota = 1;

$(window).resize(function(){
    if(!$('.closeMobileNav').hasClass('hide')) {
        if($(window).width() > 768) {
            $('.mobileNavToggle').children('a').toggleClass('hide');
            $('.main-nav').removeClass('active');
            $('body').removeClass('modal-active');
            $('.overlay').removeClass('active');
            $('.overlay').addClass('inactive');
        }
    }
	
	var currentWidth = $(window).width(); 
	
	if (initWidth > 960 && currentWidth < 960) {
		if(quota > 0) {
			location.reload();
			quota = 0;
		}
	}
	
	if (initWidth < 960 && currentWidth >= 960) {
		if(quota > 0) {
			location.reload();
			quota = 0;
		}
	}
	
});

$('.order-list-header').click(function(){
    $('.tab-order-recent').removeClass('active');
    $(this).siblings('.tab-order-recent').addClass('active');
});

$('.close-banner').click(function () {
    $('.splash-page').remove();
});

$(".top-checkout").on('click', function (event) {
    location.href = '/Order/Review';
});

$('.card-input-number').on('keyup', function() {
    var a = $(this).val().split(" ").join(""); 
    if (a.length > 0) {
		a = a.match(new RegExp('.{1,4}', 'g')).join(" ");
    } 
    $(this).val(a);
});

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}