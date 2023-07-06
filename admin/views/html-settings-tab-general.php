<div class="box">
    <div class="box-content row m-1">
        <?php do_action('admin_badge_settings_tabs_general', $general); ?>
    </div>
</div>
<script type="text/javascript">
	$(function() {
		let loading  = $('.loading');
		$('#mainform').submit(function () {
			loading.show();
			let data = $(this).serializeJSON();
			data.action = 'ProductBadgeAjax::generalSave';
			$.post(ajax, data, function(data) {}, 'json').done(function( data ) {
				loading.hide();
				show_message(data.message, data.status);
			});
			return false;
		});
	});
</script>