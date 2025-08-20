fetch('https://data.bmkg.go.id/DataMKG/TEWS/gempaterkini.json')
  .then(res => {
    if (!res.ok) {
      throw new Error('Jaringan Bermasalah');
    }
    return res.json();
  })
  .then(data => {
    const gempa = data.Infogempa.gempa;
    const list = document.getElementById('list');

    let count = 0;

    gempa.forEach(g => {
      if (parseFloat(g.Magnitude) < 5.0) return; // Filter hanya yang >= 5.0
      if (count >= 15) return; // Batas 15 entri

      const col = document.createElement('div');
      col.className = 'col-md-6 col-lg-4';

      const card = document.createElement('div');
      card.className = 'card shadow-sm h-100';

      const cardBody = document.createElement('div');
      cardBody.className = 'card-body';

      const title = document.createElement('h5');
      title.className = 'card-title fw-bold';
      title.textContent = g.Wilayah || "Gempa";

      const table = document.createElement('table');
      table.className = 'table table-sm table-borderless';

      for (let key in g) {
        if (key === 'Wilayah') continue;

        const row = document.createElement('tr');
        const dtkey = document.createElement('td');
        const dtvalue = document.createElement('td');

        dtkey.className = 'fw-semibold';
        dtkey.textContent = key;
        dtvalue.textContent = g[key];

        row.appendChild(dtkey);
        row.appendChild(dtvalue);
        table.appendChild(row);
      }

      cardBody.appendChild(title);
      cardBody.appendChild(table);
      card.appendChild(cardBody);
      col.appendChild(card);
      list.appendChild(col);

      count++;
    });

    if (count === 0) {
      list.innerHTML = `
        <div class="alert alert-info text-center">Tidak ada gempa dengan magnitudo 5.0+ yang terdeteksi saat ini.</div>
      `;
    }
  })
  .catch(err => {
    console.error('Parsing Bermasalah: ', err);
    const list = document.getElementById('list');
    list.innerHTML = `
      <div class="alert alert-danger text-center">Gagal mengambil data gempa: ${err.message}</div>
    `;
  });
