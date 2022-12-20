<?php
session_start();
include "../connection.php";

$id = $_SESSION["id"];

$stmt = $conn->prepare("SELECT content FROM pastes WHERE id = :id");
$stmt->bindParam(":id", $id);
$stmt->execute();

$result = $stmt->fetch();

include "../geshi/geshi.php";

$source = $result["content"];
$syntax = $_SESSION["syntax"];

switch ($syntax) {
    case "None":
        $language = 'text';
        break;
    // case "PHP":
    //     $language = 'php';
    //     break;
    case "HTML":
        $language = 'html4strict';
        break;
    case "CSS":
        $language = 'css';
        break;
    case "SQL":
        $language = 'mysql';
        break;
}

$geshi = new GeSHi($source, $language);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bitbin</title>
    <link rel="stylesheet" href="../css/paste.css">
    <link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon">
</head>

<body>
    <h1 class="logo">
        <span style="color:#000563">B</span>
        <span style="color:#D75065">i</span>
        <span style="color:#333782">t</span>
        <span style="color:#000563">B</span>
        <span style="color:#D75065">i</span>
        <span style="color:#333782">n</span>
    </h1>
    <div class="button-tooltip-container">
    <button title="copy share link" type="submit" value="copy" onclick="copy();" class=copybutton><svg width="22" height="22" viewBox="0 0 20 20" version="1.1"><path fill="#000" d="M20,18.2V19H0v-1.5h16.4h2.1V5.2H20V18.2z M1.5,11.3V5.2H0v12.3h1.5V11.3z M9.2,12.8V0.5h1.5v12.3H9.2z M4.6,5.2h1.5v1.5H4.6V5.2z M6.2,3.6h1.5v1.5H6.2V3.6z M13.8,5.2h1.5v1.5h-1.5V5.2z M12.3,3.6h1.5v1.5h-1.5V3.6z M10.8,2.1h1.5v1.5h-1.5V2.1zM7.7,2.1h1.5v1.5H7.7V2.1z"></path></svg></button>
    <span id="custom-tooltip">copied!</sapn>
</div>

<textarea class=visuallyhidden id="box"></textarea>
<div class="container">
        <?php echo $geshi->parse_code(); ?>
    </div>
    <div class="div-buttons">
        <div class="button">
        <button id="button">Share BitBin</button>
        <button id="button">Edit BitBin</button>
        <a href="/"><button>Main Page</button></a>
    </div>
    </div>
    <script src="../javascript/copied.js"></script>
    <script src="../javascript/button.js"></script>
</body>

</html>