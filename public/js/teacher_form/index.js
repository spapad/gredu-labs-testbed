(function ($, _, utils) {
    'use strict';

    (function () {
        var form = $('#app-form form');
        var messages = form.data('messages');
        utils.formMessages.render(form, messages);
    }());


    $('#search-schools-button').click(function() {
       $.ajax({
          url: window.location.pathname + '/mm/ΣΥΚΕΩΝ',
          data: {
             format: 'json'
          },
          error: function() {
             $('#info').html('<p>An error has occurred</p>');
          },
          dataType: 'json',
          success: function(data) {
              console.log(data);
              $('#schoolsModalBody').val(data);
    //         var $title = $('<h1>').text(data.talks[0].talk_title);
    //         var $description = $('<p>').text(data.talks[0].talk_description);
/*             $('#info')
                .append($title)
                .append($description); */
          },
          type: 'GET'
       });
    });

}(window.jQuery, _, window.EDULABS.utils));
