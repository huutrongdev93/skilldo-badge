<script type="text/javascript">
	$(function() {
		let id = $('.wcmc-badge__select.active').attr('data-tab');
		$('.wcmc-badge__select').click( function () {
			id = $(this).attr('data-tab');
			$('.wcmc-badge__select.active').removeClass('active');
			$(this).addClass('active');
			$('.tabs-option.active').removeClass('active');
			$(id).addClass('active');
		});
	});
</script>