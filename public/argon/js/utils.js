function loadImageFromOutput() {
    $(":file").change(function () {
        var files = $(this)[0].files;
        // Obtenemos la imagen del campo.
        for (var i = 0, f; (f = files[i]); i++) {
            //Solo admitimos imágenes.
            if (!f.type.match("image.*")) {
                continue;
            }
            var reader = new FileReader();
            reader.onload = (function (theFile) {
                return function (e) {
                    // Insertamos la imagen
                    document.getElementById("list").innerHTML = [
                        '<img src="',
                        e.target.result,
                        '" style="width: 100px;" class="img-fluid img-thumbnail rounded-lg" title="Imagen de Referencia"/>',
                    ].join("");
                };
            })(f);
            reader.readAsDataURL(f);
        }
    });
}

async function getMaster(url, params) {
    return axios.get(url, { params: params });
}

export { loadImageFromOutput, getMaster };
