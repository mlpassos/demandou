(function ($) {
    "use strict";
    var fn = {
        // Funcionalidades
        Iniciar: function () {
            fn.App();
        },
        App : function () {
          
          // to use when updated to ajax 

          // $('#frmProjeto-Adicionar').submit(function(e){
          //   e.preventDefault();
          //   alert($(this).serialize());
          // });
         
          // select2 template
          function formatState (state) {
            // if (!state.id) { return state.text; }
            // console.log(state);
            // var states = state.element;
            // state.foreach(function(item){
            //   console.log(item);
            // });
            // console.log(state.element);
             // if (!state.id) { return state.text; }
            var $state = $(
              '<span><img src="http://placehold.it/20x20" class="img-circle" /> ' + state.text + '</span>'
              // '<span>' +  state.element.value.toLowerCase() + '</span>'
            );
            return $state;
          };

          var lider = $("#lider");
          lider.select2({
            disabled: true,
            maximumSelectionLength: 1,
            templateResult: formatState
          });

          // lider.val(["CA", "AL"]).trigger("change"); });

          $("#participantes").select2();


          $('#data_inicio').change(function(){
            var min = $(this).val();
            $('#data_prazo').attr('min', min);
          });

        }
    }
    $(document).ready(function () {
        fn.Iniciar();
    });
})(jQuery);