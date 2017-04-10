# Team fEMR

teamfemr.org

###Community

1. [Slack](http://teamfemr.org/slack.html)
2. [JIRA](https://teamfemr.atlassian.net)
3. [Mailing List](https://groups.google.com/forum/#!forum/team-femr)

### Description

[ Fill in later ]

### Dependencies

* PHP >= 5.6.4
* OpenSSL PHP Extension
* PDO PHP Extension
* Mbstring PHP Extension
* Tokenizer PHP Extension
* XML PHP Extension
* Composer
* Node

### Installation and Deployment

* Use Git to clone the repository
* Create .env file using .env.example as a template
* Run `composer install`
* Run `npm install`
* Run `php artisan key:generate`

### Database Setup and Seeding

* Make sure your database settings are added to the .env
* Run `php artisan migrate`
* Run `php artisan db:seed`

### Assets

* Run `npm run dev` to build
* Run `npm run prod` to build for production ( to minimize )

### Other stuff to be expanded upon

* CSS Framework - http://bulma.io/
* Font Awesome - http://fontawesome.io/
* Admin Template - https://github.com/dansup/bulma-templates

### Maps/Location Data

* GeocoderLaravel
    * https://github.com/geocoder-php/GeocoderLaravel
    * http://geocoder-php.org/GeocoderLaravel
* Open Street Maps - http://wiki.openstreetmap.org/wiki/Overpass_API
* Mapzen - https://mapzen.com/
* Countries - http://data.okfn.org/data/core/country-codes
* Cities - https://www.maxmind.com/en/free-world-cities-database

