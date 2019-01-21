/* global confirm, redux, redux_change */

jQuery(document).ready(function () {

    jQuery('#info-import_warning').hide();

    // if clicked on import data button
    jQuery('.import_demo_content_button').live('click', function (e) {
        var confirm = window.confirm('WARNING: Clicking this button will replace your current theme options, sliders and widgets.  It can also take a minute to complete. Importing data is recommended on fresh installs only once. Importing on sites with content or importing twice will duplicate menus, pages and all posts.');

        if (confirm == true) {
            jQuery('#info-import_warning').fadeIn(500);
            showLoading();
            window.location = jQuery(this).attr('href');
        }
        return false;
    });

    // Show Overlay & Loading of Modal
    showLoading = function() {
            var $overlay = jQuery('.jsn-modal-overlay');
            if ($overlay.size() == 0) {
                    $overlay = jQuery('<div/>', {
                            'class': 'jsn-modal-overlay'
                    });
            }

            var $indicator = jQuery('.jsn-modal-indicator');
            if ($indicator.size() == 0) {
                    $indicator = jQuery('<div/>', {
                            'class': 'jsn-modal-indicator'
                    });
            }

            jQuery('body')
            .append($overlay)
            .append($indicator);
            $overlay.css({
                    'z-index': 9999
            }).show();
            $indicator.css({
                    'z-index': 99999
            }).show();
    }

    // Hide Overlay of Modal
    hideLoading = function() {
            jQuery('.jsn-modal-overlay').remove();
            jQuery('.jsn-modal-indicator').remove();
    }

});