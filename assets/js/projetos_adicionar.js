(function ($) {
    "use strict";
    var fn = {
        // Funcionalidades
        Iniciar: function () {
            fn.App();
        },
        App : function () {
          var base_url = 'http://' + window.location.hostname + "/demandou-git";
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
          
          $("#lider").select2({
            maximumSelectionLength: 1,
            templateResult: formatState//,
            // disabled: true
          });

          // .change(function(){
          //   var lider = $(this).val();
          //   $('#participantes').children().each(function(){
          //       if ($(this).val()==lider) {
          //         console.log('desabilitar: ' + $(this).val());
          //         $(this).attr('disabled', 'disabled'); 
          //         // $("#participantes").select2().trigger('change'); 
          //       } else {
          //         // $(this).removeAttr('disabled');
          //       }
          //   });
          // });

          $("#participantes").select2();

          // .change(function() {
          //   $(this).children().each(function() {
          //     console.log('disabled: ' + $(this).attr('disabled'));
          //     if ($(this).attr('disabled')==='disabled') {
          //       console.log('voltar a vida: ' + $(this).val());
          //       $(this).removeAttr('disabled');
          //     }
          //   });
          // });


          $('#data_inicio').change(function(){
            var min = $(this).val();
            $('#data_prazo').attr('min', min);
          });

         
          tinymce.init({
            selector: 'textarea',
            invalid_elements: "table,tr,td,tbody,img",
            height: 300,
            plugins: [
              'advlist autolink lists link charmap print preview anchor',
              'searchreplace visualblocks code fullscreen',
              'insertdatetime media paste code textcolor colorpicker wordcount'
            ],
            plugin_insertdate_dateFormat : "%d/%m/%Y",
            plugin_insertdate_timeFormat : "%H:%M:%S",
            language: 'pt_BR',
            language_url: base_url + '/assets/js/tinymce/langs/pt_BR.js',
            browser_spellcheck: true,
            contextmenu: false,
            toolbar: 'insertfile undo redo | styleselect | bold italic | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link',
            content_css: [
              '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
              '//www.tinymce.com/css/codepen.min.css'
            ]
          });
         
        }
    }
    $(document).ready(function () {
        fn.Iniciar();
    });
})(jQuery);