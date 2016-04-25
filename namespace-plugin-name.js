jQuery(document).ready(function($){
	//put some jquery here if you need it

	//call the ajax refresh feed
	$.post(ajaxurl, {
		action: 'namespace_plugin_name_refresh_feed'
	}, function(response) {
		console.log('AJAX complete');
	});

});