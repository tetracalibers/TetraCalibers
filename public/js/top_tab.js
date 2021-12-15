$(function() {
    $('.profileContainer').imagesLoaded({
        background: true
    }, function() {
        var $tabContents = $('.top_tabcontents');
        var $tabMenu = $('.top_tabs').children('.top_menu');
        var $tabAnchors = $tabMenu.find('a:not(:first)');
        $tabContents.hide();

        var default_category = 'latexbooks';
        var $defaultShow = $('#' + default_category);
        var $defaultOpenTab = $('a[href="#' + default_category + '"]').parent();
        $defaultShow.fadeIn();
        $defaultOpenTab.addClass('nowVisible');

        $tabAnchors.click(function(event) {
            event.preventDefault();
            $this = $(this);
            $openTab = $this.parent();
            $showContents = $($this.attr('href'));

            if ($openTab.hasClass('nowVisible')) {
                return;
            }

            if ($this.attr('href') === '#profile') {
                $('.top_tabs').fadeOut();
                //$('.top_img').fadeOut();
                //$('.catchcopy').fadeOut();
                //$('.siteTitle').css('color', '#f7f7f7');
                $('.page-foot').fadeOut();
                //profileResize();
            }

            $('.nowVisible').removeClass('nowVisible');
            $tabContents.fadeOut();
            $showContents.fadeIn();
            $openTab.addClass('nowVisible');

            if ($(window).width() <= 973) {
                $tabContents.velocity('scroll', {
                    duration: 1000,
                    easing: 'easeOutSine'
                });
            }
        });

        $('.returnButton').click(function(event) {
            event.preventDefault();
            $('.nowVisible').removeClass('nowVisible');
            $tabContents.fadeOut();
            $('.top_tabs').fadeIn();
            $('.page-foot').fadeIn();
            //$('.top_img').fadeIn();
            //$('.catchcopy').fadeIn();
            //$('.siteTitle').css('color', 'transparent');
            $defaultShow.fadeIn();
            $defaultOpenTab.addClass('nowVisible');
        });
    });
});
