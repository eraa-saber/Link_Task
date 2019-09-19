<?php /* Template Name: Events */
/**
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<section id="speakers" class="wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
      <div class="container">
        <div class="section-header">
          <h2 style="text-align: center;"><?php the_title(); ?></h2><br>

        </div>



			<?php /* The loop */ ?>
			<?php
			while ( have_posts() ) :
				the_post();
				?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
						<div class="entry-thumbnail">
							<?php the_post_thumbnail(); ?>
						</div>
						<?php endif; ?>

						<!-- <h1 class="entry-title"><?php the_title(); ?></h1> -->
					</header><!-- .entry-header -->

					<div class="entry-content">
						<?php the_content(); ?>
						<?php
						wp_link_pages(
							array(
								'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>',
								'after'       => '</div>',
								'link_before' => '<span>',
								'link_after'  => '</span>',
							)
						);
						?>
						<?php
// the query
$wpb_all_query = new WP_Query(array('post_type'=>'event', 'post_status'=>'publish', 'posts_per_page'=>-1)); ?>

<?php if ( $wpb_all_query->have_posts() ) : ?>



    <!-- the loop -->
    <div class="row">
    <?php while ( $wpb_all_query->have_posts() ) : $wpb_all_query->the_post(); ?>


          <div class="col-lg-4 col-md-6">
            <div class="speaker">
            <?php echo the_post_thumbnail( 'large','style=max-width:100%;height:auto;');
 ?>
             <!--  <img src="img/speakers/1.jpg" alt="Speaker 1" class="img-fluid"> -->
              <div class="details">
                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <p><?php echo wp_trim_words(get_the_content(),80,'....'); ?></p>

              </div>
            </div>
          </div>

    <?php endwhile; ?>
    </div>
    <!-- end of the loop -->



    <?php wp_reset_postdata(); ?>

<?php else : ?>
    <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>
					</div><!-- .entry-content -->




				</article><!-- #post -->

				<?php comments_template(); ?>
			<?php endwhile; ?>
			</div>

    </section>

		</div><!-- #content -->
	</div><!-- #primary -->


<?php get_footer(); ?>
