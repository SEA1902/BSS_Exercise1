<?php

namespace view\register;

ini_set('display_errors', 1);
use Controller\PersonController;
session_start();
include __DIR__ . '/vendor/autoload.php';
include('./Controller/PersonController.php');
include('./model/Person/PersonDb.php');
include('./model/Person/Person.php');
include('./model/database/DBConnect.php');

$personController = new PersonController();
$result = $personController->getAllPerson();

?>

<?php if($_SERVER['REQUEST_METHOD'] === "POST" ): ?>
    <?php
try{
    $personController->add();
    header('Location: Login.php');
} catch(\Controller\InputException  $e){
    $errs = $e->getData();
    $_SESSION['err'] = $errs;
    header('Location: Register.php');
}

    ?>

<?php else: ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/style.css">
    <title>Document</title>
</head>
<body>
<div class = "container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" class="form">
            <legend class="form-label">Đăng ký tài khoản</legend>
            <div class="form-group">
                <label for="" class="form-group_label">Tên người dùng:</label></br>
                <input type="text" class="form-control" name="name">
            </div>

            <div class="form-group">
                <label for="" class="form-group_label">Email:</label></br>
                <input type="text" class="form-control" name="email">

            </div>

            <div class="form-group form-group-radio">
                <label for="" class="form-group_label">Giới tính:</label>
                <input type="radio" class="form-control_radio" name="gender" value="0">
                <label for="gender" class="form-group_label">Female</label>
                <input type="radio" class="form-control_radio" name="gender" value="1">
                <label for="gender" class="form-group_label">Male</label>
            </div>

            <div class="form-group">
                <label for="" class="form-group_label">Password:</label></br>
                <input type="password" class="form-control" name="password">
            </div>
            <div class="error">
                <?php
                if(isset($_SESSION['err'])) {
                    foreach ($_SESSION['err'] as $err) {
                        echo "<span>*" . $err . "</span>";
                        echo "</br>";
                    }
                }
                ?>
            </div>
            <div class="form-submit">
                <button type="submit" class="btn-submit" name="dangky">Đăng ký</button>
                <a href="Login.php" >Đăng nhập</a>
            </div>
        </form>

</div>
</body>
</html>

<?php endif; ?>