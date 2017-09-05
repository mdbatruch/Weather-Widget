function AjaxTest(){
    
    console.log( "Hello!" );
    
    var that = this;
    var xhr = new Ajax();
    
    console.log( xhr );
    
    function init(){
        
    console.log( "AjaxTest.init()" );
        
        xhr.onreadystatechange = gotRemoteData;
        xhr.open( 'GET', 'context.txt', true );
        xhr.send();
    }
    
    function gotRemoteData(){
        
        console.log( xhr.readyState, xhr.responseText );
        if( xhr.readyState == xhr.DONE ){
            if ( xhr.status == 200 ) {
                //the page loaded okay.
                document.getElementById( 'dynamic-content' ).innerHTML = xhr.responseText;
            } else {
                //there was an HTTP error
                console.log( 'HTTP error code: ' + xhr.status );
            }
        }
    }
    
    window.addEventListener( 'load', init );
}

var ajaxTest = new AjaxTest();