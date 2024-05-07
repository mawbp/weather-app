fetch('http://data.bmkg.go.id/DataMKG/TEWS/gempaterkini.json')
  .then(res => {
    if(!res.ok){
      throw new Error('Jaringan Bermasalah');
    }
    return res.json();
  })
  .then(data => {
    const gempa = data.Infogempa.gempa;
    for(let i = 0; i < 15; i++){
      const item = document.createElement('li');
      const table = document.createElement('table');
      const list = document.getElementById('list');
      for(let x in gempa[i]){
        const row = document.createElement('tr');
        const dtkey = document.createElement('td');
        const dtvalue = document.createElement('td');
        const newln = document.createElement('br');

        dtkey.textContent = x;
        dtvalue.textContent = gempa[i][x];

        row.appendChild(dtkey);
        row.appendChild(dtvalue);

        table.appendChild(row);
        item.appendChild(table);

        list.appendChild(item);
      }
    }
    const item = document.querySelectorAll('li');
    item.forEach((i) => {
      var br = document.createElement('br');
      i.appendChild(br);
    });
  })
  .catch(err => {
    console.error('Parsing Bermasalah: ', err);
  });
