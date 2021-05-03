const 
    btnTrending = document .querySelector( '.posts-featured-sidebar .btn-trending' ),
    btnRecommended = document .querySelector( '.posts-featured-sidebar .btn-recommended' ),
    panelPopularPosts = document .querySelector( '#popular-posts.featured-panel' ),
    panelRecommendedPosts = document .querySelector( '#recommended-posts.featured-panel' );
    

btnTrending .addEventListener( 'click', () => {
    console .log( 'Trending!' );

    btnRecommended .classList .remove( 'current-tab-item' );
    btnTrending .classList .add( 'current-tab-item' );

    panelRecommendedPosts .classList .remove( 'is-active' );
    panelPopularPosts .classList .add( 'is-active' );

} );

btnRecommended .addEventListener( 'click', () => {
    console .log( 'Recommended!' );

    btnTrending .classList .remove( 'current-tab-item' );
    btnRecommended .classList .add( 'current-tab-item' );
    
    panelPopularPosts .classList .remove( 'is-active' );
    panelRecommendedPosts .classList .add( 'is-active' );
    
} );
                                                                