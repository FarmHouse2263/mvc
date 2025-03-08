<?php
$activitise = getActivities();
renderView('header', ['activitise' => $activitise]);