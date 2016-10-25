// add js class to html tag
try {
    $('html').addClass('js');
}
catch (e) { }

$(document).ready(function () {
    try {
        $("html").niceScroll({ autohidemode: false });
    }
    catch (e) { }
    try {
        // Isotope Filtering
        var $container = $('#contain');
        if ($container != null && $container.length > 0) {

            // initialize Isotope
            $container.isotope({
                // options...
                resizable: false, // disable normal resizing
                // set columnWidth to a percentage of container width
                masonry: { columnWidth: $container.width() / 12 }
            });

            // update columnWidth on window resize
            $(window).smartresize(function () {
                $container.isotope({
                    // update columnWidth to a percentage of container width
                    masonry: { columnWidth: $container.width() / 12 }
                });
            });


            $container.isotope({
                itemSelector: '.item',
                animationOptions: {
                    duration: 750,
                    easing: 'linear',
                    queue: true
                }
            });


            var $optionSets = $('#options .option-set'),
	    $optionLinks = $optionSets.find('a');

            $optionLinks.click(function () {
                var $this = $(this);
                // don't proceed if already selected
                if ($this.hasClass('selected')) {
                    return false;
                }
                var $optionSet = $this.parents('.option-set');
                $optionSet.find('.selected').removeClass('selected');
                $this.addClass('selected');

                // make option object dynamically, i.e. { filter: '.my-filter-class' }
                var options = {},
	         key = $optionSet.attr('data-option-key'),
	         value = $this.attr('data-option-value');
                // parse 'false' as false boolean
                value = value === 'false' ? false : value;
                options[key] = value;
                if (key === 'layoutMode' && typeof changeLayoutMode === 'function') {
                    // changes in layout modes need extra logic
                    changeLayoutMode($this, options)
                } else {
                    // otherwise, apply new options
                    $container.isotope(options);
                }

                return false;
            });
        }
    }
    catch (e)
    { }
    try {
        $(".caption a").hover(function () {
            var p = $(this).width();
            var o = Math.ceil((p - 66) / 2);
            $(this).find(".item-overlay").css({ opacity: "hide" }).stop(true, true).animate({ opacity: "show" }, 400);
            $(this).find(".item-overlay span").css({ left: "-66px" }).stop(true, true).animate({ left: o }, 400)
        },
     function () {
         var p = $(this).width() + 66;
         $(this).find(".item-overlay span").stop(true, true).animate({ left: p }, 400);
         $(this).find(".item-overlay").stop(true, true).animate({ opacity: "hide" }, 400)
     });
    }
    catch (e) { }

    try {
        var teams = $('#team-members');
        if (teams != null && teams.length > 0) {

            // items filter
            $('#team-filter a').click(function () {
                var selector = $(this).attr('data-filter');
                teams.isotope({
                    filter: selector,
                    itemSelector: '.columns',
                    layoutMode: 'fitRows'
                });

                $('#team-filter').find('a.selected').removeClass('selected');
                $(this).addClass('selected');
                return false;
            });
        }
    }
    catch (e)
    { }
    //Initializing Testimonials
    try {
        if ($('.home-testimonials').size() > 0)
            $('.home-testimonials').quovolver();
    }
    catch (e) { }
    // Navigational Menu ddsmoothmenu
    try {
        ddsmoothmenu.init({
            mainmenuid: "menu", //menu DIV id
            orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
            classname: 'navigation', //class added to menu's outer DIV
            //customtheme: ["#1c5a80", "#18374a"],
            contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
        });

    }
    catch (e) { }
    try {
        $("input:checkbox, input:radio, input:file").uniform();
    }
    catch (e) { }

    // Responsive Navigation Menu by SelectNav
    try {
        selectnav('nav', {
            label: '- Navigation Menu - ',
            nested: true,
            indent: '-'
        });
    }
    catch (e) { }
    // UItoTop plugin 
    try {
        $().UItoTop({ easingType: 'easeOutQuart' });
    }
    catch (e) { }

    // Flex Slider
    try {
        $(window).load(function () {
            $('.flexslider').flexslider({
                animation: 'fade',
                animationLoop: true,             //Boolean: Should the animation loop? If false, directionNav will received "disable" classes at either end
                slideshow: true,                //Boolean: Animate slider automatically
                slideshowSpeed: 4500,           //Integer: Set the speed of the slideshow cycling, in milliseconds
                animationSpeed: 700,             //Boolean: Pause the slideshow when interacting with control elements, highly recommended.
                pauseOnHover: true,
                pauseOnAction: false,
                controlNav: true,
                directionNav: false,
                controlsContainer: '.flex-container'
            });

            $('.flexslider2').flexslider({
                animation: 'slide',
                animationLoop: true,             //Boolean: Should the animation loop? If false, directionNav will received "disable" classes at either end
                slideshow: true,                //Boolean: Animate slider automatically
                slideshowSpeed: 4500,           //Integer: Set the speed of the slideshow cycling, in milliseconds
                animationSpeed: 700,             //Boolean: Pause the slideshow when interacting with control elements, highly recommended.
                pauseOnHover: true,
                pauseOnAction: false,
                controlNav: false,
                directionNav: true,
                controlsContainer: '.flex-container'
            });

            $('.flexslider3').flexslider({
                animation: 'slide',
                animationLoop: true,             //Boolean: Should the animation loop? If false, directionNav will received "disable" classes at either end
                slideshow: false,                //Boolean: Animate slider automatically
                slideshowSpeed: 4500,           //Integer: Set the speed of the slideshow cycling, in milliseconds
                animationSpeed: 700,             //Boolean: Pause the slideshow when interacting with control elements, highly recommended.
                pauseOnHover: true,
                pauseOnAction: false,
                controlNav: false,
                directionNav: true,
                controlsContainer: '.flex-container'
            });

            $('#thumbnail-slider').flexslider({
                animation: "slide",
                controlNav: "thumbnails"

            });
        });
    }
    catch (e) { }
    // Sliding Text and Icon Menu Style
    try {
        $('#sti-menu').iconmenu();
    }
    catch (e) { }

    // Accordion
    try {
        $("#accordion").accordion({
            autoHeight: false,
            icons: { "header": "plus", "headerSelected": "minus" }
        });
    }
    catch (e) { }

    // Progress Bar
    try {
        $(".meter > span").each(function () {
            $(this).data("origWidth", $(this).width())
	            .width(0)
	            .animate({
	                width: $(this).data("origWidth")
	            }, 1200);
        });
    }
    catch (e) { }
    // Alert Boxes
    // Closing notifications 
    // this is the class that we will target
    try {
        $(".hideit").click(function () {
            //fades the notification out	
            $(this).fadeOut(600);
        });
    } catch (e) { }

    // Tooltips
    try {
        $('[data]').colorTip({ color: 'yellow' });
    }
    catch (e) { }

    // Tabs
    try {
        $("#horizontal-tabs").tytabs({
            tabinit: "1",
            fadespeed: "fast"
        });
        $("#horizontal-tabs.a").tytabs({
            tabinit: "1",
            prefixtabs: "taba",
            prefixcontent: "contenta",
            fadespeed: "fast"
        });
        $("#horizontal-tabs.b").tytabs({
            tabinit: "1",
            prefixtabs: "tabb",
            prefixcontent: "contentb",
            fadespeed: "fast"
        });
        $("#horizontal-tabs.c").tytabs({
            tabinit: "1",
            prefixtabs: "tabc",
            prefixcontent: "contentc",
            fadespeed: "fast"
        });

        $("#vertical-tabs").tytabs({
            prefixtabs: "tabz",
            prefixcontent: "contentz"
        });
        $("#vertical-tabs.a").tytabs({
            prefixtabs: "taba",
            prefixcontent: "contenta"
        });
        $("#vertical-tabs.b").tytabs({
            prefixtabs: "tabb",
            prefixcontent: "contentb"
        });
        $("#vertical-tabs.c").tytabs({
            prefixtabs: "tabc",
            prefixcontent: "contentc"
        });
    } catch (e) { }


    // Toggle
    try {
        $('#toggle-view li').click(function () {

            var text = $(this).children('div.panel');

            if (text.is(':hidden')) {
                text.slideDown('200');
                $(this).children('span').html('-');
            } else {
                text.slideUp('200');
                $(this).children('span').html('+');
            }

        });
    }
    catch (e) { }

    try {
        // Carousel slider
        $('.slidewrap').carousel({
            slider: '.slider',
            slide: '.slide',
            slideHed: '.slidehed',
            nextSlide: '.next',
            prevSlide: '.prev',
            addPagination: false,
            addNav: false,
            speed: 500 // ms.
        });

        $('.slidewrap2').carousel({
            namespace: "carousel2" // Defaults to "carousel".
        });

        $('.slidewrap3').carousel({
            namespace: "carousel3" // Defaults to "carousel".
        });
    }
    catch (e) { }

    // jQuery Prettyphoto Lightbox
    try {
        $("area[rel^='prettyPhoto']").prettyPhoto();
        $(".gallery:first a[rel^='prettyPhoto']").prettyPhoto({ animation_speed: 'fast', theme: 'pp_default', slideshow: 4000, opacity: 0.50, deeplinking: false, overlay_gallery: false, autoplay_slideshow: false });
    }
    catch (e) { }

    try {
        // Elastic Slider
        $('#ei-slider').eislideshow({
            animation: 'center',
            autoplay: true,
            slideshow_interval: 3000,
            thumbMaxWidth: 188,
            titlesFactor: 0
        });
    }
    catch (e) { }
    try {
        if ($('.touch-item').size() > 0) {
            $('.touch-item').touchTouch();
        }
    } catch (e) { }
});



