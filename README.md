# Student Organizer

A web-based Student Organizer application built with **PHP** and **MySQL** to help students manage their academic life in one place. The system allows users to organize courses, assignments, deadlines, and other academic information through an easy-to-use interface.

## Features
* sign up page

  * Full name, email, password, confirm password
  * check if email exists and that pssword matches the confirm
  * add the user info to users table in database

* login page

  * email, password
  * check the data with the users table in database

* Course Management

  * Add, edit, and delete courses
  * View all enrolled courses

* Assignments Management

  * Add, edit, and delete assignments
  * View all current assignments

* Database Integration

  * Stores data using MySQL
  * Persistent storage for assignments, courses and users

## Technologies Used

* PHP
* MySQL
* HTML5
* CSS3
* JavaScript
* Apache (XAMPP)

## Project Structure

```text
StudentOrganizer/
│
├── assignments/
├── auth/
├── courses/
├── config/
├── database/
├── dashboard.php
├── .gitignore
└── README.md
```

## Installation

### Prerequisites

* PHP 8.x
* MySQL
* Apache
* XAMPP (recommended)
* Git

### Steps

1. Clone the repository:

```bash
git clone https://github.com/ahmedgadalla256/StudentOrganizer.git
```

2. Move the project into your XAMPP `htdocs` directory.

3. Start **Apache** and **MySQL** from the XAMPP Control Panel.

4. Create a new MySQL database.

5. Import the SQL file located in the `database/` folder.

6. Update your database connection settings if necessary.

7. Open your browser and visit:

```
http://localhost/StudentOrganizer/
```

## Future Improvements

* Calendar view
* Reminder notifications
* Search functionality
* Responsive mobile design
* Grade tracking
* Dashboard analytics

