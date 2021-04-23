const
    searchSection = document .querySelector( '#search' ),
    searchIcon = document .querySelector( '#search-icon' );

displaySearch = true;

searchIcon .addEventListener( 'click', () => {
    displaySearch = ! displaySearch;

    if( displaySearch ) {
        searchSection .style .display = 'none';
        searchIcon .classList .remove( 'dashicons-no-alt' );
        searchIcon .classList .add( 'dashicons-search' );
    }
    else {
        searchSection .style .display = 'block';
        searchIcon .classList .remove( 'dashicons-search' );
        searchIcon .classList .add( 'dashicons-no-alt' );   
    }

    console.log( `Display search ${ ! displaySearch }` );
});