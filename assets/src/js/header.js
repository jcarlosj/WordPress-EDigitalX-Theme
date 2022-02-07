const 
    bodyElement = document .querySelector( 'body' ),
    menuIcon = document .querySelector( '#menu-icon' ),
    menuHeader = document .querySelector( '.menu-header' ),
    searchSection = document .querySelector( '#search' ),
    searchIcon = document .querySelector( '#search-icon' ),
    transparentBackground = document .querySelector( '#background' );

const breakpointMedium = 768;
let 
    displayMenu = false,
    displaySearch = false;

/** Seguimiento al cambio de la ventana del navegador */
window .onresize = function () {
    const windowWidth = document .documentElement .clientWidth;     //  Obtiene el ancho interno del elemento

    console .log( `${ windowWidth }px` );

    /** Valida si el ancho interno del elemento es mayor a el breakpoint de tamano medium (768px) */
    if( breakpointMedium < windowWidth ) {
        menuIcon .classList .remove( 'change-icon' );   
        menuHeader .classList .add( 'not-display' );   

        displayMenu = false;
    }
}

const hideBackground = () => {
    transparentBackground .style .display = 'none';
    bodyElement .style .overflowY = 'initial';
}

const showBackground = () => {
    transparentBackground .style .display = 'block';
    bodyElement .style .overflowY = 'hidden';
}

const closeMenu = () => {
    displayMenu = false;
    menuIcon .classList .remove( 'change-icon' );
    menuHeader .classList .add( 'not-display' ); 
}

const openMenu = () => {
    displayMenu = true;
    menuIcon .classList .add( 'change-icon' );   
    menuHeader .classList .remove( 'not-display' );
}

const closeSearch = () => {
    searchSection .style .display = 'none';
    searchIcon .classList .remove( 'dashicons-no-alt' );
    searchIcon .classList .add( 'dashicons-search' );    
    displaySearch = false;  
}

const openSearch = () => {
    searchSection .style .display = 'block';
    searchIcon .classList .remove( 'dashicons-search' );
    searchIcon .classList .add( 'dashicons-no-alt' );   
}

/** Mobile Background */
transparentBackground .addEventListener( 'click', () => {
    hideBackground();
    closeMenu();
    closeSearch();
});

/** Icono del Menu */
menuIcon .addEventListener( 'click', () => {
    displayMenu = ! displayMenu;

    if( displaySearch )
        closeSearch();

    if( displayMenu ) {
        openMenu();
        showBackground();
    }
    else {
        closeMenu();
        hideBackground();
    }
});

/** Search */
searchIcon .addEventListener( 'click', () => {
    displaySearch = ! displaySearch;

    if( displayMenu )
        closeMenu();

    if( displaySearch ) {
        openSearch();
        showBackground()
    }
    else {
        closeSearch();
        hideBackground();
    }
});