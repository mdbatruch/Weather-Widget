/*

    A wrapper object that allows cross-browser AJAX calls.
    @constructor
    @returns XMLHTTPREQUEST|ACTIVEXOBJECT|false. A supported AJAX object or false if none is found.

*/

function Ajax(){
    
    if ( window.XMLHttpRequest ) {
        // you are using a standards-compliant browser
        return new window.XMLHttpRequest();
    } else {
        // using an older IE browser or no AJAX support
        try {
        // using an older IE browser
        return new ActiveXObject( 'MSXML2.XMLHTTP.3.0' );
        } catch (error) {
        // AJAX unsupported
            console.log( `Error` );
            return false;
        }
    }
}