<div class="qode-social-register-holder">
	<form method="post" class="qode-register-form">
		<fieldset>
			<div>
				<input type="text" name="user_register_name" id="user_register_name" placeholder="<?php esc_html_e( 'User Name', 'qode_membership' ) ?>" value="" required
				       pattern=".{3,}" title="<?php esc_html_e( 'Three or more characters', 'qode_membership' ); ?>"/>
			</div>
			<div>
				<input type="email" name="user_register_email" id="user_register_email" placeholder="<?php esc_html_e( 'Email', 'qode_membership' ) ?>" value="" required />
			</div>
            <div>
                <input type="password" name="user_register_password" id="user_register_password" placeholder="<?php esc_html_e('Password','qode_membership') ?>" value="" required />
            </div>
            <div>
                <input type="password" name="user_register_confirm_password" iid="user_register_confirm_password" placeholder="<?php esc_html_e('Repeat Password','qode_membership') ?>" value="" required />
            </div>
			<div class="qode-register-button-holder">
				<?php
                echo '<button class="qbutton" type="submit">' . esc_html__( 'REGISTER', 'qode_membership' ) . '</button>';

				wp_nonce_field( 'qode-ajax-register-nonce', 'qode-register-security' ); ?>
			</div>
		</fieldset>
	</form>
	<?php do_action( 'qode_membership_action_login_ajax_response' ); ?>
</div>