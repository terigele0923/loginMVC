<?php if(!empty($error)) {
    echo "<p style='color:red;'>$error</p>";
} ?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User info</title>
</head>
<body>
  <p>Logged in: <?= htmlspecialchars($_SESSION['user']['email'] ?? '') ?></p>
  <table border="1">
    <tr>
      <th>ID</th>
      <th>Email</th>
      <th>Created At</th>
    </tr>
    <?php foreach ($users as $u): ?>
      <tr>
        <td><?= htmlspecialchars($u['id']) ?></td>
        <td><?= htmlspecialchars($u['email']) ?></td>
        <td><?= htmlspecialchars($u['created_at']) ?></td>
      </tr>
    <?php endforeach; ?>
  </table>
  <p><a href="index.php?action=logout">Logout</a></p>
</body>
</html>
