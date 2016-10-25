/* Style Switcher */
$(document).ready(function () {
    try {
        var styleswitcherstr = ' \
	<h2>Style Switcher <a href="#"></a></h2> \
    <div class="content"> \
    <div class="clear"></div> \
    <div class="layout-switcher"> \
    <h3>Layout</h3> \
	<a id="wide" class="layout">Wide</a> \
	<a id="boxed" class="layout">Boxed</a> \
    <div class="clear"></div>  \
	<a id="white-fluid" href="../Bound - FluidWhite/index.html" class="layout big">Fluid Layout</a> \
    <div class="clear"></div>  \
    </div><!-- End layout-box --> \
    <h3>Color Style</h3> \
    <div class="switcher-box"> \
    <a id="blue" class="styleswitch color"></a> \
    <a id="orange" class="styleswitch color"></a> \
    <a id="green" class="styleswitch color"></a> \
    <a id="red" class="styleswitch color"></a> \
    <a id="purple" class="styleswitch color"></a> \
    <a id="yellow" class="styleswitch color"></a> \
    <a id="blue2" class="styleswitch color"></a> \
    <a id="brown" class="styleswitch color"></a> \
    <a id="cyan" class="styleswitch color"></a> \
    <a id="fbblue" class="styleswitch color"></a> \
    <a id="light-blue" class="styleswitch color"></a> \
    <a id="light-green" class="styleswitch color"></a> \
    <a id="lime" class="styleswitch color"></a> \
    <a id="neavy" class="styleswitch color"></a> \
    <a id="pink" class="styleswitch color"></a> \
    </div><!-- End switcher-box --> \
    <div class="clear"></div>  \
    <div class="bg hidden">  \
    <h3>BG Pattern</h3>  \
    <a id="wood" class="pattern"></a> \
    <a id="crossed" class="pattern"></a> \
    <a id="fabric" class="pattern"></a> \
    <a id="linen" class="pattern"></a> \
    <a id="diagmonds" class="pattern"></a> \
    <a id="triangles" class="pattern"></a> \
    <a id="black_thread" class="pattern"></a> \
    <a id="checkered_pattern" class="pattern"></a> \
    <a id="black_mamba" class="pattern"></a> \
    <a id="back_pattern" class="pattern"></a> \
    <a id="vichy" class="pattern"></a> \
    <a id="diamond_upholstery" class="pattern"></a> \
    <a id="lyonnette" class="pattern"></a> \
    <a id="graphy" class="pattern"></a> \
    <a id="subtlenet2" class="pattern"></a> \
    </div> \
    <div class="clear"></div> \
    <h3>White Style</h3> \
	<a href="../Bound - Dark/index.html" class="dark-style">Dark Theme</a> \
    </div><!-- End content --> \
	';


        var wrap = $('<div/>');
        wrap.addClass('switcher');
        wrap.append(styleswitcherstr);
        $("footer").after(wrap);
    }
    catch (e) { }
});

/* boxed & wide syle */
$(document).ready(function () {
    try {
        var cookieName = 'wide';

        function changeLayout(layout) {
            $.cookie(cookieName, layout);
            $('head link[name=layout]').attr('href', 'css/' + layout + '.css');
        }

        if ($.cookie(cookieName)) {
            changeLayout($.cookie(cookieName));
        }

        $("#wide").click(function () {
            $
            changeLayout('wide');
        });

        $("#boxed").click(function () {
            $
            changeLayout('boxed');
        });
    }
    catch (e)
    { }

});


/* background images */
$(document).ready(function () {
    try {
        var startClass = $.cookie('mycookie');
        $("body").addClass("crossed");
        $('.pattern').click(function () {
            $('.pattern').each(function () {
                $('body').removeClass($(this).attr('id').replace('#', ''));
            });
            var bg = $(this).attr('id').replace('#', '');
            $('body').addClass(bg);
            $.cookie('mycookie', bg);
        });

        if ($.cookie('mycookie')) {
            $('body').addClass($.cookie('mycookie'));
        }
    }
    catch (e)
    { }

});

/* Skins Style */
$(document).ready(function () {
    try {
        var cookieName = 'colorCookie';

        function changeLayout(theme) {
            $.cookie(cookieName, theme);
            $('head link[name=theme]').attr('href', 'css/themes/' + theme + '.css');
        }

        if ($.cookie(cookieName)) {
            changeLayout($.cookie(cookieName));
        }

        $(".color").click(function () {
            var id = $(this).attr('id');
            if (id != null && id != undefined)
                changeLayout($(this).attr('id').replace('#', ''));
        });
    }
    catch (e)
    { }

});


/* Reset Switcher */
$(document).ready(function () {
    try {
        // Style Switcher	
        $('.switcher').animate({
            left: '-160px'
        });

        $('.switcher h2 a').click(function (e) {
            e.preventDefault();
            var div = $('.switcher');
            if (div.css('left') === '-160px') {
                $('.switcher').animate({
                    left: '0px'
                });
            } else {
                $('.switcher').animate({
                    left: '-160px'
                });
            }
        })
    }
    catch (e)
    { }

});						   

