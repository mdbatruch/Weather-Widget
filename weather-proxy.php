<?php 
    
    require_once('includes/class.pagescraper.php');

    $pageScraper = new PageScraper();

    $pageScraper->setURL( 'http://weather.gc.ca/city/pages/on-143_metric_e.html' );

    header( 'Content-Type: application/json');
    header( 'Access-Control-Allow-Origin: *');

    $temperature = $pageScraper->scrape( '#container .wxo-conds-col2 .mrgn-bttm-0' );

    if ($temperature){
            //everything is ok
        
    $conditions = $pageScraper->scrape( '#container .wxo-conds-col1 .mrgn-bttm-0' );
    $wind = $pageScraper->scrape( '#container .wxo-conds-col3 .mrgn-bttm-0' );
    $tendency = $pageScraper->scrape( '#container .wxo-conds-col1 .mrgn-bttm-0:last-child' );
    $humidity = $pageScraper->scrape( '#container .wxo-conds-col2 .mrgn-bttm-0:last-child' );

    $weather = array();
    $weather[ 'temperature' ] = $temperature;
    $weather[ 'conditions' ] = $conditions;
    $weather[ 'wind' ] = $wind;
    $weather[ 'tendency' ] = $tendency;
    $weather[ 'humidity' ] = $humidity;
        
        $jSend = array(
        
            'status' => 'success',
            'data' => $weather
        );
        
    } else {
            //something went wrong on the server
            $jSend = array(
        
            'status' => 'error',
            'message' => 'There was an error.'
        );
    }


    echo json_encode( $jSend, JSON_PRETTY_PRINT );