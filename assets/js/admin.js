(function ($) {
    "use strict";
    var fn = {
        // Funcionalidades
        Iniciar: function () {
            fn.App();
        },
        App : function () {
            // admin functions
            // var output = "";
            var location = 'http://' + window.location.hostname + "/demandou-git";
            var month = new Array();
                month[0] = "Janeiro";
                month[1] = "Fevereiro";
                month[2] = "Março";
                month[3] = "Abril";
                month[4] = "Maio";
                month[5] = "Junho";
                month[6] = "Julho";
                month[7] = "Agosto";
                month[8] = "Setembro";
                month[9] = "Outubro";
                month[10] = "Novembro";
                month[11] = "Dezembro";
            var weekday = new Array();
                weekday[0] = "Domingo";
                weekday[1] = "Segunda-feira";
                weekday[2] = "Terça-feira";
                weekday[3] = "Quarta-feira";
                weekday[4] = "Quinta-feira";
                weekday[5] = "Sexta-feira";
                weekday[6] = "Sábado";
            // var n = month[d.getMonth()];
            function formataData(strData) {
                  return weekday[strData.getDay()] + ', ' + strData.getDate() + ' de ' + month[strData.getMonth()] + ' de ' + strData.getFullYear();
            }
            $('.label-entrega').tooltip({
              'delay': { "show": 100, "hide": 0 }
            });
            $('.tarefa-historico').popover({
            	html: true,
            	container: 'body',
            	content: function() {
            		var el = $(this);
            		var codigo_tarefa = el.attr('data-codigotarefa');
            		var titulo = el.attr('data-titulo');
            		var output = '<div id="tarefa-historico-opcoes">'
		                		+ '<ul class="list-inline">'
		                		+	'<li>'
		                		+	'<a href="" class="tarefa-historico-opcoes-links"  data-toggle="modal" data-target="#myModalObsVer" data-codigotarefa="' + codigo_tarefa + '" data-titulo="' + titulo + '">'
		                		+	'<i class="historico-links-ver fa fa-eye"></i>'
		                		+	'</a>'
		                		+	'</li>'
		                		+	'<li>'
		                		+	'<a href="" class="tarefa-historico-opcoes-like" data-codigotarefa="' + codigo_tarefa + '">'
		                		+	'<i class="historico-links-aceitar fa fa-thumbs-o-up"></i>'
		                		+	'</a>'
		                		+	'</li>'
		                		+	'<li>'
		                		+	'<a href="" class="tarefa-historico-opcoes-like" data-codigotarefa="' + codigo_tarefa + '">'
		                		+	'<i class="historico-links-rejeitar fa fa-thumbs-o-down"></i>'
		                		+	'</a>'
		                		+	'</li>'
		                		+	'</ul>'
		                		+	'</div>';
		            // console.log(output);
            		return output
            	}
            });
						function mostraResposta(codigo_tarefa, el, codigo_observacao, codigo_tipo) {
                  // se for forçada, mostra OBS pois é final, ou seja, já mostrou
                  console.log(el);
                  if (codigo_tipo == 3) {
                        return 'Forçada, apenas OBS.';
                  } else {
                        var url =  location + '/tarefa/jsontasksrespostas'
                        $.ajax({
                            method: 'post',
                            url: url,
                            data: {
                              'codigo_observacao' : codigo_observacao
                            },
                            dataType: 'json',
                            success: function(data) {
                              // el.remove();
                              if (data.length>0) {
                                data.forEach(function(item){
                                	console.log(item);
                                  var data_resposta = new Date(item.data_resposta);
                                  data_resposta.setDate(data_resposta.getDate() + 1);
                                  el.append('<div class="media">'
                                      + '<p>' + formataData(new Date(data_resposta)) + '</p>'
                                      + '<div class="media-left">'
                                      + '<a href="#">'
                                      + '<img class=" img-circle tarefa-avatar" src="' + location + '/uploads/' + item.arquivo_avatar + '" alt="avatar do avaliador da tarefa">'
                                      + '<small>' + item.nome + ' ' + item.sobrenome + '</small>'
                                      + '</a>'
                                      + '</div>'
                                      + '<div class="media-body">'
                                      + '<h4 class="media-heading">Resposta</h4>'
                                      + '<p>' + item.resposta + '</p>'
                                      + '</div>'
                                      + '</div>');
                                });
                              } 
                            },
                            error: function(erro) {
                              console.log(erro);
                            }
                        }).done(function(data){
                              
                        });
                  }   
            }
						$('#myModalObsVer').on('show.bs.modal', function (event) {
                    
                    var button = $(event.relatedTarget); // Button that triggered the modal
                    var codigo_tarefa = button.data('codigotarefa');
                    var titulo = button.data('titulo');
                    var modal = $(this);    
                    var url = location + '/tarefa/jsontasksobs'
                    var mediaOutput = '';

                    modal.find('.modal-title').text(titulo);

										$.ajax({
			                  method: 'post',
			                  url: url,
			                  data: {
			                    'codigo_tarefa' : codigo_tarefa
			                  },
			                  dataType: 'json',
			                  success: function(data) {
			                    console.log(data);
			                    // if (data.status == "sucesso") {
			                    //   grid.isotope( 'remove', el ).isotope('layout');
			                    // } else {
			                    //   alert('Deu bug, tente novamente? =]');
			                    // }
			                    // var output = '<img src="' + location + '/uploads/' + data[0].arquivo_avatar + '" class="img-circle user-thumbs">'
			                    // 	+ '<p>' + data[0].observacao + '</p>';
			                    data.forEach(function(item){
			                    	var el = $('.media-obs-' + item.codigo_tarefa);
			                    	mediaOutput += '<div class="media media-obs-' + item.codigo_tarefa + '">'
                              + '<p>' + formataData(new Date(item.obs_data_criada)) + '</p>'
                              + '<div class="media-left">'
                              + '<a href="#">'
                              + '<img class="img-circle user-thumbs-obs" src="' + location + '/uploads/' + item.arquivo_avatar + '" alt="avatar do responsável pela tarefa">'
                              + '<small>' + item.nome + '</small>'
                              + '</a>'
                              + '</div>'
                              + '<div class="media-body">'
                              + '<h4 class="media-heading">' + item.tipo + '</h4>'
                              + '<p>' + item.observacao + '</p>'
                              + '</div>'
                              + '</div>';
                              + mostraResposta(item.codigo_tarefa, el, item.codigo_observacao, item.codigo_tipo);
			                    });
			                    
			                    modal.find('.modal-body').empty().html(mediaOutput);
			                  },
			                  error: function(error) {
			                    console.log(error);
			                  }
			              });
            });
						$('body').delegate('.tarefa-historico-opcoes-like', 'click', function(e){
							e.preventDefault();
							var el = $(this);
							var codigo_tarefa = $(this).attr('data-codigotarefa');
							var url = location + '/tarefa/jsontasksobs'
							$.ajax({
                  method: 'post',
                  url: url,
                  data: {
                    'codigo_tarefa' : codigo_tarefa
                  },
                  dataType: 'json',
                  success: function(data) {
                    console.log(data);
                    // if (data.status == "sucesso") {
                    //   grid.isotope( 'remove', el ).isotope('layout');
                    // } else {
                    //   alert('Deu bug, tente novamente? =]');
                    // }
                  },
                  error: function(error) {
                    console.log(error);
                  }
              });
						});
        }
    }
    $(document).ready(function () {
        fn.Iniciar();
    });
})(jQuery);