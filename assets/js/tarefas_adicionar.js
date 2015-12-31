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

          
          var tamTarefasAdded = $('.tarefas-added-box').height();
          var tamTarefasAdd = $('.tarefas-add-box').height();
          // var i = 0;

          // if (tamTarefasAdded >= tamTarefasAdd) {
          //   var i = 0;
          //   do {
          //      i += 1;
          //      menosFonte(i);
          //      console.log(i);
          //      if ($('.tarefas-added-box').height()<=$('.tarefas-add-box').height()) {
          //       i = 10;
          //      }
          //   } while (i < 5);
          // }
          
          // function menosFonte(valor) {
          //   $('.tarefas-added-box').css('font-size', '-='+valor);
          //   $('.tarefas-added-box h4').css('font-size', '-='+valor);
          //   $('.tarefas-added-box .tarefa-dia').css('font-size', '-='+valor);
          //   $('.tarefas-added-box .tarefa-mes').css('font-size', '-='+valor);
          // }

          // $('.tarefas-added-box').animate({
          //   'height':tamTarefasAdd 
          // }, function(){
          //     console.log('fim');
          // }, 'swing',300);

          if (tamTarefasAdded >= tamTarefasAdd) {
            $('.tarefas-added-box').css('height', tamTarefasAdd);
          }

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