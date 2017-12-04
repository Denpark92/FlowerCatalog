$(document).ready(function () {
    $("a[rel=gallery]").fancybox({
        prevEffect	: 'none',
        nextEffect	: 'none',
        maxWidth    : '1000',
        maxHeight   : '700',
        padding     : '0',
        helpers	: {
            thumbs	: {
                width	: 50,
                height	: 50
            }
        }
    });
});