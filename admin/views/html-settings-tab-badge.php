<?php
$section 	= (Request::get('section')) ? Request::get('section') : 'general';
$tabs 		= ProductBadgeSetting::tabsChild();
?>
<div class="section-list">
	<ul>
		<?php foreach ($tabs as $key => $tab): ?>
		<li class="<?php echo ($section == $key )?'active':'';?>">
            <a href="<?php echo Url::admin(Sicommerce::url('setting'));?>&tab=badge&section=<?= $key ?>"><?= $tab['label'];?></a>
        </li>
		<?php endforeach ?>
	</ul>
</div>
<div class="clearfix"></div>
<input type="hidden" name="objectKey" id="objectKey" value="<?php echo $section;?>">
<?php call_user_func($tabs[$section]['callback'], $key, $section); ?>
<style>
	<?php include FCPATH.Path::plugin().BADGE_NAME.'/assets/css/style.admin.css';?>
</style>
