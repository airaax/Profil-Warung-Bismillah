<?php 
include 'config.php'; 

// --- LOGIKA PROSES DATA (BACK-END) ---

// 1. Update Jam Operasional & Pesan Hero
if (isset($_POST['update_settings'])) {
    $buka = $_POST['jam_buka'];
    $tutup = $_POST['jam_tutup'];
    $pesan = mysqli_real_escape_string($conn, $_POST['pesan_status']);
    
    mysqli_query($conn, "UPDATE settings SET jam_buka='$buka', jam_tutup='$tutup', pesan_status='$pesan' WHERE id=1");
    header("Location: admin.php?status=updated");
}

// 2. Toggle Status Menu (Tersedia/Habis)
if (isset($_GET['toggle_id'])) {
    $id = $_GET['toggle_id'];
    mysqli_query($conn, "UPDATE menu SET is_tersedia = NOT is_tersedia WHERE id=$id");
    header("Location: admin.php");
}

// Ambil data terbaru untuk ditampilkan di form
$res_set = mysqli_query($conn, "SELECT * FROM settings WHERE id=1");
$s = mysqli_fetch_assoc($res_set);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - Warung Bismillah</title>
    <style>
        :root { --primary: #FFC107; --secondary: #8B4513; --dark: #2c3e50; }
        body { font-family: 'Segoe UI', sans-serif; background: #f4f7f6; padding: 40px; color: var(--dark); }
        .container { max-width: 900px; margin: 0 auto; }
        .card { background: white; padding: 30px; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); margin-bottom: 30px; }
        h2 { border-bottom: 2px solid var(--primary); padding-bottom: 10px; margin-bottom: 20px; color: var(--secondary); }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="time"], textarea { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px; }
        button { background: var(--secondary); color: white; border: none; padding: 12px 25px; border-radius: 8px; cursor: pointer; font-weight: bold; }
        button:hover { opacity: 0.9; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { padding: 15px; text-align: left; border-bottom: 1px solid #eee; }
        .badge { padding: 5px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: bold; }
        .badge-buka { background: #d4edda; color: #155724; }
        .badge-tutup { background: #f8d7da; color: #721c24; }
        .btn-toggle { text-decoration: none; font-size: 0.85rem; color: #007bff; font-weight: bold; }
    </style>
</head>
<body>

<div class="container">
    <h1>⚙️ Panel Kendali Warung</h1>
    <p>Halo Admin, silakan atur operasional warung hari ini.</p>

    <div class="card">
        <h2>Pengaturan Warung</h2>
        <form method="POST">
            <div class="form-group" style="display: flex; gap: 20px;">
                <div style="flex: 1;">
                    <label>Jam Buka:</label>
                    <input type="time" name="jam_buka" value="<?php echo $s['jam_buka']; ?>" required>
                </div>
                <div style="flex: 1;">
                    <label>Jam Tutup:</label>
                    <input type="time" name="jam_tutup" value="<?php echo $s['jam_tutup']; ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label>Pesan Banner (Hero Text):</label>
                <textarea name="pesan_status" rows="3"><?php echo $s['pesan_status']; ?></textarea>
            </div>
            <button type="submit" name="update_settings">Simpan Perubahan</button>
        </form>
    </div>

    <div class="card">
        <h2>Kelola Stok Menu</h2>
        <table>
            <thead>
                <tr>
                    <th>Nama Menu</th>
                    <th>Status Saat Ini</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $res_menu = mysqli_query($conn, "SELECT * FROM menu");
                while ($m = mysqli_fetch_assoc($res_menu)): 
                ?>
                <tr>
                    <td><strong><?php echo $m['nama']; ?></strong></td>
                    <td>
                        <?php if ($m['is_tersedia']): ?>
                            <span class="badge badge-buka">Tersedia</span>
                        <?php else: ?>
                            <span class="badge badge-tutup">Habis</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="?toggle_id=<?php echo $m['id']; ?>" class="btn-toggle">
                            🔄 Ubah Status
                        </a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <p style="text-align: center;">
       <a href="index.php" style="color: var(--secondary); text-decoration: none; font-weight: bold;">
    ⬅ Kembali ke Halaman Utama (Pengunjung)
</a>
    </p>
</div>

</body>
</html>