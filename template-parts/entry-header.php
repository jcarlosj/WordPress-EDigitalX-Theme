
<?php if( is_front_page() ) : ?>

    <a href="<?php the_permalink(); ?>" class="post-featured-media">
        <div class="image-wrapper">
            <?php the_post_thumbnail( 'posts-featured-square-mobile' ); ?>
        </div>
    </a>

<?php 
    elseif( is_page() || is_single() ) : 
        $featured_image_url = get_the_post_thumbnail_url();
?>
        <header 
            class="hero"
            <?php if( $featured_image_url ) : ?>
                style="background-image: url( <?php echo $featured_image_url; ?> );"
            <?php else: ?>
                
            <?php endif; ?>
        >

            <div class="hero-content">
                <h1><?php the_title(); ?></h1>
            </div>
            
        </header>

<?php elseif( is_home() ) : ?>

    <a class="entry-link entry-thumbnail" href="<?php the_permalink(); ?>">
        <?php the_post_thumbnail( 'posts-featured-landscape-mobile' ); ?>
    </a>

    <header class="entry-info">
                        
        <span class="entry-catetory">
            <?php the_category(', '); ?>
        </span>
        
        <a class="entry-link" href="<?php the_permalink(); ?>">
            <h2 class="entry-title"><?php the_title(); ?></h2>
        </a>

    </header>

<?php endif; ?>