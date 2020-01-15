<?php
    require_once "./helpers/db.php";
    require_once "./helpers/common.php";
    $proId = $_GET['id'];
    $star = $_POST['star'];
    $content = isset($_POST["content"]) ? $_POST['content'] : '';
    $loi='';
    $UNIT_URL=$_SESSION['UNIT_URL'];
    $sqlquery = "SELECT * FROM comments WHERE product_id = '$proId'";
    $comments = executeQuery($sqlquery, true);
    $user_id = $_SESSION['auth']['id'];
    if (count($comments) > 0) {
        $totalStar = 0;
        foreach ($comments as $key => $comm) {
            $totalStar += $comm['star'];
        }
        $avgStar = $totalStar / count($comments);
        $newStar = ($totalStar + $star) / (count($comments) + 1);
    } else {
        $newStar = $star;
    }
    if (isset($_POST['ok'])){
        if($_POST["content"]==''){
            $loi= "*xin vui long nhap binh luan";
            header("location: $UNIT_URL&loi=$loi");
        }else {
            $commentQuery="INSERT INTO comments (`content`, `status`, product_id, `user_id`, star) VALUES ('$content', 0, $proId, $user_id, $star)" ;
            executeQuery($commentQuery);
            $updateStarQuery = "update products set star = $newStar where id = $proId";
            executeQuery($updateStarQuery);    
        }
    }
    header("location: $UNIT_URL");
?>