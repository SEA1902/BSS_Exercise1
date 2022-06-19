<?php
session_start();
$user = (isset($_SESSION['user'])) ? $_SESSION['user']: [];
?>
<?php

ini_set('display_errors', 1);
use Controller\PersonController;
use Controller\ImageController;

include __DIR__ . '/vendor/autoload.php';
include('./Controller/PersonController.php');
include('./model/Person/PersonDb.php');
include('./model/Person/Person.php');
include('./model/database/DBConnect.php');
include ('./Controller/ImageController.php');
include('./model/Image/ImageDb.php');
include('./model/Image/Image.php');

$personController = new PersonController();
$imageController = new ImageController();
$id = $user[0]["id"];
$image = $imageController->getImage($id);
//var_dump($user[0]['password']);
?>

<?php if($_SERVER['REQUEST_METHOD'] === "POST"): ?>
    <?php
//    $id = $user[0]["id"];
    if (isset($_POST["update"])){
        try{
            $personController->update($id);
            $_SESSION['user'] = $personController->getPerson($id);
            header('Location: Setting.php');
        } catch(\Controller\InputException  $e){
            $errs = $e->getData();
            $_SESSION['err'] = $errs;
            header('Location: Setting.php');
        }
    }elseif (isset($_POST["add_image"])){
        $imageController->addImage($id);
        header('Location: Setting.php');
    } elseif (isset($_POST["update_image"])){
        $imageController->updateImage($id);
        header('Location: Setting.php');
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <title>Document</title>
    </script>
</head>
<body>
<div class = "home-layout">
    <!-------------------------------sidebar-------------------------->
    <aside class="sidebar">
        <div class="sidebar-group">
            <svg class="icon-device" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M400 32C426.5 32 448 53.49 448 80V336C448 362.5 426.5 384 400 384H266.7L277.3 416H352C369.7 416 384 430.3 384 448C384 465.7 369.7 480 352 480H96C78.33 480 64 465.7 64 448C64 430.3 78.33 416 96 416H170.7L181.3 384H48C21.49 384 0 362.5 0 336V80C0 53.49 21.49 32 48 32H400zM64 96V320H384V96H64zM592 32C618.5 32 640 53.49 640 80V432C640 458.5 618.5 480 592 480H528C501.5 480 480 458.5 480 432V80C480 53.49 501.5 32 528 32H592zM544 96C535.2 96 528 103.2 528 112C528 120.8 535.2 128 544 128H576C584.8 128 592 120.8 592 112C592 103.2 584.8 96 576 96H544zM544 192H576C584.8 192 592 184.8 592 176C592 167.2 584.8 160 576 160H544C535.2 160 528 167.2 528 176C528 184.8 535.2 192 544 192zM560 400C577.7 400 592 385.7 592 368C592 350.3 577.7 336 560 336C542.3 336 528 350.3 528 368C528 385.7 542.3 400 560 400z"/></svg>
            <label for="" >Device Manager</label>
        </div>
        <div class="sidebar-group">
            <i class="fa-solid fa-laptop-medical"></i>
            <a href="./index.php">Dashboard</a>
        </div>
        <div class="sidebar-group">
            <i class="fa-solid fa-clock-rotate-left"></i>
            <a href="Logs.php" >Logs</a>
        </div>
        <div class="sidebar-group">
            <i class="fa-solid fa-gear"></i>
            <a href="#" class="active">Settings</a>
        </div>
    </aside>

    <!----------------------------    container------------------------>
    <div class="home-container">
        <!--          header            -->
        <header class="header">
            <div class="header-group">
                <?php
                if(sizeof($image) > 0){
                    $url = $image[0]["url"];
                    echo "<img src='$url' class ='image'>";
                }else{
                    echo "<i class='fa-solid fa-user icon-user'></i>";
                }
                ?>
                <span class='header-identity'>
                    <?php
                    echo $user[0]["email"];
                    ?>
                </span>
            </div>
        </header>

        <!--        content            -->
        <content class="content">
            <div class="content-wrapper setting">
                <form method="post" action="" class="form-image">
                    <div class="form-group">
                        <label for="" class="form-group_label">Ảnh đại diện:</label></br>
                        <textarea type="url" class="form-control" name="url"  accept="image/*" ><?php if(sizeof($image)>0) echo $image[0]['url']; ?></textarea>
                    </div>

                    <div class="form-submit">
                        <?php
                        if(sizeof($image) > 0){
                            echo "<button type='submit' class='btn-submit' name = 'update_image'>Thay đổi ảnh</button>";
                        }else{
                            echo "<button type='submit' class='btn-submit' name = 'add_image'>Thêm ảnh</button>";
                        }
                        ?>
                    </div>
                </form>

                <form method="post" action="">
                    <legend class="form-label">Thông tin người dùng</legend>
                    <div class="form-group">
                        <label for="" class="form-group_label">Tên người dùng:</label></br>
                        <input type="text" class="form-control" name="name" value="<?php echo $user[0]['name']?>">
                    </div>

                    <div class="form-group">
                        <label for="" class="form-group_label">Email:</label></br>
                        <input type="text" class="form-control" name="email" value="<?php echo $user[0]['email']?>">

                    </div>

                    <div class="form-group form-group-radio">
                        <label for="" class="form-group_label">Giới tính:</label>
                        <input type="radio" class="form-control_radio" name="gender" value="0" <?php echo ($user[0]['gender'] == 0)?'checked':('') ;?>>
                        <label for="gender" class="form-group_label">Female</label>
                        <input type="radio" class="form-control_radio" name="gender" value="1" <?php echo ($user[0]['gender'] == 1)?'checked':('') ;?>>
                        <label for="gender" class="form-group_label">Male</label>
                    </div>

                    <div class="form-group">
                        <label for="" class="form-group_label">Password:</label></br>
                        <input type="password" class="form-control" name="password" value="<?php echo $user[0]['password']?>">
                    </div>
                    <div class="error">
                        <?php
                        if(isset($_SESSION['err'])) {
                            foreach ($_SESSION['err'] as $err) {
                                echo "<span>*" . $err . "</span>";
                                echo "</br>";
                            }
                            unset($_SESSION['err']);
                        }
                        ?>
                    </div>
                    <div class="form-submit">
                        <button type="submit" class="btn-submit" name="update">Cập nhật thông tin</button>
                    </div>
                </form>
            </div>
        </content>
    </div>

</div>

</body>
</html>

<?php endif; ?>