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

            var inputElement = document.getElementById("userfile");
            inputElement.addEventListener("change", function(){
              var fileList = this.files;
              mostrarPreview(fileList);
            }, false);

            function mostrarPreview(files) {
              var files = files;
              $("#imagens_avatar").fadeOut('slow', function(){
                $("#imagens_avatar > img").remove();
                for (var i = 0; i < files.length; i++) {
                  var file = files[i];
                  var imageType = /^image\//;
                  if (!imageType.test(file.type)) {
                    continue;
                  }
                  var img = document.createElement("img");
                   img.classList.add("obj");
                   img.classList.add("img-circle");
                   img.setAttribute("width", "80px");
                   img.setAttribute("height", "80px");
                   img.file = file;
                  
                  var tamanho = file.size;
                   var sTamanho = tamanho + " bytes";
                   // optional code for multiples approximation
                   for (var aMultiples = ["KiB", "MiB", "GiB", "TiB", "PiB", "EiB", "ZiB", "YiB"], nMultiple = 0, nApprox = tamanho / 1024; nApprox > 1; nApprox /= 1024, nMultiple++) {
                     sTamanho = nApprox.toFixed(3) + " " + aMultiples[nMultiple] + " (" + tamanho + " bytes)";
                   }
                   $(".avatar .help-block").text('Tamanho: ' + sTamanho);
                  var preview = document.getElementById("imagens_avatar");
                   preview.appendChild(img); // Assuming that "preview" is the div output where the content will be displayed.
                  var reader = new FileReader();
                   reader.onload = (function(aImg) { return function(e) { aImg.src = e.target.result; }; })(img);
                   reader.readAsDataURL(file);
                } 
                $("#imagens_avatar").fadeIn('slow');
              });
            }
        }
    }
    $(document).ready(function () {
        fn.Iniciar();
    });
})(jQuery);