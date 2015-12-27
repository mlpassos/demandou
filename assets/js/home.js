(function ($) {
    "use strict";
    var fn = {
        // Funcionalidades
        Iniciar: function () {
        	fn.App();
        },
        App : function () {
            alert('oi');
        	$('#formLogin').submit(function(e){
        		e.preventDefault();
        		var strUsuario = $("#usuario").val();
                var strSenha   = $("#senha").val();
                $.ajax({
                    url: "http://localhost/demandou-git/usuario/autenticar",
                    type: "POST",
                    data: {
                        usuario:strUsuario, 
                        senha:strSenha,
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.status == 'falha') {
                            alert('Ooops, erro!');
                        } else {
                            console.log(data);
                            if (data.codigo_perfil == 1) {
                                // user
                                window.location = "http://localhost/demandou-git/";    
                            } else {
                                // admin
                                window.location = "http://localhost/demandou-git/admin";    
                            }
                        }
                    },
                    // ajaxSend: function(){$("body").css("background-color","blue");},
                    // ajaxComplete: function(){$("#loader").hide('slow');},
                    error: function(stc,error){
                        //alert("erro:"+error);
                        //alert('erro:'+ error);
                        console.log(error);
                        console.log(stc)
                    }
                }).done(function(response, status){
                    // if (status=="success") {
                    //     if (response.perfil=="user") {
                    //         window.location = "http://localhost/demandou/";    
                    //     } else {
                    //         window.location = "http://localhost/demandou/admin";
                    //     }
                    // } else {
                    //     // erro
                    //     alert('Erro');
                    //     window.location = "http://localhost/demandou/";
                    // }
                    //window.location = "http://localhost/demandou/welcome/";
                    //console.log(response.perfil);
                });
            });
            $('#logout').click(function(){
                var strUsuario = $("#session-usuario").val();
                //alert(strUsuario);
                $.ajax({
                    url: "http://localhost/demandou-git/usuario/logout",
                    type: "POST",
                    dataType: 'text',
                    // ajaxSend: function(){$("body").css("background-color","blue");},
                    // ajaxComplete: function(){$("#loader").hide('slow');},
                    error: function(stc,error){
                        //alert("erro:"+error);
                        //alert('erro:'+ error);
                        console.log(error);
                    }
                }).done(function(response, status){
                    if (status == "success") {
                        //alert(response);
                        window.location = "http://localhost/demandou-git/";
                    } else {
                        alert('Erro ao sair. Tente novamente. =]');
                    }
                    //console.log(response);
                });
            });
            $('.tarefas-grid').masonry({
                itemSelector: '.cor-coluna',
            });
            $('#myModalTarefaVer').on('shown.bs.modal', function (event) {
              var button = $(event.relatedTarget); // Button that triggered the modal
              var codigotarefa = button.data('codigotarefa');

              var modal = $(this);
              // ajax pegando os dados da tarefa
              modal.find('.modal-title').text('Visualizar tarefa' + codigotarefa);
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
        }
	}
    $(document).ready(function () {
        fn.Iniciar();
    });
})(jQuery);