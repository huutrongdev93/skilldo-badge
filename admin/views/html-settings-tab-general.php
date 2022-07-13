<div class="box">
    <div class="box-content row m-1">
        <?php do_action('admin_badge_settings_tabs_general', $general); ?>
    </div>
</div>
<script type="text/javascript">
	$(function() {
		$('#mainform').submit( function () {
			let data = $(this).serializeJSON();
			data.action = 'admin_badge_ajax_general_save';
			$.post(base+'/ajax', data, function(data) {}, 'json').done(function( data ) {
				show_message(data.message, data.status);
			});
			return false;
		});
	});
</script>