$(document).ready(function() {
	$('.datatable').dataTable({
			"bJQueryUI": true,
			"sPaginationType": "full_numbers"
	});
	$('sup').tooltip();
	$('input.act').tooltip();
	$('button.act').tooltip();
	
	$('#myTab a').click(function(e){
		e.preventDefault();
		$(this).tab('show');
	});
	$(function(){
		$('#myTab a:first	').tab('show');
	});
});