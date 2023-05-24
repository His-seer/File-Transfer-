<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sign Up to Creative Learning</title>

</head>

<body >
<h2 style="text-align: center"> CREATE AN ACCOUNT</h2>
<?php
if (isset($_POST["create"])) {
    $is_created = create_account();
    if ($is_created)
        echo "<h4>Account Created Successfully! Click <a href='login.php'>here</a> to go to Log in!</h4>";
    else echo "<h4>Account Creation Failed! Try Again!></h4>";
} ?>

<form action="" method="post">
    <fieldset>
        <legend>Create</legend>
        <label>Username: <input type="text" id="username" name="username"
                                value="<?php echo count($_POST) > 0 ? $_POST["username"] : "" ?>"
                                placeholder="Enter Username" required></label>
        <br><br>
        <label>Password: <input type="password" id="password" name="password"
                                value="<?php echo count($_POST) > 0 ? $_POST["password"] : "" ?>"
                                placeholder="Enter Password" required></label>
        <br>
        <br>

        <label>First Name: <input type="text" id="first-name" name="first-name" required></label>
        <br>
        <br>
        <label>Last Name: <input type="text" id="last-name" name="last-name" required></label>
        <br><br>
        <label>Email: <input type="email" id="email" name="email" required></label>
        <br>
        <br>
        <label>Date of Birth: <input type="date" id="date-of-birth" name="date-of-birth" required></label>
        <br>
        <br>
        <label>Permanent Address: <input type="text" id="permanent-address" name="permanent-address" required></label>
        <br>
        <br>
        <label>Phone Number: <input type="tel" id="phone-number" name="phone-number" required pattern="[0-9]{9,12}"
                                    title="Begin with 3-digit country code without +, and don't include leading 0."></label>
        <br><br>
        <div>
            Account Type: <br>
            <label>Employee<input type="radio" id="employee" name="account-type" value="employee" required></label>
            <label>Manager<input type="radio" id="manager" name="account-type" value="manager"></label>
        </div>
        <br>
        <label> Creative Learning Store:
            <select id="store" name="store" required>
                <option value="">---Please select the store you work at or oversee---</option>
                <option value="store_1">Store A</option>
                <option value="store_2">Store B</option>
                <option value="store_3">Store C</option>
                <option value="store_4">Store D</option>
                <option value="store_5">Store E</option>
                <option value="store_6">Store F</option>
            </select>
        </label>
        <br><br>
        <label>Position: <input type="text" id="position" name="position" required></label>
        <br><br>
        <label> Date Employed: <input type="date" id="date-employed" name="date-employed" required></label>
        <br><br>
        <br>
        <label><input type="checkbox" required>I verify that all information entered above is true and accurate.</label>
        <br
        <br>
        <label><input type="checkbox" required>I agree to all Creative Learning Company Policies</label>
        <br><br>
        <button type="submit" name="create">Create Account</button>
        <br>
    </fieldset>
</form>

</body>
</html>
<?php
function create_account()
{
    $conn = new mysqli("localhost", "root", "", "creative_learning");
    $Username = $_POST["username"];
    $Email = $_POST["email"];
    $Password = $_POST["password"];
    $FirstName = $_POST["first-name"];
    $LastName = $_POST["last-name"];
    $DateOfBirth = $_POST["date-of-birth"];
    $PermanentAddress = $_POST["permanent-address"];
    $PhoneNumber = $_POST["phone-number"];
    $DateEmployed = $_POST["date-employed"];
    $Position = $_POST["position"];
    $Store = $_POST["store"];
    $table = $_POST["account-type"] == "employee" ? "Employees" : "Managers";
    $column11 = $_POST["account-type"] == "employee" ? "JobTitle" : "Position";
    $column9 = $_POST["account-type"] == "employee" ? "StoreOfEmployment" : "StoreOfManagement";

    $query = "INSERT INTO " . $table . "(Username, Email, Password,FirstName,LastName,DateOfBirth,PermanentAddress,PhoneNumber,DateEmployed," . $column11 . ", " . $column9 . ")
                VALUES ('" . $Username . "', '" . $Email . "', '" . $Password . "', '" . $FirstName . "','" . $LastName . "', '" . $DateOfBirth . "', '" . $PermanentAddress . "', '" . $PhoneNumber . "', '" . $DateEmployed . "', '" . $Position . "', '" . $Store . "' ); 
   ";
    return $conn->query($query);
}

?>