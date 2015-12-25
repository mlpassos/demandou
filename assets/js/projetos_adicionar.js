(function ($) {
    "use strict";
    var fn = {
        // Funcionalidades
        Iniciar: function () {
            fn.App();
        },
        App : function () {

          $('#frmProjeto-Adicionar').submit(function(e){
            // e.preventDefault();
            // alert($('#participantes').val());
          });

          // $( "#lider" ).autocomplete({
          //   source: lideres
          // });
          // function split( val ) {
          //   return val.split( /,\s*/ );
          // }
          // function extractLast( term ) {
          //   return split( term ).pop();
          // }
 
          // $( "#participantes" )
          //   // don't navigate away from the field on tab when selecting an item
          //   .bind( "keydown", function( event ) {
          //     if ( event.keyCode === $.ui.keyCode.TAB &&
          //         $( this ).autocomplete( "instance" ).menu.active ) {
          //       event.preventDefault();
          //     }
          //   })
          //   .autocomplete({
          //     minLength: 0,
          //     source: function( request, response ) {
          //       // delegate back to autocomplete, but extract the last term
          //       response( $.ui.autocomplete.filter(
          //         participantes, extractLast( request.term ) ) );
          //     },
          //     focus: function() {
          //       // prevent value inserted on focus
          //       return false;
          //     },
          //     select: function( event, ui ) {
          //       var terms = split( this.value );
          //       // remove the current input
          //       terms.pop();
          //       // add the selected item
          //       terms.push( ui.item.value );
          //       // add placeholder to get the comma-and-space at the end
          //       terms.push( "" );
          //       this.value = terms.join( ", " );
          //       return false;
          //     }
          //   });
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
            // placeholder: "Escolha alguém...",
            templateResult: formatState

          }
          );
          $("#participantes").select2(
            // placeholder: "Escolha alguém..."
          );


          }
      }
          // var REGEX_EMAIL = '([a-z0-9!#$%&\'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&\'*+/=?^_`{|}~-]+)*@' +
          //         '(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?)';

          // $('#lider').selectize({
          //     persist: false,
          //     maxItems: null,
          //     valueField: 'email',
          //     labelField: 'name',
          //     searchField: ['name', 'email'],
          //     options: [
          //         {email: 'brian@thirdroute.com', name: 'Brian Reavis'},
          //         {email: 'nikola@tesla.com', name: 'Nikola Tesla'},
          //         {email: 'someone@gmail.com'}
          //     ],
          //     render: {
          //         item: function(item, escape) {
          //             return '<div>' +
          //                 (item.name ? '<span class="name">' + escape(item.name) + '</span>' : '') +
          //                 (item.email ? '<span class="email">' + escape(item.email) + '</span>' : '') +
          //             '</div>';
          //         },
          //         option: function(item, escape) {
          //             var label = item.name || item.email;
          //             var caption = item.name ? item.email : null;
          //             return '<div>' +
          //                 '<span class="label">' + escape(label) + '</span>' +
          //                 (caption ? '<span class="caption">' + escape(caption) + '</span>' : '') +
          //             '</div>';
          //         }
          //     },
          //     createFilter: function(input) {
          //         var match, regex;

          //         // email@address.com
          //         regex = new RegExp('^' + REGEX_EMAIL + '$', 'i');
          //         match = input.match(regex);
          //         if (match) return !this.options.hasOwnProperty(match[0]);

          //         // name <email@address.com>
          //         regex = new RegExp('^([^<]*)\<' + REGEX_EMAIL + '\>$', 'i');
          //         match = input.match(regex);
          //         if (match) return !this.options.hasOwnProperty(match[2]);

          //         return false;
          //     },
          //     create: function(input) {
          //         if ((new RegExp('^' + REGEX_EMAIL + '$', 'i')).test(input)) {
          //             return {email: input};
          //         }
          //         var match = input.match(new RegExp('^([^<]*)\<' + REGEX_EMAIL + '\>$', 'i'));
          //         if (match) {
          //             return {
          //                 email : match[2],
          //                 name  : $.trim(match[1])
          //             };
          //         }
          //         alert('Invalid email address.');
          //         return false;
          //     }
          // });
    //     }
    // }
    $(document).ready(function () {
        fn.Iniciar();
    });
})(jQuery);