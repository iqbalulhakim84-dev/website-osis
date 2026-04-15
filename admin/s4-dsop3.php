<?php
include '../config/koneksi.php'; // koneksi ke DB
include '../layout/header.php';
$query = "SELECT * FROM eskul WHERE kategori = 'OP3' ORDER BY eskul ASC";
$result = mysqli_query($db, $query);
?>
<div class="content-wrapper">
  <div class="container mt-5 overflow-x-scroll">
    <div class="d-flex justify-content-between align-items-center">
      <h2>Sekbid 4 – Data Struktur OP3</h2>
      <a href="javascript:history.back()" class="btn btn-primary">Kembali</a>
    </div>
    <hr>
    <div class="row justify-content-center align-items-center">
      <?php while ($eskul = mysqli_fetch_assoc($result)): ?>
        <div class="col-md-3 mb-4">
          <div class="card shadow-sm">
            <img src="../image/logo/<?= $eskul['logo'] ?: 'default.png' ?>" class="card-img-top" alt="<?= $eskul['eskul'] ?>" style="scale: 80%;">
            <div class="card-body text-center">
              <h5 class="card-title"><?= $eskul['singkatan'] ?></h5>
              <p class="text-muted"><?= $eskul['eskul'] ?></p>
              <hr>
              <p class="text-muted"><?= $eskul['pembina'] ?></p>
              <a href="data-anggota-eskul.php?id_eskul=<?= $eskul['id_eskul'] ?>" class="btn btn-primary btn-sm">Anggota</a>
              <a href="jadwal-eskul.php?id_eskul=<?= $eskul['id_eskul'] ?>" class="btn btn-outline-secondary btn-sm">Jadwal</a>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>

    <!-- <div class="text-center my-4">
      <a href="jadwal-op3.php" class="btn btn-success">Jadwal Gabungan OP3</a>
      <a href="statistik-op3.php" class="btn btn-info">Statistik OP3</a>
    </div> -->
  </div>
</div>
<hr>
<?php
include '../layout/footer.php'
?>