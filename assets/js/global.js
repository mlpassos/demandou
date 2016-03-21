(function ($) {
    "use strict";
    var fn = {
        // Funcionalidades
        Iniciar: function () {
        	fn.App();
        },
        App : function () {
            var location = 'http://' + window.location.hostname + "/demandou-git";

            // alert(location);
        	$('#formLogin').submit(function(e){
        		e.preventDefault();
        		var strUsuario = $("#usuario").val();
                var strSenha   = $("#senha").val();
                $.ajax({
                    url: location + "/usuario/autenticar",
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
                                window.location = location;    
                            } else {
                                // admin
                                window.location = location + "/admin";    
                            }
                        }
                    },
                    error: function(stc,error){
                        console.log(error);
                        console.log(stc)
                    }
                }).done(function(response, status){
                });
            });
            $('#logout').click(function(){
                var strUsuario = $("#session-usuario").val();
                $.ajax({
                    url: location + "/usuario/logout",
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
                        window.location = location;//"http://localhost/demandou-git/";
                    } else {
                        alert('Erro ao sair. Tente novamente. =]');
                    }
                    //console.log(response);
                });
            });

            // Enable pusher logging - don't include this in production
            Pusher.log = function(message) {
              if (window.console && window.console.log) {
                window.console.log(message);
              }
            };

            var pusher = new Pusher('44c94eeeff9f1fa8ac50', {
              encrypted: true
            });

            var geral = pusher.subscribe('geral');
            geral.bind('login', function(data) {
              // alertify.set({ delay: 3000 });
              alertify.log('O usuário ' + data.nome + ' está conectado.', "", 0);
              $.titleAlert("Notificação: Usuário conectado", {
                  requireBlur:false,
                  stopOnFocus:true,
                  // duration:4000,
                  interval:700
              });
              // alert('O usuário ' + data.nome + ' está conectado.');
            });
            var timeline = pusher.subscribe('timeline');
            timeline.bind('novo_projeto', function(data) {
              // alertify.set({ delay: 3000 });
              //alertify.log('O projeto ' + data.titulo + ' foi criado.', "", 0);
              var projeto = data['0'].projeto;
              var lideres = data['1'].lideres;
              var participantes = data['2'].participantes;
              // console.log(data['0'].projeto);
              // console.log(data['1'].lideres);
              // console.log(data['2'].participantes);
              
              participantes.forEach(function(item){
                console.log(item);
              });

              alertify.log('O projeto ' + projeto.titulo + ' foi criado.', "", 0);
              
              $.titleAlert("Notificação: Novo Projeto", {
                  requireBlur:false,
                  stopOnFocus:true,
                  // duration:4000,
                  interval:700
              });
              //alert('O projeto ' + data.titulo + ' foi criado.');
            });

        }
	}
    $(document).ready(function () {
        fn.Iniciar();
    });
})(jQuery);