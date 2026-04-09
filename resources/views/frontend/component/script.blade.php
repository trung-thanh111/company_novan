<script src="{{ asset('vendor/backend/js/plugins/toastr/toastr.min.js') }}"></script>

<script src="{{ asset('vendor/frontend/uikit/js/uikit.min.js') }}"></script>
<script src="{{ asset('vendor/frontend/uikit/js/components/sticky.min.js') }}"></script>
<script src="{{ asset('vendor/frontend/uikit/js/components/accordion.min.js') }}"></script>
<script src="{{ asset('vendor/frontend/uikit/js/components/lightbox.min.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Project Slider Initialization
        var projectSlider = new Swiper('.project-slider', {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            speed: 1000,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: '.project-nav-btn.next',
                prevEl: '.project-nav-btn.prev',
            },
            pagination: {
                el: '.swiper-pagination-fraction',
                type: 'fraction',
                formatFractionCurrent: function (number) {
                    return number < 10 ? '0' + number : number;
                },
                formatFractionTotal: function (number) {
                    return number < 10 ? '0' + number : number;
                }
            },
            on: {
                init: function () {
                    updateProgressBar(this);
                },
                slideChange: function () {
                    updateProgressBar(this);
                }
            }
        });

        function updateProgressBar(swiper) {
            var progress = ((swiper.realIndex + 1) / swiper.slides.length - swiper.loopedSlides * 2) * 100;
            // Simplified progress logic for looped swiper
            var total = swiper.slides.length;
            if (swiper.params.loop) {
                total = swiper.slides.length - (swiper.loopedSlides * 2);
            }
            var currentProgress = ((swiper.realIndex + 1) / total) * 100;
            document.querySelector('.swiper-progress-bar-fill').style.width = currentProgress + '%';
        }
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script src="{{ asset('frontend/resources/plugins/wow/dist/wow.min.js') }}"></script>
<script src="{{ asset('frontend/resources/function.js') }}"></script>
<script src="{{ asset('frontend/resources/js/linden.js') }}"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        if (typeof Fancybox !== 'undefined') {
            Fancybox.bind("[data-fancybox]", {});
        }
        const backToTop = document.getElementById('hp-back-to-top');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 300) {
                backToTop.classList.add('active');
            } else {
                backToTop.classList.remove('active');
            }
        });
        backToTop.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    });
</script>
