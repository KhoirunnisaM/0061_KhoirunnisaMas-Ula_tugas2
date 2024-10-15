<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mobil</title>
    <style>

        body {
            background-color: #2e2e2e;
            color: #ffffff; 
            font-family: Arial, sans-serif; 
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center; 
            align-items: center; 
            height: 100vh; 
        }

        .container {
            background-color: #3a3a3a; 
            border-radius: 8px; 
            padding: 20px; 
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5); 
            width: 400px; 
        }

        h2 {
            color: #ff8c00; 
            text-align: center; 
        }

        label {
            color: #ff8c00; 
        }

        select, input[type="text"] {
            background-color: #4a4a4a;
            border: 1px solid #ff8c00; 
            color: #ffffff;
            padding: 8px; 
            border-radius: 4px; 
            width: calc(100% - 16px);
            margin-bottom: 15px; 
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #ff8c00; 
            border: none;
            color: #ffffff; 
            padding: 10px 15px;
            border-radius: 4px; 
            cursor: pointer; 
            font-size: 16px;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #e07b00; 
        }

        .modal {
            display: none; 
            position: fixed; 
            z-index: 1000; 
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%; 
            overflow: auto; 
            background-color: rgba(0, 0, 0, 0.8);
        }

        .modal-content {
            background-color: #3a3a3a; 
            margin: 15% auto;
            padding: 20px; 
            border: 1px solid #ff8c00;
            width: 30%;
            border-radius: 8px; 
            color: #ff8c00; 
            text-align: center;
            
        }

        .close {
            color: #aaa; 
            float: right; 
            font-size: 28px;
            font-weight: bold; 
        }

        .close:hover,
        .close:focus {
            color: #ff8c00; 
            text-decoration: none; 
            cursor: pointer; 
        }
    </style>
    <script>
        function updateMerk() {
            var nama = document.getElementById("nama").value;
            var merk = document.getElementById("merk");

            // Data mobil (nama mobil dan merk)
            var data_mobil = {
                "Ferrari 488": "Ferrari",
                "Lamborghini Aventador": "Lamborghini",
                "Porsche 911": "Porsche",
                "Honda Jazz": "Honda",
                "Toyota Yaris": "Toyota",
                "Suzuki Swift": "Suzuki"
            };

            // Memunculkan merk berdasarkan nama mobil
            merk.value = data_mobil[nama] || "";
        
        }
        function openModal(content) {
            document.getElementById("modalContent").innerHTML = content;
            document.getElementById("modal").style.display = "block"; 
        }
        function closeModal() {
            document.getElementById("modal").style.display = "none"; 
        }
        window.onclick = function(event) {
            var modal = document.getElementById("modal");
            if (event.target == modal) {
                closeModal();
            }
        }
    </script>
</head>
<body>

<div class="container">
    <h2>Masukkan Nama Mobil</h2>

    <form method="POST" action="">
        <label>Nama Mobil:</label><br>
        <select id="nama" name="nama" onchange="updateMerk()" required>
            <option value="">Pilih Nama Mobil</option>
            <option value="Ferrari 488">Ferrari 488</option>
            <option value="Lamborghini Aventador">Lamborghini Aventador</option>
            <option value="Porsche 911">Porsche 911</option>
            <option value="Honda Jazz">Honda Jazz</option>
            <option value="Toyota Yaris">Toyota Yaris</option>
            <option value="Suzuki Swift">Suzuki Swift</option>
        </select><br><br>

        <label>Merk Mobil:</label><br>
        <input type="text" id="merk" name="merk" readonly required><br><br>

        <input type="submit" value="Info Mobil">
    </form>
</div>

<!-- Menampilkan informasi mobil -->
<div id="modal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <div id="modalContent"></div> 
    </div>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $merk = $_POST['merk'];

    // Informasi Mobil
    $mobil_sport_info = [
        "Ferrari 488" => ["speed" => "330 km/h", "turbo" => "Yes"],
        "Lamborghini Aventador" => ["speed" => "350 km/h", "turbo" => "Yes"],
        "Porsche 911" => ["speed" => "300 km/h", "turbo" => "Yes"],
    ];

    $city_car_info = [
        "Honda Jazz" => ["model" => "Jazz", "irit" => "Ya", "sensor" => "Ya"],
        "Toyota Yaris" => ["model" => "Yaris", "irit" => "Ya", "sensor" => "Tidak"],
        "Suzuki Swift" => ["model" => "Swift", "irit" => "Tidak", "sensor" => "Ya"],
    ];

    if (array_key_exists($nama, $mobil_sport_info)) {
        // Informasi Mobil sport
        $info = $mobil_sport_info[$nama];
        $mobilSport = new MobilSport($nama, $merk, $info['speed'], $info['turbo']);
        $content = "<h3>Informasi Mobil Sport:</h3>
                    Nama Mobil: $mobilSport->nama<br>
                    Merk: $mobilSport->merk<br>
                    Kecepatan: $info[speed]<br>
                    Turbo: $info[turbo]<br>";
        echo "<script>openModal(`$content`);</script>"; 
    } elseif (array_key_exists($nama, $city_car_info)) {
        // Informasi city car
        $info = $city_car_info[$nama];
        $cityCar = new CityCar($nama, $merk, $info['model'], $info['irit'], $info['sensor']);
        $content = "<h3>Informasi City Car:</h3>
                    Nama Mobil: $cityCar->nama<br>
                    Merk: $cityCar->merk<br>
                    Model: $info[model]<br>
                    Irit: $info[irit]<br>
                    Sensor: $info[sensor]<br>";
        echo "<script>openModal(`$content`);</script>"; 
    } else {
        echo "<script>openModal('Data mobil tidak ditemukan.');</script>"; 
    }
}

// Class utama
class Mobil {
    public $nama;
    public $merk;

    public function __construct($nama, $merk) {
        $this->nama = $nama;
        $this->merk = $merk;
    }

    public function tampilkanInfo() {
        echo "Nama Mobil: $this->nama, Merk: $this->merk<br>";
    }
}

// Buat turunan MobilSport
class MobilSport extends Mobil {
    public $speed;
    public $turbo;

    public function __construct($nama, $merk, $speed, $turbo) {
        parent::__construct($nama, $merk);
        $this->speed = $speed;
        $this->turbo = $turbo;
    }

    public function tampilkanInfo() {
        parent::tampilkanInfo();
        echo "Kecepatan: $this->speed, Turbo: $this->turbo<br>";
    }
}

// Buat turunan CityCar
class CityCar extends Mobil {
    public $model;
    public $irit;
    public $sensor;

    public function __construct($nama, $merk, $model, $irit, $sensor) {
        parent::__construct($nama, $merk);
        $this->model = $model;
        $this->irit = $irit;
        $this->sensor = $sensor;
    }

    public function tampilkanInfo() {
        parent::tampilkanInfo();
        echo "Model: $this->model, Irit: $this->irit, Sensor: $this->sensor<br>";
    }
}
?>

</body>
</html>
