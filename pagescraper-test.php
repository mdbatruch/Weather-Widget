<?php 
    
    require_once('includes/class.pagescraper.php');

    $pageScraper = new PageScraper();

    $pageScraper->setURL( 'https://weather.gc.ca/city/pages/on-143_metric_e.html' );
    $conditions = $pageScraper->scrape( '#container span.wxo-metric-hide' );
   
    
    
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width,initial-scale=1" />
        <title>PHP Page Scraper</title>
        
        <!-- main stylesheet link -->
        <link rel="stylesheet" href="css/style.css" />
        
        <!-- HTML5Shiv: adds HTML5 tag support for older IE browsers -->
        <!--[if lt IE 9]>
	    <script src="js/html5shiv.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <h1>Weather Conditions</h1>
            <p>
                <?php echo $conditions; ?>
            </p>
    </body>
</html>