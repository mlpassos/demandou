(function ($) {
    "use strict";
    var fn = {
        // Funcionalidades
        Iniciar: function () {
        	fn.App();
        },
        App : function () {
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
        }
	}
    $(document).ready(function () {
        fn.Iniciar();
    });
})(jQuery);