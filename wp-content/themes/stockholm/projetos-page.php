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




	<div class="full_width"<?php if($background_color != "") { echo " style='background-color:". $background_color ."'";} ?>>

		<div class="full_width_inner" <?php if($content_style != "") { echo wp_kses($content_style, array('style')); } ?>>
			<?php the_content(); ?>

		<?php endwhile; // end of the loop. ?>

		<div class="projeto-e-ideias">
			<!-- Products list -->
			<section class="container">

				<nav class="products-nav">
					<ul style="list-style: none;">
						<li class="pfilter" data-filter="all">
							<a class="temas" href="#">
								<span class="icon">
									<img class="alignnone size-medium wp-image-227"
									src="http://montre.com.br/web/gelsonmerisio/site/wp-content/uploads/2018/01/educacao.png" alt="" width="150" height="150">
								</span>
								<h3>TODOS</h3>
							</a>
						</li>
						<li class="pfilter" data-filter=".educacao">
							<a class="temas" href="#"><span class="icon"><img class="alignnone size-medium wp-image-227"
								src="http://montre.com.br/web/gelsonmerisio/site/wp-content/uploads/2018/01/educacao.png" alt="" width="150" height="150"></span>
								<h3>EDUCAÇÃO</h3>
							</a>
						</li>
						<li class="pfilter" data-filter=".meio-ambiente">
							<a class="temas" href="#"><span class="icon"><img class="alignnone size-medium wp-image-227"
								src="http://montre.com.br/web/gelsonmerisio/site/wp-content/uploads/2018/01/meio-ambiente.png" alt="" width="150" height="150"></span>
								<h3>MEIO AMBIENTE</h3>
							</a>
						</li>
						<li class="pfilter" data-filter=".saude">
							<a class="temas" href="#"><span class="icon"><img class="alignnone size-medium wp-image-227"
								src="http://montre.com.br/web/gelsonmerisio/site/wp-content/uploads/2018/01/saude.png" alt="" width="150" height="150"></span>
								<h3>SAÚDE</h3>
							</a>
						</li>
						<li class="pfilter" data-filter=".seguranca">
							<a class="temas" href="#"><span class="icon"><img class="alignnone size-medium wp-image-227"
								src="http://montre.com.br/web/gelsonmerisio/site/wp-content/uploads/2018/01/seguranca.png" alt="" width="150" height="150"></span>
								<h3>SEGURANÇA</h3>
							</a>
						</li>
						<li class="pfilter" data-filter=".social">
							<a class="temas" href="#"><span class="icon"><img class="alignnone size-medium wp-image-227"
								src="http://montre.com.br/web/gelsonmerisio/site/wp-content/uploads/2018/01/social.png" alt="" width="150" height="150"></span>
								<h3>SOCIAL</h3>
							</a>
						</li>
						<li class="pfilter" data-filter=".gestao-inovacao">
							<a class="temas" href="#"><span class="icon"><img class="alignnone size-medium wp-image-227"
								src="http://montre.com.br/web/gelsonmerisio/site/wp-content/uploads/2018/01/inovacao.png" alt="" width="150" height="150"></span>
								<h3>GESTÃO E INOVAÇÃO</h3>
							</a>
						</li>
						<li class="pfilter" data-filter=".transparencia">
							<a class="temas" href="#"><span class="icon"><img class="alignnone size-medium wp-image-227"
								src="http://montre.com.br/web/gelsonmerisio/site/wp-content/uploads/2018/01/transparencia.png" alt="" width="150" height="150"></span>
								<h3>TRANSPARÊNCIA</h3>
							</a>
						</li>
						<li class="pfilter" data-filter=".agronegocio">
							<a class="temas" href="#"><span class="icon"><img class="alignnone size-medium wp-image-227"
								src="http://montre.com.br/web/gelsonmerisio/site/wp-content/uploads/2018/01/gestao-eficiente.png" alt="" width="150" height="150"></span>
								<h3>AGRONEGÓCIO</h3>
							</a>
						</li>
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


								<div id="<?php echo $postid; ?>" class="mfp-hide" style="background-color: #fff;max-width: 600px;margin: 0 auto;padding: 20px;position:relative">
									<header style="text-align: center;text-transform: uppercase;">
										<h1><?php the_title(); ?></h1>
									</header>
									<section style="overflow: hidden;">
										<figure class="vc_col-md-6" style="overflow:hidden">
											<img style="width:100%" src="<?php echo $image[0]; ?>">
										</figure>
										<article class="vc_col-md-6">
											<p><?php the_content(); ?></p>
										</article>
									</section>
								</div>

								<a class="box open-popup-link" href="#<?php echo $postid; ?>">
									<figure>
										<img src="<?php echo $image[0]; ?>" alt="">
									</figure>
									<h3><?php the_title(); ?></h3>
								</a>

							</div>

						<?php endwhile; // end of the loop. ?>
						<?php wp_reset_postdata();?>
					</div>

				</article>
			</section>
		</div>

	</div>
</div>



<script type="text/javascript">

</script>

<?php get_footer(); ?>
