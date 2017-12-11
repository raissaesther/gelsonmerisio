<div class="qode-membership-dashboard-page">
	<div class="qode-membership-dashboard-page-content">
		<div class="qode-profile-image">
            <?php echo qode_membership_kses_img( $profile_image ); ?>
        </div>
		<p>
			<span><?php esc_html_e( 'First Name', 'qode_membership' ); ?>:</span>
			<?php echo $first_name; ?>
		</p>
		<p>
			<span><?php esc_html_e( 'Last Name', 'qode_membership' ); ?>:</span>
			<?php echo $last_name; ?>
		</p>
		<p>
			<span><?php esc_html_e( 'Email', 'qode_membership' ); ?>:</span>
			<?php echo $email; ?>
		</p>
		<p>
			<span><?php esc_html_e( 'Desription', 'qode_membership' ); ?>:</span>
			<?php echo $description; ?>
		</p>
		<p>
			<span><?php esc_html_e( 'Website', 'qode_membership' ); ?>:</span>
			<a href="<?php echo esc_url( $website ); ?>" target="_blank"><?php echo $website; ?></a>
		</p>
	</div>
</div>
