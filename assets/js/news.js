
document.addEventListener('DOMContentLoaded', function () {

    if (document.getElementById('news_container')) {
        new Splide('#news_container', {
            type: 'loop',
            perPage: 2,
            rewind: true,
            autoplay: false,
            interval: 2000,
            gap: 5,
            perMove: 1,
            start: 2

        }).mount();
    }

    if (document.getElementById('videos_container')) {
        new Splide('#videos_container', {
            type: 'loop',
            perPage: 2,
            rewind: true,
            autoplay: false,
            interval: 2000,
            gap: 5,
            perMove: 1,
            start: 2

        }).mount();
    }

    // mixitup
    if ((document.getElementsByClassName("product-mixit").length > 0)) {
        const mixitupContainer = (document.getElementsByClassName("product-mixit"))[0];
        mixitup(mixitupContainer, {
          load: {
            filter: ".all-variants",
          },
          animation: {
            duration: 1000,
            nudge: false,
            reverseOut: false,
            effects: "",
          },
        });
      }
})