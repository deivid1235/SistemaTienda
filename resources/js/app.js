//
import './admin';
import './usuario';



document.addEventListener('DOMContentLoaded', function () {
    const buscador = document.getElementById('buscador');
    if (!buscador) {
        return;
    }
    buscador.addEventListener('input', function () {
        const texto = this.value.toLowerCase().trim();
        document.querySelectorAll('table tbody tr').forEach(function (fila) {
            const contenido = fila.textContent.toLowerCase();

            if (contenido.includes(texto)) {
                fila.style.display = '';
            } else {
                fila.style.display = 'none';
            }
        });
    });

});