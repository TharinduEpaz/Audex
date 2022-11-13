# Epa-s-MVC-Framework
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
- Vendor - all the third party files and code

htaccess

- prettier URLS

# Router


takes the URL and decides what to do with it

create a router.php file inside the core folder 

create a class called router

include or require that file inside the controller (index.php)

require produces and error if the file is not found but include does not produce error