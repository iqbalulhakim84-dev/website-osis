<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));
    
    // Validasi email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Alamat email tidak valid.";
        exit;
    }

    // Buat instance PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Konfigurasi server
        $mail->isSMTP();
        $mail->Host = 'smtp.example.com'; // Ganti dengan SMTP server Anda
        $mail->SMTPAuth = true;
        $mail->Username = 'your-email@example.com'; // Ganti dengan email Anda
        $mail->Password = 'your-email-password'; // Ganti dengan password email Anda
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Gunakan TLS
        $mail->Port = 587; // Port SMTP

        // Pengaturan email
        $mail->setFrom($email, $name);
        $mail->addAddress('osissmkpgri1cimahi@gmail.com'); // Ganti dengan alamat email tujuan
        $mail->isHTML(false);
        $mail->Subject = "Pesan Baru dari $name";
        $mail->Body    = "Nama: $name\nEmail: $email\nPesan:\n$message";

        // Kirim email
        $mail->send();
        echo 'Pesan Anda telah dikirim!';
    } catch (Exception $e) {
        echo "Gagal mengirim pesan. Kesalahan: {$mail->ErrorInfo}";
    }
} else {
    echo "Metode permintaan tidak valid.";
}
?>
