(function ($) {
    $(document).ready(function () {
        var $track = $('.projects-track');
        if (!$track.length) {
            return;
        }

        var $cards = $track.find('.project-card');
        var cardWidth = $cards.length ? $cards[0].getBoundingClientRect().width : 0;
        var gap = parseFloat(getComputedStyle($track[0]).gap || 0);

        function scrollSlider(direction) {
            var distance = (cardWidth + gap) * direction;
            $track.animate({ scrollLeft: $track.scrollLeft() + distance }, 250);
        }

        $('.project-nav').on('click', function () {
            var direction = parseInt($(this).data('direction'), 10) || 1;
            scrollSlider(direction);
        });

        $(window).on('resize', function () {
            cardWidth = $cards.length ? $cards[0].getBoundingClientRect().width : 0;
            gap = parseFloat(getComputedStyle($track[0]).gap || 0);
        });
    });
})(jQuery);
