<!DOCTYPE html>
<html lang="en">

<body>
<meta charset="UTF-8">
<title>Title</title>

<div class="wrapper">
    <div class="header">
        <h3 class="sign-in">Вход</h3>
        <div class="button" onclick="location.href='/account/register';"">
            Регистрация
        </div>
    </div>
    <div class="clear"></div>
    <form action = '/' method="post" id = 'loginAction'>
            <div>
                <label class="user" for="text">
                    <svg viewBox="0 0 32 32">
                        <g filter="">
                            <use xlink:href="#man-people-user"></use>
                        </g>
                    </svg>
                </label>
                <input class="user-input" type="text" name="login" id="login" placeholder="Введите логин"><br>
                <div class="login_invalid-feedback"></div>
            </div>

            <div>
                <label class="lock" for="password">
                    <svg viewBox="0 0 32 32">
                        <g filter="">
                            <use xlink:href="#lock-locker"></use>
                        </g>
                    </svg>
                </label>
                <input type="password" class="form-control" name="password" id="pass" placeholder="Введите пароль"><br>
                <div class="password_invalid-feedback"></div>
            </div>

            <div>
                <input type="submit" value="Войти" />
            </div>

        </form>

</body>
</html>