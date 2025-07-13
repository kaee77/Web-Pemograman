document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('form-tambah-buku');
  if (form) {
    form.addEventListener('submit', function (e) {
      e.preventDefault();
      const judul = document.getElementById('judul').value;
      const penulis = document.getElementById('penulis').value;
      const deskripsi = document.getElementById('deskripsi').value;

      const buku = { judul, penulis, deskripsi };
      let bukuList = JSON.parse(localStorage.getItem('bukuList')) || [];
      bukuList.push(buku);
      localStorage.setItem('bukuList', JSON.stringify(bukuList));
      alert('Buku ditambahkan!');
      window.location.href = 'index.php';
    });
  }

  const bukuContainer = document.getElementById('buku-container');
  if (bukuContainer) {
    const bukuList = JSON.parse(localStorage.getItem('bukuList')) || [];
    bukuList.forEach((buku, index) => {
      const div = document.createElement('div');
      div.className = 'buku';
      div.innerHTML = `
        <h4>${buku.judul}</h4>
        <p><strong>Penulis:</strong> ${buku.penulis}</p>
        <p>${buku.deskripsi}</p>
        <button onclick="tambahFavorit(${index})">⭐ Tambah ke Favorit</button>
      `;
      bukuContainer.appendChild(div);
    });
  }

  const favoritContainer = document.getElementById('favorit-container');
  if (favoritContainer) {
    const favorit = JSON.parse(localStorage.getItem('favoritList')) || [];
    favorit.forEach((buku) => {
      const div = document.createElement('div');
      div.className = 'buku';
      div.innerHTML = `
        <h4>${buku.judul}</h4>
        <p><strong>Penulis:</strong> ${buku.penulis}</p>
        <p>${buku.deskripsi}</p>
      `;
      favoritContainer.appendChild(div);
    });
  }
});

function tambahFavorit(index) {
  const bukuList = JSON.parse(localStorage.getItem('bukuList')) || [];
  const favoritList = JSON.parse(localStorage.getItem('favoritList')) || [];
  favoritList.push(bukuList[index]);
  localStorage.setItem('favoritList', JSON.stringify(favoritList));
  alert('Buku ditambahkan ke favorit!');
}
