<?php
// connection to db
include 'soal3a.php';

$nama = $_GET['nama'] ?? '';
$alamat = $_GET['alamat'] ?? '';
$hobi = $_GET['hobi'] ?? '';

// get name and hobby data from db 
// left join because 1 name = more than 1 hobby
$sql = "SELECT p.nama, p.alamat, h.hobi
        FROM person p
        LEFT JOIN hobi h ON p.id = h.person_id
        WHERE p.nama LIKE ? AND p.alamat LIKE ? AND h.hobi LIKE ?
        ORDER BY p.nama";

$query = $conn->prepare($sql);
$search_nama = '%' . $nama . '%';
$search_alamat = '%' . $alamat . '%';
$search_hobi = '%' . $hobi . '%';
$query->bind_param("sss", $search_nama, $search_alamat, $search_hobi);
$query->execute();
$result = $query->get_result();
?>

<!DOCTYPE html>
<html>

<head>
    <title>List Person dan Hobi</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #aaa;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>

<body>
    <h2>Data Person dan Hobi</h2>


    <table style="margin-bottom: 2em;">
        <tr>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Hobi</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['nama']; ?></td>
                <td><?= htmlspecialchars($row['alamat']) ?></td>
                <td><?php echo $row['hobi']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
    <form method="get" action="soal3b.php">
        <label>Nama: <input type="text" name="nama" value="<?= htmlspecialchars($nama) ?>"></label>
        <label>Alamat: <input type="text" name="alamat" value="<?= htmlspecialchars($alamat) ?>"></label>
        <label>Hobi: <input type="text" name="hobi" value="<?= htmlspecialchars($hobi) ?>"></label>
        <br>
        <br>
        <button type="submit">Search</button>
    </form>

</body>

</html>