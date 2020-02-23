<?php
require_once('../../_libs/csv.php');
/*TODO:
 * 1. create registration form
 * 2. when user submits
 */

function signup(){
    if(count($_POST)>0){
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) return ('Invalid email.');

        $_POST['password'] = trim($_POST['password']);
        if(strlen($_POST['password'])<8) return ('password is too short');

//        $h=fopen('../../_assets/data/users/user_directory.csv','r');
//        while(!(feof($h))){
//            $line = fgets($h);
//            if(strstr($line, $_POST['email'])) die('email already in use');
//        }
//        fclose($h);

        if(containedInCSV('../../_assets/data/users/user_directory.csv', $_POST['username'])){
            return 'Username already in use.';
        }
        if(containedInCSV('../../_assets/data/users/user_directory.csv', $_POST['email'])){
            return 'Email already in use.';
        }
        $_POST['password']=password_hash($_POST['password'], PASSWORD_DEFAULT);
        print_r($_POST);
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Source+Code+Pro&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Source+Code+Pro&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../_assets/css/bootstrap.css">
    <link rel="stylesheet" href="../../_assets/css/zeitgeist-main.css">
    <title>Sign up - Zeitgeist</title>
</head>
<body id="animate-area">
<div class="container">
    <div class="spacer2"></div>
    <div class="row">
        <div class="col"></div>
        <div class="col-11 standard-container cstm-border">

            <div class="row">
                <div class="col">
                    <form action="../user/createUser.php" method="POST">
                        Username:
                        <label><input type="text" name="username" placeholder="username" required></label><br>
                        Email:
                        <label><input type="email" name="email" placeholder="mail@email.com" required></label><br>
                        First Name:
                        <label><input type="text" name="fname" placeholder="John"></label><br>
                        Last Name:
                        <label><input type="text" name="lname" placeholder="Doe"></label><br>
                        Date of Birth:
                        <span>
                            <label><select name="DOB_Month">
                                    <option value="0">month</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select></label>
                        </span>
                        <span>
                            <label><select name="DOB_Day">
                                    <option value="0">day</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>
                                <option value="31">31</option>
                            </select></label>
                        </span>
                        <span>
                            <label><select name="DOB_Year">
                                    <option value="0">year</option>
                                <option value="1990">1990</option> <!--TODO: Add more dates, preferably with JS-->
                            </select></label>
                        </span>
                        <br>
                        Password:
                        <label><input type="password" name="password" required minlength="8"></label><br>
                        Confirm Password:
                        <label><input type="password" name="confirm_password" required></label><br>
                        <button type="submit" value="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col"></div>

    </div>
</div>

<script src="../../_assets/js/jQuery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="../../_assets/js/bootstrap.js"></script>
<script src="../../_assets/js/zg-skeleton.js"></script>
</body>
</html>
