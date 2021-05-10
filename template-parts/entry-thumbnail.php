<?php if( is_front_page() || is_home() ) : ?>

    <div class="entry__thumbnail entry__thumbnail--position">

        <a class="entry__thumbnail-link" href="<?php the_permalink(); ?>">
            <?php 
                the_post_thumbnail( 
                    'entry-landscape', 
                    [
                        'class' => 'entry__featured-image entry__featured-image--rounded'
                    ]
                ); ?>
        </a>

    </div>

<?php elseif( is_page() || is_single() ) : ?>

<?php endif; ?>