/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

! function(o) {
    wp.customize("vender_header_top_background_color", function(c) {
        c.bind(function(c) {
            o("header .top-area").css("background-color", c)
        })
    }), wp.customize("vender_header_top_text_color", function(c) {
        c.bind(function(c) {
            o("header .top-area,header .social-media .social-tw").css("color", c)
        })
    }), 
    wp.customize("storefront_header_text_color", function(c) {
        c.bind(function(c) {
            o(".site-branding p.site-title a").css("color", c)
        })
    }),
    wp.customize("vender_header_nav_bg_color", function(c) {
        c.bind(function(c) {
            o(".main-nav").css("background-color", c)
        })
    }),
    wp.customize("vender_slider_bg_color", function(c) {
        c.bind(function(c) {
            o("#banner-area #carousel").css("background-color", c)
        })
    }),
    wp.customize("vender_slider_item_bg_color", function(c) {
        c.bind(function(c) {
            o(".flex-active-slide .banner-product-details").css("background-color", c)
        })
    }),
    wp.customize("vender_slider_item_bg_color", function(c) {
        c.bind(function(c) {
            o(".banner-product-details").css("border-bottom", c)
        })
    }),
    wp.customize("vender_slider_text_color", function(c) {
        c.bind(function(c) {
            o("#banner-area .product-slider .banner-product-details h3").css("color", c)
        })
    }),
    wp.customize("vender_sidebar_background_color", function(c) {
        c.bind(function(c) {
            o(".widget-area .widget").css("background-color", c)
        })
    }),
    wp.customize("vender_sidebar_heading_background_color", function(c) {
        c.bind(function(c) {
            o(".widget h2.widget-title").css("background-color", c)
        })
    }),     
    wp.customize("vender_footer_credits_background_color", function(c) {
        c.bind(function(c) {
            o(".site-footer .credits-area").css("background-color", c)
        })
    })
}(jQuery);
