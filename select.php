<?php
require_once("funcs.php");
require_once("db.php");
try {
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    exit('DB Connection Error:' . $e->getMessage());
}

$stmt = $pdo->prepare("SELECT * FROM kadai09_table;");
$status = $stmt->execute();

$view = "";
if ($status == false) {
    $error = $stmt->errorInfo();
    exit("ErrorQuery:" . $error[2]);
} else {
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $view .= "<p>";
        $view .= h($result["id"]) . "　" . h($result["date"]) . "　/　"
            . h($result["name"]) . "　/　" . h($result["myScore"]) . "問連続正解";
        $view .= '<a href="delete.php?id=' . $result['id'] . '">';
        $view .= '[削除]';
        $view .= '</a>';
        $view .= "</p>";
    }
}
