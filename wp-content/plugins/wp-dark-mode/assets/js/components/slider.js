(function ($) {

    $(document).ready(function () {

        //change wp dark mode menu item
        const wp_dark_mode_menu = $('#toplevel_page_wp-dark-mode li.wp-first-item');
        const get_started_menu = wp_dark_mode_menu.find('a').text('Get Started').end();

        wp_dark_mode_menu.parent().append(get_started_menu);

        if ($("#image_compare").length) {
            $("#image_compare").twentytwenty();
        }

        // brightness, contrast & sepia config sliders
        const sliders = $('.brightness, .contrast, .sepia');

        sliders.each(function () {
            const $slider = $(this).find('.wppool-slider');

            $slider.slider({
                slide: (e, ui) => {
                    const handle = $(".wppool-slider-handle", $slider);
                    $("input", $(this)).val(ui.value);
                    handle.text(ui.value);

                    const brightness = $("[name='wp_dark_mode_color[brightness]']").val();
                    const contrast = $("[name='wp_dark_mode_color[contrast]']").val();
                    const sepia = $("[name='wp_dark_mode_color[sepia]']").val();

                    window.wpDarkMode.includes = '.filter-preview';

                    DarkMode.enable({
                        brightness,
                        contrast,
                        sepia,
                    });
                }
            });


        });

        //Handle exclude
        setTimeout(function () {

            const excludes = $('#wpb_visual_composer');

            if (!excludes.length) {
                return;
            }

            if (!wpDarkMode.enable_backend) {
                return;
            }

            excludes.each(function () {
                if ($(this).length) {
                    $(this).addClass('wp-dark-mode-ignore');
                    $(this).find('*').addClass('wp-dark-mode-ignore');
                }
            });

            const is_saved = localStorage.getItem('wp_dark_mode_admin_active');

            if (is_saved && is_saved != 0) {
                document.querySelector('html').classList.add('wp-dark-mode-active');

                DarkMode.enable();

            }

        }, 100);

    });
})(jQuery);