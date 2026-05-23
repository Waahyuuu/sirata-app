# Panduan Integrasi Backend — Landing Page SIRATA

Dokumen ini menjelaskan dua titik integrasi antara landing page dengan sistem backend:

| # | Section | Terhubung ke | Jenis |
|---|---------|-------------|-------|
| 1 | Form Pencarian (`#search`) | SIRATA Dashboard API | REST API call dari browser |
| 2 | FAQ (`#faq`) | Admin Panel | Server-side render / JSON endpoint |

---

## 1. Form Pencarian → SIRATA Dashboard API

### Lokasi di HTML
```
index.html → <section id="search"> → <form id="searchForm">
```

### Field yang dikirim user

| Name attribute | Type | Keterangan |
|----------------|------|-----------|
| `nama_ibu` | string | Nama ibu kandung mahasiswa |
| `tanggal_lahir` | date (YYYY-MM-DD) | Tanggal lahir mahasiswa |
| `nim` | string | NIM mahasiswa |

### Kondisi saat ini (mock)

File `public/js/landing.js` baris 90–108 masih menggunakan **mock submit** — setelah 1,2 detik menampilkan data dummy yang di-hardcode di HTML (`#resultCard`). Tidak ada HTTP request yang terjadi.

```js
// landing.js — GANTI BLOK INI dengan fetch ke API nyata
searchForm.addEventListener('submit', (e) => {
  e.preventDefault();
  // saat ini hanya setTimeout + tampilkan resultCard hardcoded
});
```

### Yang perlu dilakukan backend

**1. Sediakan endpoint verifikasi + ambil data:**
```
POST /api/mahasiswa/verify
Content-Type: application/json

{
  "nim": "22010001",
  "nama_ibu": "Siti Aminah",
  "tanggal_lahir": "2003-05-10"
}
```

**2. Response sukses yang diharapkan:**
```json
{
  "status": "success",
  "data": {
    "nama": "Ahmad Fauzi",
    "nim": "22010001",
    "program_studi": "Teknik Informatika",
    "semester": "6 (Aktif)",
    "ipk": "3.42",
    "kehadiran": "87%"
  }
}
```

**3. Response gagal / data tidak ditemukan:**
```json
{
  "status": "error",
  "message": "Data tidak ditemukan. Periksa kembali NIM dan data verifikasi."
}
```

### Integrasi di landing.js

Ganti blok mock submit (baris 90–108) dengan:

```js
const searchForm = document.getElementById('searchForm');
if (searchForm) {
  searchForm.addEventListener('submit', async (e) => {
    e.preventDefault();

    const label      = document.getElementById('submitLabel');
    const resultCard = document.getElementById('resultCard');
    const formData   = new FormData(searchForm);

    label.textContent = 'Mencari...';

    try {
      const res  = await fetch('/api/mahasiswa/verify', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(Object.fromEntries(formData)),
      });
      const json = await res.json();

      if (json.status === 'success') {
        const d = json.data;
        // Isi result card dengan data nyata
        resultCard.querySelector('[data-field="nama"]').textContent      = d.nama;
        resultCard.querySelector('[data-field="nim"]').textContent       = d.nim;
        resultCard.querySelector('[data-field="prodi"]').textContent     = d.program_studi;
        resultCard.querySelector('[data-field="semester"]').textContent  = d.semester;
        resultCard.querySelector('[data-field="ipk"]').textContent       = d.ipk;
        resultCard.querySelector('[data-field="kehadiran"]').textContent = d.kehadiran;

        resultCard.classList.add('show');
        resultCard.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
      } else {
        alert(json.message); // atau tampilkan error state di UI
      }
    } catch (err) {
      alert('Gagal menghubungi server. Coba lagi.');
    } finally {
      label.textContent = 'Cari Informasi';
    }
  });
}
```

> **Catatan untuk frontend:** Tambahkan atribut `data-field` ke setiap `.result-row` di `#resultCard` agar JS bisa mengisi nilai secara dinamis. Contoh:
> ```html
> <div class="result-row">Nama <strong data-field="nama"></strong></div>
> <div class="result-row">NIM  <strong data-field="nim"></strong></div>
> ```

### Keamanan
- Validasi ketiga field di sisi server sebelum query ke SIAKAD.
- Jangan ekspos kolom sensitif selain yang tercantum di response di atas.
- Rate limit endpoint ini (misal: max 10 request/menit per IP) untuk mencegah brute-force.
- Gunakan HTTPS di production.

---

## 2. FAQ → Admin Panel

### Lokasi di HTML
```
index.html → <section id="faq"> → <div class="faq-list">
```

### Kondisi saat ini (hardcoded)

