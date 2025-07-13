<?php session_start(); ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Perpustakaan Digital</title>
  <style>
    body { margin: 0; padding: 0; font-family: sans-serif; }
    header {
      background: rgba(0,0,0,0.7); color: white; padding: 15px 30px;
      display: flex; justify-content: space-between; align-items: center;
      position: sticky; top: 0; z-index: 100;
    }
    .nav-links a, .nav-links span {
      color: white; margin-left: 15px; text-decoration: none;
    }
    .nav-links form { display: inline; }
    .nav-links button {
      background: transparent; color: white; border: none;
      cursor: pointer; margin-left: 15px; font-size: 1em;
    }

    .buku-buttons {
      display: flex;
      gap: 10px;
      margin-top: 10px;
    }

    .buku-buttons button {
      padding: 8px 14px;
      font-size: 14px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: 0.3s ease;
    }

    .buku-buttons button.baca {
      background-color: #4CAF50;
      color: white;
    }

    .buku-buttons button.favorit {
      background-color: #2196F3;
      color: white;
    }

    .buku-buttons button.baca:hover {
      background-color: #45a049;
    }

    .buku-buttons button.favorit:hover {
      background-color: #1976D2;
    }
  </style>
</head>
<body>

<header>
  <div><strong>iPerpus</strong></div>
  <nav class="nav-links">
    <a href="index.php">Beranda</a>
    <a href="tambah_buku.php">Tambah Buku</a>
    <a href="favorit.php">Favorit</a>
    <?php if (isset($_SESSION['username'])): ?>
      <span>Halo, <?= htmlspecialchars($_SESSION['username']) ?></span>
      <form action="logout.php" method="POST"><button type="submit">Logout</button></form>
    <?php else: ?>
      <a href="login.html">Login</a>
    <?php endif; ?>
  </nav>
</header>

<section class="hero" style="height: 100vh; background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?auto=format&fit=crop&w=1920&q=80') center/cover no-repeat; color: white; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center; padding: 20px;">
  <h1 style="font-size: 40px; margin-bottom: 20px;">Selamat datang di Perpustakaan Digital</h1>
  <p style="max-width: 700px; font-size: 18px; line-height: 1.6;">
    Temukan berbagai koleksi buku digital dari berbagai kategori apapun, di mana pun.<br/>
    Perpustakaan Digital menghadirkan pengalaman membaca yang mudah, cepat, dan menyenangkan hanya lewat satu klik.
  </p>
</section>

<section id="daftar-buku" style="background: linear-gradient(to bottom right, #f0f8ff, #e6f2ff); padding: 40px 20px;">
  <h3 style="text-align: center; font-size: 24px; margin-bottom: 20px; color: #333;">Daftar Buku</h3>
  <div style="max-width: 1100px; margin: auto;">
    <div style="display: flex; justify-content: center; margin-bottom: 30px;">
      <input type="text" id="searchInput" placeholder="Cari buku..." style="width: 300px; padding: 10px; font-size: 16px;">
    </div>
    <div id="buku-container" style="display: flex; justify-content: center; flex-wrap: wrap; gap: 30px;"></div>
  </div>
</section>

<section style="padding: 40px 20px; background-color: #222; color: white; text-align: center;">
  <h3 style="font-size: 24px; margin-bottom: 10px;">Hubungi Kami</h3>
  <p style="margin-bottom: 20px;">Punya pertanyaan, saran, atau ingin berkolaborasi? Kami siap mendengarkan!</p>
  <p>Email: <a href="mailto:krniawaneka@gmail.com" style="color: #00c8ff;">krniawaneka@gmail.com</a></p>
  <p>WhatsApp: <a href="https://wa.me/62895802693377" target="_blank" style="color: #00ffae;">+62 895-8026-9337-7</a></p>
  <div style="margin-top: 20px;">
    <h4>Ikuti Kami:</h4>
    <a href="https://www.instagram.com/kapuutra/" target="_blank" style="color: #fff; margin: 0 10px;">Instagram</a>
    <a href="https://www.facebook.com/ElengMC/" target="_blank" style="color: #fff; margin: 0 10px;">Facebook</a>
    <a href="https://x.com/kae_yujin" target="_blank" style="color: #fff; margin: 0 10px;">Twitter</a>
  </div>
</section>

<script>
const bukuContainer = document.getElementById('buku-container');
const searchInput = document.getElementById('searchInput');

