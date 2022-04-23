<?php
$section 	= (InputBuilder::get('section')) ? InputBuilder::get('section') : 'general';
$tabs 		= admin_badge_settings_sub_tabs();
?>
<div class="section-list">
	<ul>
		<?php foreach ($tabs as $key => $tab): ?>
		<li class="<?php echo ($section == $key )?'active':'';?>">
            <a href="<?php echo Url::admin(sicommerce::url('setting'));?>&tab=badge&section=<?= $key ?>"><?= $tab['label'];?></a>
        </li>
		<?php endforeach ?>
	</ul>
</div>
<style type="text/css">
    .section-list ul { overflow: hidden; }
	.section-list ul li { float: left; }
	.section-list ul li a { display: block; margin-right: 10px; position: relative; }
	.section-list ul li.active a { color:#000; }
</style>
<div class="clearfix"></div>
<input type="hidden" name="object_key" id="object_key" value="<?php echo 'Badge_'.$section;?>">
<?php
$class = 'Badge_'.$section;
if(method_exists ($class,'tab')) {
    $class::tab();
}
else {
    call_user_func($tabs[$section]['callback'], $key, $section);
}
?>
<style>
    .wcmc-badge__select_box { background-color: #fff; padding:10px; overflow:hidden;}
    .wcmc-badge__select {
        position: relative; overflow: hidden; height: 120px; width:23%;
        border:1px solid #ccc; border-radius: 5px;
    }
    .wcmc-badge__select.active {
        border:1px solid #000;
    }
    .tabs-option { display: none; }
    .tabs-option.active { display: block; }
</style>
<script>
    $('#mainform').submit( function () {
        let data = $( ':input' , $('.tabs-option.active')).serializeJSON();
        data.action = 'admin_badge_ajax_object_save';
        data.object_key = $('#object_key').val();
        $.post(base+'/ajax', data, function(data) {}, 'json').done(function(response) {
            show_message(response.message, response.status);
        });
        return false;
    });
</script>
