<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Favorit - Perpustakaan Digital</title>
  <style>
    body {
      margin: 0;
      font-family: sans-serif;
      background-color: #f0f0f0;
    }
    header {
      background: #2c3e50;
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
    h2 {
      text-align: center;
      margin-top: 30px;
    }
    .container {
      display: flex;
      flex-wrap: wrap;
      gap: 30px;
      justify-content: center;
      padding: 20px;
    }
    .buku {
      width: 220px;
      background: white;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      padding: 15px;
      box-sizing: border-box;
      text-align: center;
    }
    .buku img {
      width: 100%;
      height: 200px;
      object-fit: cover;
      border-radius: 6px;
      margin-bottom: 10px;
    }
    .buku h4 {
      margin: 5px 0;
      font-size: 16px;
    }
    .buku p {
      font-size: 14px;
      color: #333;
      margin: 0 0 10px;
    }
    .buku button {
      padding: 6px 10px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      background: #007bff;
      color: white;
      margin: 5px;
    }
    .hapus-btn {
      background-color: #dc3545;
    }
  </style>
</head>
<body>
  <header>
    <div><strong>Perpustakaan Digital</strong></div>
    <nav class="nav-links" id="navLinks">
      <a href="index.php">Beranda</a>
    <a href="tambah_buku.php">Tambah Buku</a>
    </nav>
  </header>

  <h2>Buku Favorit Anda</h2>
  <div class="container" id="favoritContainer"></div>

  <script>
    const favoritContainer = document.getElementById('favoritContainer');
    let favoritList = JSON.parse(localStorage.getItem('favoritList')) || [];

    function renderFavorit() {
      favoritContainer.innerHTML = '';
      if (favoritList.length === 0) {
        favoritContainer.innerHTML = '<p style="text-align:center; color:gray;">Belum ada buku favorit.</p>';
        return;
      }

      favoritList.forEach((buku, index) => {
        const div = document.createElement('div');
        div.className = 'buku';
        div.innerHTML = `
          <img src="${buku.sampul}" alt="${buku.judul}">
          <h4>${buku.judul}</h4>
          <p><strong>Penulis:</strong> ${buku.penulis}</p>
          <p><strong>Kategori:</strong> ${buku.kategori}</p>
          <button onclick="bacaBuku(${index})">Baca</button>
          <button class="hapus-btn" onclick="hapusFavorit(${index})">Hapus</button>
        `;
        favoritContainer.appendChild(div);
      });
    }

    function bacaBuku(index) {
      localStorage.setItem('bukuDibaca', JSON.stringify(favoritList[index]));
      window.location.href = 'baca.php';
    }

    function hapusFavorit(index) {
      if (confirm('Hapus dari favorit?')) {
        favoritList.splice(index, 1);
        localStorage.setItem('favoritList', JSON.stringify(favoritList));
        renderFavorit();
      }
    }

    renderFavorit();

    // Deteksi login
    const navLinks = document.getElementById("navLinks");
    const loginLink = document.getElementById("loginLink");
    const currentUser = JSON.parse(localStorage.getItem("currentUser"));
    if (currentUser) {
      loginLink?.remove();
      const halo = document.createElement("span");
      halo.style.marginLeft = "15px";
      halo.textContent = "Halo, " + currentUser.username;

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
