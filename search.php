<?php
/** Archive Template File
 * @package EDigitalX
 */

    get_header();
    do_action( 'get_file_name', basename( __FILE__ ) );
?>

	<?php
		/** Obtenemos el numero de paginas */
		$paged = ( get_query_var( 'paged' ) )
			?   get_query_var( 'paged' )
			:   1;
		# echo 'page: ' .$paged;

		/** */
		$total_post_count = wp_count_posts();
		$published_post_count = $total_post_count -> publish;
		$total_pages = ceil( $published_post_count / $posts_per_page );
	?>

	<header
		class="hero"
		<?php if( ! empty( $featured_image_id ) ) : ?>
			style="background-image: url( <?php echo $image_source; ?> );"
		<?php else: ?>

		<?php endif; ?>
	>
		<div class="container">

			<div class="hero__container-title">

				<h1 class="hero__title">
					<?php
						printf(
							/* translators: %s: Search term. */
							esc_html__( 'Results for "%s"', 'twentytwentyone' ),
							'<span class="page-description search-term">' . esc_html( get_search_query() ) . '</span>'
						);
					?>
				</h1>
				<div class="search-result-count default-max-width">
					<?php
						printf(
							esc_html(
								/* translators: %d: The number of search results. */
								_n(
									'We found %d result for your search.',
									'We found %d results for your search.',
									(int) $wp_query->found_posts,
									'twentytwentyone'
								)
							),
							(int) $wp_query->found_posts
						);
					?>
				</div><!-- .search-result-count -->

			</div>

			<ul class="hero__data">

				<li class="hero__item hero__item--publish">
					<span class="hero__number hero__number--publish">
						<?php echo $published_post_count; ?>
					</span>
					<span class="hero__description hero__description--publish">
						<?php esc_html_e( 'Publish', 'edigitalx' ); ?>
					</span>
				</li>

				<li class="hero__item hero__item--pages">
					<span class="hero__number hero__number--pages">
						<?php echo $total_pages; ?>
					</span>
					<span class="hero__description hero__description--pages">
						<?php esc_html_e( 'Pages', 'edigitalx' ); ?>
					</span>
				</li>

			</ul>
		</div>

	</header>

	<section class="section with-sidebar">
		<main class="main-content">

			<section class="container entries-found">

				<?php
					if ( have_posts() ) :
						/** The Loop */
						while ( have_posts() ) :
							the_post();

							//  Configura despliege de tiempo estimado de lectura  
							$args = theme_get_estimated_reading_time();
							$args[ 'is_entry_featured' ] = true;
						
				?>

								<article class="entry <?php echo $args[ 'is_entry_featured' ] ? 'entry-featured__content--position' : ''; ?>">

									<?php get_template_part( 'template-parts/entry', 'thumbnail', $args ); ?>

									<div class="<?php echo $args[ 'is_entry_featured' ] ? 'entry-featured entry-featured__content--size entry-featured__content--position' : 'entry__content entry__content--size entry__content--position'; ?>">

										<?php get_template_part( 'template-parts/entry', 'header', $args ); ?>
										<?php get_template_part( 'template-parts/entry', 'content' ); ?>
										<?php get_template_part( 'template-parts/entry', 'footer', $args ); ?>

									</div>

								</article>

				<?php
						endwhile;
					else:
						esc_html_e( 'No results found', 'edigitalx' );
					endif;
				?>

			</section>

			<section class="entries-pagination">

				<?php
					get_template_part( 'template-parts/entry', 'pagination' );
				?>

			</section>

		</main>
	</section>

	<?php
get_footer();



