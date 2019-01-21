var EoLiveSearch = function ($element) {

    // Self assignment
    var self = this;

    // Form element
    self.eoSearchWrapper = $element.closest('form');
    self.isLiveSearch = true;
    self.eoSearchWrapper.addClass('eo_live_search_handler');

    // On init
    jQuery(document).ready(function(){

        // Trigger 1, when letters are typed :
        $element.on('input',function(e){

            clearTimeout(self.eotTimer);
            var eoQuery = jQuery(this).val();
            if(eoQuery.length > EONET_SEARCH.search_minimum) {
                self.eoSearchElement();
            }

        });

        // Trigger 2, form is submitted :
        self.eoSearchWrapper.on('submit',function(e){
            if(self.isLiveSearch) {
                e.preventDefault();
                self.eoSearchElement();
            }
        });

        // On resize, we re-position :
        jQuery(window).on('resize', function(){
            setTimeout(function () {
                self.eoSearchPosition();
            }, 500);
        });

    });

    // Handle the requests:
    self.eoSearchElement = function () {

        self.eotTimer = setTimeout(function () {

            var s = $element.val();

            // If has auto loader :
            if ($element.hasClass('ui-autocomplete-input')) {
                $element.autocomplete("destroy");
                $element.removeData('autocomplete');
            }

            // Popover :
            var eoSearchPopover = self.eoSearchWrapper.find('#eo_live_search_popover');
            if(eoSearchPopover.length === 0) {
                // Markup :
                var eoPopHTML = '<div id="eo_live_search_popover" class="eo_custom_popover" style="width: '+EONET_SEARCH.search_box_width+'px"><div class="eo_live_search_query">'+
                    EONET_SEARCH.search_label_results +': <span>'+ s +'</span>' +
                    '<a href="javascript:void(0);" id="eo_live_search_page" class="eo_live_search_control"><i class="fa fa-file-text-o"></i></a>' +
                    '<a href="javascript:void(0);" id="eo_live_search_close" class="eo_live_search_control"><i class="fa fa-times"></i></a></div>' +
                    '<div id="eo_live_search_results"></div></div>';
                self.eoSearchWrapper.append(eoPopHTML);
                // Position :
                self.eoSearchPosition();
                // Re assign
                eoSearchPopover = self.eoSearchWrapper.find('#eo_live_search_popover');
            } else {
                eoSearchPopover.find('.eo_live_search_query span').html(s);
            }

            // Scrollbar
            eoSearchPopover.find('.eo_search_tabs .eo_tabs_content').mCustomScrollbar({
                theme: "inset"
            });

            // Popover closing :
            eoSearchPopover.find('.eo_live_search_query a#eo_live_search_close').on('click', function () {
                eoSearchPopover.fadeOut();
                setTimeout(function () {
                    eoSearchPopover.remove();
                }, 500);
            });

            // If user want page search :
            eoSearchPopover.find('.eo_live_search_query #eo_live_search_page').on('click', function () {
                self.isLiveSearch = false;
                self.eoSearchWrapper.submit();
            });

            var eoSearchResultsWrapper = eoSearchPopover.find('#eo_live_search_results');

            // Loader in the field :
            if(self.eoSearchWrapper.find('.eonet_loader').length === 0) {
                var eoloaderPos = self.eoSearchWrapper.width() - (self.eoSearchWrapper.find('input[type="submit"],button[type="submit"]').width())*2.5;
            }
            self.eoSearchWrapper.addClass('is-fetching');

            // Loader in the result :
            if(eoSearchResultsWrapper.find('.eonet_loader').length === 0) {
                eoSearchResultsWrapper.eonetLoader({'colored': true});
            }

            // We prepare the query
            var data = {
                'action' : EONET_SEARCH.search_action,
                's' : s,
                'security' : EONET_SEARCH.search_nonce
            };

            jQuery.post(EONET_SEARCH.ajax_url, data, function(response) {

                // We output the result :
                eoSearchResultsWrapper.empty();
                eoSearchResultsWrapper.append(response);

                self.eoSearchTabs();

                if(EONET_SEARCH.search_history === 'true') {
                    self.eoSearchHistory();
                }

                // We clear the loader :
                self.eoSearchWrapper.removeClass('is-fetching');
                self.eoSearchWrapper.find('.eonet_loader').remove();
                eoSearchResultsWrapper.find('.eonet_loader').remove();

            });

        }, 1000);

    };

    // Position box:
    self.eoSearchPosition = function (){

        // Top position :
        var eoSearchPopover = self.eoSearchWrapper.find('#eo_live_search_popover');

        // self.eoSearchWrapper
        var eoWrapFieldDiff = $element.offset().top - self.eoSearchWrapper.offset().top;
        var eoPopoverTop = (eoWrapFieldDiff + $element.outerHeight() + 30);
        //var eoPopoverTop = ($element.height() + 30);
        eoSearchPopover.css('top', eoPopoverTop+'px');
        // Offset, if there isn't any space we force the positionement :
        var eoSearchGutter = (jQuery(window).width() - ($element.offset().left + eoSearchPopover.width()));
        if(eoSearchGutter < 40) {
            eoSearchPopover.css('margin-left', (eoSearchGutter-40)+'px');
            eoSearchPopover.find('.eo_live_search_query:after, .eo_live_search_query:before').css('left', (eoSearchGutter+40)+'px');
        }

    };

    // Tabs inside
    self.eoSearchTabs = function () {

        var eoTabsWrapper = jQuery(".eo_tabs"),
            eoTabsNav = eoTabsWrapper.find('.eo_tabs_header'),
            eoTabsContainer = eoTabsWrapper.find('.eo_tabs_content'),
            //eoBaseWidth = eoTabsWrapper.parent().width();
            eoBaseWidth = eoTabsContainer.width();

        // Init class :
        eoTabsNav.find('li.eo_tab_nav').first().addClass('is-active');
        eoTabsContainer.find('div.eo_tab_content').first().addClass('is-active');
        eoTabsContainer.height(eoTabsContainer.find('div.eo_tab_content.is-active').height());


        // Tab width & viewport :
        eoTabsContainer.find('div.eo_tab_content').width(eoBaseWidth);
        eoTabsContainer.width(eoBaseWidth);
        // Tab container width :
        //eoTabsContainer.find('div.eo_tabs_content_inner').width((eoTabsContainer.find('div.eo_tab_content').length)*eoBaseWidth);

        // Click trigger :
        eoTabsNav.find('a').on('click', function (e) {
            e.preventDefault();

            // Get slug :
            var eoCurrentType = jQuery(this).data('eo-post-type'),
                eoCurrentTab = jQuery('div.eo_tab_content[data-eo-post-type="'+eoCurrentType+'"]');

            // Class switcher :
            eoTabsNav.find('li.eo_tab_nav').removeClass('is-active');
            jQuery(this).closest('li.eo_tab_nav').addClass('is-active');
            eoTabsContainer.find('div.eo_tab_content').removeClass('is-active');
            eoCurrentTab.addClass('is-active');
            eoTabsContainer.animate({
                'height' : eoTabsContainer.find('div.eo_tab_content.is-active').height()
            });

            // We calculate the offset :
            var eoOffset = eoCurrentTab.index() * eoBaseWidth;

            // We make it move :
            //eoTabsContainer.find('div.eo_tabs_content_inner').css('margin-left', '-'+eoOffset+'px');

        });


    };

    // Search history tab
    self.eoSearchHistory = function () {

        var eoSearchHistory = jQuery('.eo_history_list');

        eoSearchHistory.find('a').on('click', function () {
            // We get the history's value :
            var eoSearchVal = jQuery(this).find('h5').text();
            $element.val(eoSearchVal);
            // We start the search again :
            setTimeout(function () {
                self.eoSearchElement();
            }, 400);
        });

    };

};

/*
 * We match our selector $elements
 */
var eoSearchField = jQuery(EONET_SEARCH.search_selector);

/*
 * If nothing found
 */
if(eoSearchField.length === 0) {

    console.warn('[EONET] No search form found...Search form required is '+EONET_SEARCH.search_selector);

}

/*
 * We create one instance per search
 */
eoSearchField.each(function () {

    new EoLiveSearch(jQuery(this));

});
