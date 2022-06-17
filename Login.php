<?php

namespace view\login;
session_start();
use Controller\PersonController;

include __DIR__ . '/vendor/autoload.php';
include('./Controller/PersonController.php');
include('./model/Person/PersonDb.php');
include('./model/Person/Person.php');
include('./model/database/DBConnect.php');

$personController = new PersonController();
?>
<?php if($_SERVER['REQUEST_METHOD'] === "POST" ): ?>
    <?php

    $stmt = $personController->check();
    $count = $stmt->rowCount();
    if($count > 0){
        session_start();
        $_SESSION['user'] = $stmt->fetchAll();
        var_dump($_SESSION['user']);
        header('Location: index.php');exit;
    }else{
        $err = "Email hoặc mật khẩu không chính xác";
        $_SESSION["err"]= $err;
        header('Location: Login.php');exit;
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
            <span class="error">
                <?php
                if(isset($_SESSION["err"])){
                    echo "*".$_SESSION["err"];
                    unset($_SESSION['err']);
                }
                ?>
            </span>
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