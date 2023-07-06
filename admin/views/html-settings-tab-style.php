<div class="row">
	<div class="col-md-6">
		<div class="box">
			<div class="box-content p-2">
                <label for="">Sử dụng mẫu có sẳn</label>
                <hr style="margin: 5px 0;">
                <div class="clearfix"></div>
                <div class="badge-style-wrapper">
                    <?php foreach ($styles as $styleKey => $style): ?>
                        <div class="badge-style-item js_badge_style_item <?php echo ($active == $styleKey) ? 'active' : '';?>" data-style="<?php echo $styleKey;?>">
                            <?php $style->html($tab)?>
                            <style><?php $style->css()?></style>
                        </div>
                    <?php endforeach ?>
                </div>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="box">
			<div class="box-content p-2" id="js_badge_style_form" style="position: relative; min-height: 200px">
                <?php Admin::loading();?>
                <div class="row" id="js_badge_style_form_result"></div>
			</div>
		</div>
	</div>
</div>

<script>
    $(function() {

		let styleId     = $('.js_badge_style_item.active').attr('data-style');

		let objectId    = $('#objectKey').val();

		let formLoading = $('#js_badge_style_form .loading');

		styleLoadForm();

		function styleLoadForm() {

			if(styleId === undefined || objectId === undefined) return false;

			formLoading.show();

			let data = {
				action : 'ProductBadgeAjax::styleLoad',
                style: styleId,
				objectId: objectId
            }

            $.post(ajax, data, function(data) {}, 'json').done(function(response) {

				formLoading.hide();

				if(response.status == 'success') {

					let form = decodeURIComponent(atob(response.form).split('').map(function (c) {
						return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
					}).join(''));

					$('#js_badge_style_form_result').html(form).promise().done(function () {
						formBuilderReset();
					});
                }
				else {
					show_message(response.message, response.status);
                }
            });

            return false;
        }

		$(document).on('click', '.js_badge_style_item', function() {

			if($(this).attr('data-style') == styleId) return false;

			$('.js_badge_style_item').removeClass('active');

			$(this).addClass('active');

			styleId = $(this).attr('data-style');

			styleLoadForm();

			return false;
        });

		$(document).on('submit', '#mainform', function() {

			let data        = $(':input' , $('#js_badge_style_form_result')).serializeJSON();
			data.action     = 'ProductBadgeAjax::objectSave';
			data.styleId    = styleId;
			data.objectId   = objectId;

			$.post(ajax, data, function(data) {}, 'json').done(function(response) {
				show_message(response.message, response.status);
			});

			return false;
		})
    })
</script>