(function(){
	$(".command").on(' touchstart change click', function(){
		$command = $(this).attr('command');
		$command = $command.split(',');
		for (let i = 0; i < $command.length; i++) {
			call('command', $command[i], $(this))
		}

	});
})();

call = function(class_name , function_name , param)
{
	return window[class_name][function_name](param) ;
}
Common = function()
{
	this.elementSearch = function(text, element_class, type = 'text')
	{
		new_text = text.toLowerCase().trim();
		$("."+element_class).each(function(index, el){
			if (type == 'text') {
				search_text = $(this).text();
			}else{
				$($(this).find(type)).each(function(index, el) {
					search_text = $(this).val();
					if (search_text.trim()) {
						return;
					}
				});
			}
			is_found = search_text.indexOf(new_text);
			if (is_found > -1) {
				$(this).show(0);
			}else{
				$(this).hide(0);
			}
		});
	}
	this.confirm = function(message, action, url=null)
	{
		confirm = confirm(message);
		if (confirm == true) {
			switch (action) {
				case 'url':
					window.location.href = url;
					break;
			}
		}
	}
	this.getSelected = function()
	{
		selected = [];
		$("input[type='checkbox']").each(function(index, el){
			if (Number($(this).prop('checked'))) {
				value = $(this).val();
				selected.push(value);
			}
		});
		return selected;
	}
	this.selectionCheck = function()
	{
		selected = this.getSelected();
		if (!empty(selected)) {
			return selected;
		}
		template.alert('error', 'Select First Please');
		return false;
	}
	this.redirect = function(url)
	{
			window.location.href = url;
	}
	this.removeRaw = function(element)
	{
		table
        .row( element.parents('tr') )
        .remove()
        .draw();
	}
	this.serializeToJson = function(data)
	{
		new_data = {};
		for (let i = 0; i < data.length; i++) {

			new_data[data[i].name] = data[i].value;
		}
		return new_data;
	}
	this.addToForm = function(data, form)
	{
		form = new FormData(form[0]);
		for (let i = 0; i < data.length; i++) {
			form.append(data[i].name, data[i].value);
		}
		console.log(form);
		return form;
	}
	this.formData = function(element)
	{
		data = $("#"+form).serializeArray();
		data = common.addToForm(data, $("#"+form));
		// data = JSON.stringify(data);
		return data;
	}
}

