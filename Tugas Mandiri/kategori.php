<section id="daftar-buku" style="background: linear-gradient(to bottom right, #f0f8ff, #e6f2ff); padding: 40px 20px;">
  <style>
    #buku-container {
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
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      min-height: 350px;
      transition: transform 0.2s;
    }

    .buku:hover {
      transform: translateY(-5px);
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
      margin: 5px auto 0;
      padding: 6px 10px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      background: #007bff;
      color: white;
    }

    .buku .hapus-button {
      background: #dc3545;
    }

    #search-filter {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 10px;
      margin-bottom: 30px;
    }

    #searchInput, #kategoriFilter {
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 6px;
    }
  </style>

  <h3 style="text-align: center; font-size: 24px; margin-bottom: 20px; color: #333;">Daftar Buku</h3>
  <div id="search-filter">
    <input type="text" id="searchInput" placeholder="Cari buku...">
    <select id="kategoriFilter">
      <option value="">Semua Kategori</option>
      <option value="Fiksi">Fiksi</option>
      <option value="Pengembangan Diri">Pengembangan Diri</option>
      <option value="Komik">Komik</option>
      <option value="Fantasi">Fantasi</option>
      <option value="Sejarah">Sejarah</option>
    </select>
  </div>
  <div id="buku-container"></div>

  <script>
    const bukuContainer = document.getElementById('buku-container');
    const searchInput = document.getElementById('searchInput');
    const kategoriFilter = document.getElementById('kategoriFilter');

    const defaultBooks = [
      {
        judul: "Negeri 5 Menara",
        penulis: "Ahmad Fuadi",
        sampul: "https://e-library.banjarmasinkota.go.id/storage/book_cover/1708476835_Negeri%205%20Menara.jpg",
        kategori: "Fiksi"
      },
      {
        judul: "Laskar Pelangi",
        penulis: "Andrea Hirata",
        sampul: "https://i.pinimg.com/736x/59/c1/55/59c155af6177866a3143df5dd9159ea1.jpg",
        kategori: "Fiksi"
      },
      {
        judul: "Atomic Habits",
        penulis: "James Clear",
        sampul: "https://images-na.ssl-images-amazon.com/images/I/91bYsX41DVL.jpg",
        kategori: "Pengembangan Diri"
      },
      {
        judul: "Doraemon",
        penulis: "Fujiko F. Fujio",
        sampul: "https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1461218010i/29969432.jpg",
        kategori: "Komik"
      },
      {
        judul: "Detective Conan",
        penulis: "Gosho Aoyama",
        sampul: "https://cdn.gramedia.com/uploads/products/3o3i8-03tc.jpg",
        kategori: "Komik"
      },
      {
        judul: "One Piece",
        penulis: "Eiichiro Oda",
        sampul: "https://cdn.gramedia.com/uploads/items/9786020483993_Cov_One_Piece_86.jpg",
        kategori: "Komik"
      },
      {
        judul: "Harry Potter",
        penulis: "J.K. Rowling",
        sampul: "https://images-na.ssl-images-amazon.com/images/I/81YOuOGFCJL.jpg",
        kategori: "Fantasi"
      },
      {
        judul: "Si Anak Spesial",
        penulis: "Tere Liye",
        sampul: "https://bukukita.com/babacms/displaybuku/117409_f.jpg",
        kategori: "Fiksi"
      },
    ];

    let userBooks = JSON.parse(localStorage.getItem('bukuList')) || [];
    let bukuData = [...defaultBooks, ...userBooks];

    function renderBuku() {
      const keyword = searchInput.value.toLowerCase();
      const kategori = kategoriFilter.value;

      bukuContainer.innerHTML = '';
      bukuData
        .filter(b =>
          b.judul.toLowerCase().includes(keyword) &&
          (kategori === '' || b.kategori === kategori)
        )
        .forEach((buku, index) => {
          const div = document.createElement('div');
          div.className = 'buku';
          div.innerHTML = `
            ${buku.sampul ? `<img src="${buku.sampul}" alt="${buku.judul}">` : ''}
            <h4>${buku.judul}</h4>
            <p><strong>Penulis:</strong> ${buku.penulis}</p>
            <p><strong>Kategori:</strong> ${buku.kategori || 'Umum'}</p>
            <button onclick="tambahFavorit(${index})">Tambahkan ke Favorit</button>
            ${index >= defaultBooks.length ? `<button class='hapus-button' onclick='hapusBuku(${index - defaultBooks.length})'>Hapus</button>` : ''}
          `;
          bukuContainer.appendChild(div);
        });
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
        renderBuku();
      }
    }

    searchInput.addEventListener('input', renderBuku);
    kategoriFilter.addEventListener('change', renderBuku);

    renderBuku();
  </script>
</section>
