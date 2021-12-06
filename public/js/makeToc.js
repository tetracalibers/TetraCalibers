$(function() {
    var $tocList = $('.toc');
    var $tocTitle = $('.tocTitle');
    var $contentsContainer = $('.blogContents');
    var $sectionTitles = $contentsContainer.find('h1');

    if ($sectionTitles.length > 0) {
        $tocTitle.text('Contents');

        $sectionTitles.each(function() {
            $this = $(this);
            sectionTitle = $this.text();
            $this.attr('id', sectionTitle);
            var $tocListItem = $('<li></li>').text(sectionTitle);
            $tocListItem.wrapInner('<a></a>');
            $tocListItem.children('a').attr('href', '#' + sectionTitle);
            $tocListItem.appendTo($tocList);
        });
    }

    var $tocAnchors = $tocList.find('a');

    $tocAnchors.on('click', function(event) {
        event.preventDefault();
        $this = $(this);
        $destination = $($this.attr('href'));
        $destination.velocity('scroll', {
            duration: 1000,
            offset: -1 * 16 * 2,
            easing: 'easeOutSine'
        });
    });
});
