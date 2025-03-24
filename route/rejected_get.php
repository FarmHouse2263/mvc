<?php
$rejected = getRejectedReq_activity($_SESSION['id']);

renderView('/rejected_get', ['rejected' => $rejected]);
