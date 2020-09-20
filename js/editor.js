$(function () {
	$('.alert-success').delay(2000).fadeOut();
	$(".nav-item").find(".active").removeClass("active");
	$(".nav-item").eq(0).addClass("active");

	// Filling the edit form (should be AJAX..)
	$('.edit').click(function () {
		let id = $(this).data('id');
		$('#edit_id').val(id);
		let name = $(this).parent().siblings().eq(1).text();
		let link = $(this).parent().siblings().eq(2).text();
		$('#edit_name').val(name);
		$('#edit_link').val(link);
	});

	$('.delete').click(function() {
		let id = $(this).data('id');
		$('#delete_id').val(id);
	});
})