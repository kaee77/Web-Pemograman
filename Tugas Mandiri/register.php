<?php session_start(); ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Register</title>
  <style>
    * {
      box-sizing: border-box;
    }

    body, html {
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', sans-serif;
      height: 100vh;
      overflow: hidden;
    }

    body {
      background: linear-gradient(-45deg, #0f2027, #203a43, #2c5364, #0f2027);
      background-size: 400% 400%;
      animation: gradientBG 20s ease infinite;
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
    }

    @keyframes gradientBG {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    .register-container {
      background: white;
      padding: 50px 40px;
      border-radius: 16px;
      box-shadow: 0 12px 30px rgba(0, 0, 0, 0.25);
      width: 100%;
      max-width: 500px;
      animation: fadeIn 1s ease;
      z-index: 10;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .register-container h2 {
      text-align: center;
      margin-bottom: 30px;
      color: #222;
      font-size: 26px;
    }

    input[type="text"], input[type="password"] {
      width: 100%;
      padding: 14px;
      margin-bottom: 20px;
      border-radius: 10px;
      border: 1px solid #ccc;
      font-size: 16px;
      transition: 0.3s;
    }

    input:focus {
      border-color: #2575fc;
      outline: none;
    }

    button {
      width: 100%;
      padding: 14px;
      background-color: #2575fc;
      color: white;
      border: none;
      border-radius: 10px;
      font-size: 17px;
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    button:hover {
      background-color: #1b5ede;
    }

    .login-link {
      text-align: center;
      margin-top: 20px;
      font-size: 15px;
    }

    .login-link a {
      color: #2575fc;
      text-decoration: none;
      font-weight: bold;
    }

    .login-link a:hover {
      text-decoration: underline;
    }

    .error {
      color: red;
      text-align: center;
      margin-top: 10px;
      font-size: 14px;
    }

    /* BUBBLES */
    .bubble {
      position: absolute;
      bottom: -100px;
      background: rgba(255, 255, 255, 0.1);
      border-radius: 50%;
      animation: rise 10s infinite ease-in;
      z-index: 1;
    }

    @keyframes rise {
      0% { transform: translateY(0) scale(1); opacity: 1; }
      100% { transform: translateY(-1200px) scale(1.5); opacity: 0; }
    }

    /* STARS */
    .star {
      position: absolute;
      width: 2px;
      height: 2px;
      background: white;
      border-radius: 50%;
      animation: moveStars 20s linear infinite;
      z-index: 0;
    }

    @keyframes moveStars {
      0% { transform: translateY(0); opacity: 1; }
      100% { transform: translateY(1000px); opacity: 0; }
    }
  </style>
</head>
<body>

  <!-- Bubble Animations -->
  <div class="bubble" style="left: 20%; width: 40px; height: 40px;"></div>
  <div class="bubble" style="left: 45%; width: 25px; height: 25px; animation-delay: 2s;"></div>
  <div class="bubble" style="left: 70%; width: 60px; height: 60px; animation-delay: 4s;"></div>
  <div class="bubble" style="left: 85%; width: 35px; height: 35px; animation-delay: 1.5s;"></div>

  <!-- Starfield -->
  <script>
    for (let i = 0; i < 100; i++) {
      const star = document.createElement('div');
      star.className = 'star';
      star.style.left = Math.random() * window.innerWidth + 'px';
      star.style.top = Math.random() * -window.innerHeight + 'px';
      star.style.animationDuration = 5 + Math.random() * 15 + 's';
      document.body.appendChild(star);
    }
  </script>

  <!-- Register Form -->
  <div class="register-container">
    <h2>Daftar Akun Baru</h2>
    <form action="register_procces.php" method="POST">
      <input type="text" name="username" placeholder="Username" required />
      <input type="password" name="password" placeholder="Password" required />
      <input type="password" name="konfirmasi_password" placeholder="Konfirmasi Password" required />
      <button type="submit">Daftar</button>
    </form>
    <?php if (isset($_SESSION['register_error'])): ?>
      <div class="error"><?= $_SESSION['register_error']; unset($_SESSION['register_error']); ?></div>
    <?php endif; ?>

    <div class="login-link">
      Sudah punya akun? <a href="login.html">Login di sini</a>
    </div>
  </div>

</body>
</html>
