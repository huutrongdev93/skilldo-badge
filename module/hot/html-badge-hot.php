<?php
	$styles = Badge_hot::style();
?>
<div class="wcmc-badge-box">
	<div class="row">
		<div class="col-md-6">
			<div class="wcmc-badge__select_box">
				<label for="">Sử dụng mẫu có sẳn</label>
				<hr style="margin: 5px 0;">
				<div class="clearfix"> </div>
				<?php foreach ($styles as $item_key => $item): ?>
				<label class="wcmc-badge__select <?php echo (!empty($item['active'])) ? 'active' : '';?>" data-tab="#tab-<?php echo $item_key;?>">
					<?php include 'items/item-'.$item_key.'.php';?>
				</label>
				<?php endforeach ?>
			</div>
		</div>
		<div class="col-md-6">
			<div class="wcmc-badge__select_box">
				<label for="">Cấu hình</label>
				<hr style="margin: 5px 0;">
				<div class="clearfix"> </div>
                <?php foreach ($styles as $item_key => $item): ?>
					<div class="tabs-option <?php echo (!empty($item['active'])) ? 'active' : '';?>" id="tab-<?php echo $item_key;?>">
						<?php include 'tabs/tab-'.$item_key.'.php';?>
					</div>
				<?php endforeach ?>
			</div>
		</div>
	</div>
</div>
<?php include 'style.hot.php'; ?>
<?php include 'script.hot.php'; ?>