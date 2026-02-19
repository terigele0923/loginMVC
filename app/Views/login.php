<?php
if(!empty($error)) {
    echo "<p style='color:red;'>$error</p>";
}
?>
<!DOCTYPE html>
<html lang="jp">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
</head>
<body>
  <form method="POST" action="index.php?action=login">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br><br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br><br>
    <button type="submit">Login</button>
  </form>
  <p><a href="index.php?action=register">Create Account</a></p>
</body>
</html>
