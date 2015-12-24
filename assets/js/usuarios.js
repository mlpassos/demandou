(function ($) {
    "use strict";
    var fn = {
        // Funcionalidades
        Iniciar: function () {
            fn.App();
        },
        App : function () {
            $('.tarefas-grid').masonry({
                itemSelector: '.cor-coluna',
            });
             $('#myModalTarefaVer').on('shown.bs.modal', function (event) {
              var button = $(event.relatedTarget); // Button that triggered the modal
              var codigotarefa = button.data('codigotarefa');

              var modal = $(this);
              // ajax pegando os dados da tarefa
              modal.find('.modal-title').text('Visualizar ' + codigotarefa);
              // modal.find('.modal-body').text('Corpo...');
            });
            $('#myModalTarefaAdicionar').on('shown.bs.modal', function (event) {
              var button = $(event.relatedTarget); // Button that triggered the modal
              var codigotarefa = button.data('codigotarefa');

              var modal = $(this);
              // ajax pegando os dados da tarefa
              modal.find('.modal-title').text('Adicionar à ' + codigotarefa);
              modal.find('.modal-body').text('Corpo...');
            });
            $('body').delegate('#projeto-add-tarefa','click', function(){
                var titulo = $('#projeto-titulo').val();
                //alert(titulo);
                $('.form-head').toggle('slow');
                $('.form-head-next').toggle('slow');
            });
            $('body').delegate('#projeto-gravar','click', function(){
                var icon = $('#projeto-gravar').children('span');
                $('#projeto-add-tarefa').fadeToggle('slow');
                icon.removeClass('glyphicon-floppy-disk').addClass('glyphicon-floppy-saved');
                alert('ok');
            });

            // PREVIEW DA IMAGEM DO avatar
        }
    }
    $(document).ready(function () {
        fn.Iniciar();
    });
})(jQuery);