<?php
$activitise = getActivities(); 
if (isset($_GET['deleted']) && $_GET['deleted'] == 'success'): ?>
    <div class="alert alert-success" role="alert">
        กิจกรรมถูกลบสำเร็จ
    </div>
<?php endif;

renderView('Choose_activity_get', ['activitise' => $activitise]);


?>
