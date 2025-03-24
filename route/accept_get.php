<?php
    $accept = getApprovedReq_activity($_SESSION['id']);
    renderView('/accept_get', ['accept' => $accept]);
?>
