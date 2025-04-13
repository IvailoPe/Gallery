<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="http://localhost/project-gallery/assets/css/log-reg-css.css">
    <script src="http://localhost/project-gallery/assets/js/log-regJS.js"></script>
</head>

<body>
<img style="width: 140px; height: 140px; margin: 100px auto 0 auto; display: block;" src="http://localhost/project-gallery/assets/officialSitePic/logo_ivo.png" alt="">
    <div id="login-register-box">
        <div id="options">
            <button id="login-btn-change">Login</button>
            <button id="register-btn-change">Register</button>
        </div>
        <div id="login-box">
            <form>
                <label for="username">Username</label>
                <input name="username" type="text">
                <div class="errors">
                </div>
                <label for="password">Password</label>
                <input name="password" type="password">
                <div class="errors"></div>
                <button>Login</button>
            </form>
        </div>
        <div id="register-box">
            <form>
                <label for="username">Username</label>
                <input name="username" type="text">
                <div class="errors"></div>
                <label for="password">Password</label>
                <input name="password" type="password">
                <div class="errors"></div>
                <label for="re-password">Re-Password</label>
                <input name="re-password" type="password">
                <div class="errors"></div>
                <button>Register</button>
            </form>
        </div>
    </div>
</body>
</html>