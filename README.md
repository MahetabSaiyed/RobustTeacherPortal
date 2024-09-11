# RobustTeacherPortal
A robust teacher portal built with PHP, HTML, CSS, and JavaScript for managing student information, including login functionality, student listings, and new student entries.
A web-based teacher portal built using PHP, HTML, CSS, and JavaScript. This application allows teachers to manage student listings, edit student details, and add new students, all in a secure and scalable environment.

## Features
- **Login System:** Secure login for teachers with authentication via a database.
- **Student Listing:** Displays a list of students with their names, subjects, and marks.
- **Edit/Delete Students:** Inline editing of student details and option to delete records.
- **Add New Students:** Modal-based form for adding new students and updating existing student records based on name and subject combination

## Technologies Used
- **Frontend:** HTML, CSS, JavaScript
- **Backend:** PHP
- **Database:** MySQL

## Setup Instructions
1. Clone the repository:
	``` git clone https://github.com/yourusername/RobustTeacherPortal.git ```
2. Install a local server (XAMPP, MAMP, or LAMP) to run PHP and MySQL.
3. Create a database in MySQL and import the provided SQL file to set up the student and teacher tables.
4. Configure the database connection:
	- Update the database credentials in the `defined.php` and `config.php` file.
5. Run the project locally by navigating to the project directory in your browser:
	``` http://localhost/RobustTeacherPortal ```
