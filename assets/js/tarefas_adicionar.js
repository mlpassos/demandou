(function ($) {
    "use strict";
    var fn = {
        // Funcionalidades
        Iniciar: function () {
            fn.App();
        },
        App : function () {
          
          // select2 template
          function formatState (state) {
            var $state = $(
              '<span><img src="http://placehold.it/20x20" class="img-circle" /> ' + state.text + '</span>'
            );
            return $state;
          };
          $("#lider").select2({
            maximumSelectionLength: 1,
            templateResult: formatState
          });
          $("#participantes").select2();
        }
    }
    $(document).ready(function () {
        fn.Iniciar();
    });
})(jQuery);