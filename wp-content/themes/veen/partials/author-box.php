<?php $epcl_theme = epcl_get_theme_options(); ?>
<?php if( epcl_get_option('enable_author', true) ): ?>
	<?php
    if( !get_the_author_meta('description') ) return;

    $author_id = get_the_author_meta('ID');
    $user_meta = get_user_meta( $author_id, 'epcl_user', true );
    if( !empty($user_meta) && !empty( $user_meta['avatar']) && $user_meta['avatar']['url'] != '' ){
        $author_avatar = $user_meta['avatar']['url'];
    }else{
        $author_avatar = get_avatar_url( get_the_author_meta('email'), array( 'size' => 120 ));
    }
    $author_name = get_the_author();
    $author_url = get_author_posts_url($author_id);
    $class = $author_position = '';
    if($author_avatar) $class .= ' with-avatar'; else $class .= ' no-avatar';
    if( !empty($user_meta) && !empty( $user_meta['position']) ){
        $author_position = $user_meta['position'];
    }
    $website = get_the_author_meta('user_url');

    if( is_single() ) $class .= ' np-bottom';
    if( is_author() ) $class .= ' grid-container grid-small';
    if( is_archive() ){
        $author_position = count_user_posts( $author_id ) .' '. esc_html__('Articles', 'veen');
    }

    ?>    
    <?php if( is_single() ): ?>
        <div class="epcl-border"></div>
    <?php endif; ?>
    <!-- start: .author -->
    <section id="author" class="author section <?php echo esc_attr($class); ?>">
        <?php if( is_single() ): ?>
            <h3 class="title medium bordered"><?php esc_html_e('About the Author', 'veen'); ?></h3>
        <?php endif; ?>
        <div class="flex">
            <?php if($author_avatar): ?>
                <div class="avatar">
                    <a href="<?php echo esc_url( $author_url ); ?>" class="thumb"><span class="fullimage cover" style="background-image: url('<?php echo esc_url( $author_avatar ); ?>');"></span></a>
                </div>
            <?php endif; ?>
            <div class="info">
                <h4 class="title small author-name"><a href="<?php echo esc_attr( $author_url ); ?>"><?php echo esc_attr( $author_name ); ?></a></h4>
                <p class="position"><span class="dot small"></span> <?php echo esc_html($author_position); ?></p>
                <?php if( !empty($user_meta) && ($user_meta['facebook'] || $user_meta['twitter'] || $website) ): ?>
                    <div class="social">
                        <?php if( $website ): ?>
                            <a href="<?php echo esc_url( $website ); ?>" class="website tooltip" title="<?php esc_attr_e('Website', 'veen'); ?>: <?php echo esc_url( $website ); ?>" target="_blank" rel="nofollow noopener"><i class="fa fa-globe"></i></a>
                        <?php endif; ?>
                        <?php if( $user_meta['twitter'] ): ?>
                            <a href="<?php echo esc_url( $user_meta['twitter'] ); ?>" class="twitter tooltip" title="<?php esc_attr_e('Follow me on Twitter', 'veen'); ?>" target="_blank" rel="nofollow noopener"><i class="fa fa-twitter"></i></a>
                        <?php endif; ?>
                        <?php if( $user_meta['facebook']  ): ?>
                            <a href="<?php echo esc_url( $user_meta['facebook'] ); ?>" class="facebook tooltip" title="<?php esc_attr_e('Follow me on Facebook', 'veen'); ?>" target="_blank" rel="nofollow noopener"><i class="fa fa-facebook"></i></a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                <p><?php the_author_meta('description'); ?></p>
                <?php if( is_single() ): ?>
                    <a href="<?php echo esc_url( $author_url ); ?>" class="button outline"><?php esc_html_e('View All Articles', 'veen'); ?></a>
                <?php endif; ?>
                <div class="clear"></div>
            </div>
        </div>
        <div class="clear"></div>
    </section>
    <!-- end: .author -->
    <div class="clear"></div>
<?php endif; ?>
