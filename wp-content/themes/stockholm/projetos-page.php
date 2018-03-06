<?php
/*
Template Name: Projetos e Ideias Page
*/
?>

<?php
global $wp_query;
$id = $wp_query->get_queried_object_id();
get_header();
?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>


	<?php if(get_post_meta($id, "qode_page_scroll_amount_for_sticky", true)) { ?>
		<script>
		var page_scroll_amount_for_sticky = <?php echo get_post_meta($id, "qode_page_scroll_amount_for_sticky", true); ?>;
		</script>
	<?php } ?>

	<?php get_template_part( 'title' ); ?>

TESTE

	<div class="full_width"<?php if($background_color != "") { echo " style='background-color:". $background_color ."'";} ?>>
		<div class="full_width_inner" <?php if($content_style != "") { echo wp_kses($content_style, array('style')); } ?>>
			<div class="contact_info">
				<?php the_content(); ?>
			</div>
		</div>
	</div>
	<?php if($show_section == "yes" || $qode_options['enable_contact_form'] == "yes") { ?>
		<div class="container"<?php if($background_color != "") { echo " style='background-color:". $background_color ."'";} ?>>
			<div class="container_inner<?php echo esc_attr($container_class); ?> clearfix q_contact_page default_template_holder">

				<!-- Contact form right/left -->

			</div>
		</div>
	<?php } ?>

<?php endwhile; ?>
<?php endif; ?>
<script type="text/javascript">
jQuery(document).ready(function($){
	$j('form#contact-form').submit(function(){
		$j('form#contact-form .contact-error').remove();
		var hasError = false;
		$j('form#contact-form .requiredField').each(function() {
			if(jQuery.trim($j(this).val()) == '' || jQuery.trim($j(this).val()) == jQuery.trim($j(this).attr('placeholder'))){
				var labelText = $j(this).prev('label').text();
				$j(this).parent().append("<strong class='contact-error'><?php _e('This is a required field', 'qode'); ?></strong>");
				$j(this).addClass('inputError');
				hasError = true;
			} else { //else 1
				if($j(this).hasClass('email')) { //if hasClass('email')
				var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,6})?$/;
				if(!emailReg.test(jQuery.trim($j(this).val()))){
					var labelText = $j(this).prev('label').text();
					$j(this).parent().append("<strong class='contact-error'><?php _e('Please enter a valid email address.', 'qode'); ?></strong>");
					$j(this).addClass('inputError');
					hasError = true;
				}
			} //end of if hasClass('email')

		} // end of else 1
	}); //end of each()

	if(!hasError){
		challengeField = $j("input#recaptcha_challenge_field").val();
		responseField = $j("input#recaptcha_response_field").val();
		name =  $j("input#fname").val();
		lastname =  $j("input#lname").val();
		email =  $j("input#email").val();
		website =  $j("input#website").val();
		message =  $j("textarea#message").val();

		var form_post_data = "";

		var html = $j.ajax({
			type: "POST",
			url: "<?php echo QODE_ROOT; ?>/includes/ajax_mail.php",
			data: "recaptcha_challenge_field=" + challengeField + "&recaptcha_response_field=" + responseField + "&name=" + name + "&lastname=" + lastname + "&email=" + email + "&website=" + website + "&message=" + message,
			async: false
		}).responseText;

		if(html == "success"){
			var formInput = $j(this).serialize();

			$j("form#contact-form").before("<div class='contact-success'><strong><?php _e('THANK YOU!', 'qode'); ?></strong><p><?php _e('Your email was successfully sent. We will contact you as soon as possible.', 'qode'); ?></p></div>");
			$j("form#contact-form").hide();
			$j.post($j(this).attr('action'),formInput);
			hasError = false;
			return false;
		} else {
			<?php
			if ($qode_options['use_recaptcha'] == "yes"){
				?>
				$j("#recaptcha_response_field").parent().append("<span class='contact-error extra-padding'><?php _e('Invalid Captcha', 'qode'); ?></span>");
				Recaptcha.reload();
				<?php
			} else {
				?>
				$j("form#contact-form").before("<div class='contact-success'><strong><?php _e('Email server problem', 'qode'); ?></strong></p></div>");
				<?php
			}
			?>
			return false;
		}
	}
	return false;
});
});
</script>

<?php get_footer(); ?>