Ada **6 item FAQ** yang di-hardcode langsung di HTML. Setiap item punya struktur:

```html
<div class="faq-item [open]">
  <button class="faq-q">
    [Pertanyaan] <span class="faq-icon">+</span>
  </button>
  <div class="faq-a">
    <div class="faq-a-inner">[Jawaban]</div>
  </div>
</div>
```

Kelas `open` pada item pertama berarti accordion terbuka secara default.

### Yang perlu dilakukan backend

**1. Buat tabel FAQ di database (contoh):**
```sql
CREATE TABLE faqs (
  id         INT PRIMARY KEY AUTO_INCREMENT,
  pertanyaan TEXT NOT NULL,
  jawaban    TEXT NOT NULL,
  urutan     INT  DEFAULT 0,
  aktif      TINYINT(1) DEFAULT 1
);
```

**2. Sediakan endpoint untuk landing page:**
```
GET /api/faq
```
Response:
```json
[
  {
    "id": 1,
    "pertanyaan": "Apa itu SIRATA?",
    "jawaban": "SIRATA adalah sistem rapor digital..."
  },
  {
    "id": 2,
    "pertanyaan": "Informasi apa saja yang tersedia?",
    "jawaban": "Nilai mata kuliah, persentase kehadiran..."
  }
]
```
Urutkan berdasarkan kolom `urutan ASC`. Hanya tampilkan yang `aktif = 1`.

**3. Kelola FAQ dari Admin Panel:**

Admin panel perlu menyediakan halaman CRUD FAQ dengan operasi:

| Operasi | Endpoint | Body |
|---------|----------|------|
| List semua | `GET /admin/faq` | — |
| Tambah | `POST /admin/faq` | `{ pertanyaan, jawaban, urutan }` |
| Edit | `PUT /admin/faq/:id` | `{ pertanyaan, jawaban, urutan, aktif }` |
| Hapus | `DELETE /admin/faq/:id` | — |

### Dua opsi render untuk landing page

**Opsi A — Server-side render (direkomendasikan)**

Backend merender `index.html` sebagai template dan mengisi `.faq-list` langsung dari database. Tidak ada request tambahan dari browser.

```html
<!-- Contoh dengan template engine (Blade / Twig / dll) -->
<div class="faq-list">
  @foreach ($faqs as $i => $faq)
  <div class="faq-item {{ $i === 0 ? 'open' : '' }}">
    <button class="faq-q">
      {{ $faq->pertanyaan }} <span class="faq-icon">+</span>
    </button>
    <div class="faq-a">
      <div class="faq-a-inner">{{ $faq->jawaban }}</div>
    </div>
  </div>
  @endforeach
</div>
```

**Opsi B — Fetch dari JS (jika landing tetap file statis)**

Tambahkan di `landing.js` setelah `DOMContentLoaded`:

```js
async function loadFaq() {
  const list = document.querySelector('.faq-list');
  if (!list) return;

  const res  = await fetch('/api/faq');
  const faqs = await res.json();

  list.innerHTML = faqs.map((faq, i) => `
    <div class="faq-item ${i === 0 ? 'open' : ''}">
      <button class="faq-q">${faq.pertanyaan} <span class="faq-icon">+</span></button>
      <div class="faq-a"><div class="faq-a-inner">${faq.jawaban}</div></div>
    </div>
  `).join('');

  // Re-attach accordion listener setelah DOM diisi
  document.querySelectorAll('.faq-q').forEach(btn => {
    btn.addEventListener('click', () => {
      const item   = btn.closest('.faq-item');
      const isOpen = item.classList.contains('open');
      document.querySelectorAll('.faq-item').forEach(i => i.classList.remove('open'));
      if (!isOpen) item.classList.add('open');
    });
  });
}

loadFaq();
```

> Hapus 6 item FAQ hardcoded di `index.html` setelah opsi ini diimplementasi.

---

## Ringkasan Checklist untuk Backend

### SIRATA Dashboard API
- [ ] Endpoint `POST /api/mahasiswa/verify` — verifikasi 3 field, query SIAKAD, return data mahasiswa
- [ ] Validasi & sanitasi input di server
- [ ] Rate limiting pada endpoint verify
- [ ] Response format sesuai spesifikasi di atas

### Admin Panel (FAQ)
- [ ] Tabel `faqs` di database
- [ ] CRUD endpoint FAQ di admin panel (`/admin/faq`)
- [ ] Endpoint publik `GET /api/faq` (atau server-side render)
- [ ] Field `urutan` untuk mengatur urutan tampil
- [ ] Field `aktif` untuk menyembunyikan FAQ tanpa menghapus

---

*Dokumen ini mengacu pada state landing page per commit terakhir di `/Users/aldi/redesign/index.html`.*
