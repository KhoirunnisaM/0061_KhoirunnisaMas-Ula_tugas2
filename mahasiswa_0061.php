<?php
session_start(); 

// Kelas utama mahasiswa_si
class mahasiswa_si {
    public $nama;
    public $nim;
    public $jurusan;

    public function __construct($nama, $nim) {
        $this->nama = $nama;
        $this->nim = $nim;
        $this->jurusan = "Sistem Informasi";
    }
    public function dataInfo() {
        return [
            'Nama' => $this->nama,
            'NIM' => $this->nim,
            'Jurusan' => $this->jurusan
        ];
    }
}

// Kelas turunan si_murni
class si_murni extends mahasiswa_si {
    public $konsentrasi;
    public $kelas;
    public $ipk;
    public $dosen_pa;

    public function __construct($nama, $nim, $kelas, $ipk, $dosen_pa) {
        parent::__construct($nama, $nim);
        $this->konsentrasi = "Sistem Informasi Murni";
        $this->kelas = $kelas;
        $this->ipk = $ipk;
        $this->dosen_pa = $dosen_pa;
    }
    public function getInfo() {
        $basic = parent::dataInfo();
        $basic['Konsentrasi'] = $this->konsentrasi;
        $basic['Kelas'] = $this->kelas;
        $basic['IPK'] = $this->ipk;
        $basic['Dosen Pembimbing'] = $this->dosen_pa;
        return $basic;
    }
}

// Kelas turunan si_bd
class si_bd extends mahasiswa_si {
    public $konsentrasi;
    public $kelas;
    public $ipk;
    public $dosen_pa;

    public function __construct($nama, $nim, $kelas, $ipk, $dosen_pa) {
        parent::__construct($nama, $nim);
        $this->konsentrasi = "Sistem Informasi Bisnis Digital";
        $this->kelas = $kelas;
        $this->ipk = $ipk;
        $this->dosen_pa = $dosen_pa;
    }
    public function getInfo() {
        $basic = parent::dataInfo();
        $basic['Konsentrasi'] = $this->konsentrasi;
        $basic['Kelas'] = $this->kelas;
        $basic['IPK'] = $this->ipk;
        $basic['Dosen Pembimbing'] = $this->dosen_pa;
        return $basic;
    }
}

// Data mahasiswa SI Murni
$mahasiswaMurni = [
    new si_murni("Khoirunnisa Mas'Ula", "123456789", "3P51", "3.85", "Dr. Agus"),
    new si_murni("Khoir", "123456790", "3P51", "3.75", "Dr. Siti"),
    new si_murni("Mas'Ula", "123456791", "3P51", "3.65", "Dr. Budi")
];

// Data mahasiswa SI Bisnis Digital
$mahasiswaBD = [
    new si_bd("Khoirun", "987654321", "3P52", "3.75", "Dr. Rina"),
    new si_bd("Nisa", "987654322", "3P52", "3.65", "Dr. Tono"),
    new si_bd("Khoirunnisa", "987654323", "3P52", "3.90", "Dr. Fahmi")
];

if (!isset($_POST['konsentrasi'])) {
    unset($_SESSION['konsentrasi']);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa Sistem Informasi</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #e0e0e0; 
            padding: 30px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #007BFF;
            font-size: 2.5em;
        }

        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: 0 auto 30px auto;
        }

        .form-title {
            text-align: center;
            margin-bottom: 20px;
            color: #007BFF; 
            font-size: 2em;
        }

        label {
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
            display: block;
        }

        .radio-group {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .radio-group input[type="radio"] {
            margin-right: 10px;
        }

        .radio-group label {
            font-weight: normal;
            margin-right: 20px;
            color: #555;
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #007BFF; 
            border: none;
            border-radius: 6px;
            color: #ffffff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-weight: bold;
        }

        input[type="submit"]:hover {
            background-color: #0056b3; 
        }

        .data-mahasiswa {
            max-width: 800px;
            margin: 0 auto;
            background-color: #ffffff; 
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .data-mahasiswa h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #007BFF;
            font-size: 2em;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #ffffff; 

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
            color: #555;
        }

        th {
            background-color: #007BFF; 
            color: #ffffff;
        }

        tr:hover {
            background-color: #f1f1f1; 
        }

        @media (max-width: 600px) {
            table, thead, tbody, th, td, tr {
                display: block;
            }

            th {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            tr {
                margin-bottom: 15px;
            }

            td {
                border: none;
                position: relative;
                padding-left: 50%;
            }

            td:before {
                position: absolute;
                top: 15px;
                left: 15px;
                width: 45%;
                padding-right: 10px;
                white-space: nowrap;
                font-weight: bold;
                color: #555;
            }

            td:nth-of-type(1):before { content: "Nama"; }
            td:nth-of-type(2):before { content: "NIM"; }
            td:nth-of-type(3):before { content: "Jurusan"; }
            td:nth-of-type(4):before { content: "Konsentrasi"; }
            td:nth-of-type(5):before { content: "Kelas"; }
            td:nth-of-type(6):before { content: "IPK"; }
            td:nth-of-type(7):before { content: "Dosen Pembimbing"; }
        }
    </style>
</head>
<body>

<form method="POST" action="">
    <div class="form-title">Data Mahasiswa Sistem Informasi</div>
    <label for="konsentrasi">Pilih Konsentrasi:</label>
    <div class="radio-group">
        <input type="radio" id="murni" name="konsentrasi" value="murni" <?php echo isset($_SESSION['konsentrasi']) 
        && $_SESSION['konsentrasi'] == 'murni' ? 'checked' : ''; ?> required>
        <label for="murni">Sistem Informasi Murni</label>
    </div>
    <div class="radio-group">
        <input type="radio" id="bisnis_digital" name="konsentrasi" value="bisnis_digital" 
        <?php echo isset($_SESSION['konsentrasi']) && $_SESSION['konsentrasi'] == 'bisnis_digital' ? 'checked' : ''; ?> required>
        <label for="bisnis_digital">Sistem Informasi Bisnis Digital</label>
    </div>
    <input type="submit" value="Tampilkan Data">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['konsentrasi'] = $_POST["konsentrasi"];
    $konsentrasi = $_SESSION['konsentrasi'];

    echo '<div class="data-mahasiswa">';
    echo '<h2>Data Mahasiswa ' . ($konsentrasi == "murni" ? "Sistem Informasi Murni" : "Sistem Informasi Bisnis Digital") . '</h2>';
    echo '<table>';
    echo '<thead>';
    echo '<tr><th>Nama</th><th>NIM</th><th>Jurusan</th><th>Konsentrasi</th><th>Kelas</th><th>IPK</th><th>Dosen Pembimbing</th></tr>';
    echo '</thead>';
    echo '<tbody>';

    $dataMahasiswa = $konsentrasi == "murni" ? $mahasiswaMurni : $mahasiswaBD;

    foreach ($dataMahasiswa as $mahasiswa) {
        $info = $mahasiswa->getInfo();
        echo '<tr>';
        foreach ($info as $value) {
            echo '<td>' . $value . '</td>';
        }
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
    echo '</div>';
}
?>
</body>
</html>
