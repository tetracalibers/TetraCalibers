$(function() {
    var $tocList = $('.toc');
    var $sectionTitles = $('.notesCategory');

    if ($sectionTitles.length > 0) {
        $sectionTitles.each(function() {
            $this = $(this);
            sectionTitle = $this.text().replace(/\s/g, "");
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
            duration: 500,
            offset: 0,
            easing: 'easeOutSine'
        });
    });
});
