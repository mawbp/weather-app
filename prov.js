document.addEventListener('DOMContentLoaded', () => {
  const select = document.querySelector('#siti');
  select.style.display = 'none';
})

function prov() {
  const selectEle = document.querySelector("#province");
  const val = selectEle.value;
  fetch(`http://data.bmkg.go.id/DataMKG/MEWS/DigitalForecast/DigitalForecast-${val}.xml`)
    .then(res => res.text())
    .then(xmlStr => {
      const parser = new DOMParser();
      const xmlDoc = parser.parseFromString(xmlStr, "text/xml");

      const id = xmlDoc.querySelector('area').getAttribute('id');
      const kota = xmlDoc.getElementsByTagName('area');
      const select = document.querySelector('#city');
      const con = document.querySelector('#siti');
      if(select.options.length > 0) {
        while(select.options.length > 0) {
          select.remove(0);
        }
      }

      var valuestr = "";
      for(var i = 0; i < kota.length; i++) {
        var nama = kota[i].getAttribute('description');
        var kode = kota[i].getAttribute('id');
        const option = document.createElement('option');
        option.innerHTML = nama;
        option.setAttribute('value', `${kode}`);

        
        select.appendChild(option);
        // valuestr += "Hasil " + (i + 1) + ": " + value + "\n";
      }

      con.style.display = 'block';
    });
};