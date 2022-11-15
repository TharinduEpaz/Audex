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

  

**htaccess file**

- prettier URLS

---

# Router

![Screenshot 2022-11-08 at 12.12.19 PM.png](MVC%20framework%20fe61796c0d32491e9fdd015d863fc169/Screenshot_2022-11-08_at_12.12.19_PM.png)

- takes the URL and decides what to do with it
- create a router.php file inside the core folder
- create a class called router
- include or require that file inside the controller (index.php)
- require produces and error if the file is not found but include does not produce error

### Regular Expressions

- Used to match strings
- preg_match method is used to match the string to a pattern
- preg_replace method is used to match and replace a given pattern to a string

### Routing table

- routing table consists of regular expressions that can be used to match URLs.
- If a URL consists some ID like “audex/posts/123/edit” that ID 123 can be also detected and stored inside the routing table.
- Routing table consists of regular expressions other than the direct entries. IF we try to add entries manually into the routing table then the table may be very large. regular expressions is very efficient in this case.

---

## OOP PHP Concepts need for the framework

### Creating objects of a class

```php
$post = new Post();

//create object based on a variable
$class_name = "Post";
$post = new $class_name;
```

### Calling a method

```php
$post = new post();
$post->save();

//call a method based on a variable

$method = "save";
$post-> $method();
```

### Passing parameters to a method

```php
class post
{
	public function save($_Arg1,$_Arg2){};
}

$post = new post();
call_user_func_array([$post,"save"],[123,"abc"]); 
//first array consists the object and the name of the method
//second array consists the parameters
```

### class exists and is callable

```php
$class_name = "post"

if (class_exists($class_name)){
$post = new $class_name();
}

$method = "save";

if(is_callable([$class_name,$method]){
	$post->$method();
}
```

---

Dispatching in the framework

- Routing = asking for directions
- Dispatching = following those directions