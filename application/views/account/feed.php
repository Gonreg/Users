<!DOCTYPE html>
<html lang="en">
<body>
<meta charset="UTF-8">
<title>Title</title>
<div class="wrapper">
    <div class="header">
        <h3 class="sign-in"><?php echo 'Добро пожаловать, ' . $_COOKIE['name'] ?></h3>
    </div>
    <button class="logout" onclick="window.location.href = '/account/logout';">Выйти</button>
</div>
<div class="clear"></div>

</body>
</html>