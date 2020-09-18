$(function () {
	$('.alert-success').delay(2000).fadeOut();

	// Filling the edit form (should be AJAX..)
	$('.edit').click(function () {
		let id = $(this).data('id');
		$('#edit_id').val(id);
		let name = $(this).parent().siblings().eq(1).text();
		$('#edit_name').val(name);
	});

	$('.delete').click(function() {
		let id = $(this).data('id');
		$('#delete_id').val(id);
	});

})