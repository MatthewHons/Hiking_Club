<?php
$text = $_GET['message'];
$return = '';
$color = '';
switch ($text) {
    case 'createdSuccess':
        $return = 'The hike was created successfully';
        $color = 'green';
        break;
    case 'createdFailed':
        $return = 'There was a problem creating the hike';
        $color = 'red';
        break;

    default:
        print_r('error');
}
?>
<div class="text <?= $color ?>">
    <p><?= $return ?></p>
</div>