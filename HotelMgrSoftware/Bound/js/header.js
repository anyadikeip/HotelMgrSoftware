function is_touch_device() {
    return !!('ontouchstart' in window);
}
$(document).ready(function () {
    var sticky_header = $('header').clone();
    sticky_header.find('.topmost').remove();
    sticky_header.find('.logo').parent().remove();
    sticky_header.addClass('menu-sticky');
    $('.gwrapper').prepend(sticky_header);
    sticky_header.fadeOut(0);
    var h = parseFloat($("header:last").height()) + 100;
    scrollPos = $(window).scrollTop();

    if ((scrollPos > h) && !(is_touch_device())) header_transform();

    function header_transform() {
        scrollPos = $(window).scrollTop();

        if (scrollPos > h) {
            sticky_header.fadeIn(500);

        } else {

            sticky_header.fadeOut(500);
        }
    }


    $(window).scroll(function () {
        if (!(is_touch_device())) header_transform();

    })


});