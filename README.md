# Developer Test Project

This application uses PHP as well as a MySQL database.
Follow these steps to start it.

1. Install XAMPP.
2. Extract the project and copy the contents of developer_test_project-main to C:\xampp\htdocs\
3. Open curd\conn.php and either use the below configuration, or create a MySQL database and replace it with your own.

$server = '78.138.24.66';
$username = 'root';
$password = 'Developer22Developer22';
$database = 'developer_test';
$conn = mysqli_connect($server,$username,$password,$database);

4. Open XAMPP Control Panel and click "Start" next to "MySQL" as well as "Apache."
5. Go to localhost/curd
