<?php /* Template Name: Fullwidth (no sidebar) */ ?>

<?php get_header(); ?>

<?php
$wrapper_class = '';
$prefix = EPCL_THEMEPREFIX.'_';
$post_meta = get_post_meta( get_the_ID(), 'epcl_page_fullwidth', true );
?>
<!-- start: #page -->
<main id="page" class="main grid-container">
	<?php if(have_posts()): the_post(); ?>
		<!-- start: .center -->
	    <div id="single" class="center content fullcover">

        <?php if( has_post_thumbnail() ): ?>
                <div class="post-format-wrapper featured-image cover">
                    <img data-src="<?php the_post_thumbnail_url('epcl_page_header'); ?>" alt="<?php the_title(); ?>" class="lazy fullwidth">
                    <div class="info">
                        <?php if( !isset($post_meta['enable_title']) || (defined('EPCL_PLUGIN_PATH') && $post_meta['enable_title'] ) ): ?>   
                            <h1 class="title large"><?php the_title(); ?></h1>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>      

	        <!-- start: .left-content -->
	        <div class="left-content np-mobile">
	            <article <?php post_class(); ?>>

	                <section class="post-content">
                        <?php if( !has_post_thumbnail() && !isset($post_meta['enable_title']) ): ?>
                            <h1 class="title large bordered"><?php the_title(); ?></h1>
                        <?php elseif( !has_post_thumbnail() && defined('EPCL_PLUGIN_PATH') && $post_meta['enable_title'] ): ?>   
                            <h1 class="title large bordered"><?php the_title(); ?></h1>
                        <?php endif; ?>
	                    <div class="text">
	                        <?php the_content(); ?>
	                    </div>
	                    <div class="clear"></div>
	                </section>

	            </article>
	        </div>
	        <!-- end: .content -->

	        <div class="clear"></div>

	    </div>
	    <!-- end: .center -->
    <?php endif; ?>
</main>
<!-- end: #page -->
<?php get_footer(); ?>
