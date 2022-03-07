<?php
    // if( isset ( $args ) ) :
    //     echo '<pre>';  var_dump( $args );   echo '</pre>';
    // endif;
?>

<?php if( is_front_page() || is_home() || is_archive() || is_search() ) : ?>

    <header class="entry__header">

        <span class="entry__categories">
            <?php the_category( ' ' ); ?>
        </span>

        <h2 class="<?php echo $args[ 'is_entry_featured' ] ? 'entry-featured__title' : 'entry__title'; ?>">
            <a class="entry__title-link" href="<?php the_permalink(); ?>">

                <?php if( $args[ 'is_entry_featured' ] ) : ?>

                    <?php
                        $title = theme_limit_string_length( get_the_title(), 60 );
                        echo esc_html( $title );
                    ?>

                <?php else: ?>

                    <?php the_title(); ?>

                <?php endif; ?>

            </a>
        </h2>

    </header>

<?php elseif( is_single() ) :
    $post_title_background = get_post_meta( get_the_ID(), 'post_title_background', true );
    $featured_image_url = get_the_post_thumbnail_url();
    $bgcolor = $post_title_background == 'dark' ? 'light-color' : 'dark-color';
?>

    <header
        class="hero"
        <?php if( $featured_image_url ) : ?>
            style="background-image: url( <?php echo $featured_image_url; ?> );"
        <?php else: ?>

        <?php endif; ?>
    >

        <div class="hero__featured-image container">
            <h1 class="entry__title entry__title--<?php echo $bgcolor; ?>"><?php the_title(); ?></h1>
            
            <?php $args[ 'color_entry_author' ] = $bgcolor; ?>

            <?php get_template_part( 'template-parts/entry', 'details', $args ); ?>
        </div>

    </header>

<?php elseif( is_page() ) : 
    $featured_image_url = get_the_post_thumbnail_url(); 
?>

    <header
        class="hero"
        <?php if( $featured_image_url ) : ?>
            style="background-image: url( <?php echo $featured_image_url; ?> );"
        <?php endif; ?>
    >

        <div class="hero-content container">
            <h1><?php the_title(); ?></h1>
        </div>

    </header>

<?php endif; ?>