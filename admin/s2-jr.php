<?php
include '../config/koneksi.php';
include '../layout/header.php';
$query = "
SELECT jr.*, ak1.nama AS dibuat_oleh, ak2.nama AS diubah_oleh  
FROM jadwal_razia jr
LEFT JOIN akun ak1 ON jr.created_by = ak1.id_akun
LEFT JOIN akun ak2 ON jr.updated_by = ak2.id_akun
ORDER BY tanggal DESC";
$result = mysqli_query($db, $query);

if (isset($_POST['tambah'])) {
  if (create_jadwal_razia($_POST) > 0) {
    echo "<script>
               alert('Data Berhasil Ditambahkan');
               document.location.href = 's2-jr.php';
               </script>";
  } else {
    echo "<script>
               alert('Data Gagal Ditambahkan');
               document.location.href = 's2-jr.php';
               </script>";
  }
}
// jika tombol ubah di tekan jalankan script berikut
if (isset($_POST['ubah'])) {
  if (update_jadwal_razia($_POST) > 0) {
    echo "<script>
               alert('Data Berhasil Diubahkan');
               document.location.href = 's2-jr.php';
               </script>";
  } else {
    echo "<script>
               alert('Data Gagal Diubahkan');
               document.location.href = 's2-jr.php';
               </script>";
  }
}
if (isset($_POST['hapus'])) {
  if (delete_jadwal_razia($_POST) > 0) {
    echo "<script>
               alert('Data Berhasil Dihapus');
               document.location.href = 's2-jr.php';
               </script>";
  } else {
    echo "<script>
               alert('Data Gagal Dihapus');
               document.location.href = 's2-jr.php';
               </script>";
  }
}
?>
<div class="content-wrapper">
  <div class="container mt-5 overflow-x-scroll">
    <div class="d-flex justify-content-between align-items-center">
      <h2>Sekbid 2 – Jadwal Razia</h2>
      <a href="javascript:history.back()" class="btn btn-primary">Kembali</a>
    </div>
    <hr>
    <a class="btn btn-primary tambah-btn" data-bs-toggle="modal" data-bs-target="#modalTambah"><i class="fas fa-plus-circle"></i> Tambah</a>

    <table id="serverside" class="table table-bordered table-striped mt-3">
      <thead>
        <tr>
          <th>No</th>
          <th>Tanggal</th>
          <th>Jenis Razia</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        while ($data = mysqli_fetch_assoc($result)) :
        ?>
          <tr>
            <td><?= $no++; ?></td>
            <td><?= date('d-m-Y', strtotime($data['tanggal'])) ?></td>
            <td><?= $data['jenis_razia']; ?></td>
            <td width="144">
              <a class="btn btn-info btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#modalDetail<?= $data['id_razia']; ?>"><i class="fas fa-eye"></i></a>
              <a class="btn btn-success btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#modalUbah<?= $data['id_razia']; ?>"><i class="fas fa-edit"></i></a>
              <a class="btn btn-danger btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $data['id_razia']; ?>"><i class="fas fa-trash"></i></a>
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
            <label for="tanggal">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="jenis_razia">Jenis Razia</label>
            <input type="text" name="jenis_razia" id="jenis_razia" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="petugas">Petugas</label>
            <select name="petugas" id="petugas" class="form-control" required>
              <option value="">-- Petugas --</option>
              <option value="Guru">Guru</option>
              <option value="Siswa & Guru">Siswa & Guru</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="keterangan">Keterangan</label>
            <input type="text" name="keterangan" id="keterangan" class="form-control" required>
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
  <div class="modal fade" id="modalUbah<?= $r['id_razia']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title" id="exampleModalLabel">Ubah Data</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="" method="post">
            <input type="hidden" name="id_razia" value="<?= $r['id_razia']; ?>">
            <div class="mb-3">
              <label for="tanggal">Tanggal</label>
              <input type="date" name="tanggal" id="tanggal" class="form-control" value="<?= htmlspecialchars($r['tanggal']); ?>" required>
            </div>
            <div class="mb-3">
              <label for="jenis_razia">Jenis Razia</label>
              <input type="text" name="jenis_razia" id="jenis_razia" class="form-control" value="<?= htmlspecialchars($r['jenis_razia']); ?>" required>
            </div>
            <div class="mb-3">
              <label for="petugas">Petugas</label>
              <select name="petugas" id="petugas" class="form-control" required>
                <option value="Guru" <?= $r['petugas'] == 'Guru' ? 'selected' : null ?>>Guru</option>
                <option value="Siswa & Guru" <?= $r['petugas'] == 'Siswa & Guru' ? 'selected' : null ?>>Siswa & Guru</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="keterangan">Keterangan</label>
              <input type="text" name="keterangan" id="keterangan" class="form-control" value="<?= htmlspecialchars($r['keterangan']); ?>" required>
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
  <div class="modal fade" id="modalHapus<?= $r['id_razia']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <input type="hidden" name="id_razia" value="<?= $r['id_razia']; ?>">
            <button type="submit" name="hapus" class="btn btn-danger">Hapus</button>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>
<?php mysqli_data_seek($result, 0); // reset pointer 
?>
<?php while ($r = mysqli_fetch_assoc($result)) : ?>
  <div class="modal fade" id="modalDetail<?= $r['id_razia']; ?>" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-info text-white">
          <h5 class="modal-title">Detail Jadwal</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          <table class="table table-bordered">
            <tr>
              <th>Tanggal</th>
              <td><?= date('d-m-Y', strtotime($r['tanggal'])) ?></td>
            </tr>
            <tr>
              <th>Jenis Razia</th>
              <td><?= htmlspecialchars($r['jenis_razia']); ?></td>
            </tr>
            <tr>
              <th>Petugas</th>
              <td><?= htmlspecialchars($r['petugas']); ?></td>
            </tr>
            <tr>
              <th>Keterangan</th>
              <td><?= htmlspecialchars($r['keterangan']); ?></td>
            </tr>

            <tr>
              <th>Dibuat Pada</th>
              <td><?= date('d-m-Y H:i', strtotime($r['created_at'])); ?></td>
            </tr>
            <tr>
              <th>Dibuat Oleh</th>
              <td><?= htmlspecialchars($r['dibuat_oleh']); ?></td>
            </tr>

            <tr>
              <th>Terakhir Diubah</th>
              <td><?= date('d-m-Y H:i', strtotime($r['updated_at'])); ?></td>
            </tr>
            <tr>
              <th>Diubah Oleh</th>
              <td><?= htmlspecialchars($r['diubah_oleh']); ?></td>
            </tr>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
        </div>
      </div>
    </div>
  </div>
<?php endwhile;
include '../layout/footer.php';
?>