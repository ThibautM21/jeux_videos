$(function () {

	$('.alert-success').delay(2000).fadeOut();
	$(".nav-item").find(".active").removeClass("active");
	$(".nav-item").eq(3).addClass("active");

	// Filling the edit form (should be AJAX..)
	$('.edit').click(function () {
		let id = $(this).data('id');
		let tr = $(this).parent().parent();
		let game = tr.children().eq(1).text();
		let support = tr.children().eq(2).text();
		let release = tr.children().eq(3).text();
		$('#edit_id').val(id);

		$('#edit_form').children().eq(1).children().each(function () {
			$(this).removeAttr('selected');
			console.log($(this).text());
			if ($(this).text() == game) {
				$(this).attr('selected', 'true');
			}
		})
		$('#edit_form').children().eq(2).children().each(function () {
			$(this).removeAttr('selected');
			if ($(this).text() == support) {
				$(this).attr('selected', 'true');
			}
		})
		$('#edit_form').children().eq(3).val(release);
	});

	$('.delete').click(function() {
		let id = $(this).data('id');
		$('#delete_id').val(id);
	});
})