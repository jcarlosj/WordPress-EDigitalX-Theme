<?php
/** Entry Pagination Template File (Blog)
 * @package EDigitalX
 */
?>

<div class="paginate">
    <?php
        # echo paginate_links(); # Forma con numeracion 
        wpex_pagination ();
    ?>
</div>

<!-- <div class="pagination">
    <?php # Forma sin numeracion
        # previous_posts_link();
        # next_posts_link();
    ?>
</div> -->