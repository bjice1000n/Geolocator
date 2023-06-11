# Geolocator
Retrieve and display coordinates (longitude and latitude) for a given address, using Google Maps and OpenStreetMap (OSM). Main implementation is done for Google Maps using Google Maps API. For OpenStreetMap only place-holder is provided which is simulated and return static results. 

Prerequisites:
1) PHP 7.4
2) Nodejs v18

The main focus is the PHP API solution, which is implemented using OOP and uses an external library to convert the address to coordinates. In addition, a minor SPA has been made with React, which is responsible for taking the address from the user and rendering the result.

Installation:<br />
Once you pull the code, it consists of two parts:<br />

1. Back end PHP in located into api directory.<br />
   First run:<br />
   `composer install`<br /><br />

   That should install all dependencies along with PHPUnit for tests.<br />
   Next thing you have to copy `.env.example` file into `.env` and put a valid Google API key.<br /><br />

   To execute unit testing run<br />
   `./vendor/bin/phpunit tests`<br /><br />

   _NOTE: PHP api directory must be top directory in the apache server in order for router to work properly. The route pick request url using full path in the url address._<br /><br />

2. React SPA located into geolocator directory.<br />
   Install packages with:<br />
   `npm install`<br /><br />

   Copy `.env.example` to `.env.local` and make sure that API url is set to proper one in `.env.local` where PHP API will respond. By default that is set to localhost/api.<br /><br />
    To start React SPA locally you have to run:<br />
   `run start`<br /><br />
   That should start local server and open React application into default browser.

By default Google Maps API class is used. In order to change it either to use OpenStreetMaps API or other - just change the class that is instantiate in GeolocatoionRepository constructor. Keep in mind that OSM is just simulating a real request and don't require valid key.<br /><br />
If new API have to be inplemented then new class must be created which have to extend MapsAPI abstract class and implement IAddressCoordinates interface. Currently assumption is that new API will be authenticate via _GET parameter along with search parameter in url using curl. Once new class is created implementing it should be similar to the OSM API described above.