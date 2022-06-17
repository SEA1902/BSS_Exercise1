<?php

namespace view\login;

use Controller\PersonController;

//include __DIR__ . '/vendor/autoload.php';
include('./controller/PersonController.php');
include('./model/Person/PersonDb.php');
include('./model/Person/Person.php');
include('./model/database/DBConnect.php');

$personController = new PersonController();
$loginErr ="";
?>
<?php if($_SERVER['REQUEST_METHOD'] === "POST" ): ?>
    <?php

    session_start();
    $stmt = $personController->check();
    $count = $stmt->rowCount();

    if($count > 0){
        $_SESSION['user'] = $stmt->fetchAll();
        var_dump($_SESSION['user']);
        header('Location: index.php');exit;
    }else{
        echo "Email hoặc mật khẩu chưa chính xác";
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
        <legend class="form-label">Đăng nhập</legend>
        <div class="form-group">
            <label for="" class="form-group_label">Email:</label></br>
            <input type="text" class="form-control" name="email">
        </div>

        <div class="form-group">
            <label for="" class="form-group_label">Mật khẩu:</label></br>
            <input type="password" class="form-control" name="password">
            <span class="error"> <?php echo $loginErr;?></span>
        </div>

        <div class="form-submit">
            <input type="submit" class="btn-submit" name="dangnhap" value="Đăng nhập">
            <a href="./Register.php" >or create new account</a>
        </div>
    </form>

</div>
</body>
</html>

<?php endif; ?>