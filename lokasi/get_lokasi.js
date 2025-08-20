const provSelect = document.getElementById('provinsi');
const kotaSelect = document.getElementById('kota');
const kecamatanSelect = document.getElementById('kecamatan');
const desaSelect = document.getElementById('desa');

// Ambil data provinsi dari PHP proxy
fetch('lokasi/get_provinsi.php')
.then(res => {
    if (!res.ok) throw new Error('Gagal mengambil data provinsi');
    return res.json();
})
.then(data => {
    provSelect.innerHTML = '<option disabled selected value="">Pilih Provinsi...</option>';
    data.data.forEach(prov => {
    const opt = document.createElement('option');
    opt.value = prov.code;
    opt.textContent = prov.name;
    provSelect.appendChild(opt);
    });
    provSelect.disabled = false;
})
.catch(err => {
    console.error(err);
    provSelect.innerHTML = '<option disabled>Gagal memuat provinsi</option>';
});

// Ketika provinsi dipilih, ambil kota
provSelect.addEventListener('change', () => {
const provCode = provSelect.value;
kotaSelect.disabled = true;
kotaSelect.innerHTML = '<option>Memuat kota...</option>';

kecamatanSelect.disabled = true;
kecamatanSelect.innerHTML = '<option>Pilih kabupaten / kota dulu</option>';

desaSelect.disabled = true;
desaSelect.innerHTML = '<option>Pilih kecamatan dulu</option>';

fetch(`lokasi/get_kota.php?provinsi=${provCode}`)
    .then(res => {
    if (!res.ok) throw new Error('Gagal mengambil data kota');
    return res.json();
    })
    .then(data => {
    kotaSelect.innerHTML = '<option disabled selected value="">Pilih Kota...</option>';
    data.data.forEach(kota => {
        const opt = document.createElement('option');
        opt.value = kota.code;
        opt.textContent = kota.name;
        kotaSelect.appendChild(opt);
    });
    kotaSelect.disabled = false;
    })
    .catch(err => {
    console.error(err);
    kotaSelect.innerHTML = '<option disabled>Gagal memuat kota</option>';
    });
});

// Ketika kota dipilih, ambil kecamatan
kotaSelect.addEventListener('change', () => {
const kotaCode = kotaSelect.value;
kecamatanSelect.disabled = true;
kecamatanSelect.innerHTML = '<option>Memuat kecamatan...</option>';

desaSelect.disabled = true;
desaSelect.innerHTML = '<option>Pilih kecamatan dulu</option>';

fetch(`lokasi/get_kecamatan.php?kota=${kotaCode}`)
    .then(res => {
    if (!res.ok) throw new Error('Gagal mengambil data kecamatan');
    return res.json();
    })
    .then(data => {
    kecamatanSelect.innerHTML = '<option disabled selected value="">Pilih Kecamatan...</option>';
    data.data.forEach(kec => {
        const opt = document.createElement('option');
        opt.value = kec.code;
        opt.textContent = kec.name;
        kecamatanSelect.appendChild(opt);
    });
    kecamatanSelect.disabled = false;
    })
    .catch(err => {
    console.error(err);
    kecamatanSelect.innerHTML = '<option disabled>Gagal memuat kecamatan</option>';
    });
});

// Ketika kecamatan dipilih, ambil desa
kecamatanSelect.addEventListener('change', () => {
const kecamatanCode = kecamatanSelect.value;
desaSelect.disabled = true;
desaSelect.innerHTML = '<option>Memuat desa...</option>';

fetch(`lokasi/get_desa.php?kecamatan=${kecamatanCode}`)
    .then(res => {
    if (!res.ok) throw new Error('Gagal mengambil data desa');
    return res.json();
    })
    .then(data => {
    desaSelect.innerHTML = '<option disabled selected value="">Pilih Desa...</option>';
    data.data.forEach(desa => {
        const opt = document.createElement('option');
        opt.value = desa.code;
        opt.textContent = desa.name;
        desaSelect.appendChild(opt);
    });
    desaSelect.disabled = false;
    })
    .catch(err => {
    console.error(err);
    desaSelect.innerHTML = '<option disabled>Gagal memuat desa</option>';
    });
});

// Ketika desa dipilih, aktifkan tombol
desaSelect.addEventListener('change', () => {
  if (desaSelect.value) {
    btnCekCuaca.disabled = false;
  }
});

btnCekCuaca.addEventListener('click', () => {
  const desaSelect = document.getElementById('desa');
  const desaText = desaSelect.selectedOptions[0].textContent;
  const kodeDesa = desaSelect.value;

  // Tampilkan loading
  const cuacaDiv = document.getElementById('cuaca');
  cuacaDiv.innerHTML = '<p>Memuat data cuaca...</p>';

  fetch(`lokasi/get_cuaca.php?desa=${kodeDesa}`)
    .then(res => {
      if (!res.ok) throw new Error('Gagal mengambil data cuaca');
      return res.json();
    })
    .then(json => {
      const info = json.data[0].cuaca.flat(); // Gabungkan array waktu
      let html = `<h3>Prakiraan Cuaca untuk Desa ${desaText}</h3>`;
      html += `<div class="table-responsive"><table class="table table-bordered"><thead><tr>
        <th>Jam</th><th>Cuaca</th><th>Suhu</th><th>Kelembaban</th><th>Angin</th>
      </tr></thead><tbody>`;

      info.forEach(item => {
        html += `
          <tr>
            <td>${item.local_datetime}</td>
            <td><img src="${item.image}" alt="${item.weather_desc}" width="32" /> ${item.weather_desc}</td>
            <td>${item.t}°C</td>
            <td>${item.hu}%</td>
            <td>${item.wd} (${item.ws} m/s)</td>
          </tr>`;
      });

      html += `</tbody></table></div>`;
      cuacaDiv.innerHTML = html;
    })
    .catch(err => {
      cuacaDiv.innerHTML = `<p class="text-danger">Gagal memuat data cuaca: ${err.message}</p>`;
    });
});
