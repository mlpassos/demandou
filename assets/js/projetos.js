(function ($) {
    "use strict";
    var fn = {
        // Funcionalidades
        Iniciar: function () {
            fn.App();
            // fn.TL();
        },
        App : function () {
            jQuery.extend({
                handleError: function( s, xhr, status, e ) {
                    // If a local callback was specified, fire it
                    if ( s.error )
                        s.error( xhr, status, e );
                    // If we have some XML response text (e.g. from an AJAX call) then log it in the console
                    else if(xhr.responseText)
                        console.log(xhr.responseText);
                }
            });
                  // var timelines = $('.cd-horizontal-timeline'),
                  // eventsMinDistance = 100;
                  // // console.log(initTimeline(timelines));
                  // (timelines.length > 0) && initTimeline(timelines);

                  // function initTimeline(timelines) {
                  //   timelines.each(function(){
                  //     var timeline = $(this),
                  //       timelineComponents = {};
                  //     //cache timeline components 
                  //     timelineComponents['timelineWrapper'] = timeline.find('.events-wrapper');
                  //     timelineComponents['eventsWrapper'] = timelineComponents['timelineWrapper'].children('.events');
                  //     timelineComponents['fillingLine'] = timelineComponents['eventsWrapper'].children('.filling-line');
                  //     timelineComponents['timelineEvents'] = timelineComponents['eventsWrapper'].find('a');
                  //     timelineComponents['timelineDates'] = parseDate(timelineComponents['timelineEvents']);
                  //     timelineComponents['eventsMinLapse'] = minLapse(timelineComponents['timelineDates']);
                  //     timelineComponents['timelineNavigation'] = timeline.find('.cd-timeline-navigation');
                  //     timelineComponents['eventsContent'] = timeline.children('.events-content');

                  //     //assign a left postion to the single events along the timeline
                  //     setDatePosition(timelineComponents, eventsMinDistance);
                  //     //assign a width to the timeline
                  //     var timelineTotWidth = setTimelineWidth(timelineComponents, eventsMinDistance);
                  //     //the timeline has been initialize - show it
                  //     timeline.addClass('loaded');

                  //     //detect click on the next arrow
                  //     timelineComponents['timelineNavigation'].on('click', '.next', function(event){
                  //       event.preventDefault();
                  //       updateSlide(timelineComponents, timelineTotWidth, 'next');
                  //     });
                  //     //detect click on the prev arrow
                  //     timelineComponents['timelineNavigation'].on('click', '.prev', function(event){
                  //       event.preventDefault();
                  //       updateSlide(timelineComponents, timelineTotWidth, 'prev');
                  //     });
                  //     //detect click on the a single event - show new event content
                  //     timelineComponents['eventsWrapper'].on('click', 'a', function(event){
                  //       event.preventDefault();
                  //       timelineComponents['timelineEvents'].removeClass('selected');
                  //       $(this).addClass('selected');
                  //       updateOlderEvents($(this));
                  //       updateFilling($(this), timelineComponents['fillingLine'], timelineTotWidth);
                  //       updateVisibleContent($(this), timelineComponents['eventsContent']);
                  //     });

                  //     //on swipe, show next/prev event content
                  //     timelineComponents['eventsContent'].on('swipeleft', function(){
                  //       var mq = checkMQ();
                  //       ( mq == 'mobile' ) && showNewContent(timelineComponents, timelineTotWidth, 'next');
                  //     });
                  //     timelineComponents['eventsContent'].on('swiperight', function(){
                  //       var mq = checkMQ();
                  //       ( mq == 'mobile' ) && showNewContent(timelineComponents, timelineTotWidth, 'prev');
                  //     });

                  //     //keyboard navigation
                  //     $(document).keyup(function(event){
                  //       if(event.which=='37' && elementInViewport(timeline.get(0)) ) {
                  //         showNewContent(timelineComponents, timelineTotWidth, 'prev');
                  //       } else if( event.which=='39' && elementInViewport(timeline.get(0))) {
                  //         showNewContent(timelineComponents, timelineTotWidth, 'next');
                  //       }
                  //     });
                  //   });
                  // }

                  // function updateSlide(timelineComponents, timelineTotWidth, string) {
                  //   //retrieve translateX value of timelineComponents['eventsWrapper']
                  //   var translateValue = getTranslateValue(timelineComponents['eventsWrapper']),
                  //     wrapperWidth = Number(timelineComponents['timelineWrapper'].css('width').replace('px', ''));
                  //   //translate the timeline to the left('next')/right('prev') 
                  //   (string == 'next') 
                  //     ? translateTimeline(timelineComponents, translateValue - wrapperWidth + eventsMinDistance, wrapperWidth - timelineTotWidth)
                  //     : translateTimeline(timelineComponents, translateValue + wrapperWidth - eventsMinDistance);
                  // }

                  // function showNewContent(timelineComponents, timelineTotWidth, string) {
                  //   //go from one event to the next/previous one
                  //   var visibleContent =  timelineComponents['eventsContent'].find('.selected'),
                  //     newContent = ( string == 'next' ) ? visibleContent.next() : visibleContent.prev();

                  //   if ( newContent.length > 0 ) { //if there's a next/prev event - show it
                  //     var selectedDate = timelineComponents['eventsWrapper'].find('.selected'),
                  //       newEvent = ( string == 'next' ) ? selectedDate.parent('li').next('li').children('a') : selectedDate.parent('li').prev('li').children('a');
                      
                  //     updateFilling(newEvent, timelineComponents['fillingLine'], timelineTotWidth);
                  //     updateVisibleContent(newEvent, timelineComponents['eventsContent']);
                  //     newEvent.addClass('selected');
                  //     selectedDate.removeClass('selected');
                  //     updateOlderEvents(newEvent);
                  //     updateTimelinePosition(string, newEvent, timelineComponents, timelineTotWidth);
                  //   }
                  // }

                  // function updateTimelinePosition(string, event, timelineComponents, timelineTotWidth) {
                  //   //translate timeline to the left/right according to the position of the selected event
                  //   var eventStyle = window.getComputedStyle(event.get(0), null),
                  //     eventLeft = Number(eventStyle.getPropertyValue("left").replace('px', '')),
                  //     timelineWidth = Number(timelineComponents['timelineWrapper'].css('width').replace('px', '')),
                  //     timelineTotWidth = Number(timelineComponents['eventsWrapper'].css('width').replace('px', ''));
                  //   var timelineTranslate = getTranslateValue(timelineComponents['eventsWrapper']);

                  //       if( (string == 'next' && eventLeft > timelineWidth - timelineTranslate) || (string == 'prev' && eventLeft < - timelineTranslate) ) {
                  //         translateTimeline(timelineComponents, - eventLeft + timelineWidth/2, timelineWidth - timelineTotWidth);
                  //       }
                  // }

                  // function translateTimeline(timelineComponents, value, totWidth) {
                  //   var eventsWrapper = timelineComponents['eventsWrapper'].get(0);
                  //   value = (value > 0) ? 0 : value; //only negative translate value
                  //   value = ( !(typeof totWidth === 'undefined') &&  value < totWidth ) ? totWidth : value; //do not translate more than timeline width
                  //   setTransformValue(eventsWrapper, 'translateX', value+'px');
                  //   //update navigation arrows visibility
                  //   (value == 0 ) ? timelineComponents['timelineNavigation'].find('.prev').addClass('inactive') : timelineComponents['timelineNavigation'].find('.prev').removeClass('inactive');
                  //   (value == totWidth ) ? timelineComponents['timelineNavigation'].find('.next').addClass('inactive') : timelineComponents['timelineNavigation'].find('.next').removeClass('inactive');
                  // }

                  // function updateFilling(selectedEvent, filling, totWidth) {
                  //   //change .filling-line length according to the selected event
                  //   var eventStyle = window.getComputedStyle(selectedEvent.get(0), null),
                  //     eventLeft = eventStyle.getPropertyValue("left"),
                  //     eventWidth = eventStyle.getPropertyValue("width");
                  //   eventLeft = Number(eventLeft.replace('px', '')) + Number(eventWidth.replace('px', ''))/2;
                  //   var scaleValue = eventLeft/totWidth;
                  //   setTransformValue(filling.get(0), 'scaleX', scaleValue);
                  // }

                  // function setDatePosition(timelineComponents, min) {
                  //   for (var i = 0; i < timelineComponents['timelineDates'].length; i++) { 
                  //       var distance = daydiff(timelineComponents['timelineDates'][0], timelineComponents['timelineDates'][i]),
                  //         distanceNorm = Math.round(distance/timelineComponents['eventsMinLapse']) + 2;
                  //       timelineComponents['timelineEvents'].eq(i).css('left', distanceNorm*min+'px');
                  //   }
                  // }

                  // function setTimelineWidth(timelineComponents, width) {
                  //   var timeSpan = daydiff(timelineComponents['timelineDates'][0], timelineComponents['timelineDates'][timelineComponents['timelineDates'].length-1]),
                  //     timeSpanNorm = timeSpan/timelineComponents['eventsMinLapse'],
                  //     timeSpanNorm = Math.round(timeSpanNorm) + 4,
                  //     totalWidth = timeSpanNorm*width;
                  //   timelineComponents['eventsWrapper'].css('width', totalWidth+'px');
                  //   updateFilling(timelineComponents['timelineEvents'].eq(0), timelineComponents['fillingLine'], totalWidth);
                  
                  //   return totalWidth;
                  // }

                  // function updateVisibleContent(event, eventsContent) {
                  //   var eventDate = event.data('date'),
                  //     visibleContent = eventsContent.find('.selected'),
                  //     selectedContent = eventsContent.find('[data-date="'+ eventDate +'"]'),
                  //     selectedContentHeight = selectedContent.height();

                  //   if (selectedContent.index() > visibleContent.index()) {
                  //     var classEnetering = 'selected enter-right',
                  //       classLeaving = 'leave-left';
                  //   } else {
                  //     var classEnetering = 'selected enter-left',
                  //       classLeaving = 'leave-right';
                  //   }

                  //   selectedContent.attr('class', classEnetering);
                  //   visibleContent.attr('class', classLeaving).one('webkitAnimationEnd oanimationend msAnimationEnd animationend', function(){
                  //     visibleContent.removeClass('leave-right leave-left');
                  //     selectedContent.removeClass('enter-left enter-right');
                  //   });
                  //   eventsContent.css('height', selectedContentHeight+'px');
                  // }

                  // function updateOlderEvents(event) {
                  //   event.parent('li').prevAll('li').children('a').addClass('older-event').end().end().nextAll('li').children('a').removeClass('older-event');
                  // }

                  // function getTranslateValue(timeline) {
                  //   var timelineStyle = window.getComputedStyle(timeline.get(0), null),
                  //     timelineTranslate = timelineStyle.getPropertyValue("-webkit-transform") ||
                  //           timelineStyle.getPropertyValue("-moz-transform") ||
                  //           timelineStyle.getPropertyValue("-ms-transform") ||
                  //           timelineStyle.getPropertyValue("-o-transform") ||
                  //           timelineStyle.getPropertyValue("transform");

                  //       if( timelineTranslate.indexOf('(') >=0 ) {
                  //         var timelineTranslate = timelineTranslate.split('(')[1];
                  //       timelineTranslate = timelineTranslate.split(')')[0];
                  //       timelineTranslate = timelineTranslate.split(',');
                  //       var translateValue = timelineTranslate[4];
                  //       } else {
                  //         var translateValue = 0;
                  //       }

                  //       return Number(translateValue);
                  // }

                  // function setTransformValue(element, property, value) {
                  //   element.style["-webkit-transform"] = property+"("+value+")";
                  //   element.style["-moz-transform"] = property+"("+value+")";
                  //   element.style["-ms-transform"] = property+"("+value+")";
                  //   element.style["-o-transform"] = property+"("+value+")";
                  //   element.style["transform"] = property+"("+value+")";
                  // }

                  // //based on http://stackoverflow.com/questions/542938/how-do-i-get-the-number-of-days-between-two-dates-in-javascript
                  // function parseDate(events) {
                  //   var dateArrays = [];
                  //   events.each(function(){
                  //     var dateComp = $(this).data('date').split('/'),
                  //       newDate = new Date(dateComp[2], dateComp[1]-1, dateComp[0]);
                  //     dateArrays.push(newDate);
                  //   });
                  //     return dateArrays;
                  // }

                  // function parseDate2(events) {
                  //   var dateArrays = [];
                  //   events.each(function(){
                  //     var singleDate = $(this),
                  //       dateComp = singleDate.data('date').split('T');
                  //     if( dateComp.length > 1 ) { //both DD/MM/YEAR and time are provided
                  //       var dayComp = dateComp[0].split('/'),
                  //         timeComp = dateComp[1].split(':');
                  //     } else if( dateComp[0].indexOf(':') >=0 ) { //only time is provide
                  //       var dayComp = ["2000", "0", "0"],
                  //         timeComp = dateComp[0].split(':');
                  //     } else { //only DD/MM/YEAR
                  //       var dayComp = dateComp[0].split('/'),
                  //         timeComp = ["0", "0"];
                  //     }
                  //     var newDate = new Date(dayComp[2], dayComp[1]-1, dayComp[0], timeComp[0], timeComp[1]);
                  //     dateArrays.push(newDate);
                  //   });
                  //     return dateArrays;
                  // }

                  // function daydiff(first, second) {
                  //     return Math.round((second-first));
                  // }

                  // function minLapse(dates) {
                  //   //determine the minimum distance among events
                  //   var dateDistances = [];
                  //   for (var i = 1; i < dates.length; i++) { 
                  //       var distance = daydiff(dates[i-1], dates[i]);
                  //       dateDistances.push(distance);
                  //   }
                  //   return Math.min.apply(null, dateDistances);
                  // }

                  // /*
                  //   How to tell if a DOM element is visible in the current viewport?
                  //   http://stackoverflow.com/questions/123999/how-to-tell-if-a-dom-element-is-visible-in-the-current-viewport
                  // */
                  // function elementInViewport(el) {
                  //   var top = el.offsetTop;
                  //   var left = el.offsetLeft;
                  //   var width = el.offsetWidth;
                  //   var height = el.offsetHeight;

                  //   while(el.offsetParent) {
                  //       el = el.offsetParent;
                  //       top += el.offsetTop;
                  //       left += el.offsetLeft;
                  //   }

                  //   return (
                  //       top < (window.pageYOffset + window.innerHeight) &&
                  //       left < (window.pageXOffset + window.innerWidth) &&
                  //       (top + height) > window.pageYOffset &&
                  //       (left + width) > window.pageXOffset
                  //   );
                  // }

                  // function checkMQ() {
                  //   //check if mobile or desktop device
                  //   return window.getComputedStyle(document.querySelector('.cd-horizontal-timeline'), '::before').getPropertyValue('content').replace(/'/g, "").replace(/"/g, "");
                  // }
            $('.tarefas-grid').masonry({
                itemSelector: '.cor-coluna',
            });
            $('.projetos-acoes-btn').tooltip({
              'delay': { "show": 500, "hide": 100 }
            });
            var month = new Array();
                month[0] = "Janeiro";
                month[1] = "Fevereiro";
                month[2] = "Maio";
                month[3] = "Abril";
                month[4] = "Maio";
                month[5] = "Junho";
                month[6] = "Julho";
                month[7] = "Ago";
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
            $('#myModalProjetoVer').on('hidden.bs.modal', function (event) {
                     var modal = $(this);
                     modal.find('.modal-tarefas-lista').html('');
                     modal.find('.modal-body').find('.data-faltam').html('');
                     modal.find('.modal-title').text('');
                     modal.find('.modal-body').find('.descricao').text('');
                     modal.find('.modal-body').find('.data-inicio').text('');
                     modal.find('.modal-body').find('.data-prazo').text('');
            });
            $('#myModalProjetoVer').on('show.bs.modal', function (event) {
                    var button = $(event.relatedTarget); // Button that triggered the modal
                    var modal = $(this);
                    var codigo_projeto = button.data('codigoprojeto');
                    var titulo = button.data('titulo');
                    var descricao = button.data('descricao');
                    var prioridade = button.data('prioridade');
                    switch(prioridade) {
                        case 3:
                            var pclass = "#F2DEDE";
                            break;
                        case 2:
                            var pclass = "#FCF8E3";
                            break;
                        case 1:
                            var pclass = "#DFF0D8";
                            break;
                        default:
                            // nothing
                    }
                    var data_inicio = new Date(button.data('inicio'));
                    data_inicio.setDate(data_inicio.getDate() + 1);
                    var data_prazo = new Date(button.data('prazo'));
                    data_prazo.setDate(data_prazo.getDate() + 1);
                    var hoje = new Date();
                    var faltam = Math.floor((data_prazo - hoje) / (1000*60*60*24));
                    var total = Math.floor((data_prazo - data_inicio) / (1000*60*60*24));
                    var check_inicio = Math.floor((data_inicio - hoje) / (1000*60*60*24));
                    var check_fim = Math.floor((data_prazo - hoje) / (1000*60*60*24));
                    modal.find('.modal-content').css('background-color',pclass);

                    if (check_inicio>=0) {
                            // nao começou
                            var comecou = false;
                            if (check_inicio==0) {
                              modal.find('.modal-body').find('.data-faltam').text('Começou hoje!').addClass('alert alert-success').removeClass('alert-danger alert-warning');
                            } else {
                              if (check_inicio == 1) {
                                modal.find('.modal-body').find('.data-faltam').text('Começa Amanhã').addClass('alert alert-success').removeClass('alert-danger alert-warning');
                              } else {
                                modal.find('.modal-body').find('.data-faltam').text('Faltam ' + check_inicio + ' dias para começar.').addClass('alert alert-success').removeClass('alert-danger alert-warning');
                              }
                            }
                            modal.find('.modal-body').find('.progress').find('.progress-bar').css('width', '0%').text('0%');
                    } else {
                            var comecou = true;
                            // começou
                            if (check_fim<=0) {
                              if (check_fim==0) { 
                                var porcento = 100;
                                modal.find('.modal-body').find('.data-faltam').text('Termina hoje').addClass('alert alert-danger').removeClass('alert-success alert-warning');
                              } else {
                                // atrasado
                                modal.find('.modal-body').find('.data-faltam').text('Atrasado ' + faltam*(-1) + ' dias.').addClass('alert alert-danger').removeClass('alert-success alert-warning');
                                var porcento = 100;
                              } 
                            } else {
                              modal.find('.modal-body').find('.data-faltam').text('Faltam ' + check_fim + ' dias para terminar.').addClass('alert alert-warning').removeClass('alert-danger alert-success');
                              var porcento = [(total-faltam) * 100] / total;
                            }
                            modal.find('.modal-body').find('.progress').find('.progress-bar').css('width', porcento.toFixed(2) + '%').text(porcento.toFixed(2)+'%');
                    }
                    // ajax pegando os dados da tarefa
                      modal.find('.modal-title').text(titulo);
                      modal.find('.modal-body').find('.descricao').text(descricao);
                      modal.find('.modal-body').find('.data-inicio').text('Início: ' + formataData(data_inicio));
                      modal.find('.modal-body').find('.data-prazo').text('Prazo: ' + formataData(data_prazo));
            });
            $('#myModalTarefaVer').on('hidden.bs.modal', function (event) {
                  var modal = $(this);
                  modal.find('.modal-tarefas-lista').html('');
                  // FIX AQUI
                  // if ($('.tarefa-observacoes').css('display')=='block') {
                  //       $('.tarefa-observacoes').css('display', 'none');
                  // }
            });
            

            // function getTasksUsersInfo() {
            //   var res = [],
            //   atrasados = "", comecou = "";
            //   var ajax = $.ajax({
            //             method: 'post',
            //             // async:false,
            //             url: 'http://localhost/demandou-git/tarefa/jsontarefas',
            //             dataType: 'json',
            //             success: function(data) {
            //                comecou = data.filter(function(item,index,arr){
            //                   var inicio = new Date(item.data_inicio);
            //                   var hoje = new Date();
            //                   return Math.floor((inicio - hoje) / (1000*60*60*24))<=0;
            //                }).map(function(item,index,arr) {
            //                   return item;
            //                });
            //                atrasados = data.filter(function(item,index,arr){
            //                   var prazo = new Date(item.data_prazo);
            //                   var hoje = new Date();
            //                   return Math.floor((prazo - hoje) / (1000*60*60*24))<0;
            //                }).map(function(item,index,arr) {
            //                   return item;
            //                });
                           
            //             },
            //             error: function(error) {
            //               alert('erro');
            //               console.log(error);
            //             },
            //           }).done(function(data){
            //             console.log(comecou);
            //             console.log(atrasados);
            //           });

            // }

            // getTasksUsersInfo();

            function mostraOpcoes(codigo_tipo, codigo_observacao) {
                  if (codigo_tipo == 1) {
                       return '<div class="form-group">'
                        + 'Aceitar entrega?<br>' 
                        + '<label class="radio-inline"><input type="radio" id="observacao_extender-' + codigo_observacao + '-sim" name="observacao_extender-' + codigo_observacao + '"> Sim</label>'
                        + '<label class="radio-inline"><input type="radio" id="observacao_extender-' + codigo_observacao + '-nao" name="observacao_extender-' + codigo_observacao + '"> Não</label>'
                        + '</div>';      
                  } else if (codigo_tipo == 2) {
                        return '<div class="form-group">'
                        + 'Extender o prazo?<br>' 
                        + '<label class="radio-inline"><input type="radio" id="observacao_extender-' + codigo_observacao + '-sim" name="observacao_extender-' + codigo_observacao + '"> Sim</label>'
                        + '<label class="radio-inline"><input type="radio" id="observacao_extender-' + codigo_observacao + '-nao" name="observacao_extender-' + codigo_observacao + '"> Não</label>'
                        + '</div>';
                  } else {
                        return '';
                  }
            }
            function mostraResposta(codigo_tarefa, el, codigo_observacao, codigo_tipo, lider) {
                  // se for forçada, mostra OBS pois é final, ou seja, já mostrou
                  // console.log('aqui');
                  if (codigo_tipo == 3) {
                        return 'Forçada, apenas OBS.';
                  } else {
                        var url = 'http://localhost/demandou-git/tarefa/jsontasksrespostas'
                        $.ajax({
                            method: 'post',
                            url: url,
                            data: {
                              'codigo_observacao' : codigo_observacao
                            },
                            dataType: 'json',
                            success: function(data) {
                              console.log(data);
                              if (data.length>0) {
                                    data.forEach(function(item){
                                          var data_resposta = new Date(item.data_resposta);
                                          data_resposta.setDate(data_resposta.getDate() + 1);
                                          el.append('<div class="media">'
                                              + '<p>' + formataData(new Date(data_resposta)) + '</p>'
                                              + '<div class="media-left">'
                                              + '<a href="#">'
                                              + '<img class=" tarefa-avatar" src="http://localhost/demandou-git/uploads/' + item.arquivo_avatar + '" alt="avatar do avaliador da tarefa">'
                                              + '<small>' + item.nome + ' ' + item.sobrenome + '</small>'
                                              + '</a>'
                                              + '</div>'
                                              + '<div class="media-body">'
                                              + '<h4 class="media-heading">Resposta</h4>'
                                              + '<p>' + item.resposta + '</p>'
                                              + '</div>'
                                              + '</div>');
                                    });
                              } else {
                                     if (lider == 1) {
                                          // mostra form
                                          alert('aqui');
                                          el.append('<div>'
                                                + '<div class="form-group">'
                                                + '<label for="observacao_responder">Responder Observação</label><br>' 
                                                + '<input type="checkbox" class="switch switch-resposta" id="observacao_responder" name="observacao_responder" data-codigoobservacao="' + codigo_observacao +'">'
                                                + '</div>'
                                                + '<div class="form-group">'
                                                + '<div class="obs-resposta observacao-resposta-' + codigo_observacao + '" data-codigotarefa="' + codigo_tarefa + '" data-lider="' + lider + '" data-tipo="' + codigo_tipo + '">'
                                                + mostraOpcoes(codigo_tipo, codigo_observacao)
                                                + '<label for="observacao_resposta">Observações</label>'
                                                + '<textarea id="observacao_resposta" name="observacao_resposta" class="form-control" rows="3"></textarea>'
                                                + '<button type="button" class="btn btn-primary btn-small" id="resposta_gravar"><i class="fa fa-disk"></i> Responder</button>'
                                                + '</div>'
                                                + '</div>'
                                                + '</div>');
                                    } else {
                                          // mostra mensagem ainda sem resposta
                                          el.append('<p>Aguardando resposta.</p>');
                                    }
                              }
                            },
                            error: function(erro) {
                              console.log(erro);
                            }
                        }).done(function(data){
                              if (data.length>0) {
                                    // nada, ja respondido
                              } else {
                                    el.find("input[type=checkbox].switch-resposta").each(function() {
                                        $(this).before(
                                          '<span class="switch switch-resposta">' +
                                          '<span class="mask" /><span class="background" />' +
                                          '</span>'
                                        );
                                        // Hide checkbox
                                        $(this).hide();
                                        // Set inital state
                                        if (!$(this)[0].checked) {
                                          //alert('nao marcado');
                                          $(this).prev().find(".background").css({left: "-56px"});
                                        }
                                    }); // End each()
                                    el.find("span.switch-resposta").click(function() {
                                        // If on, slide switch off
                                        console.log('estava ' + $(this).next()[0].checked);
                                        var codigo_observacao = $(this).next()[0].attributes[4].value;
                                        if ($(this).next()[0].checked) {
                                          // console.log('Foi pra ' + $(this).next()[0].checked);
                                          $(this).find(".background").animate({left: "-56px"}, 200);
                                          $('.observacao-resposta-' + codigo_observacao).hide('slow');
                                          // $('#myModalTarefaFinalizar').modal('hide');
                                        // Otherwise, slide switch on
                                        } else {
                                          // console.log($(this).next()[0].attributes[4].value);
                                          // console.log($(this).next()[0].codigotarefa);
                                          // var codigo_tarefa = $(this).next()[0].attr('data-codigotarefa');
                                          $('.observacao-resposta-' + codigo_observacao).show('slow');
                                          // $('#myModalTarefaFinalizar').modal('show');
                                          $(this).find(".background").animate({left: "0px"}, 200);
                                          // console.log($(this).next()[0].checked);
                                        }
                                        // Toggle state of checkbox
                                        $(this).next()[0].checked = !$(this).next()[0].checked;
                                        console.log('está ' + $(this).next()[0].checked);
                                    });
                              }
                        });
                  }   
            }
            $('body').delegate('.show-obs','click',function(){
                  $(this).next().stop(true,true).slideToggle("slow");
            });

            function mostrarObs(codigoTarefa, dono, lider, UsuarioTarefaNome, UsuarioTarefaAvatar) { 
                 
                  var url = 'http://localhost/demandou-git/tarefa/jsontasksobs'
                  var resp = "";
                  $.ajax({
                        method: 'post',
                        url: url,
                        // async:false,
                        data: {
                          'codigo_tarefa' : codigoTarefa
                        },
                        dataType: 'json',
                        success: function(data) {
                        //if (data.length>0) {
                              console.log(data);
                              if (data.length>0) {
                                   $('.tarefa-observacoes-' + codigoTarefa).css('display', 'none');
                                   $('#showObs-' + codigoTarefa).removeClass("hidden").addClass("show");
                              }
                              data.forEach(function(item){
                                    // checar se dono da tarefa
                                     if (item.codigo_tipo==3 && dono==0) {
                                          UsuarioTarefaNome = $('#nome_usuario').val();
                                          UsuarioTarefaAvatar = $('#avatar_usuario').val();
                                    } else {
                                           UsuarioTarefaNome = item.nome + ' ' + item.sobrenome;
                                          UsuarioTarefaAvatar = item.arquivo_avatar;
                                    }
                                    // console.log(item);
                                    var el = $('.tarefa-observacoes-' + codigoTarefa);
                                    $('.tarefa-observacoes-' + codigoTarefa).append(''
                                     // observações
                                    + '<div class="media">'
                                    + '<p>' + formataData(new Date(item.obs_data_criada)) + '</p>'
                                    + '<div class="media-left">'
                                    + '<a href="#">'
                                    + '<img class=" tarefa-avatar" src="http://localhost/demandou-git/uploads/' + UsuarioTarefaAvatar + '" alt="avatar do responsável pela tarefa">'
                                    + '<small>' + UsuarioTarefaNome + '</small>'
                                    + '</a>'
                                    + '</div>'
                                    + '<div class="media-body">'
                                    + '<h4 class="media-heading">' + item.tipo + '</h4>'
                                    + '<p>' + item.observacao + '</p>'
                                    + '</div>'
                                    + '</div>');
                                    // respostas passando tipo, só mostra se 1 ou 2
                                    mostraResposta(codigoTarefa, el, item.codigo_observacao, item.codigo_tipo, lider);
                              });
                            },
                            error: function (error) {
                              console.log('erro: ' + error);
                            }
                  });
            }

            function showAndamento(check_fim, check_inicio, total, faltam, hoje, codigoUsuarioAtual, UsuarioTarefaAvatar, UsuarioTarefaNome, codigoUsuarioTarefa,data_inicio,data_prazo, data_fim, codigoTarefa, lider, encerrada, encerrada_por) {
                  var resposta = [], output="", atrasado=0;
                  if (data_fim!==null) {
                              // sendo diferente e não é líder
                              if (lider !== 1) {
                                   output += 'Tempo consumido (%)<div class="progress">'
                                                  + '<div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:100%;min-width: 2em;">'
                                                  + '100%'
                                                  + '</div>'
                                                  + '</div>';
                                    if (encerrada === null) {
                                          output += '<p class="alert alert-info">Finalizada em <em>' + formataData(new Date(data_fim)) + '</em>, aguardando validação.</p>';
                                    } else {
                                          output += '<p class="alert alert-success"><i class="icone-thumbs fa fa-thumbs-up"></i> Tarefa encerrada.</p>';
                                    }
                              }
                  } else {
                        // ainda não finalizou
                        if (encerrada===null) { 
                              if (check_inicio>=0) {
                                        // nao começou
                                        var comecou = false;
                                        if (check_inicio==0) {
                                          output += '<p class="alert alert-info">Começou hoje</p>';
                                        } else {
                                          if (check_inicio == 1) {
                                            output += '<p class="alert alert-info">Começa amanhã</p>';
                                          } else {
                                            output += '<p class="alert alert-info">' + 'Faltam ' + check_inicio + ' dias para começar.' + '</p>';
                                          }
                                        }
                                        // progress bar 0
                                        output += 'Tempo consumido (%)<div class="progress">'
                                                  + '<div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="min-width: 2em;">'
                                                  + '0%'
                                                  + '</div>'
                                                  + '</div>'
                              } else {
                                        var comecou = true;
                                        // começou
                                        if (check_fim<=0) {
                                          if (check_fim==0) { 
                                            var porcento = 100;
                                            output += '<p class="alert alert-info">Termina hoje!</p>';
                                          } else {
                                            // atrasado
                                            var porcento = 100;
                                            var atrasado = 1;
                                            output += '<p class="alert alert-info">' + 'Atrasado ' + ((faltam*(-1)==1) ? faltam*(-1) + ' dia.' : faltam*(-1) + ' dias.') 
                                            // se usuário atual é o dono da tarefa, mostra mensagem sobre negociar prazo.
                                            if (codigoUsuarioAtual == codigoUsuarioTarefa) {
                                                output += ', finalize para negociar novo prazo.</p>';
                                            } else {
                                                output += '</p>';
                                            }
                                          } 
                                        } else {
                                          var porcento = [(total-faltam) * 100] / total;
                                          output += '<p class="alert alert-info">' + ((check_fim==1) ? 'Falta ' + check_fim + ' dia.' : 'Faltam ' + check_fim + ' dias.') + '</p>';
                                          
                                        }
                                        output += 'Tempo consumido (%)<div class="progress">'
                                                  + '<div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="'+ porcento.toFixed(2) + '%' + '" aria-valuemin="0" aria-valuemax="100" style="width:' + porcento.toFixed(2) + '%' + ';min-width: 2em;">'
                                                  + porcento.toFixed(2) + '%'
                                                  + '</div>'
                                                  + '</div>'
                              }
                        } else {
                              output += '<div class="alert alert-danger">Tarefa encerrada pelo líder.</div>';
                        }
                  }
                  resposta = {
                        out: output,
                        late: atrasado
                  }
                  return resposta;
            }

            function usuarioAcoes(codigoUsuarioAtual, UsuarioTarefaAvatar, UsuarioTarefaNome, codigoUsuarioTarefa,data_inicio,data_prazo, data_fim, codigoTarefa, lider, encerrada, encerrada_por) {
                  var hoje = new Date();
                  var data_inicio = new Date(data_inicio);
                  var data_prazo = new Date(data_prazo);
                  var faltam = Math.floor((data_prazo - hoje) / (1000*60*60*24));
                  var total = Math.floor((data_prazo - data_inicio) / (1000*60*60*24));
                  var check_inicio = Math.floor((data_inicio - hoje) / (1000*60*60*24));
                  var check_fim = Math.floor((data_prazo - hoje) / (1000*60*60*24));
                  var atrasado = 0;
                  var output = "";
                  // já finalizou a tarefa e não é dono dela ou líder...
                  if (codigoUsuarioAtual == codigoUsuarioTarefa) {
                        // já faz embaixo
                        var dono = 1;
                  } else {
                        var dono = 0;
                        if (lider == 0) {
                              var andamento = showAndamento(check_fim, check_inicio, total, faltam, hoje, codigoUsuarioAtual, UsuarioTarefaAvatar, UsuarioTarefaNome, codigoUsuarioTarefa,data_inicio,data_prazo, data_fim, codigoTarefa, lider, encerrada, encerrada_por);
                              output += andamento.out;
                        }
                  } 
                  // caso dono da tarefa e ela tenha começado ou seja líder, mostra controles de finalização
                  if ( (check_inicio <= 0 && codigoUsuarioAtual == codigoUsuarioTarefa ) || (lider==1) ) {
                        // já foi finalizada antes?
                        if (data_fim===null) {
                              if (encerrada===null) {
                                    var andamento = showAndamento(check_fim, check_inicio, total, faltam, hoje, codigoUsuarioAtual, UsuarioTarefaAvatar, UsuarioTarefaNome, codigoUsuarioTarefa,data_inicio,data_prazo, data_fim, codigoTarefa, lider, encerrada, encerrada_por);
                                    output += andamento.out;
                                    output += '<button type="button" class="hidden btn btn-xs btn-primary show-obs show-obs-' + codigoTarefa + '" id="showObs-' + codigoTarefa + '">Mostrar histórico</button>';
                                    output += '<p class="tarefa-observacoes tarefa-observacoes-' + codigoTarefa + '"></p>';
                                    mostrarObs(codigoTarefa, dono, lider,UsuarioTarefaNome,UsuarioTarefaAvatar);
                                    output += '<div>'
                                    + '<div class="form-group">'
                                    + '<label for="tarefa_encerrar">Finalizar tarefa</label><br>' 
                                    + '<input type="checkbox" class="switch" id="tarefa_encerrar" name="tarefa_encerrar" data-codigotarefa="' + codigoTarefa +'">'
                                    + '</div>'
                                    + '<div class="form-group">'
                                    + '<div class="tarefa-observacao tarefa-obs-' + codigoTarefa +'" data-atrasado="' + andamento.late + '" data-dono="' + dono + '" data-lider="' + lider + '" data-codigousuario="' + codigoUsuarioTarefa + '">'
                                    + '<label for="tarefa_observacao">Observações</label>'
                                    + '<textarea id="tarefa_observacao" name="tarefa_observacao" class="form-control" rows="3"></textarea>'
                                    // + '<form id="arqObsForm" name="arqObsForm" enctype="multipart/form-data">'
                                    // + '<div class="form-group">'
                                    // + '<label for="arquivo_obs">Anexo(s)</label>'
                                    // + '<input type="file" id="arquivo_obs" name="arquivo_obs">'
                                    // + '<p class="help-block">Conteúdo/Relatório produzido</p>'
                                    // + '</div>'
                                    // + '</form>'
                                    + '<button type="button" class="btn btn-primary btn-small" id="tarefa_gravar"><i class="fa fa-disk"></i> Salvar</button>'
                                    + '</div>'
                                    + '</div>'
                                    + '</div>';
                              } else {
                                    output += '<div class="alert alert-danger">Tarefa encerrada pelo líder.</div>';
                                     output += '<button type="button" class="hidden btn btn-xs btn-primary show-obs show-obs-' + codigoTarefa + '" id="showObs-' + codigoTarefa + '">Mostrar histórico</button>';
                                    output += '<p class="tarefa-observacoes tarefa-observacoes-' + codigoTarefa + '"></p>';
                                    mostrarObs(codigoTarefa, dono, lider,UsuarioTarefaNome,UsuarioTarefaAvatar);
                              }
                        } else {
                              // verificar se existe solicitação de novo prazo pendente, se tiver exibir a resposta.
                              if (encerrada===null) {
                                    output += '<p class="alert alert-info">Tarefa finalizada em <em>' + formataData(new Date(data_fim)) + '</em>, aguardando validação.</p>';
                                    output += '<button type="button" class="btn btn-xs btn-primary show-obs show-obs-' + codigoTarefa + '" id="showObs-' + codigoTarefa + '" style="display:none;">Mostrar histórico</button>'
                                          +' <p class="tarefa-observacoes tarefa-observacoes-' + codigoTarefa + '">'
                                          + '</p>';
                                    mostrarObs(codigoTarefa, dono, lider,UsuarioTarefaNome,UsuarioTarefaAvatar);
                              } else {
                                    output += '<p class="alert alert-success"><i class="icone-thumbs fa fa-thumbs-up"></i> Tarefa encerrada.</p>';
                                    output += '<button type="button" class="hidden btn btn-xs btn-primary show-obs show-obs-' + codigoTarefa + '" id="showObs-' + codigoTarefa + '">Mostrar histórico</button>'
                                          + '<p class="tarefa-observacoes tarefa-observacoes-' + codigoTarefa + '">'
                                          + '</p>';
                                    mostrarObs(codigoTarefa, dono, lider,UsuarioTarefaNome,UsuarioTarefaAvatar);
                              }
                        }
                  } 
                  return output;
            }

            function getTarefaPrioridade(codigo) {
                  var code = parseInt(codigo);
                  
                  switch(code) {
                       case 3:
                            var out = {
                                'classe': "danger",
                                'texto': 'ALTA',
                                'cor': '#F2DEDE'
                            }
                            break;
                        case 2:
                            // var out = "#FCF8E3";
                            var out = {
                                'classe': "warning",
                                'texto': 'MÉDIA',
                                'cor': '#FCF8E3'
                            }
                            break;
                        case 1:
                            // var out = "#DFF0D8";
                            var out = {
                                'classe': "success",
                                'texto': 'BAIXA',
                                'cor': '#DFF0D8'
                            }
                            break;
                        default:
                            // nothing
                            var out = "erro";
                  }     
                  return out;
            }
   
            // $('.tarefas-box').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
            //       $(this).removeClass('animated flipInX');
            // });

            $('#myModalTarefaVer').on('show.bs.modal', function (event) {
                    var button = $(event.relatedTarget); // Button that triggered the modal
                    var codigo_projeto = button.data('codigoprojeto');
                    var modal = $(this);
                    var titulo = button.data('titulo');
                    var lider = button.data('lider');
                    var codigo_usuario = button.data('codigousuario');
                    // console.log("a: " + codigo_usuario);
                    var url = 'http://localhost/demandou-git/tarefa/jsonprojecttasks';
                    modal.find('.modal-title').text(titulo);
                    $.ajax({
                      method: 'post',
                      url: url,
                      data: {
                        'codigo_projeto' : codigo_projeto
                      },
                      dataType: 'json',
                      success: function(data) {
                        console.log(data);
                        if (data.length==0) {
                          // nada
                          $('#myModalTarefaVer .modal-tarefas-lista').append('<p><span class="fa fa-exclamation-triangle"></span> Relaxe, sem tarefas no projeto ainda, mas não se preocupe, você será avisado. =]</p>');
                        } else {
                          var aux = "";
                          var output = '<div id="carousel-example-generic" class="carousel slide">'
                                       + '<ol class="carousel-indicators">';
                          for (var i = 0; i <= data.length - 1;  i++) {
                                output += (i==0) ? '<li data-target="#carousel-example-generic" class="active" data-slide-to="' + i + '"></li>' : '<li data-target="#carousel-example-generic" data-slide-to="' + i + '"></li>';
                          };
                          output += '</ol><div class="carousel-inner" role="listbox">';
                          data.forEach(function(item){
                            // var usuarioEditavel = (codigo_usuario == item.codigo_usuario) ? true
                            // console.log(item.data_inicio);
                            if (aux!==item.codigo_tarefa) {
                              var data_inicio = new Date(item.data_inicio);
                              data_inicio.setDate(data_inicio.getDate() + 1);
                              var data_prazo = new Date(item.data_prazo);
                              data_prazo.setDate(data_prazo.getDate() + 1);
                              if (item.data_fim === null) {
                                    var data_fim = item.data_fim;
                              } else {
                                    var data_fim = new Date(item.data_fim);
                                    data_fim.setDate(data_fim.getDate() + 1);
                              }
                              // $('#myModalTarefaVer .modal-tarefas-lista').append(''
                                      // output += ''//
                                      output += (aux=="") ? '<div class="item active">' : '<div class="item">'
                                      output += '<div class="tarefa-individual-box panel panel-' + getTarefaPrioridade(item.prioridade).classe + '">'
                                        // + '<i class="pin animated fadeInDown"></i>'
                                        + '<div class="panel-heading tarefas-single">'
                                        + '<div class="pull-left">'
                                        + '<h2 class="panel-title tarefas-titulo">'+item.titulo+'</h2>'
                                        + '<button type="button" class="btn-edit btn btn-xs btn-default" aria-label="alterar tarefa">'
                                        + '<span class="fa fa-pencil" aria-hidden="true"></span>'
                                        + '</button>'
                                        + '</div>'
                                        + '<div class="pull-right">'
                                        + '<img class="img-thumbnail tarefa-avatar" src="http://localhost/demandou-git/uploads/' + item.arquivo_avatar + '" alt="avatar do responsável pela tarefa">'
                                        + '<div class="pull-right">'
                                        + '<small> ' + item.nome + ' ' + item.sobrenome + '</small>'
                                        + '<em><small> ' + item.usuario_funcao + '</small></em>'
                                        + '</div>'      
                                        + '</div>'
                                        + '</div>' 
                                        + '<div class="panel-body" style="background-color:' +  getTarefaPrioridade(item.prioridade).cor + ';">'
                                        + '<p>' +  item.descricao + '</p>' 
                                        + '<p><span class="glyphicon glyphicon-calendar"></span> ' +  formataData(data_inicio) + '</p>' 
                                        + '<p><span class="glyphicon glyphicon-time"></span> ' +  formataData(data_prazo) + '</p>'
                                        + '<div>' + usuarioAcoes(codigo_usuario, item.arquivo_avatar, item.nome + ' ' + item.sobrenome, item.codigo_usuario, data_inicio, data_prazo, data_fim, item.codigo_tarefa, lider, item.encerrada, item.encerrada_por) + '</div>'
                                       + '</div>'
                                       + '</div>'
                                       + '</div>';//);
                                
                                aux = item.codigo_tarefa; 
                            } else {
                              // faz nada, é igual
                              //$("#myModalTarefaVer .tarefa-" + item.codigo_tarefa).append('<li>' + item.codigo_usuario + '-' + item.papel + '</li>');
                            }
                            // aqui
                          });
                          output += '</div>'
                                    + '<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">'
                                    + '<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>'
                                    + '<span class="sr-only">Previous</span>' 
                                    + '</a>'
                                    + '<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">'
                                    + '<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>'
                                    + '<span class="sr-only">Next</span>'
                                    + '</a>'
                                    + '</div>';
                           $('#myModalTarefaVer .modal-tarefas-lista').append(output);
                        }
                      },
                      error: function(error) {
                        alert('erro');
                        console.log(error);
                      },
                    }).done(function(){

                        $('#carousel-example-generic').carousel('pause');

                        // $(':checkbox').iphoneStyle();
                        $("input[type=checkbox].switch").each(function() {
                            // Insert mark-up for switch
                            //console.log($(this));
                            $(this).before(
                              '<span class="switch">' +
                              '<span class="mask" /><span class="background" />' +
                              '</span>'
                            );
                            // Hide checkbox
                            $(this).hide();
                            // Set inital state
                            if (!$(this)[0].checked) {
                              //alert('nao marcado');
                              $(this).prev().find(".background").css({left: "-56px"});
                            }
                        }); // End each()
                        $("span.switch").click(function() {
                            // If on, slide switch off
                            console.log('estava ' + $(this).next()[0].checked);
                            var codigo_tarefa = $(this).next()[0].attributes[4].value;
                            if ($(this).next()[0].checked) {
                              // console.log('Foi pra ' + $(this).next()[0].checked);
                              $(this).find(".background").animate({left: "-56px"}, 200);
                              $('.tarefa-obs-' + codigo_tarefa).hide('slow');
                              // $('#myModalTarefaFinalizar').modal('hide');
                            // Otherwise, slide switch on
                            } else {
                              // console.log($(this).next()[0].attributes[4].value);
                              // console.log($(this).next()[0].codigotarefa);
                              // var codigo_tarefa = $(this).next()[0].attr('data-codigotarefa');
                              $('.tarefa-obs-' + codigo_tarefa).show('slow');
                              // $('#myModalTarefaFinalizar').modal('show');
                              $(this).find(".background").animate({left: "0px"}, 200);
                              // console.log($(this).next()[0].checked);
                            }
                            // Toggle state of checkbox
                            $(this).next()[0].checked = !$(this).next()[0].checked;
                            console.log('está ' + $(this).next()[0].checked);
                        });
                    });
            });
            
            // var files;
            // $('body').delegate('#arquivo_obs', 'change', function(e){
            //       // alert('po');
            //       files = e.target.files;
            // });

            $('body').delegate('.tarefas-titulo', 'mouseenter', function() {
                  var el = $(this).next('.btn-edit');
                  if (el.hasClass('animated-alt fadeOutDown')) {
                        el.removeClass('animated-alt fadeOutDown');
                  }
                  el.addClass('animated-alt fadeInUp');
                  // alert('oi');
            });
            $('body').delegate('.tarefas-titulo', 'mouseleave', function() {
                  var el = $(this).next('.btn-edit');
                  el.removeClass('animated-alt fadeInUp').addClass('animated-alt fadeOutDown');
                  // alert('sai');
            });

            $('body').delegate('.btn-edit', 'mouseenter', function() {
                  var el = $(this);
                  el.removeClass('animated-alt fadeOutDown').css('opacity',1);
                  // alert('sai');
            });
            $('body').delegate('.btn-edit', 'mouseleave', function() {
                  var el = $(this);
                  el.addClass('animated-alt fadeOutDown');
                  // alert('sai');
            });



            $('body').delegate('#tarefa_gravar','click', function(){
                  var res = $(this).parent().parent().parent().find('input#tarefa_encerrar.switch')[0].checked;
                  // // console.log(res);
                  if (res) {
                    // grava
                    var observacao = $(this).parent().find('#tarefa_observacao').val();
                    var lider = $(this).parent().attr('data-lider');
                    var atrasado = $(this).parent().attr('data-atrasado');
                    var codigo_usuario = $(this).parent().attr('data-codigousuario');
                    var codigo_tarefa = $(this).parent().attr('class').match(/\d+/)[0];
                    var resp = {observacao,lider,atrasado,codigo_usuario,codigo_tarefa};
                    console.log(resp);
                    var url = 'http://localhost/demandou-git/tarefa/finalizar';
                    $.ajax({
                            method: 'post',
                            url: url,
                            data: {
                              'codigo_tarefa' : codigo_tarefa,
                              'observacao' : observacao,
                              'lider': lider,
                              'atrasado' : atrasado,
                              'codigo_usuario': codigo_usuario
                            },
                            dataType: 'json',
                            success: function(data) {
                              console.log(data);

                            },
                            error: function(error) {
                              console.log(error);
                            }
                    });
                  }
            });

            $('body').delegate('#resposta_gravar','click', function(){
                  var res = $(this).parent().parent().parent().find('input#observacao_responder.switch-resposta')[0].checked;
                  console.log('grava resposta? ' + res);
                  if (res) {
                    // grava
                    var resposta = $(this).parent().find('#observacao_resposta').val();
                    var lider = $(this).parent().attr('data-lider');
                    var tipo = $(this).parent().attr('data-tipo');
                    alert('tipo: ' + tipo);
                    // var tipo = $(this).parent().attr('data-tipo');
                    var codigo_observacao = $(this).parent().attr('class').match(/\d+/)[0];
                    // if (tipo == "2" || tipo == "1") {
                    var extender = $('#observacao_extender-' + codigo_observacao + '-sim')[0].checked;
                    alert('extender: ' + extender);
                        // var nextende = $('#observacao_extender-' + codigo_observacao + '-nao')[0].checked;
                    // }
                    var codigo_tarefa = $(this).parent().attr('data-codigotarefa');
                    var r = {resposta, lider, codigo_observacao, tipo};
                    console.log(r);
                    var url = 'http://localhost/demandou-git/tarefa/responder';
                    $.ajax({
                            method: 'post',
                            url: url,
                            data: {
                              'codigo_observacao' : codigo_observacao,
                              'resposta' : resposta,
                              'lider': lider,
                              'tipo' : tipo,
                              'codigo_tarefa' : codigo_tarefa,
                              'extender' : extender
                              // não precisa pois é lider e pega no session->userdata()
                              // 'codigo_usuario': codigo_usuario
                            },
                            dataType: 'json',
                            success: function(data) {
                              console.log(data);

                            },
                            error: function(error) {
                              console.log(error);
                            }
                    });
                  }
            });

        }

    }
    $(document).ready(function () {
        fn.Iniciar();
    });
})(jQuery);