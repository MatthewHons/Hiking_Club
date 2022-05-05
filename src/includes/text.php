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
    case 'updateSuccess':
        $return = 'The hike was updated successfully';
        $color = 'green';
        break;
    case 'updateFailed':
        $return = 'There was a problem updating the hike';
        $color = 'red';
        break;
    case 'deleteSuccess':
        $return = 'The hike was deleted successfully';
        $color = 'green';
        break;
    case 'wrongPwd':
        $return = 'The password don\'t match for that user.';
        $color = 'red';
        break;
    case 'noPseudo':
        $return = 'This username does not exist.';
        $color = 'red';
        break;
    case 'subscriptionSuccess':
        $return = 'Account created';
        $color = 'green';
        break;
    case 'subscriptionFailed':
        $return = 'Account Failed';
        $color = 'red';
        break;
    case 'emailUsed':
        $return = 'This email adress is already used. Please try again.';
        $color = 'red';
        break;
    case 'userNameUsed':
        $return = 'This username is already used. Please try again.';
        $color = 'red';
        break;
    case 'profilUpdate':
        $return = 'The profil was updated successfully';
        $color = 'green';
        break;
    case 'profilFailed':
        $return = 'There was a problem updating your profil';
        $color = 'red';
        break;
    case 'fillAll':
        $return = 'You need to fill all the fields';
        $color = 'red';
        break;

    default:
        print_r('error');
}
?>
<div class="text <?= $color ?>">
    <p><?= $return ?></p>
</div>