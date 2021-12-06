$(function() {
    $('.toTopButton').click(function(e) {
        e.preventDefault();

        $('html').velocity('scroll', {
            duration: 1000,
            offset: 0,
            easing: 'easeOutSine'
        });
    });
});
