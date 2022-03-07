<?php
/** Comments Template File
 * @package EDigitalX
 */

    do_action( 'get_file_name', basename( __FILE__ ) );
?>

    <section class="comments container">

        <?php 
            $class_logged_in = ( is_user_logged_in() ) ? 'form-logged-in' : '';
        ?>
        
        <div class="<?php echo $class_logged_in; ?>">

            <?php
                $args = [
                    'class_submit' => 'btn btn-primary',
                ];
                comment_form( $args );
            ?>

            <h3 class="comment-title">
                <?php _e( 'Comments', 'edigitalx' ); ?>
            </h3>
            <ul class="comment-list">
                <?php
                    $args = [
                        'post_id'   => $post -> ID,
                        'status'    => 'approve'
                    ];
                    $comments = get_comments( $args );

                    #   Valida si no esta vacio el array de comentarios
                    if( ! empty( $comments ) ) {
                        $args = [
                            'per_page'  => 10,
                            'reverse_top_level' => false
                        ];
                        wp_list_comments( $args, $comments );
                    }
                    else {
                        ?>
                            <p class="comment-message">
                                <?php _e( 'There are no comments', 'edigitalx' ); ?>
                            </p>
                        <?php
                    }

                ?>
            </ul>

        </div>

    </section>
