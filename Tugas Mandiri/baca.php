<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Baca Buku</title>
  <style>
    body {
      font-family: sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
    }

    header {
      background: #333;
      color: white;
      padding: 15px 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .nav-links a, .nav-links span {
      color: white;
      margin-left: 15px;
      text-decoration: none;
    }

    .kontainer {
      max-width: 900px;
      margin: 30px auto;
      background: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      text-align: center;
    }

    h1 {
      color: #333;
      font-size: 26px;
    }

    .info {
      margin: 15px 0;
      font-size: 16px;
    }

    .pdf-link a {
      display: inline-block;
      padding: 10px 20px;
      background-color: #007bff;
      color: white;
      text-decoration: none;
      border-radius: 6px;
      margin-top: 20px;
    }

    .pdf-link a:hover {
      background-color: #0056b3;
    }

    .pdf-error {
      color: red;
      margin-top: 20px;
      font-weight: bold;
    }
  </style>
</head>
<body>

  <header>
    <div><strong>Perpustakaan Digital</strong></div>
    <nav class="nav-links" id="navLinks">
      <a href="index.php">Beranda</a>
      <a href="favorit.php">Favorit</a>
    </nav>
  </header>

  <div class="kontainer">
    <h1 id="judul">Judul Buku</h1>
    <div class="info"><strong>Penulis:</strong> <span id="penulis"></span></div>
    <div class="info"><strong>Kategori:</strong> <span id="kategori"></span></div>
    <div id="pdf-link-container"></div>
  </div>

  <script>
    const buku = JSON.parse(localStorage.getItem('bukuDibaca'));
    const container = document.getElementById('pdf-link-container');

    if (buku) {
      document.getElementById('judul').textContent = buku.judul || '-';
      document.getElementById('penulis').textContent = buku.penulis || '-';
      document.getElementById('kategori').textContent = buku.kategori || '-';

      if (buku.pdf) {
        container.innerHTML = `<div class="pdf-link"><a href="${buku.pdf}" target="_blank">📄 Buka PDF</a></div>`;
      } else {
        container.innerHTML = `<div class="pdf-error">File PDF tidak tersedia.</div>`;
      }
    } else {
      document.body.innerHTML = '<p style="text-align:center; padding:50px;">Data buku tidak ditemukan.</p>';
    }

    // Deteksi login user
    const navLinks = document.getElementById("navLinks");
    const loginLink = document.getElementById("loginLink");
    const currentUser = JSON.parse(localStorage.getItem("currentUser"));

    if (currentUser) {
      loginLink?.remove();
      const halo = document.createElement("span");
      halo.textContent = "👋 Halo, " + currentUser.username;
      halo.style.marginLeft = "15px";

      const logout = document.createElement("a");
      logout.href = "#";
      logout.textContent = "Logout";
      logout.style.marginLeft = "15px";
      logout.onclick = () => {
        localStorage.removeItem("currentUser");
        alert("Berhasil logout.");
        window.location.reload();
      };

      navLinks.appendChild(halo);
      navLinks.appendChild(logout);
    }
  </script>
</body>
</html>
