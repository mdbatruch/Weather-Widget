/*

                    CREATES A WEATHER WIDGET AT THE SUPPLIED ID, USING THE PHP PROXY  SCRIPT PROVIDED FOR LIVE WEATHER DATA.
                    @PARAM - STRING - elementId. ID ATTRIBUTE OF THE ELEMENT THE WEATHER WIDGET SHOULD RENEDER WITHIN.
                    @PARAM - STRING - weatherProxyURL. THE URL OF THE PHP PROXY SCRIPT THE PROVIDES THE CURRENT WEATHER CONDITONS.

*/

function AjaxWeatherWidget( elementId, weatherProxyURL ){
    
    console.log( "Hello!" );
    
    var that = this;
    
    var xhr = new Ajax();
    var elementId = elementId;
    var weatherProxyURL = weatherProxyURL;
    
    var containerElement = null;
    var buttonElement = null;
    var listElement = null;
    
/*

                    INITIALIZES THE WEATHER WIDGET.
                    @CALLBACK
                    @PRIVATE

*/
    
    function init(){
        
        console.log( 'AjaxWeatherWidget.init()');
        
        //find the target element in the DOM
        containerElement = document.getElementById( elementId );
        
        var seperator = ( containerElement.className.length > 0) ? '' : '';
        containerElement.className += seperator + 'ajax-weather-widget';
        
        //create a list for the weather data
        listElement = document.createElement( 'dl' );
        listElement.id = 'weather-data';
        containerElement.appendChild(listElement);
        //create a new button
        buttonElement = document.createElement( 'button' );
        buttonElement.id = 'load-button';
        buttonElement.innerHTML = 'Load Weather Info';
        buttonElement.addEventListener('click', requestWeatherData);
        //insert the button into the container element
        containerElement.appendChild( buttonElement );
    }

/*

                    CREATES AN AJAX REQUEST FOR THE CURRENT WEATHER DATA.
                    @CALLBACK
                    @PRIVATE
                    @PARAM (EVENT) - THE CLICK EVENT THAT TRIGGERED THE FUNCTION CALL.

*/
    
    function requestWeatherData(){
        
    console.log( "AjaxWeatherWidget.init()" );
        
        xhr.onreadystatechange = receivedWeatherData;
        xhr.open( 'GET', weatherProxyURL, true );
        xhr.send();
    }

/*

                    PROCESSES RECEIVED WEATHER DATA AND OUTPUTS IT.
                    @CALLBACK
                    @PRIVATE

*/
    
    function receivedWeatherData(){
        
        console.log( xhr.readyState, xhr.responseText );
        if( xhr.readyState == xhr.DONE ){
            if ( xhr.status == 200 ) {
                //the page loaded okay.
                
                var response = JSON.parse(xhr.responseText);
                
                if ( response.status == 'success'){
                    //we got the data
                    renderData( response.data );
                } else if (response.status == 'error') {
                    //there was an error
                    alert(response.message);
                }
                
            } else {
                //there was an HTTP error
                console.log( 'HTTP error code: ' + xhr.status );
            }
        }
        

    }

/*
        
            CREATES HTML NEEDED TO DISPLAY THE WEATHER DATA.
            @PARAM weatherData. THE JS OBJECT CONTAINING THE VARIOUS PARTS OF THE CURRENT WEATHER.
        
*/
    function renderData( weatherData ){
            
            listElement.innerHTML = `<dt>Temperature</dt><dd class="temperature">` + weatherData.temperature + `</dd>
                                    <dt>Conditions</dt><dd class="temperature">` + weatherData.conditions + `</dd>
                                    <dt>Humidity</dt><dd class="temperature">` + weatherData.humidity + `</dd>
                                    <dt>Wind</dt><dd class="temperature">` + weatherData.wind + `</dd>
                                    <dt>Tendency</dt><dd class="temperature">` + weatherData.tendency + `</dd>`
    }               
    
    window.addEventListener( 'load', init );
}

new AjaxWeatherWidget( 'weather-widget', 'weather-proxy.php');