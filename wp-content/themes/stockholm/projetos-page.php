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

<?php while ( have_posts() ) : the_post(); ?>
	<?php if(get_post_meta($id, "qode_page_scroll_amount_for_sticky", true)) { ?>
		<script>
		var page_scroll_amount_for_sticky = <?php echo get_post_meta($id, "qode_page_scroll_amount_for_sticky", true); ?>;
		</script>
	<?php } ?>

	<?php get_template_part( 'title' ); ?>

	<?php the_content(); ?>

<?php endwhile; // end of the loop. ?>



<div class="full_width"<?php if($background_color != "") { echo " style='background-color:". $background_color ."'";} ?>>
	<div class="full_width_inner" <?php if($content_style != "") { echo wp_kses($content_style, array('style')); } ?>>
		<div class="projeto-e-ideias">
			<!-- Products list -->
			<section class="container">

				<nav class="products-nav">
					<ul>
						<li class="filter" data-filter="all"><a href="#"><h3>Todos</h3></a></li>
						<li class="filter" data-filter=".noticias"><a href="#"><h3>Notícias</h3></a></li>
						<li class="filter" data-filter=".artigos"><a href="#"><h3>Artigos</h3></a></li>
						<li class="filter" data-filter=".projetos"><a href="#"><h3>Projetos</h3></a></li>
						<li class="filter" data-filter=".realizacoes"><a href="#"><h3>Realizações</h3></a></li>
					</ul>
				</nav>

				<article class="products-list">
					<ul id="prod-container">
						<?php
						    $post = array(
						    'post_type' => 'post',
						    'order' => 'ASC',
						    'post_status' => 'publish'
						);
						$loop = new WP_Query( $post ); ?>

						<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

						<?php $postid = get_the_ID(); ?>
						<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
						<?php $terms = get_the_terms( $post->ID, 'category' ); ?>

						<li class="col-sm-3 mix <?php foreach( $terms as $term ) echo ' ' . $term->slug; ?>">
							<a class="popup-modal" href="#<?php echo $postid; ?>">
								<figure>
									<img src="<?php echo $image[0]; ?>" alt="">
									<figcaption>
									</figcaption>
								</figure>
								<h3><?php the_title(); ?></h3>
							</a>

							<div id="<?php echo $postid; ?>" class="mfp-hide" style="background-color: #fff;max-width: 600px;margin: 0 auto;padding: 20px;position:relative">
								<button title="Close (Esc)" type="button" class="mfp-close popup-modal-dismiss" style="position: absolute;right: 0;top: 0;color: #32323d;">×</button>
								<header style="text-align: center;text-transform: uppercase;">
									<h1><?php the_title(); ?></h1>
								</header>
								<section style="overflow: hidden;">
									<figure class="col-md-6" style="overflow:hidden">
										<img style="width:100%" src="<?php echo $image[0]; ?>">
									</figure>
									<article class="col-md-6">
										<p><?php the_content(); ?></p>
									</article>
								</section>
							</div>
						</li>
					<?php endwhile; // end of the loop. ?>
			    <?php wp_reset_postdata();?>


				</ul>
			</article>
		</section>
	</section>
</div>
</div>
</div>



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
