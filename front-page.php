<?php
/** Front-Page Template File
 * @package EDigitalX
 */

    get_header();
    do_action( 'get_file_name', basename( __FILE__ ) );
?>

    <section class="posts-featured">
        <div class="container">
            <div class="featured-content">

                <?php get_template_part( 'template-parts/entries-featured/entry', 'last' ); ?>

                <div class="posts-featured-sidebar">

                    <?php get_template_part( 'template-parts/entries-featured/entries', 'tabs' ); ?>
                    <?php get_template_part( 'template-parts/entries-featured/entries', 'popular' ); ?>
                    <?php get_template_part( 'template-parts/entries-featured/entries', 'recommended' ); ?>

                </div><!-- .posts-featured-sidebar  -->

            </div>
        </div>
    </section>

    <section class="container">

        <h2><?php _e( 'Most commented posts', 'pizzashop' ); ?></h2>

        <div class="entries-blog">

            <?php
                $args = array(
                    // Order by comment count.
                    'orderby' => 'comment_count',
                    'posts_per_page' => 3
                );

                // Instantiate new query instance.
                $most_commented_posts = new WP_Query( $args );

                // echo '<pre>';   var_dump( $my_query );   echo '</pre>';

                if ( $most_commented_posts -> have_posts() ) :
                    while( $most_commented_posts -> have_posts() ) :
                        $most_commented_posts -> the_post();

                        $estimated_time = get_post_meta( get_the_ID(), 'estimated_reading_time', true );        #   Obtengo el valor del Meta Box
                        $has_estimated_time = ( $estimated_time == '' || $estimated_time == 0 ) ? false : true;

                        ?>

                            <?php
                                $args = [
                                    'is_entry_featured'  => false,
                                    'has_estimated_time' => $has_estimated_time,
                                    'estimated_time'     => $estimated_time
                                ];
                            ?>

                                <article class="entry entry-blog">

                                    <?php get_template_part( 'template-parts/entry', 'thumbnail' ); ?>

                                    <div class="<?php echo $args[ 'is_entry_featured' ] ? 'entry-featured entry-featured__content--size entry-featured__content--position' : 'entry__content entry__content--size entry__content--position'; ?>">

                                        <?php get_template_part( 'template-parts/entry', 'header' ); ?>
                                        <?php get_template_part( 'template-parts/entry', 'content' ); ?>
                                        <?php get_template_part( 'template-parts/entry', 'footer', $args ); ?>

                                    </div>

                                </article>

                        <?php

                    endwhile;
                else:
                endif;
                wp_reset_postdata();

            ?>

        </div>

    </section>

<?php 
    get_footer();