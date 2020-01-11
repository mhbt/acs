<?php
session_start();
if(!isset($_SESSION["credentials"])){
    header("Location: ./login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<?php
require_once "./partials/head.php";
?>
<body class="fix-header fix-sidebar card-no-border">
<?php
require_once "./partials/preloader.php";
require_once "./partials/main-wrapper-start.php";
require_once "./partials/header.php";
require_once "./partials/sidebar.php";
//----------------------------------------
// Add Your Page Here
//----------------------------------------
require_once "./partials/humw-page.php";
require_once "./partials/main-wrapper-end.php";
require_once "./partials/web-scripts.php";
?>
<!-- ============================================================== -->
<!--graph script-->
 <!-- npk SEASON graph -->
 <script src="./dark/js/weekly/humidity/weeklyhumidity1.js"></script>

</body>
</html>