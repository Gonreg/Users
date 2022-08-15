<!DOCTYPE html>
<html lang="en">
<body>
<meta charset="UTF-8">
<title>Title</title>
<div class="wrapper">
    <div class="header">
        <h2 class="sign-in">Регистрация</h2>
        <div class="button" onclick="location.href='/';"
        ">Вход
    </div>
</div>
<div class="clear"></div>

<form action='/account/register' method="post" id="register">
    <div>

        <label for="login"></label>
        <input type="text" class="user-input" name="login" id="login" placeholder="Введите логин"><br>
        <div class="login_invalid-feedback"></div>
    </div>

    <div>

        <label for="email"></label>
        <input type="email" class="form-control" name="email" id="email" placeholder="Введите Email"><br>
        <div class="email_invalid-feedback"></div>
    </div>

    <div>

        <label for="name"></label>
        <input type="text" class="user-input" name="name" id="name" placeholder="Введите имя"><br>
        <div class="name_invalid-feedback"></div>
    </div>

    <div>

        <label for="family"></label>
        <input type="text" class="user-input" name="family" id="family" placeholder="Введите фамилию"><br>
        <div class="family_invalid-feedback"></div>
    </div>

    <div>
        <label for="password"></label>
        <input type="password" class="user-input" name="password" id="password" placeholder="Введите пароль"><br>
        <div class="password_invalid-feedback"></div>
    </div>

    <div>
        <label for="password_repeat"></label>
        <input type="password" class="user-input" name="password_repeat" id="password_repeat"
               placeholder="Повторите пароль"><br>
        <div class="password_repeat_invalid-feedback"></div>
    </div>

    <input type="submit" value="Зарегестрироваться" />
</form>
</body>
</html>