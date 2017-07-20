<?php
header("Content-Type: text/html; charset=UTF-8");
require_once("login.php");
login();
$host = "localhost";
$user = "root";
$pass = "dbpass";
$dbname = "uploader";
$tbname = "event";

$link = mysqli_connect($host,$user,$pass,$dbname);
if(!$link){ exit("データベース接続エラー"); }

$result = mysqli_query($link,"SELECT * FROM $tbname");
if(!$result){ exit("データベース取得エラー"); }

mysqli_close($link);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
    <header>
        <h1>イベント一覧</h1>
    </header>
    <main>
    <div id="event-list">
        <?php while($row = mysqli_fetch_assoc($result)): ?>
        <table>
            <tr>
                <th>イベント名</th>
                <td><?= $row['name']?></td>
            </tr>
            <tr>
                <th>締め切り日</th>
                <td><?= $row['deadline']?></td>
            </tr>
            <tr>
                <td colspan="2">
                    <form class="delete-form" action="admin_eventdelete_confirm.php" method="POST">
                        <input type="hidden" name="name" value="<?= $row['name']?>">
                        <input type="hidden" name="deadline" value="<?= $row['deadline']?>">
                        <input type="hidden" name="deleteID" value="<?= $row['id']?>">
                        <button class="delete-button" type="sibmit" class="delete-button">削除</button>
                    </form>
                </td>
            </tr>
        </table>
        <?php endwhile;
        mysqli_free_result($result);
        ?>
    </div>
    <a class="link-button1" href="admin.php">戻る</a>
    </main>
    <footer>
    </footer>
</body>
</html>