const 
    menuIcon = document .querySelector( '#menu-icon' ),
    menuHeader = document .querySelector( '.menu-header' );

let displayMenu = false;

const breakpointMedium = 768;

menuIcon .addEventListener( 'click', () => {
    displayMenu = ! displayMenu;
    
    if( displayMenu ) {
        menuIcon .classList .add( 'change-icon' );   
        menuHeader .classList .remove( 'not-display' );
    }
    else {
        menuIcon .classList .remove( 'change-icon' );
        menuHeader .classList .add( 'not-display' ); 
    }
    
    console.log( `Display menu ${ ! displayMenu }` );
});

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

console .log( 'Main Header' );