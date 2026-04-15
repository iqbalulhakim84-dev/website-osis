<!-- Footer -->
<footer class="text-center mt-6">
    <div class="container d-flex justify-content-between align-items-center">
        <!-- Logo Kiri -->
        <div>
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'Admin'): ?>
                <img src="../image/logo pgri.png" alt="Logo 1" width="105" height="100">
            <?php elseif (isset($_SESSION['role']) && $_SESSION['role'] === 'Anggota'): ?>
                <img src="../image/logo pgri.png" alt="Logo 1" width="105" height="100">
            <?php else: ?>
                <img src="image/logo pgri.png" alt="Logo 1" width="105" height="100">
            <?php endif; ?>
        </div>

        <!-- Teks Tengah -->
        <div>
            <p class="mb-0">© 2024 OSIS SMK PGRI 1 CIMAHI. Semua hak dilindungi.</p>
            <p class="mb-0 d-inline fs-7">
                <a href="https://www.instagram.com/osismkpgri01?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==">@osismkpgri01</a>
            </p>
            <p class="mb-0 d-inline fs-7">
                <i class="bi bi-globe"></i> osissmkpg1
            </p>
            <p class="mb-0">
                <a href="#" class="text-light">Kebijakan Privasi</a> |
                <a href="#" class="text-light">Ketentuan Layanan</a>
            </p>
        </div>

        <!-- Logo Kanan -->
        <div>
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'Admin'): ?>
                <img src="../image/logo OSIS 1.png" alt="Logo 1" width="75" height="65">
            <?php elseif (isset($_SESSION['role']) && $_SESSION['role'] === 'Anggota'): ?>
                <img src="../image/logo OSIS 1.png" alt="Logo 1" width="75" height="65">
            <?php else: ?>
                <img src="image/logo OSIS 1.png" alt="Logo 1" width="75" height="65">
            <?php endif; ?>
        </div>
    </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-qpbm4SpvnVNSKkGzJZ+jWyGVF5NR6OPBQuGmukbuM+q"></script>