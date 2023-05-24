

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login to Creative Learning</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<h2 style="text-align: center">SIGN IN</h2>

<?php
  session_start();
  $count = 0;
  // connecto database
  
  $title = "login";
  require_once "./template/header.php";
 
  ;
?>


<form action="" method="post">
    <fieldset>
        <legend>Login</legend>
        <label>Username: <input type="text" id="username" name="username"
                                value="<?php echo count($_POST) > 0 ? $_POST["username"] : "" ?>"
                                placeholder="Enter Username" required></label>
        <br><br>
        <label>Password: <input type="password" id="password" name="password"
                                value="<?php echo count($_POST) > 0 ? $_POST["password"] : "" ?>"
                                placeholder="Enter Password" required></label>
        <br> <br>
        <label>Employee<input type="radio" id="employee" checked name="account-type" value="employee" required></label>
        <label>Manager<input type="radio" id="manager" name="account-type" value="manager"></label>
        <br>
        <br>
        <button type="submit" name="login">Log In</button>
        <button type="submit" name="signup" formaction="signup.php">Sign Up</button>
        <br><br>

        <?php if (isset($_POST["login"])) authorize($_POST["username"], $_POST["password"]); ?>
        <br>
    </fieldset>
    <div style="text-align: right">No account? <a href="signup.php">Sign up</a></div>
</form>

</body>
</html>

<?php
function authorize($username, $password)
{
    // connect to creative learning database
    $conn = new mysqli("localhost", "root", "", "creative_learning");

    $main_page = $_POST['account-type'] == "employee" ? "main-employee.php" : "main-manager.php";
    $table = $_POST['account-type'] == "employee" ? "Employees" : "Managers";

    $query = "SELECT * FROM " . $table . " WHERE Username='" . $username . "';";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row["Username"] === $username && $row["Password"] === $password) {
            echo "<strong>Welcome!</strong>";
            $conn->close();
            Header("Location: " . $main_page . "?username=" . $username);
        } else echo "<strong>Invalid Username and/or Password!</strong>";
    } else echo "<strong>Invalid Username and/or Password!</strong>";
}

?>