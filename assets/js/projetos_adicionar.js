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
          
          $("#lider").select2({
            maximumSelectionLength: 1,
            templateResult: formatState//,
            // disabled: true
          });//.val(["6"]).trigger("change");
          $("#participantes").select2();


          $('#data_inicio').change(function(){
            var min = $(this).val();
            $('#data_prazo').attr('min', min);
          });

          tinymce.init({
            selector: 'textarea',
            // forced_root_block : "",
            invalid_elements: "table,tr,td,tbody,img",
            height: 300,
            plugins: [
              'advlist autolink lists link charmap print preview anchor',
              'searchreplace visualblocks code fullscreen',
              'insertdatetime media contextmenu paste code textcolor colorpicker'
            ],
            toolbar: 'insertfile undo redo | styleselect | bold italic | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
            content_css: [
              '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
              '//www.tinymce.com/css/codepen.min.css'
            ]
          });
          
        //    tinyMCE.init({
        //     theme : "advanced",
        //     mode : "textareas",
        //     plugins : "imagemanager,filemanager,insertdatetime,preview,emotions,visualchars,nonbreaking",
        //     theme_advanced_buttons1_add: 'insertimage,insertfile',
        //     theme_advanced_buttons2_add: 'separator,forecolor,backcolor',
        //     theme_advanced_buttons3_add: 'emotions,insertdate,inserttime,preview,visualchars,nonbreaking',
        //     theme_advanced_disable: "styleselect,formatselect,removeformat",
        //     plugin_insertdate_dateFormat : "%Y-%m-%d",
        //     plugin_insertdate_timeFormat : "%H:%M:%S",
        //     theme_advanced_toolbar_align : "left",
        //     theme_advanced_resize_horizontal : false,
        //     theme_advanced_resizing : true,
        //     apply_source_formatting : true,
        //     spellchecker_languages : "+English=en",
        //     extended_valid_elements :"img[src|border=0|alt|title|width|height|align|name],"
        //     + "a[href|target|name|title]," + "p,",
        //     invalid_elements: "table,span,tr,td,tbody,font"

        // });

        }
    }
    $(document).ready(function () {
        fn.Iniciar();
    });
})(jQuery);