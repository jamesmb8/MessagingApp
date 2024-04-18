<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header>
        <nav class="navbar">
            <div class="navbar-title">Blog</div>
            <div class="navbar-menu">
                <a href="index.php" class="navbar-link">Sign up</a>
            </div>
        </nav>

    </header>
    <div class="container">
        <form class="login-form" action="login.php" method="POST">
            <h2>Login</h2>
            <div class="form-group">
                <label for="email">Username:</label>
                <input type="username" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button href="blogpage.php" type="submit">Login</button>
            <div class="signup-link">

            </div>
        </form>
    </div>
</body>

</html>