$(function () {

	$('.alert-success').delay(2000).fadeOut();
	$(".nav-item").find(".active").removeClass("active");
	$(".nav-item").eq(4).addClass("active");

	// Filling the edit form (should be AJAX..)
	$('.edit').click(function () {
		let id = $(this).data('id');
		let tr = $(this).parent().parent();
		let image = tr.children().eq(1).children('img');
		let title = tr.children().eq(2).text();
		let desc = tr.children().eq(3).text();
		let link = tr.children().eq(4).text();
		let pegi = tr.children().eq(5).text();
		let type = tr.children().eq(6).text();
		let name = tr.children().eq(7).text();

		$('#edit_form').children().eq(0).val(id);
		$('#edit_form').children().eq(1).val(title);
		$('#edit_form').children().eq(2).val(desc);
		$('#edit_form').children().eq(3).val(link);
		$('#edit_form').children().eq(4).val(pegi);
		$('#edit_form').children().eq(5).children().each(function () {
			$(this).removeAttr('selected');
			if ($(this).text() == type) {
				$(this).attr('selected', 'true');
			}
		})
		$('#edit_form').children().eq(6).children().each(function () {
			$(this).removeAttr('selected');
			if ($(this).text() == name) {
				$(this).attr('selected', 'true');
			}
		})
		if (image.length) {
			console.log(image.attr('src'));
			$('#edit_form').find('#edit_image').append($('<img width=100 class="img-fluid" src="' + image.attr('src') + '">'))
		}
	});

	$('.delete').click(function() {
		let id = $(this).data('id');
		$('#delete_id').val(id);
	});

	$("input:file").change(function () {
		$(this).parent().siblings('.picture').empty();
		let reader = new FileReader();
		let img = $('<img class="img-fluid" width="100" height="100" src="">');
		reader.onload = function(e) {
			img.attr('src', e.target.result);
		}
		reader.readAsDataURL($(this)[0].files[0]);
		$(this).parent().siblings('.picture').append(img);
	});
})