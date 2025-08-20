fetch('https://data.bmkg.go.id/DataMKG/TEWS/autogempa.json')
  .then(res => {
    if (!res.ok) {
      throw new Error('Jaringan Bermasalah');
    }
    return res.json();
  })
  .then(data => {
    const gempa = data.Infogempa.gempa;
    const map = data.Infogempa.gempa.Shakemap;

    const table = document.getElementById('info');

    for (let key in gempa) {
      const row = document.createElement('tr');
      const keyCell = document.createElement('td');
      const valueCell = document.createElement('td');

      keyCell.textContent = key;
      valueCell.textContent = gempa[key];

      keyCell.className = 'fw-semibold';
      row.appendChild(keyCell);
      row.appendChild(valueCell);
      table.appendChild(row);
    }

    const image = document.createElement('img');
    image.setAttribute('src', `https://data.bmkg.go.id/DataMKG/TEWS/${map}`);
    image.setAttribute('alt', 'Peta Shakemap');
    image.className = 'img-fluid rounded mt-3';
    document.getElementById('image').appendChild(image);
  })
  .catch(err => {
    console.error('Parsing Bermasalah: ', err);

    const container = document.querySelector('.container');
    container.innerHTML += `
      <div class="alert alert-danger text-center mt-4" role="alert">
        Gagal mengambil data gempa: ${err.message}
      </div>
    `;
  });
