<div class="qode-membership-dashboard-page">
	<div>
		<form method="post" id="qode-membership-update-profile-form">
			<div class="qode-membership-input-holder">
				<label for="first_name"><?php esc_html_e( 'First Name', 'qode_membership' ); ?></label>
				<input class="qode-membership-input" type="text" name="first_name" id="first_name"
				       value="<?php echo $first_name; ?>">
			</div>
			<div class="qode-membership-input-holder">
				<label for="last_name"><?php esc_html_e( 'Last Name', 'qode_membership' ); ?></label>
				<input class="qode-membership-input" type="text" name="last_name" id="last_name"
				       value="<?php echo $last_name; ?>">
			</div>
			<div class="qode-membership-input-holder">
				<label for="email"><?php esc_html_e( 'Email', 'qode_membership' ); ?></label>
				<input class="qode-membership-input" type="email" name="email" id="email"
				       value="<?php echo $email; ?>">
			</div>
			<div class="qode-membership-input-holder">
				<label for="url"><?php esc_html_e( 'Website', 'qode_membership' ); ?></label>
				<input class="qode-membership-input" type="text" name="url" id="url" value="<?php echo $website; ?>">
			</div>
			<div class="qode-membership-input-holder">
				<label for="description"><?php esc_html_e( 'Description', 'qode_membership' ); ?></label>
				<input class="qode-membership-input" type="text" name="description" id="description"
				       value="<?php echo $description; ?>">
			</div>
			<div class="qode-membership-input-holder">
				<label for="password"><?php esc_html_e( 'Password', 'qode_membership' ); ?></label>
				<input class="qode-membership-input" type="password" name="password" id="password" value="">
			</div>
			<div class="qode-membership-input-holder">
				<label for="password2"><?php esc_html_e( 'Repeat Password', 'qode_membership' ); ?></label>
				<input class="qode-membership-input" type="password" name="password2" id="password2" value="">
			</div>
			<?php

            echo '<button type="submit" class="qbutton">' . esc_html__( 'UPDATE PROFILE', 'qode_membership' ) . '</button>';

			wp_nonce_field( 'qode_validate_edit_profile', 'qode_nonce_edit_profile' )
			?>
		</form>
		<?php
		do_action( 'qode_membership_action_login_ajax_response' );
		?>
	</div>
</div>