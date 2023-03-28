var loader = $('<div class="loader" id="loader"><img src="../../loading.gif" alt="loading..."></div>')
    .appendTo("body")
    .hide();

$(document).ajaxStart(function() {
    loader.show();
}).ajaxStop(function() {
    loader.hide();
}).ajaxError(function(a, b, e) {
    loader.hide();
    throw e;
});

setTimeout(function(){ $('.flash-body').html(''); }, 50000);


function preventFormSubmitOnEnter()
{
	$(window).keydown(function(event){
	    if(event.keyCode == 13) {
	      event.preventDefault();
	      return false;
	    }
  	});
}


$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
});

Ajax =
{
	store : function(data, url, method=null, global=true)
	{
		var d = new Date();
		return $.ajax({
			data: data,
			url:url,
	        type: method == null ? "POST" : method,
	        dataType: 'json',
			global: global,
	    });
	},
	upload : function(formData, url)
	{
		return $.ajax({
            type:'POST',
            url: url,
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
        });
	}
};

Form =
{
	submit : function(path, params, method)
	{
	    method = method || "post";

	    var form = document.createElement("form");
	    form.setAttribute("method", method);
	    form.setAttribute("action", path);
		console.log(path);
		console.log(form);
	    for(var key in params) {
	        if(params.hasOwnProperty(key)) {
	            var hiddenField = document.createElement("input");
	            hiddenField.setAttribute("type", "hidden");
	            hiddenField.setAttribute("name", key);
	            hiddenField.setAttribute("value", params[key]);

	            form.appendChild(hiddenField);
	         }
	    }

	    document.body.appendChild(form);
	    form.submit();
	}
}

MessageHelper =
{
	showMessage : function(type, message)
	{
		className = ''; icon = '';
		switch(type)
		{
			case 'danger' : className = 'alert-danger'; icon = '<i class="fa fa-times-circle" aria-hidden="true"></i>'; break;
			case 'success' : className = 'alert-success'; icon = '<i class="fa fa-check-circle" aria-hidden="true"></i>'; break;
			case 'info' : className = 'alert-info'; icon = '<i class="fa fa-check-circle" aria-hidden="true"></i>'; break;
			case 'warning' : className = 'alert-warning'; icon = '<i class="fa fa-check-circle" aria-hidden="true"></i>'; break;
		}
		var html = '';

		html +='<div class="alert '+className+' alert-block">';
		html +='<button type="button" class="close" data-dismiss="alert">X</button>';
		html +='<strong>'+message+'</strong>';
		html +='</div>';

		$('.flash-body').html(html);
		//return html;
	},

}


