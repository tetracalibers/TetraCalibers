$(function() {
    var typed = new Typed('.typed', {
        strings: ["Tetra\nCalibers"],
        typeSpeed: 100,
        onComplete: (self) => {
            $('.markerAnime').addClass('is-active');
        }
        //showCursor: false
    });
});
