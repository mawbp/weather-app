fetch('http://data.bmkg.go.id/DataMKG/TEWS/autogempa.json')
  .then(res => {
    if(!res.ok){
      throw new Error('Jaringan Bermasalah');
    };
    return res.json();
  })
  .then(data => {
    console.log(data);
    const gempa = data.Infogempa.gempa;
    const map = data.Infogempa.gempa.Shakemap;
    
    const table = document.getElementById('info');
    for(let key in gempa){
      const tableRow = document.createElement('tr');
      const tableDataKey = document.createElement('td');
      const tableDataValue = document.createElement('td');

      tableDataKey.textContent = key;
      tableDataValue.textContent = gempa[key];

      tableRow.appendChild(tableDataKey);
      tableRow.appendChild(tableDataValue);
      table.appendChild(tableRow);
    }
    const image = document.createElement('img');
    image.setAttribute('src', `http://data.bmkg.go.id/DataMKG/TEWS/${map}`)
    document.getElementById('image').appendChild(image);
  })
  .catch(err => {
    console.error('Parsing Bermasalah: ', err);
  });
  