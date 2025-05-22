<?php
session_start();


$step = isset($_POST['step']) ? (int)$_POST['step'] : 1;
// input proses based on current step
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($step === 1) {
        $nama = $_POST['nama'] ?? '';
        $_SESSION['nama'] = $nama;
        $step = 2;
    } elseif ($step === 2) {
        $umur = filter_input(INPUT_POST, 'umur', FILTER_VALIDATE_INT);
        if ($umur && $umur > 0) {
            $_SESSION['umur'] = $umur;
            $step = 3;
        } else {
            $error = "Masukkan umur yang valid (harus angka positif).";
        }
    } elseif ($step === 3) {
        $hobi = $_POST['hobi'] ?? '';
        $_SESSION['hobi'] = $hobi;
        $step = 4;
    }
}

// function for showing form
function renderForm($step)
{
    // for error if umur = minus number
    global $error;
    if ($error) echo "<p style='color:red;'>$error</p>";


    $form_input = [
        1 => ['label' => 'Nama', 'type' => 'text', 'name' => 'nama'],
        2 => ['label' => 'Umur', 'type' => 'number', 'name' => 'umur'],
        3 => ['label' => 'Hobi', 'type' => 'text', 'name' => 'hobi'],
    ];

    if (!isset($form_input[$step])) return;

    $data = $form_input[$step];
    echo "
    <form method='post'>
        <label>{$data['label']}:</label><br>
        <input type='{$data['type']}' name='{$data['name']}' required><br><br>
        <input type='hidden' name='step' value='{$step}'>
        <button type='submit'>Lanjut</button>
    </form>";
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Multi Step Form</title>
</head>

<body>

    <?php
    if ($step >= 1 && $step <= 3) {
        renderForm($step);
    } elseif ($step == 4) {
        echo "<h2>Hasil Input:</h2>";
        echo "<p><strong>Nama:</strong> " . htmlspecialchars($_SESSION['nama']) . "</p>";
        echo "<p><strong>Umur:</strong> " . htmlspecialchars($_SESSION['umur']) . "</p>";
        echo "<p><strong>Hobi:</strong> " . htmlspecialchars($_SESSION['hobi']) . "</p>";
    }
    ?>

</body>

</html>