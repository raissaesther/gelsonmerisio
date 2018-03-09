<?php
/*
Template Name: Projetos e Ideias Page
*/
?>

<?php get_header(); ?>
<?php
global $wp_query;
$id = $wp_query->get_queried_object_id();
if(get_post_meta($id, "qode_show-sidebar", true) == ''){
	$sidebar = $qode_options['category_blog_sidebar'];
}
else{
	$sidebar = get_post_meta($id, "qode_show-sidebar", true);
}

if(get_post_meta($id, "qode_page_background_color", true) != ""){
	$background_color = get_post_meta($id, "qode_page_background_color", true);
}else{
	$background_color = "";
}

?>

<?php if(get_post_meta($id, "qode_page_scroll_amount_for_sticky", true)) { ?>
	<script>
	var page_scroll_amount_for_sticky = <?php echo get_post_meta($id, "qode_page_scroll_amount_for_sticky", true); ?>;
	</script>
<?php } ?>
<?php get_template_part( 'title' ); ?>
<?php
$revslider = get_post_meta($id, "qode_revolution-slider", true);
if (!empty($revslider)){ ?>
	<div class="q_slider"><div class="q_slider_inner">
		<?php echo do_shortcode($revslider); ?>
	</div></div>
	<?php
}
?>

<div class="full_width">
	<div class="full_width_inner">

		<div class="projeto-e-ideias container_inner clearfix">
			<!-- Products list -->
			<section class="wpb_column vc_column_container vc_col-sm-12">
				<nav class="products-nav">
					<ul style="list-style: none;">
						<li class="filter" data-filter=".todos"> <a class="temas" href="#"> <span class="icon"> <img class="alignnone size-medium wp-image-227" src="http://montre.com.br/web/gelsonmerisio/site/wp-content/uploads/2018/03/todos.png" alt="" width="150" height="150"> </span> <h3>TODOS</h3> </a> </li>
						<li class="filter" data-filter=".educacao"> <a class="temas" href="#"><span class="icon"><img class="alignnone size-medium wp-image-227" src="http://montre.com.br/web/gelsonmerisio/site/wp-content/uploads/2018/01/educacao.png" alt="" width="150" height="150"></span> <h3>EDUCAÇÃO</h3> </a> </li>
						<li class="filter" data-filter=".meio-ambiente"> <a class="temas" href="#"><span class="icon"><img class="alignnone size-medium wp-image-227" src="http://montre.com.br/web/gelsonmerisio/site/wp-content/uploads/2018/01/meio-ambiente.png" alt="" width="150" height="150"></span> <h3>MEIO AMBIENTE</h3> </a> </li>
						<li class="filter" data-filter=".saude"> <a class="temas" href="#"><span class="icon"><img class="alignnone size-medium wp-image-227" src="http://montre.com.br/web/gelsonmerisio/site/wp-content/uploads/2018/01/saude.png" alt="" width="150" height="150"></span> <h3>SAÚDE</h3> </a> </li>
						<li class="filter" data-filter=".seguranca"> <a class="temas" href="#"><span class="icon"><img class="alignnone size-medium wp-image-227" src="http://montre.com.br/web/gelsonmerisio/site/wp-content/uploads/2018/01/seguranca.png" alt="" width="150" height="150"></span> <h3>SEGURANÇA</h3> </a> </li>
						<li class="filter" data-filter=".social"> <a class="temas" href="#"><span class="icon"><img class="alignnone size-medium wp-image-227" src="http://montre.com.br/web/gelsonmerisio/site/wp-content/uploads/2018/01/social.png" alt="" width="150" height="150"></span> <h3>SOCIAL</h3> </a> </li>
						<li class="filter" data-filter=".gestao-inovacao"> <a class="temas" href="#"><span class="icon"><img class="alignnone size-medium wp-image-227" src="http://montre.com.br/web/gelsonmerisio/site/wp-content/uploads/2018/01/inovacao.png" alt="" width="150" height="150"></span> <h3>GESTÃO E INOVAÇÃO</h3> </a> </li>
						<li class="filter" data-filter=".transparencia"> <a class="temas" href="#"><span class="icon"><img class="alignnone size-medium wp-image-227" src="http://montre.com.br/web/gelsonmerisio/site/wp-content/uploads/2018/01/transparencia.png" alt="" width="150" height="150"></span> <h3>TRANSPARÊNCIA</h3> </a> </li>
						<li class="filter" data-filter=".agronegocio"> <a class="temas" href="#"><span class="icon"><img class="alignnone size-medium wp-image-227" src="http://montre.com.br/web/gelsonmerisio/site/wp-content/uploads/2018/01/gestao-eficiente.png" alt="" width="150" height="150"></span> <h3>AGRONEGÓCIO</h3> </a> </li>
					</ul>
				</nav>

				<article class="products-list">
					<div id="prod-container">
						<?php
						$post = array(
							'post_type' => 'post',
							'order' => 'ASC',
							'post_status' => 'publish',
							'posts_per_page' => -1
						);
						$loop = new WP_Query( $post ); ?>

						<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

							<?php $postid = get_the_ID(); ?>
							<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
							<?php $terms = get_the_terms( $post->ID, 'category' ); ?>

							<div class="vc_col-sm-3 mix <?php foreach( $terms as $term ) echo ' ' . $term->slug; ?>">


								<a class="box open-popup-link" href="#<?php echo $postid; ?>">
									<figure style="background-image: url(<?php echo $image[0]; ?>);">
									</figure>
									<h3><?php the_title(); ?></h3>
								</a>


								<div id="<?php echo $postid; ?>" class="gm-mdl mfp-hide" style="background-color: #fff;max-width: 600px;margin: 0 auto;padding: 20px;position:relative">
									<header style="text-align: center;text-transform: uppercase;">
										<h3><?php the_title(); ?></h3>
									</header>
									<section style="overflow: hidden;" class="wpb_column vc_column_container">
										<div class="vc_col-sm-12" style="overflow:hidden">
											<img style="max-width: 50%;float: left;margin: 0 20px 0 0;" src="<?php echo $image[0]; ?>">

											<p><?php the_content(); ?></p>
										</div>
									</section>
								</div>


							</div>

						<?php endwhile; // end of the loop. ?>
						<?php wp_reset_postdata();?>
					</div>

				</article>
			</section>
		</div>

	</div>
</div>


<?php get_footer(); ?>
