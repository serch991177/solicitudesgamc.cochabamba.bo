<script>
    $(document).ready(function() {

        var latitud = document.getElementsByName("latitude")[0].value;
        var longitud = document.getElementsByName("longitude")[0].value;

        var flag = false;

        if (latitud != '' && longitud != '') {
            flag = true;
            var mymap = L.map('mapid').setView([latitud, longitud], 17);
        } else {
            var mymap = L.map('mapid').setView([-17.39382474713952, -66.15696143763128], 17);
        }


        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            maxZoom: 18,
            minZoom: 12,
        }).addTo(mymap);

        if (flag) {
            var marcador;
            marcador = new L.Marker([latitud, longitud], {
                draggable: false
            });
            mymap.addLayer(marcador);
            marcador.bindPopup("<b>Ubicación Seleccionada</b>").openPopup();
        }

    });
</script>