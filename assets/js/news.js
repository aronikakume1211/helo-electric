
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
})