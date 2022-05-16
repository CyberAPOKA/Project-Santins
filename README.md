 <h1> Project-Santis </h1>
<h4> This project was developed for a selection process of the company Santins! </h4>
<p>I made a restricted access system with two types of user, standard user and super admin user.</p>
<p> The project consists of the user creating an account, logging in, registering at universities, viewing them and also removing their registration, the standard user can also suggest a university, universities created by standard users will be under review, and only the super admin user can change its status, super admin user can also delete universities. </p>
<h2>Resources used</h2>
<p>For the user control part I used the laravel/jetstream library and a "role" field in the users table to differentiate them.</p>
<p>Consuming JSON: I made the api routes and used Postman, I made a function in the controller that takes only the first 100 universities.</p>
<p>Searching universities: I made a search function in the controller that searches all universities for anything the user types, anywhere in the database.</p>
<p>Enrollment: The user can register at universities, it is a table that takes the user's id with the id and name of the university. </p>
<p>Add universities: It's a simple form that asks for 5 information about the university, "alpha_two_code", "country", "domains", "name" and "web_pages". This university created by the default user will be as “Awaiting Approval” and it is not possible to apply to it.</p>
<p>My subscriptions: Returns a table with all universities that that user has signed up for, along with a remove button, which deletes that user's relationship with that university in the database.</p>
<p>API for external access – Login: I made an api route that hits the informed url, when inserting a json with email and password, the function will check if the user exists or not, if it exists, it will return all the data of that user along with all the universities he signed up for .</p>

<h2>Extra functions: </h2>
<h4>SUPER ADMIN</h4>
<p>I made a super admin user, he has the power to approve the universities suggested by the standard users, so they can enroll in these universities too, the super admin can also delete any university from the table.</p>
<h4>Validations</h4>
<p>I used the "proengsoft/laravel-jsvalidation" library to validate the universities form, the restrictions were, all fields are mandatory, the "alpha_two_code" field must contain only 2 digits, and the "web_pages" field must be a valid URL.</p>

<h4>Messages</h4>
<p>I used the SweetAlert library to inform the user when he makes a request, for example, success messages, errors and information.</p>

<h4>User</h4>
<p>I created a rule where the user cannot apply to the same university more than once.</p>

<h2>Now you know all the project information, let's run it on your machine?</h2>