const defaultBooks = [
  {judul: "Negeri 5 Menara", penulis: "Ahmad Fuadi", sampul: "https://e-library.banjarmasinkota.go.id/storage/book_cover/1708476835_Negeri%205%20Menara.jpg", kategori: "Fiksi", rating: 4.6, isi: "", pdf: "Negeri 5 Menara.pdf"},
  {judul: "Laskar Pelangi", penulis: "Andrea Hirata", sampul: "https://i.pinimg.com/736x/59/c1/55/59c155af6177866a3143df5dd9159ea1.jpg", kategori: "Fiksi", rating: 4.8, isi: "", pdf: "laskar-pelangi.pdf"},
  {judul: "Atomic Habits", penulis: "James Clear", sampul: "https://images-na.ssl-images-amazon.com/images/I/91bYsX41DVL.jpg", kategori: "Pengembangan Diri", rating: 4.9, isi: "", pdf: "atomic-habits.pdf"},
  {judul: "Doraemon", penulis: "Fujiko F. Fujio", sampul: "https://awsimages.detik.net.id/community/media/visual/2023/11/10/manga-doraemon-plus.jpeg?w=600&q=90", kategori: "Komik", rating: 4.7, isi: "", pdf: "doraemon.pdf"},
  {judul: "Detective Conan", penulis: "Gosho Aoyama", sampul: "https://cdn.gramedia.com/uploads/products/3o3i8-03tc.jpg", kategori: "Komik", rating: 4.5, isi: "", pdf: "Detective Conan.pdf"},
  {judul: "Harry Potter", penulis: "J.K. Rowling", sampul: "https://images-na.ssl-images-amazon.com/images/I/81YOuOGFCJL.jpg", kategori: "Fantasi", rating: 5.0, isi: "", pdf: "Harry Potter .pdf"},
  {judul: "Si Anak Spesial", penulis: "Tere Liye", sampul: "https://bukukita.com/babacms/displaybuku/117409_f.jpg", kategori: "Fiksi", rating: 4.4, isi: "", pdf: "si-anak-spesial.pdf"},
  {judul: "One Piece", penulis: "Eiichiro Oda", sampul: "https://onepieceberwarna.com/komik/ATS/VOL%20106/1076/01.jpg", kategori: "Komik", rating: 4.9, isi: "", pdf: "one-piece.pdf"}
];

let userBooks = JSON.parse(localStorage.getItem('bukuList')) || [];
let bukuData = [...defaultBooks, ...userBooks];

function renderBuku(judul = '') {
  bukuContainer.innerHTML = '';
  bukuData
    .filter(b => b.judul.toLowerCase().includes(judul.toLowerCase()))
    .forEach((buku, i) => {
      const div = document.createElement('div');
      div.className = 'buku';
      div.style = 'width: 220px; background: white; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); padding: 15px;';
      div.innerHTML = `
        <img src="${buku.sampul}" alt="${buku.judul}" style="width: 100%; height: 200px; object-fit: cover; border-radius: 6px; margin-bottom: 10px;">
        <h4>${buku.judul}</h4>
        <p><strong>Penulis:</strong> ${buku.penulis}</p>
        <p><strong>Kategori:</strong> ${buku.kategori}</p>
        <div class="rating">⭐ ${buku.rating?.toFixed(1) || '4.0'}</div>
        <div class="buku-buttons">
          <button class="baca" onclick="bacaBuku(${i})">Baca</button>
          <button class="favorit" onclick="tambahFavorit(${i})">Favorit</button>
          ${i >= defaultBooks.length ? `<button onclick='hapusBuku(${i - defaultBooks.length})' style="background-color:#f44336;color:white;border:none;border-radius:8px;">Hapus</button>` : ''}
        </div>
      `;
      bukuContainer.appendChild(div);
    });
}

function bacaBuku(index) {
  localStorage.setItem('bukuDibaca', JSON.stringify(bukuData[index]));
  window.location.href = 'baca.php';
}

function tambahFavorit(index) {
  const favorit = JSON.parse(localStorage.getItem('favoritList')) || [];
  favorit.push(bukuData[index]);
  localStorage.setItem('favoritList', JSON.stringify(favorit));
  alert('Buku ditambahkan ke favorit!');
}

function hapusBuku(index) {
  if (confirm('Yakin ingin menghapus buku ini?')) {
    userBooks.splice(index, 1);
    localStorage.setItem('bukuList', JSON.stringify(userBooks));
    bukuData = [...defaultBooks, ...userBooks];
    renderBuku(searchInput.value);
  }
}

searchInput.addEventListener('input', () => renderBuku(searchInput.value));
renderBuku();
</script>

</body>
</html>
