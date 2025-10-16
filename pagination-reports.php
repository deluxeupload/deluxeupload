<?php
    include_once "dash-board.php";
    $itemsPerPageRep = 4;
    $pageRep = isset($_GET['page_reps']) ? (int)$_GET['page_reps'] : 1;
    if($pageRep < 1) $pageRep = 1;
    $totalItemsRep = count($reps);
    $totalPagesRep = ceil($totalItemsRep / $itemsPerPageRep);
    $start = ($pageRep - 1) * $itemsPerPageRep;
    $currentReps = array_slice($reps,$start,$itemsPerPageRep);
?>