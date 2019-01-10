# FaceClone

This is a simple application that simulates some features of actual facebook.


# Steps by Step Guide for Front-End:

## Create Login and Signup Page
- [x] Include [Bootstrap 4](http://www.getbootstrap.com) - The front-end framework
- [x] Create a login form.
- [x] Create a Registration Form
- [x] Add Custom Styles if Needed


## Create Timeline Page

- [x] Create a Page for Timeline.
- [x] Create Navigation Links.
- [x] Create a Row and divide it in 3 sections like 3,6,3 = 12
- [x] Create Containers from which user can see stuff like friend requests, friends etc.
- [x] Create a form from which user can make post.
- [x] Create a Section for Posts.
- [x] Apply Custom styling if needed.


## Create Profile Page

- [x] Create a Profile Page.
- [x] Create a Row and divide it in 3 section like 3,6,3 = 12
- [x] Fields to Update profile image.
- [x] Fields to Edit Profile.


## Responsive Design.
- [ ] Add Responsiveness in all pages.

# Steps by Step Guide for Back-End:

## Create Database

- [x] Create "Tables.sql".
- [x] Create SQL queries to Create Required Tables.
- [x] Create Database Class.
- [x] Create Data members for that class.
- [x] Set all data members to null in constructor.
- [x] Create a Connect method.
- [x] Connect to database using PDO and return the PDO Object.

## Sign UP
- [x] Create User Class.
- [x] Create Getters and Setters in User Class.
- [x] Create signup.inc.php.
- [x] Get value from fields and Create a User Object.
- [x] Create operations.inc.php.
- [x] Create a Function store_user($connection, $user).
- [x] Create a Function exists($connection , $user) for validation.
- [x] Create a Function signup_status() in func.inc.php to display an alert box.
- [ ] Reset the signup form.

## Login
- [x] Create login.inc.php.
- [x] Get values from fiedls.
- [x] Create a function for login in operations.inc.php.
- [x] Create Session if user is valid.
- [x] Redirect the user to home.php.
- [x] Create a Function login_status() in func.inc.php.
- [x] Display an error message to user using login_status() if user is not valid.
- [ ] Reset the login form.

## Profile
- [x] Create a Function to list all the posts by a specific user.
- [x] Get data about a profile.
- [x] Hide the Status Edit form if user visits the profile of another user
- [x] Show all the friends of that person.
- [ ] Hide the Edit form other users.

## Home Page
- [x] Created the Friend System.
- [x] Fix the unfriend bug.

# Others

- [ ] Provide the documentation for each step in FRONT & BACK END.

## Bring Older Posts When a User Scrolls to the end of the Page.
- [x] Install JQuery.min.js
- [ ] Create a load-post.php.
- [ ] Use Jquery to Load load-post.php from Server.
- [ ] When user scrolls down, bring new data from Server
