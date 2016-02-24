(function ($) {
    "use strict";
    var fn = {
        // Funcionalidades
        Iniciar: function () {
            fn.App();
        },
        App : function () {

          function showMensagem(el, data, elbox) {
            var classe = (data.status == "sucesso") ? "alert alert-success" : "alert alert-danger";
            var mensagemHTML = $.parseHTML(data.mensagem);
            el.addClass('alert ' + classe +  ' animated-alt-med fadeInUp').html(mensagemHTML).one('webkitAnimationEnd oanimationend msAnimationEnd animationend', function(){
                  var isso = $(this);
                  setTimeout(function(){
                        isso.removeClass('animated-alt-med fadeInUp').addClass('animated-alt-med fadeOutDown').one('webkitAnimationEnd oanimationend msAnimationEnd animationend', function(){
                              isso.removeClass('animated-alt-med fadeOutDown ' + classe).html('');
                        });
                        if (elbox!=="") {
                              setTimeout(function(){
                                    elbox.hide('slow');
                              },1000);
                        }
                  },500);
                  
            });
          }
          
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
          // $("#participantes").select2();

          $('body').delegate('#frmTarefa-Adicionar', 'submit', function(e) {
                  e.preventDefault();
                  // var data = $(this).serialize();
                  // var location = 'http://' + window.location.hostname + "/demandou-git";
                  var form = $(this);
                  var codigo_projeto = form.find("input[name='codigo_projeto']").val();
                  // var codigo_tarefa = form.find("input[name='codigo_tarefa']").val();
                  var createdby = form.find("input[name='usuario_nome']").val();
                  var createdbypicture = form.find("input[name='usuario_avatar']").val();
                  var titulo = form.find("#titulo").val();
                  var descricao = form.find("#descricao").val();
                  var prioridade = null;
                  form.find("input[name='prioridade']").each(function(){
                        if ($(this).is(':checked')) {
                              prioridade = $(this).val();
                        }
                  });
                  var data_inicio = form.find("#data_inicio").val();
                  var data_prazo = form.find("#data_prazo").val();
                  var lider = form.find('#lider').val();
                  var codigo_status = "";
                  form.find('#codigo_status').each(function(){
                        if ($(this).is(':checked')) {
                              codigo_status = $(this).val();
                        } else {
                              codigo_status = '0';
                        }
                  });
                  var data = {codigo_projeto,titulo,descricao,prioridade,data_inicio,data_prazo,lider,codigo_status};
                  //alert(data_inicio);
                  console.log(data);
                  var el = form.find('.form-message');
                  el.html('<img src="http://cdn2.rode.com/images/common/ajax-loader-black.gif" alt="imagem mostra que sistema está trabalhando">');//text('Atualizando dados e notificando líder.')
                  $.ajax({
                          url: location,
                          type: "POST",
                          data: {
                              codigo_projeto : codigo_projeto,
                              titulo : titulo,
                              descricao : descricao,
                              prioridade : prioridade,
                              data_inicio : data_inicio,
                              data_prazo : data_prazo,
                              lider : lider,
                              codigo_status
                          },
                          dataType: 'json',
                          success: function(data) {
                              el.html('');
                              showMensagem(el, data);
                              var data_prazo = new Date();
                              var dia = data_prazo.getDay();
                              var month = new Array();
                              month[0] = "Jan";
                              month[1] = "Fev";
                              month[2] = "Mar";
                              month[3] = "Abr";
                              month[4] = "Mai";
                              month[5] = "Jun";
                              month[6] = "Jul";
                              month[7] = "Ago";
                              month[8] = "Set";
                              month[9] = "Out";
                              month[10] = "Nov";
                              month[11] = "Dez";
                              var mes = month[data_prazo.getMonth()];
                              switch(prioridade) {
                                  case "3":
                                      var prioridadec = 'prioridade-alta';
                                      break;
                                  case "2":
                                      var prioridadec = 'prioridade-media';
                                      break;
                                  case "1":
                                      var prioridadec = 'prioridade-baixa';
                                      break;
                                  default:
                                      // nada
                              }
                              // setTimeout(function(){
                              //   window.location = location;
                              // },1000);
                              //$('.tarefas-added-box').load(location+'/'+codigo_projeto + ' .tarefas-added-box')
                              $('.tarefas-added-box').append('<div class="tarefas-added-box-postit media">'
                                + '<div class="media-left">'
                                + '<p class="tarefa-dia">'
                                + dia
                                + '</p>'
                                + '<p class="tarefa-mes">'
                                + mes + '|' + data_prazo.getYear()
                                + '</p>'
                                + '</div>'
                                + '<div class="media-body">'
                                + '<h4 class="media-heading ' + prioridadec + '">' + titulo + '</h4>'
                                + '<p>'
                                + 'desc'  
                                + '</p>'
                                + '<img class="tarefas-box-lider-img lider-thumbs img-circle" src="http://secom.pa.gov.br/demandou/uploads/' + createdbypicture + '" alt="imagem do avatar do líder da tarefa">'
                                + '</div>'
                                + '</div>');
                          },
                          error: function(stc,error){
                              console.log(error);
                              console.log(stc)
                          }
                     }).done(function(data){
                        console.log('fim alteração');
                     });
            });


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