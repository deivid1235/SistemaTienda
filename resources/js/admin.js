// Estilo
const openBtn = document.getElementById('open-styles');
const openBtn2 = document.getElementById('open-styles-2');
const closeBtn = document.getElementById('close-styles');
const panel = document.getElementById('styles-panel');
const backdrop = document.getElementById('backdrop');

function abrirPanel() {
    if (panel) panel.classList.remove('translate-x-full');
    if (backdrop) backdrop.classList.remove('hidden');
}

function cerrarPanel() {
    if (panel) panel.classList.add('translate-x-full');
    if (backdrop) backdrop.classList.add('hidden');
}

if (openBtn) {
    openBtn.addEventListener('click', function (e) {
        e.preventDefault();
        abrirPanel();
    });
}

if (openBtn2) {
    openBtn2.addEventListener('click', function (e) {
        e.preventDefault();
        abrirPanel();
    });
}

if (closeBtn) {
    closeBtn.addEventListener('click', function () {
        cerrarPanel();
    });
}

if (backdrop) {
    backdrop.addEventListener('click', function () {
        cerrarPanel();
    });
}

if (panel && panel.dataset.editando === '1') {
    abrirPanel();
}
//Buscar color munero 
const colorPicker = document.getElementById('color_picker');
const colorHex = document.getElementById('color_hex');
if (colorPicker && colorHex) {
    colorPicker.addEventListener('input', function () {
        colorHex.value = this.value.toUpperCase();
    });
    colorHex.addEventListener('input', function () {
        let valor = this.value.trim();
        if (!valor.startsWith('#')) {
            valor = '#' + valor;
        }
        if (/^#[0-9A-Fa-f]{6}$/.test(valor)) {
            colorPicker.value = valor;
        }
    });
}

//PERU/API
document.addEventListener('DOMContentLoaded', function () {
    const departamento = document.getElementById('departamento');
    const provincia = document.getElementById('provincia');
    const distrito = document.getElementById('distrito');

    if (!departamento || !provincia || !distrito) {
        return;
    }
    const urlDepartamentos = departamento.dataset.url;
    const urlProvincias = provincia.dataset.url;
    const urlDistritos = distrito.dataset.url;
    cargarDepartamentos();
    async function cargarDepartamentos() {
        try {
            const response = await fetch(urlDepartamentos);
            const data = await response.json();

            departamento.innerHTML = '<option value="">Seleccione departamento</option>';

            data.data.forEach(item => {
                departamento.innerHTML += `
                    <option value="${item.nombre}" data-codigo="${item.codigo}">
                        ${item.nombre}
                    </option>
                `;
            });

        } catch (error) {
            console.error('Error cargando departamentos:', error);
        }
    }

    departamento.addEventListener('change', async function () {
        const opcion = this.options[this.selectedIndex];
        const codigo = opcion.dataset.codigo;
        provincia.innerHTML = '<option value="">Cargando provincias...</option>';
        distrito.innerHTML = '<option value="">Seleccione distrito</option>';
        provincia.disabled = true;
        distrito.disabled = true;
        if (!codigo) {
            provincia.innerHTML = '<option value="">Seleccione provincia</option>';
            return;
        }

        try {
            const response = await fetch(`${urlProvincias}/${codigo}`);
            const data = await response.json();

            provincia.innerHTML = '<option value="">Seleccione provincia</option>';

            data.data.forEach(item => {
                provincia.innerHTML += `
                    <option value="${item.nombre}" data-codigo="${item.codigo}">
                        ${item.nombre}
                    </option>
                `;
            });

            provincia.disabled = false;
        } catch (error) {
            console.error('Error cargando provincias:', error);
            provincia.innerHTML = '<option value="">Error cargando provincias</option>';
        }
    });

    provincia.addEventListener('change', async function () {
        const opcion = this.options[this.selectedIndex];
        const codigo = opcion.dataset.codigo;
        distrito.innerHTML = '<option value="">Cargando distritos...</option>';
        distrito.disabled = true;
        if (!codigo) {
            distrito.innerHTML = '<option value="">Seleccione distrito</option>';
            return;
        }

        try {
            const response = await fetch(`${urlDistritos}/${codigo}`);
            const data = await response.json();

            distrito.innerHTML = '<option value="">Seleccione distrito</option>';

            data.data.forEach(item => {
                distrito.innerHTML += `
                    <option value="${item.nombre}" data-codigo="${item.codigo}">
                        ${item.nombre}
                    </option>
                `;
            });
            distrito.disabled = false;
        } catch (error) {
            console.error('Error cargando distritos:', error);
            distrito.innerHTML = '<option value="">Error cargando distritos</option>';
        }
    });

});

