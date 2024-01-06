I completed this project independently after my internship at HyperPay in the summer of 2023. I used external resources like Laravel Daily (Youtube), W3Schools, and Coursera. The project is a group organizer webpage with features that include creating groups for shared to do lists, personal to do lists, and a dashboard that manages the urgent tasks, messages, and invites to join other groups. The groups, invites, group tasks, personal tasks, and messages are all stored in a database. The reason I created this project is to have a place to manage my personal tasks, and group tasks with friends. Furthermore, I wanted to practice a relational database model with a many-to-many relationship between users and groups. 

I completed the project in the Laravel framework, which is mainly programmed in PHP and Blade. The folders committed in this project are organized based on the Laravel framework. The following is a manual of where to find each aspect of my code:

- The business logic, extracting from the database, and how the webpages are routed can be found under /App/Http/Controllers
- The middleware, access restrictions, and authorization are handled under /App/Http/Controllers/Auth and under /App/Http/Middleware
- The object oriented design for database elements and more can be found under /App/Models
- The database migrations, descriptions of database tables, and how the database was built is under /Database/Migrations
- Public elements such as images, and my CSS designs are under /Public/images and /Public/css respectively.
- The views, frontend programs, and the layouts in HTML are all under /Resources/Views , you can find the main layouts under /Resources/Views/Layouts and you can find specific page designs directly under /Resources/Views
- The main routes, authorizations, and middlewares can be found in /Routes/web.php
