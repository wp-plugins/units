<?php settings_fields( 'unit-switcher-units' ); ?>
<tr valign="top">
	<td colspan="2" style="padding:0;">
		<div class="unitswitcher-units">
			<?php //var_dump(get_option('unitswitcher_units'));?>
			
			<ul class="unitswitcher-units-header">
				<li><?php _e('Primary Unit', 'unitswitcher'); ?> (<span>X</span>)</li>
				<li><?php _e('Alternate Units', 'unitswitcher'); ?></li>
			</ul>

			<ul class="unitswitcher-unit-list">
				<?php foreach( $this->settings_repo->allUnits() as $unit_key => $unit ) : ?>
				<li class="unitswitcher-unit-item">
					<table class="unitswitcher-unit-table">
						<tr>
							<td>
								<div class="unitswitcher-defaults">
									<input type="text" placeholder="<?php _e('Name', 'unitswitcher'); ?>" value="<?php echo $unit['default']; ?>" name="unitswitcher_units[<?php echo $unit_key; ?>][default]" class="unitswitcher-name">
									<input type="text" placeholder="<?php _e('Singular Name', 'unitswitcher'); ?>" value="<?php echo $unit['default_singular']; ?>" name="unitswitcher_units[<?php echo $unit_key; ?>][default_singular]" class="unitswitcher-singular">
								</div>
							</td>
							<td>
								<ul class="unitswitcher-alternates">
									<?php 
									if ( isset($unit['alternates']) ) :
									foreach ( $unit['alternates'] as $alt_key => $alternate ) :
									?>
									<li class="unitswitcher-alternate-item">
										<div class="formula">
											<input type="text" class="unitswitcher-formula" placeholder="<?php _e('Formula', 'unitswitcher'); ?>" value="<?php echo $alternate['formula']; ?>" name="unitswitcher_units[<?php echo $unit_key; ?>][alternates][<?php echo $alt_key; ?>][formula]">
											<span class="equals">=</span>
										</div>
										<div class="alternates">
											<input type="text" placeholder="<?php _e('Name', 'unitswitcher'); ?>" value="<?php echo $alternate['name']; ?>" name="unitswitcher_units[<?php echo $unit_key; ?>][alternates][<?php echo $alt_key; ?>][name]" class="unitswitcher-alt-name">
											<input type="text" placeholder="<?php _e('Singular Name', 'unitswitcher'); ?>" value="<?php echo $alternate['name_singular']; ?>" name="unitswitcher_units[<?php echo $unit_key; ?>][alternates][<?php echo $alt_key; ?>][name_singular]" class="unitswitcher-alt-singular">
										</div>
										<div class="unitswitcher-add-remove-unit unitswitcher-btn-group">
											<a href="#" class="unitswitcher-remove-alternate">-</a>
											<a href="#" class="unitswitcher-add-alternate">+</a>
										</div>
									</li>
									<?php endforeach; endif; ?>
								</ul>
							</td>
						</tr>
					</table>
					<div class="unitswitcher-add-remove-unit unitswitcher-btn-group">
						<a href="#" class="unitswitcher-remove-unit">-</a>
						<a href="#" class="unitswitcher-add-unit">+</a>
					</div>
				</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</td>
</tr>