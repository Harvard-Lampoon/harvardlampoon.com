<?php get_template_part('amp/header'); ?>

<!-- start: #page-404 -->
<main id="page-404" class="main grid-container">

	<!-- start: .center -->
    <div class="center content">
    
        <article>
            <div class="not-found section grid-container grid-small">
                <h2 class="title ularge"><strong><?php esc_html_e("404", 'veen'); ?></strong><br><?php esc_html_e("Page not found", 'veen'); ?></h2>
            </div>
            <div class="text textcenter">
                <h3 class="title medium no-margin"><?php esc_html_e("Something's wrong here...", 'veen'); ?></h3>
                <p><?php esc_html_e("We can't find the page you're looking.", 'veen'); ?></p>
            </div>
            <div class="buttons">
                <a href="<?php echo home_url('/'); ?>" class="button secondary bordered"><?php esc_html_e("Go back to home", 'veen'); ?></a>
            </div>
            
        </article>

        <div class="clear"></div>

	</div>
	<!-- end: .center -->
</main>
<!-- end: #page-404 -->

<?php get_template_part('amp/footer'); ?>