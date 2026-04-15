<?php
session_start();
$title = 'Daftar Akun';
include '../layout/header.php';

// tampil seluruh data
$data_akun = select("SELECT * FROM akun");

// jika tombol tambah di tekan jalankan script berikut
if (isset($_POST['tambah'])) {
    if (create_akun($_POST) > 0) {
        echo "<script>
               alert('Data Akun Berhasil Ditambahkan');
               document.location.href = 'akun.php';
               </script>";
    } else {
        echo "<script>
               alert('Data Akun Gagal Ditambahkan');
               document.location.href = 'akun.php';
               </script>";
    }
}
// jika tombol ubah di tekan jalankan script berikut
if (isset($_POST['ubah'])) {
    if (update_akun($_POST) > 0) {
        echo "<script>
               alert('Data Akun Berhasil Diubahkan');
               document.location.href = 'akun.php';
               </script>";
    } else {
        echo "<script>
               alert('Data Akun Gagal Diubahkan');
               document.location.href = 'akun.php';
               </script>";
    }
}
if (isset($_POST['hapus'])) {
    if (delete_akun($_POST) > 0) {
        echo "<script>
               alert('Data Akun Berhasil Dihapus');
               document.location.href = 'akun.php';
               </script>";
    } else {
        echo "<script>
               alert('Data Akun Gagal Dihapus');
               document.location.href = 'akun.php';
               </script>";
    }
}
?>
<div class="content-wrapper">
    <div class="container mt-5 overflow-x-scroll">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Data Akun</h2>
            <a href="javascript:history.back()" class="btn btn-primary">Kembali</a>
        </div>
        <hr>
        <a class="btn btn-primary tambah-btn" data-bs-toggle="modal" data-bs-target="#modalTambah"><i class="fas fa-plus-circle"></i> Tambah</a>
        <table id="serverside" class="table table-bordered table-striped mt-3">
            <thead>
                <th>No</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Email</th>
                <th>Password</th>
                <th>Role</th>
                <th>Aksi</th>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($data_akun as $akun): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= htmlspecialchars($akun['nama']); ?></td>
                        <td><?= htmlspecialchars($akun['username']); ?></td>
                        <td><?= htmlspecialchars($akun['email']); ?></td>
                        <td>Password Ter-enkripsi</td>
                        <td><?= htmlspecialchars($akun['role']); ?></td>
                        <td class="text-center">
                            <a type="button" class="btn btn-success btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#modalUbah<?= $akun['id_akun']; ?>">
                                <li class="fas fa-edit"></li>
                            </a>
                            <a type="button" class="btn btn-danger btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $akun['id_akun']; ?>">
                                <li class="fas fa-trash"></li>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- Modal Tambah -->
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Akun</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" id="nama" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" required
                                minlength="6">
                        </div>
                        <div class="mb-3">
                            <label for="role">role</label>
                            <select name="role" id="role" class="form-control" required>
                                <option value="">--Pilih Role--</option>
                                <option value="Admin">Admin</option>
                                <option value="Anggota">Anggota</option>
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
    <?php foreach ($data_akun as $akun): ?>
        <div class="modal fade" id="modalUbah<?= $akun['id_akun']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="exampleModalLabel">Ubah Akun</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post">
                            <input type="hidden" name="id_akun" value="<?= $akun['id_akun']; ?>">
                            <div class="mb-3">
                                <label for="nama">Nama</label>
                                <input type="text" name="nama" id="nama" class="form-control" value="<?= htmlspecialchars($akun['nama']); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" class="form-control" value="<?= htmlspecialchars($akun['username']); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" value="<?= htmlspecialchars($akun['email']); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="password">Password <small>(Masukkan password baru/lama)</small></label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Kosongkan jika tidak diubah"  minlength="6">
                            </div>
                            <?php if ($_SESSION['role'] == 'Admin'): ?>
                                <div class="mb-3">
                                    <label for="role">role</label>
                                    <select name="role" id="role" class="form-control" required>
                                        <option value="Admin" <?= $akun['role'] == 'Admin' ? 'selected' : null ?>>Admin</option>
                                        <option value="Anggota" <?= $akun['role'] == 'Anggota' ? 'selected' : null ?>>Operator Osis</option>
                                    </select>
                                </div>
                            <?php else: ?>
                                <input type="hidden" name="role" value="<?= $akun['role']; ?>">
                            <?php endif; ?>
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
    <?php foreach ($data_akun as $akun): ?>
        <div class="modal fade" id="modalHapus<?= $akun['id_akun']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus Akun</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Yakin ingin menghapus akun <strong><?= htmlspecialchars($akun['nama']); ?></strong>?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <form action="" method="post" class="d-inline">
                            <input type="hidden" name="id_akun" value="<?= $akun['id_akun']; ?>">
                            <button type="submit" name="hapus" class="btn btn-danger">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<?php include '../layout/footer.php'; ?>