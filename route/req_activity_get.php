<?php
$activitise = getAllReq_activity($_SESSION['id']);

renderView('req_activity_get', ['activitise' => $activitise]);
