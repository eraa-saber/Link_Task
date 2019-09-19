<?php
/**
 * @package Event Planners
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
    <header class="entry-header">
        <h1 class="single_title"><?php the_title(); ?></h1>
    </header><!-- .entry-header -->
     <div class="postmeta">
            <div class="post-date"><?php echo date('M d, Y',strtotime(get_post_meta(get_the_ID(),'date',true))); ?> | Start@ <?php echo get_post_meta(get_the_ID(),'start_time',true)?>
                | End@ <?php echo get_post_meta(get_the_ID(),'end_time',true)?></div><!-- post-date -->
            <div class="post-comment"> &nbsp;|&nbsp; <a href="<?php comments_link(); ?>"><?php comments_number(); ?></a></div>
            <div class="clear"></div>
    </div><!-- postmeta -->
	<?php if (has_post_thumbnail() ){ ?>
    	<div class="post-thumb" style="width: 100%;height: 100%;"><?php the_post_thumbnail(); ?></div>
    <?php }?>
    <div class="entry-content">
        <p>
	<?php
			the_content();
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'event-planners' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'event-planners' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
		?>
        </p>
        <div class="postmeta">
            <div class="post-tags"><?php the_tags(); ?> </div>
            <div class="post-tags">Categories:
            <?php
            $categories = get_the_category();
            if ( ! empty( $categories ) ) {
                echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
            }
            ?>
            </div>
            <div class="clear"></div>


        </div><!-- postmeta -->
    </div><!-- .entry-content -->

</article>