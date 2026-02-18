<?php
declare(strict_types=1);
/** @var array $errors */
/** @var string $email */
/** @var string $success */
?>
<!doctype html>
<html lang="ja">
<head>
  <meta charset="utf-8" />
  <title>ログイン</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <style>
    body { font-family: system-ui, sans-serif; max-width: 420px; margin: 40px auto; padding: 0 16px; }
    .card { border: 1px solid #ddd; border-radius: 10px; padding: 16px; }
    .error { background: #fff3f3; border: 1px solid #f2bcbc; padding: 10px; border-radius: 8px; margin-bottom: 12px; }
    .success { background: #f0fff4; border: 1px solid #b7ebc6; padding: 10px; border-radius: 8px; margin-bottom: 12px; }
    label { display: block; margin: 10px 0 4px; }
    input { width: 100%; padding: 10px; box-sizing: border-box; }
    button { margin-top: 14px; width: 100%; padding: 10px; }
  </style>
</head>
<body>
  <div class="card">
    <h1>ログイン</h1>

    <?php if (!empty($errors)): ?>
      <div class="error">
        <ul>
          <?php foreach ($errors as $e): ?>
            <li><?= htmlspecialchars($e, ENT_QUOTES, 'UTF-8') ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>

    <?php if ($success !== ''): ?>
      <div class="success">
        <?= htmlspecialchars($success, ENT_QUOTES, 'UTF-8') ?>
      </div>
    <?php endif; ?>

    <form method="post" action="<?= htmlspecialchars($basePath, ENT_QUOTES, 'UTF-8') ?>/">
      <label for="email">メールアドレス</label>
      <input id="email" name="email" type="email" value="<?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8') ?>" required />

      <label for="password">パスワード</label>
      <input id="password" name="password" type="password" required />

      <button type="submit">ログイン</button>
    </form>
  </div>
</body>
</html>
