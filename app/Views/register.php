<?php if(!empty($error)) {
    echo "<p style='color:red;'>$error</p>";
} ?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Account</title>
</head>
<body>
  <form method="POST" action="index.php?action=register">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br><br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br><br>
    <button type="submit">Create Account</button>
  </form>
  <p><a href="index.php?action=login">Login</a></p>
</body>
</html>
