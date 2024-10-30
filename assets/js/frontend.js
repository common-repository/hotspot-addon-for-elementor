(function ($, elementor) {
    "use strict";
    var WTT = {

        init: function () {

            var widgets = {
                'wttd-hotspot-block.default': WTT.hotspotBlock,
            };
            $('.wttd-hotspot-section .wttd-hotspot-item a').hover(
                function(){ $(this).addClass('active') },
                function(){ $(this).removeClass('active') }
         )
           
           
           

        }, 

      
    };
    $(window).on('elementor/frontend/init', WTT.init);
}(jQuery, window.elementorFrontend));