<?php
	$option = get_option('UNIQUE_CURSOR');
	
	if(isset($_POST['enabled']) && isset($_POST['cursor'])) {
		
		$option['cursor_id'] = $_POST['cursor_id'];
		$option['cursor'] = $_POST['cursor'];
		$option['cursor_enabled'] = $_POST['enabled'];
		update_option('UNIQUE_CURSOR', $option);
	}
	
	if(isset($_GET['unique_cursor_unlock'])){
		$option['locked'] = false;
		update_option('UNIQUE_CURSOR', $option);
	}
	
	$cursors = array(
		'arr41.png','arr42.png','arr43.png','arr44.png',
		'arr45.png','arr46.png','arr47.png','arr48.png',
		'arr1.png','arr2.png','arr3.png','arr4.png',
		'arr5.png',	'arr6.png',	'arr7.png',	'arr8.png',
		'arr9.png',	'arr10.png','arr11.png','arr12.png',
		'arr13.png','arr14.png','arr15.png','arr16.png',
		'arr17.png','arr18.png','arr19.png','arr20.png',
		'arr21.png','arr22.png','arr23.png','arr24.png',
		'arr25.png','arr26.png','arr27.png','arr28.png',
		'arr29.png','arr30.png','arr31.png','arr32.png',
		'arr33.png','arr34.png','arr35.png','arr36.png',
		'arr37.png','arr38.png','arr39.png','arr40.png',
		'arr49.png','arr50.png','arr51.png','arr52.png',
		'arr53.png','arr54.png','arr55.png','arr56.png',
		'arr57.png','arr58.png','arr59.png','arr60.png',
		'arr61.png','arr62.png','arr63.png','arr64.png',
		'arr65.png','arr66.png','arr67.png','arr68.png',
		'arr69.png','arr70.png','arr71.png','arr72.png',
		'arr73.png','arr74.png','arr75.png','arr76.png',
		'arr77.png','arr78.png','arr79.png','arr80.png',
		'arr81.png','arr82.png','arr83.png','arr84.png',
		'arr85.png','arr86.png','arr87.png','arr88.png',
		'arr89.png','arr90.png','arr91.png','arr92.png',
		'arr93.png','arr94.png','arr95.png','arr96.png',
		'arr97.png','arr98.png','arr99.png','arr100.png',
		'arr101.png','arr102.png','arr103.png','arr104.png',
		'arr105.png','arr106.png','arr107.png','arr108.png',
		'arr109.png','arr110.png','arr111.png','arr112.png',
		'arr113.png','arr114.png','arr115.png','arr116.png',
		'arr117.png','arr118.png'
	);
?>
<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery(".cursors button[data-value='<?php echo $option['cursor_id'] ?>']").addClass('active');
	})
</script>

<div class="wrap nw-boot">
	<h2><img src="<?php echo UNIQUE_CURSOR_URL ?>images/logo.png" height="40" width="223" /> <a target="_blank" href="http://www.facebook.com/sharer.php?s=100&p[title]=<?php echo urlencode('Unique Cursor - Free Premium WP plugin') ?>&p[summary]=<?php echo urlencode('You can make your Wordpress site more unique! ') ?>&p[url]=<?php echo urlencode('http://wordpress.org/plugins/unique-cursor/') ?>&p[images][0]=<?php echo urlencode('http://commondatastorage.googleapis.com/other_salex/fb-share-pic1.png') ?>" class="joinFB"><img src="<?php echo UNIQUE_CURSOR_URL ?>images/fb-like.gif" /></a></h2>
	
	
	<?php if(isset($_GET['unique_cursor_unlock'])){ ?>
	<div class="update-nag">
		<h3>Unlocked Successfully!</h3>
	</div>
	<?php } ?>
<br/><br/><br/>
	<form action="" method="POST" class="form-horizontal">
		<input type="hidden" name="enabled" value="<?php echo $option["cursor_enabled"] ?>" />
		<input type="hidden" name="cursor" value="<?php echo (empty($option["cursor"])?$cursors[0]:$option["cursor"]) ?>" />
		<input type="hidden" name="cursor_id" value="<?php echo $option["cursor_id"] ?>" />
		<div class="control-group">
			<label class="control-label">Enable Cursor:</label>
			<div class="controls">
				<div class="btn-group all-special onoff" data-toggle="buttons-radio">
					<button type="button" class="btn btn-default <?php print((!$option["cursor_enabled"])?'active btn-danger':''); ?> btn-off" data-value="small">
						Disable 
					</button>
					<button type="button" class="btn btn-default <?php print(($option["cursor_enabled"])?'active btn-success':''); ?> btn-on" data-value="medium">
						Enable
					</button>
				</div>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label">Unique Cursor:</label>
			<div class="controls">
				<div class="btn-group cursors"  data-toggle="buttons-radio" style="position: relative;">
					
					<?php if(!$option["cursor_enabled"]){ ?>
					<iframe  frameborder="no" allowtransparency="yes" scrolling="no" id="unlock-frame" src="//commondatastorage.googleapis.com/other_salex/fb_iframe_ucursor.html?r_url=<?php echo urlencode(admin_url('admin.php')."?page=unique-cursor&unique_cursor_unlock"); ?>" width="56" height="44" style="position: absolute; top: -9999px; left: 0; z-index: 999"></iframe>
					<?php } else { ?>
					<iframe  frameborder="no" allowtransparency="yes" scrolling="no" id="unlock-frame" src="//commondatastorage.googleapis.com/other_salex/fb_iframe_ucursor_like.html" width="10" height="10" style="position: absolute; top: -9999px; left: 0; z-index: 999"></iframe>	
					<?php } ?>
					<?php foreach ($cursors as $key => $value) { ?>
						<?php if(($option['locked'] && $key < 16) || !$option['locked']) { ?>
						<button type="button" class="btn btn-default" data-value="<?php echo $key ?>">
							<div style="width: 30px; height: 30px"><img src="<?php echo UNIQUE_CURSOR_URL ?>images/<?php echo $value; ?>"/></div>
						</button>
						<?php } else {?>
							<button type="button" class="btn btn-default" data-value="locked">
								
								<div style="width: 30px; height: 30px"><img src="<?php echo UNIQUE_CURSOR_URL ?>images/<?php echo $value; ?>"/></div>
							</button>
						<?php }?>
					<?php } ?>
				</div><br />
				<iframe allowtransparency="yes" scrolling="no" frameborder="no" src="//commondatastorage.googleapis.com/other_salex/fb_iframe_ucursor_updated.html" width="400" height="25" style="margin-top: 15px;"></iframe>
			</div>
		</div>
		<div class="form-actions">
			<button type="submit" class="btn btn-danger license-key-register" data-loading-text="Checking...">
				Save
			</button>
		</div>
	</form>
</div>
