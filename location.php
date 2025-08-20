<!-- <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lokasi</title>
</head>
<body>
  <h1>Cuaca Berbagai Kota Besar</h1>
  <form action="weatherind.php" method="post">
    <label for="wilayah">Pilih Kota</label>
    <select name="wilayah" id="wilayah">
      <?php
        // $data = new SimpleXMLElement('http://data.bmkg.go.id/DataMKG/MEWS/DigitalForecast/DigitalForecast-Indonesia.xml', 0, true);
        // $kota = array();
        // $kode = array();
        // foreach($data->forecast->area as $area) {
        //   $nama = $area['description'];
        //   $id = $area['id'];
        //   $kota[] = (string)$nama;
        //   $kode[] = (string)$id;
        // }
        // $lengkap = array_combine($kota, $kode);
        // $count = count($kota);
        // sort($kota);

        // for($i = 0; $i < $count; $i++) {
        //   $namkot = $kota[$i];
        //   $dekot = $lengkap[$namkot];
        //   echo "<option value= '" . $dekot . "'>" . $namkot . "</option>";
        // }
      ?>
    </select>
    <button type="submit">Tampilkan</button>
  </form>
  <br><br><br><hr>

  <h1>Cuaca Berbagai Wilayah</h1>
  <form action="weatherprov.php" id="formprov" method="post">
    <label for="province">Pilih Provinsi</label>
    <select name="province" id="province">
      <option value="Aceh">Aceh</option>
      <option value="Bali">Bali</option>
      <option value="BangkaBelitung">Bangka Belitung</option>
      <option value="Banten">Banten</option>
      <option value="Bengkulu">Bengkulu</option>
      <option value="DIYogyakarta">DI Yogyakarta</option>
      <option value="DKIJakarta">DKI Jakarta</option>
      <option value="Gorontalo">Gorontalo</option>
      <option value="Jambi">Jambi</option>
      <option value="JawaBarat">Jawa Barat</option>
      <option value="JawaTengah">Jawa Tengah</option>
      <option value="JawaTimur">Jawa Timur</option>
      <option value="KalimantanBarat">Kalimantan Barat</option>
      <option value="KalimantanSelatan">Kalimantan Selatan</option>
      <option value="KalimantanTengah">Kalimantan Tengah</option>
      <option value="KalimantanTimur">Kalimantan Timur</option>
      <option value="KalimantanUtara">Kalimantan Utara</option>
      <option value="KepulauanRiau">Kepulauan Riau</option>
      <option value="Lampung">Lampung</option>
      <option value="Maluku">Maluku</option>
      <option value="MalukuUtara">Maluku Utara</option>
      <option value="NusaTenggaraBarat">Nusa Tenggara Barat</option>
      <option value="NusaTenggaraTimur">Nusa Tenggara Timur</option>
      <option value="Papua">Papua</option>
      <option value="PapuaBarat">Papua Barat</option>
      <option value="Riau">Riau</option>
      <option value="SulawesiBarat">Sulawesi Barat</option>
      <option value="SulawesiSelatan">Sulawesi Selatan</option>
      <option value="SulawesiTengah">Sulawesi Tengah</option>
      <option value="SulawesiTenggara">Sulawesi Tenggara</option>
      <option value="SulawesiUtara">Sulawesi Utara</option>
      <option value="SumateraBarat">Sumatera Barat</option>
      <option value="SumateraSelatan">Sumatera Selatan</option>
      <option value="SumateraUtara">Sumatera Utara</option>
    </select>
    <button type="button" onclick="prov()">Pilih</button>
    <br>
    <div id="siti">
      <label for="city">Pilih Kota</label>
      <select name="city" id="city"></select>
      <button type="submit" id="tampil">Tampilkan</button>
    </div>
  </form>
  <script src="prov.js"></script>
</body>
</html> -->

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Pilih Wilayah</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
  <div class="container py-5">
    <h2>Pilih Wilayah</h2>

    <div class="mb-3">
      <label for="provinsi" class="form-label">Provinsi</label>
      <select id="provinsi" class="form-select">
        <option selected disabled value="">Memuat provinsi...</option>
      </select>
    </div>

    <div class="mb-3">
      <label for="kota" class="form-label">Kota/Kabupaten</label>
      <select id="kota" class="form-select" disabled>
        <option selected disabled value="">Pilih provinsi dulu</option>
      </select>
    </div>

    <div class="mb-3">
      <label for="kecamatan" class="form-label">Kecamatan</label>
      <select id="kecamatan" class="form-select" disabled>
        <option selected disabled value="">Pilih kabupaten / kota dulu</option>
      </select>
    </div>

    <div class="mb-3">
      <label for="desa" class="form-label">Desa</label>
      <select id="desa" class="form-select" disabled>
        <option selected disabled value="">Pilih kecamatan dulu</option>
      </select>
    </div>

    <div class="mb-3 text-end">
      <button id="btnCekCuaca" class="btn btn-primary" disabled>Cek Cuaca</button>
    </div>

    <div id="cuaca" class="mt-4"></div>
  </div>

  <script src="lokasi/get_lokasi.js"></script>
</body>
</html>
