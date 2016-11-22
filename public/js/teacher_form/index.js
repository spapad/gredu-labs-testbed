(function ($, _, utils) {
    'use strict';

    (function () {
        var form = $('#app-form form');
        var messages = form.data('messages');
        utils.formMessages.render(form, messages);
    }());

}(window.jQuery, _, window.EDULABS.utils));

window.onload = function() {
 
    $.post({
        url: 'http://relabs1.minedu.gov.gr/mypoint/taxonomy_vocabulary/getTree.json',
        type: 'POST',
        data: { vid: "13"} ,
        dataType: 'json',
      
    }).done(function(data, statusText, resObject) {
     for ( var index = 0; index < data.length; index++ ) {
      if (data[ index ].depth == 0)
        $('#el-idrima')
         .append($("<option></option>")
                    .attr("value",index)
                    .text(data[ index ].name)); 
    }
    }); 
  
} 


$('#el-idrima').on('change', function() {

   var key = this.value;
 	 
 $.post({
        url: 'http://relabs1.minedu.gov.gr/mypoint/taxonomy_vocabulary/getTree.json',
        type: 'POST',
        data: { vid: "13"} ,
        dataType: 'json',
      
    }).done(function(data, statusText, resObject) {
	    

   if (document.getElementById("el-sxolh").options.length != 0) { 
           var i;
		for(i = document.getElementById("el-sxolh").options.length-1;i >= 1; i--)
             {
               document.getElementById("el-sxolh").remove(i);
             }
             $("#el-sxolh").append('<option value=1></option>');
    }         
	if (document.getElementById("el-tmhma").options.length != 0) { 
           var i;

         for(i = document.getElementById("el-tmhma").options.length-1;i >= 1; i--)
             {
               document.getElementById("el-tmhma").remove(i);
             }    
            $("#el-tmhma").append('<option value=1></option>');
	}

     for ( var index = 0; index < data.length; index++ ) {
      if (data[ index ].parents == data[key].tid && data[ index ].depth == 1)
        $('#el-sxolh')
         .append($("<option></option>")
                    .attr("value",index)
                    .text(data[ index ].name)); 
    }
    });
});


$('#el-sxolh').on('change', function() {

   var key = this.value;
  
 $.post({
        url: 'http://relabs1.minedu.gov.gr/mypoint/taxonomy_vocabulary/getTree.json',
        type: 'POST',
        data: { vid: "13"} ,
        dataType: 'json',
      
    }).done(function(data, statusText, resObject) {
     
     if (document.getElementById("el-tmhma").options.length != 0) { 
           var i;

	  for(i = document.getElementById("el-tmhma").options.length-1;i >= 1; i--)
             {
               document.getElementById("el-tmhma").remove(i);
             }    
             $("#el-tmhma").append('<option value=1></option>');
	}
     for ( var index = 0; index < data.length; index++ ) {
      if (data[ index ].parents == data[key].tid && data[ index ].depth == 2)
      
        $('#el-tmhma')
         .append($("<option></option>")
                    .attr("value",index)
                    .text(data[ index ].name)); 
    }
    });
});
