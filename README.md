# MVC framework

Why MVC is good?

![Screenshot 2022-11-08 at 10.26.32 AM.png](MVC%20framework%20fe61796c0d32491e9fdd015d863fc169/Screenshot_2022-11-08_at_10.26.32_AM.png)

controller : user interaction 

model : data and database/storing and retrieving data

views : what users sees on screen (HTML)

why mvc?

- Separation of concerns - code does stuff + code show stuff
- easier code reuse
- organized code
- secure code
- developer specialization - front end and the backend developer specialization

Folder Structure

- App
    - Controllers
    - Models
    - Views
- Core - our framework code is here
- Log - logging files
- Public - all the publicly accessible files go
    - only folder accisable to the web
    - front controller of any static sites (CSS and images)
    - root of the web server
    - IT IS SECURE BECAUSE THE DATABASE PASSWORDS CANNOT BE FOUND INSIDE THIS FOLDER
- Vendor - all the third party files and code

  

htaccess

- prettier URLS

# Router

![Screenshot 2022-11-08 at 12.12.19 PM.png](MVC%20framework%20fe61796c0d32491e9fdd015d863fc169/Screenshot_2022-11-08_at_12.12.19_PM.png)

takes the URL and decides what to do with it

create a router.php file inside the core folder 

create a class called router

include or require that file inside the controller (index.php)

require produces and error if the file is not found but include does not produce error

## OOP PHP Concepts need for the framework

### Creating objects

```php

```