<div class="wrap">
	<h1><?php _e('Units Settings', 'unitswitcher'); ?></h1>

	<?php //if ( is_wp_error($unit_errors) ) echo $unit_errors->get_error_message(); ?>

	<h2 class="nav-tab-wrapper">
		<a class="nav-tab <?php if ( $tab == 'general' ) echo 'nav-tab-active'; ?>" href="options-general.php?page=unit-switcher">
			<?php _e('General', 'unitswitcher'); ?>
		</a>
		<a class="nav-tab <?php if ( $tab == 'units' ) echo 'nav-tab-active'; ?>" href="options-general.php?page=unit-switcher&tab=units">
			<?php _e('Units', 'unitswitcher'); ?>
		</a>
	</h2>

	<form method="post" enctype="multipart/form-data" action="options.php">
		<table class="form-table">
			<?php include(UnitSwitcher\Helpers::view('settings/settings-' . $tab)); ?>
		</table>
		<?php submit_button(); ?>
	</form>
</div><!-- .wrap -->