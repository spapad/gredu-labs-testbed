(function ($, _, utils) {
    'use strict';

    (function () {
        var form = $('#app-form form');
        var messages = form.data('messages');
        utils.formMessages.render(form, messages);
    }());

    var proto = $.ui.autocomplete.prototype,
	initSource = proto._initSource;

    $("#select_school").autocomplete({
        source: window.location.protocol + "//" + window.location.host + "/teacher-form/mm",
        minLength: 4,
        select: function(event, ui) {
            console.log(ui);
            $("#mm_id").val(ui.item.mm_id);
            $("#el-school").val(ui.item.value);
            $("#el-schooltelef").val(ui.item.tel);
        },

        html: false,

        open: function(event, ui) {
            $(".ui-autocomplete").css("z-index", 1000);
        }
    });

}(window.jQuery, _, window.EDULABS.utils));