//Login imaganes
const zonaSeleccionImagen = document.getElementById('zonaSeleccionImagen');
const inputImagenes = document.getElementById('imagenesCarrusel');
const imagenPrevia = document.getElementById('imagenPrevia');
const contenidoImagen = document.getElementById('contenidoImagen');
const botonGuardarImagen = document.getElementById('botonGuardarImagen');
const anteriorImagen = document.getElementById('anteriorImagen');
const siguienteImagen = document.getElementById('siguienteImagen');
const contadorImagenes = document.getElementById('contadorImagenes');
let archivosSeleccionados = [];
let indiceActual = 0;
if (zonaSeleccionImagen) {
    zonaSeleccionImagen.addEventListener('click', function (e) {
        if (
            e.target.closest('#anteriorImagen') ||
            e.target.closest('#siguienteImagen')
        ) {
            return;
        }
        inputImagenes.click();
    });

    inputImagenes.addEventListener('change', function () {
        const nuevosArchivos = Array.from(this.files);
        if (nuevosArchivos.length === 0) {
            return;
        }
        archivosSeleccionados = nuevosArchivos;
        indiceActual = 0;
        mostrarImagen();
        botonGuardarImagen.disabled = false;
    });

    function mostrarImagen() {
        if (archivosSeleccionados.length === 0) {
            return;
        }
        const archivo = archivosSeleccionados[indiceActual];
        const lector = new FileReader();
        lector.onload = function (e) {
            imagenPrevia.src = e.target.result;
            imagenPrevia.classList.remove('hidden');
            contenidoImagen.classList.add('hidden');
            contadorImagenes.textContent =
                (indiceActual + 1) + ' / ' + archivosSeleccionados.length;
            if (archivosSeleccionados.length > 1) {
                contadorImagenes.classList.remove('hidden');
                anteriorImagen.classList.remove('hidden');
                anteriorImagen.classList.add('flex');
                siguienteImagen.classList.remove('hidden');
                siguienteImagen.classList.add('flex');
            } else {
                contadorImagenes.classList.add('hidden');
                anteriorImagen.classList.add('hidden');
                siguienteImagen.classList.add('hidden');
            }
        };

        lector.readAsDataURL(archivo);
    }
    anteriorImagen.addEventListener('click', function (e) {
        e.stopPropagation();
        if (indiceActual > 0) {
            indiceActual--;
            mostrarImagen();
        }
    });

    siguienteImagen.addEventListener('click', function (e) {
        e.stopPropagation();
        if (indiceActual < archivosSeleccionados.length - 1) {
            indiceActual++;
            mostrarImagen();
        }
    });
}

// Consulta API DNI, RUC
async function consultarDocumento() {
    const boton = document.getElementById('btnConsultarDocumento');
    const tipo = document.getElementById('tipo_documento').value;
    const numero = document.getElementById('numero_documento').value.trim();
    const url = boton.dataset.url;
    const nombre = document.getElementById('nombre');
    if (!tipo) {
        alert('Seleccione el tipo de documento.');
        return;
    }
    if (!numero) {
        alert('Ingrese el número de documento.');
        return;
    }
    if (tipo === 'DNI' && numero.length !== 8) {
        alert('El DNI debe tener 8 dígitos.');
        return;
    }

    if (tipo === 'RUC' && numero.length !== 11) {
        alert('El RUC debe tener 11 dígitos.');
        return;
    }
    if (tipo === 'PASAPORTE') {
        alert('La consulta automática no está disponible para pasaporte.');
        return;
    }
    if (!url) {
        alert('No se encontró la ruta de consulta.');
        return;
    }
    try {
        boton.disabled = true;

        const response = await fetch(
            `${url}?tipo_documento=${encodeURIComponent(tipo)}&numero_documento=${encodeURIComponent(numero)}`,
            {
                method: 'GET',
                headers: {
                    'Accept': 'application/json'
                }
            }
        );
        const resultado = await response.json();

        if (!response.ok || !resultado.success) {
            alert(resultado.message ?? 'No se pudo realizar la consulta.');
            return;
        }
        const data = resultado.data;
        if (tipo === 'DNI') {
            nombre.value = (
                data.nombre_completo ??
                `${data.nombres ?? ''} ${data.apellido_paterno ?? ''} ${data.apellido_materno ?? ''}`
            ).trim();

            if (document.getElementById('direccion')) {
                document.getElementById('direccion').value =
                    data.direccion ?? data.direccion_completa ?? '';
            }
        }
        if (tipo === 'RUC') {
            nombre.value =
                data.razon_social ??
                data.nombre_o_razon_social ??
                data.nombre ??
                '';
            if (document.getElementById('direccion')) {
                document.getElementById('direccion').value =
                    data.direccion ?? data.direccion_completa ?? '';
            }
        }

    } catch (error) {
        console.error(error);
        alert('Ocurrió un error al consultar el documento.');
    } finally {
        boton.disabled = false;
    }
}
window.consultarDocumento = consultarDocumento;

