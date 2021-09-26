// console .log( 'X: ' + window .pageXOffset );
// console .log( 'Y: ' + window .pageYOffset );

var screenWidth = screen.width;
var screenHeight = screen.height;
console .log( screenWidth + "x" + screenHeight  );

let 
    btnGoUp = document .getElementById( 'btn-go-up' ),
    btnTelegram = document .getElementById( 'btn-telegram' );

window .onscroll = () => {
    var y = window .scrollY;
    if( y > 0 ) {
        btnGoUp .style .opacity = 1;
        // btnGoUp .style .transition = 'opacity 1s';
        btnGoUp .style .display = 'flex';
        btnTelegram .style .bottom = '90px';
    } 
    else {
        btnGoUp .style .opacity = 0;
        // btnGoUp .style .transition = 'opacity 1s';
        btnGoUp .style .display = 'none';
        btnTelegram .style .bottom = '24px';
    }

    console.log(y);
  };