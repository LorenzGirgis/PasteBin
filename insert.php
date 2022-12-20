<?php
session_start();
include "connection.php";

$id = uniqid();
$_SESSION["id"] = $id;
$content = $_POST["content"];
$syntax = $_POST["syntax-highlighting"];
$_SESSION["syntax"] = $syntax;
$template = file_get_contents("template.php");

$stmt = $conn->prepare("INSERT INTO pastes (id, content, syntax) VALUES (:id, :content, :syntax)");
$stmt->bindParam(":id", $id);
$stmt->bindParam(":content", $content);
$stmt->bindParam(":syntax", $syntax);
$stmt->execute();

$paste = fopen("pastes/" . $id . ".php", "w");
fwrite($paste, $template);

header("Location: pastes/" . $id . ".php");
?>