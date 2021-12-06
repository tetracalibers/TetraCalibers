$(function() {
    var $categoryArea = $('.categoryListText');
    var $categoryBack = $('.categoryBack');

    function categoryBackSizing() {

        var categoryAreaHeight = $categoryArea.outerHeight();

        var windowHeight = $(window).height();
        var windowWidth = $(window).width();

        var categoryAreaPos = $categoryArea.offset().top;
        var categoryBackPos = $categoryBack.offset().top;

        var top = -1 * (categoryBackPos - categoryAreaPos) - windowHeight * 0.3 * 0.25;
        var height = categoryAreaHeight * 1.5;
        var maxHeight = windowWidth * 0.3;

        $categoryBack.css({
            'width' : height > maxHeight ? maxHeight + 'px' : height + 'px',
            'height' : height + 'px',
            'top': top + 'px',
        });
    }

    $(window).on('load resize', function() {
        categoryBackSizing();
    });
});
