<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Tambah Buku</title>
  <style>
    body {
      font-family: sans-serif;
      margin: 0;
      background: #f0f8ff;
    }

    header {
      background: rgba(0, 0, 0, 0.7);
      color: white;
      padding: 15px 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      position: sticky;
      top: 0;
      z-index: 100;
    }

    .nav-links a {
      color: white;
      margin-left: 15px;
      text-decoration: none;
    }

    main {
      max-width: 500px;
      margin: 50px auto;
      padding: 30px;
      background: white;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    h2 {
      text-align: center;
      color: #333;
    }

    label {
      display: block;
      margin-top: 15px;
      font-weight: bold;
    }

    input, select {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 6px;
      box-sizing: border-box;
    }

    button {
      margin-top: 20px;
      width: 100%;
      padding: 12px;
      background: #007bff;
      color: white;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-size: 16px;
    }

    button:hover {
      background: #0056b3;
    }

    .message {
      margin-top: 15px;
      text-align: center;
      color: green;
    }
  </style>
</head>
<body>
  <header>
    <div><strong>Perpustakaan Digital</strong></div>
    <nav class="nav-links">
      <a href="index.php">Beranda</a>
      <a href="tambah_buku.php">Tambah Buku</a>
      <a href="favorit.php">Favorit</a>
    </nav>
  </header>

  <main>
    <h2>Tambah Buku Baru</h2>
    <form id="formTambahBuku">
      <label for="judul">Judul Buku</label>
      <input type="text" id="judul" required>

      <label for="penulis">Penulis</label>
      <input type="text" id="penulis" required>

      <label for="kategori">Kategori</label>
      <input type="text" id="kategori" required>

      <label for="sampul">URL Gambar Sampul</label>
      <input type="text" id="sampul">

      <label for="rating">Rating</label>
      <input type="number" step="0.1" min="0" max="5" id="rating" required>

      <button type="submit">Simpan Buku</button>
    </form>
    <div class="message" id="pesan"></div>
  </main>

  <script>
    document.getElementById('formTambahBuku').addEventListener('submit', function(e) {
      e.preventDefault();

      const bukuBaru = {
        judul: document.getElementById('judul').value,
        penulis: document.getElementById('penulis').value,
        kategori: document.getElementById('kategori').value,
        sampul: document.getElementById('sampul').value,
        rating: parseFloat(document.getElementById('rating').value)
      };

      const bukuList = JSON.parse(localStorage.getItem('bukuList')) || [];
      bukuList.push(bukuBaru);
      localStorage.setItem('bukuList', JSON.stringify(bukuList));

      document.getElementById('pesan').textContent = 'Buku berhasil ditambahkan!';
      this.reset();
    });
  </script>
</body>
</html>
