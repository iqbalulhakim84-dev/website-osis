<?php
include '../config/koneksi.php';
include '../layout/header.php';
$query = "SELECT * FROM jadwal_jaga_barisan ORDER BY tanggal DESC";
$result = mysqli_query($db, $query);
// jika tombol tambah di tekan jalankan script berikut
if (isset($_POST['tambah'])) {
  if (create_jaga_barisan($_POST) > 0) {
    echo "<script>
               alert('Data Berhasil Ditambahkan');
               document.location.href = 's2-jpb.php';
               </script>";
  } else {
    echo "<script>
               alert('Data Gagal Ditambahkan');
               document.location.href = 's2-jpb.php';
               </script>";
  }
}
// jika tombol ubah di tekan jalankan script berikut
if (isset($_POST['ubah'])) {
  if (update_jaga_barisan($_POST) > 0) {
    echo "<script>
               alert('Data Berhasil Diubahkan');
               document.location.href = 's2-jpb.php';
               </script>";
  } else {
    echo "<script>
               alert('Data Gagal Diubahkan');
               document.location.href = 's2-jpb.php';
               </script>";
  }
}
if (isset($_POST['hapus'])) {
  if (delete_jaga_barisan($_POST) > 0) {
    echo "<script>
               alert('Data Berhasil Dihapus');
               document.location.href = 's2-jpb.php';
               </script>";
  } else {
    echo "<script>
               alert('Data Gagal Dihapus');
               document.location.href = 's2-jpb.php';
               </script>";
  }
}
?>
<div class="content-wrapper">
  <div class="container mt-5 overflow-x-scroll">
    <div class="d-flex justify-content-between align-items-center">
      <h2>Sekbid 2 – Jadwal Jaga Barisan</h2>
      <a href="javascript:history.back()" class="btn btn-primary">Kembali</a>
    </div>
    <hr>
    <a class="btn btn-primary tambah-btn" data-bs-toggle="modal" data-bs-target="#modalTambah"><i class="fas fa-plus-circle"></i> Tambah</a>

    <table id="serverside" class="table table-bordered table-striped mt-3">
      <thead>
        <tr>
          <th>No</th>
          <th>Tanggal</th>
          <th>Keterangan</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        while ($data = mysqli_fetch_assoc($result)) : ?>
          <tr>
            <td><?= $no++; ?></td>
            <td><?= date('d-m-Y', strtotime($data['tanggal'])) ?></td>
            <td><?= $data['keterangan']; ?></td>
            <td>
              <a class="btn btn-success btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#modalUbah<?= $data['id_jadwal']; ?>">Ubah</a>
              <a class="btn btn-danger btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $data['id_jadwal']; ?>">Hapus</a>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</div>
<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
          <div class="mb-3">
            <label for="id_anggota">Nama Siswa</label>
            <select name="id_anggota" id="id_anggota" class="form-control" required>
              <option value="">-- Pilih Siswa --</option>
              <?php
              $anggota = select("SELECT * FROM data_anggota ORDER BY id_anggota ASC");
              foreach ($anggota as $a) :
              ?>
                <option value="<?= $a['id_anggota']; ?>"><?= $a['nama']; ?> (<?= $a['kelas']; ?>)</option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="tanggal">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="bacaan_doa">Bacaan Doa</label>
            <input type="text" name="bacaan_doa" id="bacaan_doa" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="nilai">Nilai</label>
            <select name="nilai" id="nilai" class="form-control" required>
              <option value="">-- Nilai --</option>
              <option value="Sangat Memuaskan">Sangat Memuaskan</option>
              <option value="Cukup Memuaskan">Cukup Memuaskan</option>
              <option value="Kurang Memuaskan">Kurang Memuaskan</option>
            </select>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
            <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal Ubah -->
<?php foreach ($result as $r): ?>
  <div class="modal fade" id="modalUbah<?= $r['id_tes']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title" id="exampleModalLabel">Ubah r</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="" method="post">
            <input type="hidden" name="id_tes" value="<?= $r['id_tes']; ?>">
            <div class="mb-3">
              <label for="id_anggota">Nama Siswa</label>
              <select name="id_anggota" id="id_anggota" class="form-control" required>
                <?php
                $anggota = select("SELECT * FROM data_anggota ORDER BY id_anggota ASC");
                foreach ($anggota as $a) :
                ?>
                  <option value="<?= $a['id_anggota']; ?>" <?= $a['id_anggota'] == $r['id_anggota'] ? 'selected' : '' ?>>
                    <?= $a['nama']; ?> (<?= $a['kelas']; ?>)
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="mb-3">
              <label for="tanggal">Tanggal</label>
              <input type="date" name="tanggal" id="tanggal" class="form-control" value="<?= htmlspecialchars($r['tanggal']); ?>" required>
            </div>
            <div class="mb-3">
              <label for="bacaan_doa">Bacaan Doa</label>
              <input type="text" name="bacaan_doa" id="bacaan_doa" class="form-control" value="<?= htmlspecialchars($r['bacaan_doa']); ?>" required>
            </div>
            <div class="mb-3">
              <label for="nilai">Nilai</label>
              <select name="nilai" id="nilai" class="form-control" required>
                <option value="Sangat Memuaskan" <?= $r['nilai'] == 'Sangat Memuaskan' ? 'selected' : null ?>>Sangat Memuaskan</option>
                <option value="Cukup Memuaskan" <?= $r['nilai'] == 'Cukup Memuaskan' ? 'selected' : null ?>>Cukup Memuaskan</option>
                <option value="Kurang Memuaskan" <?= $r['nilai'] == 'Kurang Memuaskan' ? 'selected' : null ?>>Kurang Memuaskan</option>
              </select>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
              <button type="submit" name="ubah" class="btn btn-success">Ubah</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>
<!-- Modal Hapus -->
<?php foreach ($result as $r): ?>
  <div class="modal fade" id="modalHapus<?= $r['id_tes']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Yakin ingin menghapus data ini?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <form action="" method="post" class="d-inline">
            <input type="hidden" name="id_tes" value="<?= $r['id_tes']; ?>">
            <button type="submit" name="hapus" class="btn btn-danger">Hapus</button>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php endforeach;
include '../layout/footer.php';
?>