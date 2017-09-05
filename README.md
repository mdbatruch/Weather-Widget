# Weather-Widget
An AJAX Weather Widget that allows you to check the weather on the fly.

With the help of Object Oriented Programming with PHP this app allows you to scrape the government of Canada's weather website and grab data to display nicely.

This example by default is set to display Toronto's current weather but you can change the city by going into the weather-proxy.php file and adjusting the following variable to whichever url you are looking for below:

$pageScraper->setURL( 'http://weather.gc.ca/city/pages/on-143_metric_e.html' );

All the pages have the same layout and classes/ids applied to them but if this doesn't work then try making sure that the right div/containers are being selected by the PageScraper.
