<div class="alerts">
	<?php foreach($alerts as $key => $message) :?>
		<div class="alert alert-<?php echo $key; ?> bg-<?php echo $key; ?>">
			<?php echo $message; ?>
		</div>
	<?php endforeach;?>
</div>
