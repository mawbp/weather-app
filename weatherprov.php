<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kota Pilihan</title>
</head>
<body>
  <?php 
    if (isset($_POST['province']) && isset($_POST['city'])) {
      $prov = $_POST['province'];
      $kota = $_POST['city'];
      $data = new SimpleXMLElement("http://data.bmkg.go.id/DataMKG/MEWS/DigitalForecast/DigitalForecast-". $prov .".xml", 0, true);
      $area = $data->xpath("//area[@id = '". $kota ."']/name[@xml:lang = 'id_ID']")[0];
      echo "<h1>Prakiraan Cuaca Untuk ". $area ."</h1>";

      echo "<h4>Cuaca</h4>";
      foreach($data->xpath("//area[@id = '". $kota ."']/parameter[@id = 'weather']/timerange") as $weathertime) {
        $weather = $weathertime->value;
        $weatherwaktu = $weathertime['datetime'];
        $weatherwaktu2 = DateTime::createFromFormat('YmdHi', $weatherwaktu)->format('d/m/Y H:i');
        $w;

        switch ($weather) {
          case 0: $w = 'Cerah'; break;
          case 1: $w = 'Cerah Berawan'; break;
          case 2: $w = 'Cerah Berawan'; break;
          case 3: $w = 'Berawan'; break;
          case 4: $w =  'Berawan Tebal'; break;
          case 5: $w =  'Udara Kabur'; break;
          case 10: $w =  'Asap'; break;
          case 45: $w =  'Kabut'; break;
          case 60: $w =  'Hujan Ringan'; break;
          case 61: $w =  'Hujan Sedang'; break;
          case 63: $w =  'Hujan Lebat'; break;
          case 80: $w =  'Hujan Lokal'; break;
          case 95: $w =  'Hujan Petir'; break;
          case 97: $w =  'Hujan Petir'; break;
          default: $w =  'Tidak terdeteksi'; break;
        }

        echo "Waktu: " . $weatherwaktu2 . " | " . "Cuaca: " . $w . "<br>";
      }

      echo "<h4>Kelembaban</h4>";
      foreach($data->xpath("//area[@id = '". $kota ."']/parameter[@id = 'hu']/timerange") as $hutime){
        $nilai = $hutime->value;
        $huwaktu = $hutime['datetime'];
        $huwaktu2 = DateTime::createFromFormat('YmdHi', $huwaktu)->format('d/m/Y H:i');
    
        echo "Waktu: " . $huwaktu2 . " |" . " Kelembaban: " . $nilai . "%" . "<br>"; 
      }

      echo "<h4>Temperatur</h4>";
      foreach($data->xpath("//area[@id = '". $kota ."']/parameter[@id = 't']/timerange") as $ttime) {
        $t = $ttime->value;
        $twaktu = $ttime['datetime'];
        $twaktu2 = DateTime::createFromFormat('YmdHi', $twaktu)->format('d/m/Y H:i');
        echo "Waktu: " . $twaktu2 . " |" . " Temperatur: " . $t . "C" . "<br>";
      }

      echo "<h4>Kelembaban Min.</h4>";
      foreach($data->xpath("//area[@id = '". $kota ."']/parameter[@id = 'humin']/timerange") as $humintime) {
        $humin = $humintime->value;
        $huminday = $humintime['day'];
        $huminday2 = DateTime::createFromFormat('Ymd', $huminday)->format('d/m/Y');
        echo "Waktu: " . $huminday2 . " | " . "Kelembaban Min: " . $humin . "%" . "<br>";
      }

      echo "<h4>Temperatur Min.</h4>";
      foreach($data->xpath("//area[@id = '". $kota ."']/parameter[@id = 'tmin']/timerange") as $tmintime) {
        $tmin = $tmintime->value;
        $tminday = $tmintime['day'];
        $tminday2 = DateTime::createFromFormat('Ymd', $tminday)->format('d/m/Y');
        echo "Waktu: " . $tminday2 . " | " . "Temperatur Min: " . $tmin . "C" . "<br>";
      }

      echo "<h4>Kelembaban Maks.</h4>";
      foreach($data->xpath("//area[@id = '". $kota ."']/parameter[@id = 'humax']/timerange") as $humaxtime) {
        $humax = $humaxtime->value;
        $humaxday = $humaxtime['day'];
        $humaxday2 = DateTime::createFromFormat('Ymd', $humaxday)->format('d/m/Y');
        echo "Waktu: " . $humaxday2 . " | " . "Kelembaban Maks: " . $humax . "%" . "<br>";
      }

      echo "<h4>Temperatur Maks.</h4>";
      foreach($data->xpath("//area[@id = '". $kota ."']/parameter[@id = 'tmax']/timerange") as $tmaxtime) {
        $tmax = $tmaxtime->value;
        $tmaxday = $tmaxtime['day'];
        $tmaxday2 = DateTime::createFromFormat('Ymd', $tmaxday)->format('d/m/Y');
        echo "Waktu: " . $tmaxday2 . " |" . " Temperatur Maks: " . $tmax . "C" . "<br>";
      }
    }
  ?>
</body>
</html>