<?php
include 'layout/header.php';
include 'config/koneksi.php';

$query = $db->query("SELECT * FROM acara ORDER BY id_acara DESC LIMIT 1");
$acara = $query->fetch_assoc();
?>

<body>

  <!-- Modal Acara OSIS -->
  <div class="modal fade" id="modalAcara" tabindex="-1" aria-labelledby="modalAcaraLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content shadow-lg">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="modalAcaraLabel">📢 <?= $acara['judul']; ?></h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body text-center">
          <?php if (!empty($acara['gambar'])): ?>
            <img src="image/acara/<?= $acara['gambar']; ?>" alt="Acara OSIS" class="img-fluid rounded mb-3">
          <?php endif; ?>
          <h4><?= $acara['judul']; ?></h4>
          <p><?= $acara['deskripsi']; ?></p>
          <p>
            📅 <b><?= date("d M Y", strtotime($acara['tanggal'])); ?></b><br>
            🕘 <b><?= $acara['jam']; ?></b><br>
            📍 <b><?= $acara['tempat']; ?></b>
          </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Carousel -->
  <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="image/tingkat12.jpg" class="d-block w-100 animate__animated animate__fadeIn" alt="tingkat12">
        <div class="carousel-caption d-none d-md-block">
          <h5>OSIS SMK PGRI 1 CIMAHI</h5>
          <p>Mari bersatu memajukan sekolah!.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="image/pensi2.jpg" class="d-block w-100 animate__animated animate__fadeIn" alt="pensi2">
        <div class="carousel-caption d-none d-md-block">
          <h5>OSIS SMK PGRI 1 CIMAHI</h5>
          <p>Wujudkan dengan aksi, generasi unggul siap untuk mengabdi.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="image/foto osis3.jpeg" class="d-block w-100 animate__animated animate__fadeIn" alt="osis3">
        <div class="carousel-caption d-none d-md-block">
          <h5>OSIS SMK PGRI 1 CIMAHI</h5>
          <p>Cerdas, kreatif, dan beriman.</p>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

  <div class="container">
    <div class="row" style="margin-top: 30px;">
      <div class="col-md-4">
        <div class="card card-custom mb-4">
          <div class="card-body">
            <h5 class="card-title">Kegiatan Kerohanian</h5>
            <p class="card-text">Solat Dhuha bersama meningkatkan iman dan taqwa siswa-siswi SMK PGRI 1 Cimahi.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card card-custom mb-4">
          <div class="card-body">
            <h5 class="card-title">Berbagai Jenis Perlombaan</h5>
            <p class="card-text">Berbagai jenis perlombaan baik akademik maupun non-akademik seperti...</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card card-custom mb-4">
          <div class="card-body">
            <h5 class="card-title">Rasa Nasionalisme & Cinta Tanah Air</h5>
            <p class="card-text">Mengadakan upacara rutin setiap hari penting di Indonesia seperti...</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Program Kerja Section -->
  <div class="container text-center my-4">
    <h2>PROGRAM KERJA</h2>
    <p>Beberapa program kerja yang telah direncanakan dan rutin berjalan setiap tahunnya.</p>
  </div>
  <div class="container">
    <div class="row" style="margin-top: 30px;">
      <div class="col-md-4">
        <div class="card mb-4 animate__animated animate__fadeIn">
          <img src="image/pilketos.jpeg" class="card-img-top" alt="pilketos">
          <div class="card-body">
            <h5 class="card-title">Pemilihan Calon Ketua & Wakil Ketua Osis</h5>
            <p class="card-text">Pembelajaran Demokrasi di lingkungan Sekolah.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card mb-4 animate__animated animate__fadeIn">
          <img src="image/pensi.JPG" class="card-img-top" alt="pensi">
          <div class="card-body">
            <h5 class="card-title">Pentas Seni</h5>
            <p class="card-text">Pentas seni diadakan sebagai sarana pengembangan bakat, minat, dan daya cipta siswa sekolah.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card mb-4 animate__animated animate__fadeIn">
          <img src="image/porak.JPG" class="card-img-top" alt="porak">
          <div class="card-body">
            <h5 class="card-title">Pekan Olahraga</h5>
            <p class="card-text">Momen untuk mempererat persatuan, membangun semangat sportivitas, dan meningkatkan kesehatan fisik siswa.</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container mt-5">
    <div class="row align-items-center">
      <div class="col-md-6">
        <h2 class="text-black">Belajar dan bekerja bersama dalam tim untuk menyukseskan program kerja</h2>
        <p>Dalam OSIS kita belajar dan bekerja bersama dalam setiap program kerja yang telah direncanakan.</p>
      </div>
      <div class="col-md-6">
        <div class="card card-custom shadow">
          <img src="image/foto osis3.jpeg" class="card-img animate__animated animate__zoomIn" alt="OSIS Activity">
        </div>
      </div>
    </div>
  </div>
  <!-- Google Maps Embed -->
  <div class="container mt-5">
    <div class="row align-item-center">
      <iframe
        width="600"
        height="450"
        style="border:0; margin-left: 3px; margin-right: 2px;"
        loading="lazy"
        allowfullscreen
        referrerpolicy="no-referrer-when-downgrade"
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.166648444271!2d107.54534667403479!3d-6.870625767222008!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e51ef1452b9b%3A0xf27ba488f11ef50c!2sSMK%20PGRI%201%20CIMAHI!5e0!3m2!1sid!2sid!4v1725524362325!5m2!1sid!2sid">
      </iframe>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> -->
  <script>
    // Script agar modal otomatis muncul saat halaman dibuka
    window.addEventListener('load', function() {
      var myModal = new bootstrap.Modal(document.getElementById('modalAcara'));
      myModal.show();
    });
  </script>
</body>
<?php include 'layout/footer.php'; ?>