Command = function ()
{
	this.filler = function (element)
	{
		val = element.val();
		if (val) {
			source = element.attr('source');
			source = source.replace("%id%", val);
			spinner = element.attr('spinner');
			filling_data = element.attr('make-data');
			fill = element.attr('fill');
			data = server.call('get', source, null, function(data){
			opts = call('filler', filling_data, data);
				if (opts) {
					opts = "<option></option>"+opts;
					$("#"+fill).html(opts);
					$("#"+fill).prop('disabled', false);
				}else{
					$("#"+fill).html("");
					$("#"+fill).prop('disabled', true);
				}

				$("select").selectpicker('refresh');
			}, function(){}, function(){
				$("#"+spinner).show();
			}, function(data){
				$("#"+spinner).hide();
			});
		}else{
			$("#"+fill).html("");
			$("#"+fill).prop('disabled', true);
			$("select").selectpicker('refresh');
		}
	}
	this.uploader = function (element)
	{
		viewer = element.attr('viewer');
		input = element.attr('input');
		if (!isset(storage['old-img'])) {
			storage['old-img'] = $("#"+viewer).attr('src');
		}
		$("#"+input).click();
		$("#"+input).change(function() {
			if (this.files && this.files[0]){
				var reader = new FileReader();
				reader.onload = function(e) {
			      $('#'+viewer).attr('src', e.target.result);
			    }
			    reader.readAsDataURL(this.files[0]);
			}
			$("#"+viewer).attr('src', storage['old-img']);
		});
	}
	this.modal = function (element)
	{
		modal = element.attr("modal");
		$("#"+modal).modal('show');
		if (isset(element.attr("info"))) {
			info = element.attr("info");
			info = JSON.parse(info);
			for (prop in info) {
					filler.formAction($('#'+modal+' form') ,info[prop]);
				}
			}
	}
	this.check = function (element)
	{
		check = element.attr('check');
		value = element.val();
		$("#"+check).prop('checked', true);
	}
	this.checkAll = function (element)
	{
		is_chek_list = isset(element.attr('check-list'));
		if (is_chek_list) {
			check_list = element.attr('check-list');
			checks = $("#"+check_list);
		}else{
			checks = $("input[type='checkbox']");
		}
		checks.prop('checked', true);
	}
	this.unCheckAll = function (element)
	{
		is_chek_list = isset(element.attr('check-list'));
		if (is_chek_list) {
			check_list = element.attr('check-list');
			checks = $("#"+check_list);
		}else{
			checks = $("input[type='checkbox']");
		}
		checks.prop('checked', false);
	}
	this.print = function(element)
	{
			this.formSubmit(element);
			setTimeout(function(){ // Delay for Chrome
					location.reload(true);
			}, 100);
	}
	this.formSubmit = function (element)
	{
		form = element.attr('form');
		if(isset(element.attr('action'))) {
			action = element.attr('action');
			console.log($("#"+form).size());
			$("#"+form).attr('action', action);
		}
		$("#"+form).submit();
	}
	this.search = function(element)
	{
		type = element.attr('search-type');
		if (isset(element.attr('source'))) {
			source = element.attr('source');
			if (source == 'text') {
				search = element.text();
			}
		}else{
			search = element.val();
		}
		if (isset(type)) {
			if (type == 'front') {
				elements = element.attr('elements');
				target = element.attr('target');
				common.elementSearch(search, elements, target);
			}
		}
	}
	this.confirm = function(element)
	{
		action = element.attr('action');
		message = element.attr('message');
		if (action == 'url') {
			url = element.attr('url');
			common.confirm(message, action, url);
		}
	}
	this.confirmSelected = function(element)
	{
		selected = common.getSelected();
		selected ={"selected":selected};
		selected = $.param(selected);
		action = element.attr('action');
		message = element.attr('message');
		if (action == 'url') {
			url = element.attr('url');
			common.confirm(message, action, url+"?"+selected);
		}
	}
	this.printSelected = function(element)
	{
			form = element.attr('form');
			$("#"+form).attr('target', '_blank');
			this.supmitSelected(element);
			setTimeout(function(){ // Delay for Chrome

					location.reload(true);
			}, 100);
	}
	this.supmitSelected = function(element)
	{
		selected  = common.selectionCheck();
		if (!selected) {
			return false;
		}
		action = element.attr('action');
		form = element.attr('form');
		name = element.attr('name');
		$("#"+name).val(selected);
		if (action != 'hidden') {
			action = element.attr('action');
			$("#"+form).attr('action', action);
		}
		console.log("swdd");
		$("#"+form).submit();
	}
	this.inputRedirect = function(element)
	{
			input = element.attr('input');
			value = $("#"+input).val();
			url = element.attr('url');
			if (isset(value) && value.trim()) {
					window.location.href = url.replace('%value%', value);
			}else{
					$("#"+input).focusin();
			}
	}
	this.redirect = function (element)
	{
		value = element.val();
		url = element.attr('url');
		if (isset(value)) {
			window.location.href = url.replace('%value%', value);
		}
	}
	this.backendSearch = function(element)
	{
			element.keyup(function(event) {
					hot_key.on('enter',function(){
							result_type = element.attr('result-type');
							search = element.val();
							if (result_type == 'redirect') {
									url = element.attr('url');
									url = url.replace("%search%", search);
									common.redirect(url);
							}
					})
			});
	}
	this.tableFiller = function(element)
	{
		temp = element.attr('template');
		url = element.attr('url');
		table = element.attr('table');

		$("#"+table).dataTable().fnDestroy();
		$("#"+table).DataTable({
			processing: true,
            serverSide: true,
            ajax:url,
			"language":
		    {
		    	"processing":template.preloader
		    },
			columns: template[temp]
		});
	}
	this.addAttribute = function(element)
	{
		attribs = element.attr('attribs');
		attribs = JSON.parse(attribs);
		new_element = element.attr('element')
		for (let i = 0; i < attribs.length; i++) {
			$('#'+new_element).attr(attribs[i].name, attribs[i].value);
		}
	}
	this.changeCard = function(element)
	{
		method = element.attr('method');
		if (!isset(method)) {
			method = 'GET';
			url = element.attr('url');
			data = '';
			token = null;
		}else{
			method = element.attr('method');
			form = element.attr('form');
			url = $("#"+form).attr('action');
			data = common.formData(form);
			console.log(data);
			token = $("#"+form+' input[name="_token"]').val();
		}
		card = element.attr('card');
		hide = element.attr('hide');
		show = element.attr('show');
		card_add_class = element.attr('card-add-class');
		card_remove_class = element.attr('card-remove-class');

		server.call(method, url, data, function(data){
			if (!data.status) {
				showNotification("bg-black", data.message, "bottom", "{{revfull()}}", "animated fadeIn", "animated flipOutY");
			}
			if (data.status) {
				showNotification("bg-blue", data.message, "bottom", '{{revfull()}}', "animated fadeIn", "animated flipOutY");
			}
			$("."+hide).addClass('hidden');
			$("."+show).removeClass('hidden');
			$("#"+card+" .header").removeClass(card_remove_class);
			$("#"+card+" .header").addClass(card_add_class);

		}, function(){}, function(){}, function(){
			$(".modal").modal('hide');
		},token);

	}

}


