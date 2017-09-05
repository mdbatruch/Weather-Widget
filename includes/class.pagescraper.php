<?php

    /*
    
            @const GANON_LOCATION. THE location the needed Ganon Library.
            @link https://github.com/Shemahmforash/Ganon The Github page for the Ganon library.
    */


    define('GANON_LOCATION', 'includes/libraries/Ganon.php');

    /*
    
            DEFINES AN OBJECT THAT ALLOWS THE SCRAPING OF ANY REMOTE PAGE FOR PARTICULAR DATA.
            @version - 0.5
            @author - MIKE B
    */

    class PageScraper{
        
        /*
        
                @var - string $url. THE URL OF THE PAGE TO BE LOADED.
        
        */
        
        private $url = '';
        
        /*
        
                @var - resource $cURL. THE CURL HANDLE FOR THE REMOTE CONNECTION.
        
        */
        
        private $cURL = null;
        
        /*
        
               @var - DOMNode $html. THE LOADED HTML DOM OF THE PAGE BEING SCRAPED. 
        
        */
        
        
        private $html = null;
        
        /*
        
               CONSTRUCTOR FUNCTION, CREATES AND CONFIGURES A CURL CONNECTION.
        
        */
        
        function __construct( ){
            
            require_once( GANON_LOCATION );
            
            $this->cURL = curl_init();
            
            curl_setopt($this->cURL,
                        CURLOPT_RETURNTRANSFER,
                        true );
            
            curl_setopt($this->cURL,
                        CURLOPT_HEADER,
                        false );
            
            curl_setopt($this->cURL,
                        CURLOPT_FOLLOWLOCATION,
                        true );
        }
        
        /*
        
               SETS THE URL OF THE REMOTE PAGE TO LOAD.
               @param string $url. THE ADDRESS OF THE PAGE TO BE LOADED.
        
        */
        
        
        public function setURL ( $url ){
            $this->url = $url;
            
            curl_setopt($this->cURL,
                        CURLOPT_URL,
                        $this->url );
        }
        
        /*
        
               LOADS AND RETURNS DATA FROM THE REMOTE PAGE.
               @param string $selector. SELECT WHICH PART OF DOCUMENT TO SCRAPE.
               @return string. THE DATA THAT WAS FOUND AT THE PROVIDED SELECTOR.
               @throws E_USER_ERROR. IF THE REMOTE SERVER RETURNS A HTTP RESPONSE OTHER THAN 200.
        
        */
        
        public function scrape( $selector = 'body' ){
            
            if( !$this->html){
            
                $response = curl_exec( $this->cURL );

                if( curl_getinfo( $this->cURL, CURLINFO_HTTP_CODE ) == 200 ){

                $this->html = str_get_dom( $response );

                } else {

                trigger_error( 'Remote server issued HTTP code ' . 
                            curl_getinfo($this->cURL, CURLINFO_HTTP_CODE ), 
                            E_WARNING );
                    return false;
            }
                
                }
            
            $html = $this->html;
            
            $data = $html( $selector, 0 )->getPlainText();
            return $data;
        }
        
        /*
        
               DESTRUCTOR FUNCTION, RELEASES THE CURL RESOURCE.
        
        */
        
        function __destruct( ){
            
            curl_close( $this->cURL );
        }
    }