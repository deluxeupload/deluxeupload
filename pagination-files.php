<?php
    include_once "dash-board.php";
    $itemsPerPage = 4;
    $page = isset($_GET['page_files']) ? (int)$_GET['page_files'] : 1;
    if($page < 1) $page = 1;
    $totalItems = count($files);
    $totalPages = ceil($totalItems / $itemsPerPage);
    $start = ($page - 1) * $itemsPerPage;
    $currentFiles = array_slice($files,$start,$itemsPerPage);
?>