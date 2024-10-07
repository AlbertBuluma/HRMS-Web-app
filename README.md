\## About the HRMS Third-party Web app

This web app integrates with the HRMS via the HRMS API. It provides an interface through which users can create, update and retrieve staff details.

It consumes the following HRMS API endpoints:
1. Staff Registration
2. Staff Retrieval
3. Staff Update

## Installation
1. Host machine should have the following tools already installed and fully functional:
* [Docker](https://docs.docker.com/engine/install/ubuntu/#installation-methods)
* [Docker Compose](https://docs.docker.com/desktop/install/linux/ubuntu/)
* [Composer](https://getcomposer.org/download/)
* MySQL v8.0
* PHP v8.2


2. Clone the project directory into a location on the host machine

``git clone https://github.com/AlbertBuluma/HRMS-Web-app.git .``

3. Create and configure the project env file

``cp .env.example .env``

4. Modify the database variables to much the configurations of your active MYSQL database

``
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=database_port
DB_DATABASE=database_name
DB_USERNAME=database_root_user
DB_PASSWORD=database_password
``

5. Install project package dependencies
   ``composer install``

6. Run the project database migrations
   ``php artisan migrate``

7. Seed the database

``php artisan db:seed``

8. Serve the application

``php artisan serve --port=8000``

Default login credentials
``email: administrator@email.com``
``password: password``


