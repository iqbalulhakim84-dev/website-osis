<?php
include '../config/koneksi.php';
include '../layout/header.php';

// Ambil data dari tabel tes_doa_harian + relasi ke siswa
$query = "
  SELECT tdh.*, da.nama, da.kelas, ak1.nama AS dibuat_oleh, ak2.nama AS diubah_oleh
  FROM tes_doa_harian tdh
  JOIN data_anggota da ON tdh.id_anggota = da.id_anggota
  LEFT JOIN akun ak1 ON tdh.created_by = ak1.id_akun
  LEFT JOIN akun ak2 ON tdh.updated_by = ak2.id_akun
  ORDER BY tdh.tanggal DESC
  ";
$result = mysqli_query($db, $query);

// jika tombol tambah di tekan jalankan script berikut
if (isset($_POST['tambah'])) {
  if (create_doa_harian($_POST) > 0) {
    echo "<script>
               alert('Data Berhasil Ditambahkan');
               document.location.href = 's1-dh.php';
               </script>";
  } else {
    echo "<script>
               alert('Data Gagal Ditambahkan');
               document.location.href = 's1-dh.php';
               </script>";
  }
}
// jika tombol ubah di tekan jalankan script berikut
if (isset($_POST['ubah'])) {
  if (update_doa_harian($_POST) > 0) {
    echo "<script>
               alert('Data Berhasil Diubahkan');
               document.location.href = 's1-dh.php';
               </script>";
  } else {
    echo "<script>
               alert('Data Gagal Diubahkan');
               document.location.href = 's1-dh.php';
               </script>";
  }
}
if (isset($_POST['hapus'])) {
  if (delete_doa_harian($_POST) > 0) {
    echo "<script>
               alert('Data Berhasil Dihapus');
               document.location.href = 's1-dh.php';
               </script>";
  } else {
    echo "<script>
               alert('Data Gagal Dihapus');
               document.location.href = 's1-dh.php';
               </script>";
  }
}
?>
<div class="content-wrapper">
  <div class="container mt-5 overflow-x-scroll">
    <div class="d-flex justify-content-between align-items-center">
      <h2>Sekbid 1 – Tes Doa Harian</h2>
      <a href="javascript:history.back()" class="btn btn-primary">Kembali</a>
    </div>
    <hr>
    <a class="btn btn-primary tambah-btn" data-bs-toggle="modal" data-bs-target="#modalTambah"><i class="fas fa-plus-circle"></i> Tambah</a>

    <table id="serverside" class="table table-bordered table-striped mt-3">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Siswa</th>
          <th>Tanggal</th>
          <th>Bacaan Doa</th>
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
            <td><?= $data['nama']; ?></td>
            <td><?= $data['tanggal']; ?></td>
            <td><?= $data['bacaan_doa']; ?></td>
            <td width="144">
              <a class="btn btn-info btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#modalDetail<?= $data['id_tes']; ?>"><i class="fas fa-eye"></i></a>
              <a class="btn btn-success btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#modalUbah<?= $data['id_tes']; ?>"><i class="fas fa-edit"></i></a>
              <a class="btn btn-danger btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $data['id_tes']; ?>"><i class="fas fa-trash"></i></a>
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
            <label for="id_anggota">Nama Anggota</label>
            <select name="id_anggota" id="id_anggota" class="form-control" required>
              <option value="">-- Pilih Anggota --</option>
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
          <h5 class="modal-title" id="exampleModalLabel">Ubah Data</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="" method="post">
            <input type="hidden" name="id_tes" value="<?= $r['id_tes']; ?>">
            <div class="mb-3">
              <label for="id_anggota">Nama Anggota</label>
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
<?php endforeach; ?>
<?php mysqli_data_seek($result, 0); // reset pointer 
?>
<?php while ($r = mysqli_fetch_assoc($result)) : ?>
  <div class="modal fade" id="modalDetail<?= $r['id_tes']; ?>" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-info text-white">
          <h5 class="modal-title">Detail Anggota</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          <table class="table table-bordered">
            <tr>
              <th>Nama</th>
              <td><?= htmlspecialchars($r['nama']); ?></td>
            </tr>
            <tr>
              <th>Kelas</th>
              <td><?= htmlspecialchars($r['kelas']); ?></td>
            </tr>
            <tr>
              <th>Tanggal</th>
              <td><?= htmlspecialchars($r['tanggal']); ?></td>
            </tr>
            <tr>
              <th>Bacaan Doa</th>
              <td><?= htmlspecialchars($r['bacaan_doa']); ?></td>
            </tr>
            <tr>
              <th>Nilai</th>
              <td><?= htmlspecialchars($r['nilai']); ?></td>
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