<?php
session_start();
$user = (isset($_SESSION['user'])) ? $_SESSION['user']: [];
?>
<?php

ini_set('display_errors', 1);
use Controller\LogController;

include __DIR__ . '/vendor/autoload.php';
include('./Controller/LogController.php');
include('./model/Log/LogDb.php');
include('./model/Log/Log.php');
include('./model/database/DBConnect.php');

$total = 10;
if(isset($_GET["total"]) && !empty($_GET["total"])) $total = $_GET["total"];
$logController = new LogController();
$logs = $logController->getAllLog();
//$i = $_GET["numberPage"];
$arr = [];
if(isset($_GET["search"]) && !empty($_GET["search"])) {
    $search = $_GET["search"];
    foreach ($logs as $log){
        if($log["name_device"] == $search) array_push($arr, $log);
    }
}else{
    $arr = $logs;
}
$numberAllLogs = sizeof($arr);
$numberPages = (($numberAllLogs%$total) == 0) ? (floor($numberAllLogs/$total)) : (floor($numberAllLogs/$total) + 1);
if($numberPages == 0) $numberPages = 1;
$currentPage = 1;
//
//if( isset($_POST["page"])){
//    dd($_POST["page"]);
//}
//if(isset($_SESSION["currentPage"]) ) {
//    $currentPage = $_SESSION["currentPage"];
//    unset($_SESSION["currentPage"]);
//}
//echo $currentPage;

if($currentPage == $numberPages) $size = $numberAllLogs;
else $size = $currentPage*$total;

$renderLogs = [];
for ($i = ($currentPage-1)*$total; $i < $size; $i++){
    array_push($renderLogs, $arr[$i]);
}
//var_dump($renderLogs);
?>


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
            <a href="Logs.php" class="active">Logs</a>
        </div>
        <div class="sidebar-group">
            <i class="fa-solid fa-gear"></i>
            <a href="Setting.php">Settings</a>
        </div>
    </aside>

<!----------------------------    container------------------------>
    <div class="home-container">
<!--          header            -->
        <header class="header">
            <div class="header-group">
                <i class="fa-solid fa-user icon-user"></i>
                <span class='header-identity'>
                    <?php
                    echo $user[0]["email"];
                    ?>
                </span>
            </div>
        </header>

<!--        content            -->
        <content class="content">
            <div class="content-wrapper">
                <div class="content-search">
                    <span>Action Logs</span>
                    <form class="total-device" method="GET" action="">
                        <span>Total: </span>
                        <input type="number" name="total" id="total" value="<?php echo $total;?>">
                        <button type="submit">Select</button>
                    </form>
                    <form class="search" method="get" action="">
                        <input type="text" name="search" id="search" placeholder="name">
                        <button type="submit">Search</button>
                    </form>
                </div>
                <div class="content-table">
                    <table>
                        <thead>
                        <tr>
                            <th scope="col">Device ID#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Action</th>
                            <th scope="col">Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($renderLogs as $log){
                            echo "<tr>";
                            echo "<td >".$log['id']."</td>";
                            echo "<td >".$log['name_device']."</td>";
                            echo "<td >".$log['action']."</td>";
                            echo "<td >".$log['date']."</td>";
                            echo "</tr>";
                        }
                        ?>

                        <tr>
                            <th class="total-label">Total</th>
                            <th></th>
                            <th></th>
                            <th class="total-page"><?php echo $total;?></th>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="pagination">
                    <?php

                    for ($i = 1; $i <= $numberPages; $i++){
                        if($i == $currentPage) {
                            echo "<span class='active'>$i</span>";
                        }
                        else echo "<span>$i</span>";
                    }

//                    for ($i = 1; $i <= $numberPages; $i++){
//                        if($i == $currentPage) {
//                            echo "<a href='Logs.php'>";
//                            echo "<form method='post'>";
//                            echo "<button type='submit'' name='page' class='active'>";
/*                            echo "<?php $currentPage = $i ?>";*/
//                            if(isset($_SESSION["currentPage"])) $_SESSION["currentPage"] = $i;
//                            echo "$i";
//                            echo "</button>";
//                            echo "</form>";
//                            echo "</a>";
//                        }
//                        else {
//                            echo "<a href='Logs.php'>";
//                            echo "<form method='post'>";
//                            echo "<button type='submit'' name='page'>";
/*                            echo "<?php $currentPage = $i ?>";*/
//                            if(isset($_SESSION["currentPage"])) $_SESSION["currentPage"] = $i;
//                            echo "$i";
//                            echo "</button>";
//                            echo "</form>";
//                            echo "</a>";
//                        };
//                    }

                    ?>
                    <form class="" method="get" action="">
                        <input name="currentPage" type="number" min="1" max="<?php echo $numberPages?>"
                               placeholder="<?php echo $currentPage."/".$numberPages; ?>" >
                        <button type="submit">Go</button>
                    </form>

                </div>
            </div>
        </content>
    </div>

</div>

</body>
</html>
