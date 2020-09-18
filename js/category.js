$(function () {
	$('.alert-success').delay(2000).fadeOut();
	$(".nav-item").find(".active").removeClass("active");
	$(".nav-item").eq(1).addClass("active");

	// Filling the edit form (should be AJAX..)
	$('.edit').click(function () {
		let id = $(this).data('id');
		$('#edit_id').val(id);
		let type = $(this).parent().siblings().eq(1).text();
		$('#edit_type').val(type);
	});

	$('.delete').click(function() {
		let id = $(this).data('id');
		$('#delete_id').val(id);
	});
})