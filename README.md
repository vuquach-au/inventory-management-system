# inventory-management-system
This project is built for managing products, employees, suppliers, customers for an ecommerce website.
This project is built on Vue Js and Php Laravel 7 framework and Mysql Database.

The project has been initialized by composer (https://getcomposer.org/download/) to automate the installation.

Laravel documentation could be found here (included Laravel 7.x) together with Eloquent ORM:
https://laravel.com/docs/7.x/installation

It has been using JWT Token for Login Authentication

This project is using third party plugins such as Sweet Alert for Notifications on CRUD functions to support Vue.


//==================================Issues during implementation====================//
Issue Notes:

1. DOM not updating with Laravel, Vue and Axios->duplicate id="app" in welcome.blade.php and layouts.blade.php.

-> Solutions: remove id="app" in layouts.blade.php as it is unneccessary.

2. Authentication request made by Postman did not work.
-> Solutions: adjust Postman to Basic Auth in Authorization tab.