Filler = function()
{
	this.options = function(data)
	{
		opts = "";
		data = data.data;
		for (prop in data) {
			opts+="<option value='"+data[prop].id+"'>"+data[prop].name_en+"</option>\n";
		}
		return opts;
	}
	this.formAction = function(form, url)
	{
		form.attr('action', url);
	}
}

Server = function()
{
	/**
	* Call to server
	* @param {string} type the request method post or get
	* @param {string} url to call and send requests
	* @param {Object} data to send through http
	* @param {callback} success to call when request is success
	* @param {callback} failuer to call when request is failuer
	* @param {callback} waiting to call when request is waiting
	* @param {callback} completed to call when request is completed
	*/
	this.call = function(type, url, data, success, failuer, waiting, completed, token=null)
	{
		if (token) {
			$.ajaxSetup({
			    headers: {
				    'X-CSRF-TOKEN': token,
					'Authorization': 'Bearer ' + api_token
			    }
			});
		}else{
			$.ajaxSetup({
			    headers: {
					'Authorization': 'Bearer ' + api_token
			    }
			});
		}
		waiting();
		$.ajax({
			url: url,
			type: type,
			data: data,
			async: false,
			cache: false,
		    contentType: false,
			dataType : 'json',
		    processData: false,
			success: function (data)
			{
				success(data);
			},
			error: function(xhr, error)
			{
		        failuer(xhr, error);
		 	},
		 	complete: function()
		 	{
		 		completed();
				$("#waiting").addClass('hidden');
		 	}
		});
	}
}

Templates = function()
{
	this.alert = function(type, message)
	{
		switch (type) {
			case 'error':
				showNotification("bg-black", message, "bottom", 'right', "animated fadeIn", "animated flipOutY");
				break;
		}
	}
	this.preloader = '<div style="position:absolute;top:25%;left:50%">\n'+
		'<div class="loader">\n'+
			'<div class="preloader">\n'+
				'<div class="spinner-layer pl-red">\n'+
					'<div class="circle-clipper right">\n'+
						'<div class="circle"></div>\n'+
					'</div>\n'+
					'<div class="circle-clipper left">\n'+
						'<div class="circle"></div>\n'+
					'</div>\n'+
				'</div>\n'+
			'</div>\n'+
			'<p>Please wait...</p>\n'+
		'</div>\n'+
	'</div>';
	this.another_runsheet = [
		{data:'runsheet_number'},
		{data:'count'},
		{data:'created_at'},
		{
			mData:'url',
			mRender: function (data, type, row) {
				return '<a href="'+data+'" class="btn bg-green waves-effect" data-toggle="tooltip" data-placement="top" >\n'+
							'<i class="material-icons">remove_red_eye</i>\n'+
							'</a>\n'+
							'<a href="'+row.print_url+'" class="btn bg-orange waves-effect" data-toggle="tooltip" data-placement="top" target="_blank" >\n'+
							'<i class="material-icons">print</i>\n'+
							'</a>\n'
			}

		}
	];
	this.another_returnsheet = [
		{data:'returnsheet_number'},
		{data:'count'},
		{data:'created_at'},
		{
			mData:'url',
			mRender: function (data, type, row) {
				return '<a href="'+data+'" class="btn bg-green waves-effect" data-toggle="tooltip" data-placement="top" >\n'+
							'<i class="material-icons">remove_red_eye</i>\n'+
							'</a>\n'+
							'<a href="'+row.print_url+'" class="btn bg-orange waves-effect" data-toggle="tooltip" data-placement="top" target="_blank" >\n'+
							'<i class="material-icons">print</i>\n'+
							'</a>\n'
			}

		}
	];
}

var isset = function(variable)
{
	if (typeof variable !== 'undefined') {
		return true
	}
	return false;
}
var empty = function(array)
{
	if (!Array.isArray(array)) {
		throw "variable not Array !";
	}
	if (array == null || !array.length) {
		return true
	}else{
		return false
	}
}
var in_array = function (array, needle)
{
	index = array.indexOf(needle);
		if (index < 0) {
			return false;
		}
		return true;
}



storage = {};
window.command = new Command();
window.filler = new Filler();

common = new Common();
server = new Server();
template = new Templates();
