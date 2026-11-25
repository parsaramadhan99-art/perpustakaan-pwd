<?php
require_once "koneksi.php";

$sql    = "SELECT * FROM anggota ORDER BY id ASC";
$hasil  = mysqli_query($koneksi, $sql);
$jumlah = mysqli_num_rows($hasil);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Anggota Perpustakaan</title>
</head>
<body>
    <h2>Data Anggota Perpustakaan</h2>
    <p>Total data: <?php echo $jumlah; ?></p>
    <a href="form_anggota.php">Form Pendaftaran Anggota</a>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>No. Anggota</th>
                <th>Nama Lengkap</th>
                <th>Email</th>
                <th>No. HP</th>
                <th>Jenis Anggota</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($jumlah > 0) { ?>
                <?php $no = 1; while ($baris = mysqli_fetch_assoc($hasil)) { ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo htmlspecialchars($baris["no_anggota"]); ?></td>
                        <td><?php echo htmlspecialchars($baris["nama_lengkap"]); ?></td>
                        <td><?php echo htmlspecialchars($baris["email"]); ?></td>
                        <td><?php echo htmlspecialchars($baris["no_hp"]); ?></td>
                        <td><?php echo htmlspecialchars($baris["jenis_anggota"]); ?></td>
                        <td><?php echo htmlspecialchars($baris["alamat"]); ?></td>
                        <td>
                            <!-- Tombol Edit -->
                            <a href="edit_anggota.php?id=<?php echo (int) $baris["id"]; ?>">
                                <button type="button">Edit</button>
                            </a>


                            <form action="hapus.php" method="post" onsubmit="return confirm('Yakin ingin menghapus data ini?');" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo (int) $baris["id"]; ?>">
                                <button type="submit">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="8" align="center">Belum ada data anggota.</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>