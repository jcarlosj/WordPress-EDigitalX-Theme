<?php
/** Entry Content Template File (Blog)
 * @package EDigitalX
 */
?>

<?php if( is_front_page() || is_home() || is_archive() || is_search() ) : ?>

    <p class="entry__excerpt">

        <?php if( has_excerpt() ): ?>

            <?php
                $excerpt = wp_strip_all_tags( get_the_excerpt() );
                echo $excerpt;
            ?>

        <?php else: ?>

            <?php echo wp_trim_words( get_the_content(), 18, '..' ); ?>

        <?php endif; ?>

    </p>

<?php elseif( is_single() ) : ?>

    <div class="">

        <div class="entry__categories">
            <?php the_category( ' ' ); ?>
        </div>
        <?php get_template_part( 'template-parts/entry', 'details', $args ); ?>
        <main class="main-content">
            <?php the_content(); ?>
        </main>
    </div>

<?php elseif( is_page() ) : ?>

    <section class="section">
        <main class="main-content container">

            <?php the_content(); ?>

        </main>
    </section>

<?php elseif( is_home() ) : ?>

    <p class="entry-excerpt">
        <?php if( has_excerpt() ): ?>
            <?php echo get_the_excerpt(); ?>
        <?php else: ?>
            <?php echo wp_trim_words( get_the_content(), 18, '..' ); ?>
        <?php endif; ?>
    </p>

<?php endif; ?>

