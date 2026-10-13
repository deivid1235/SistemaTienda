
function mostrarLogoMarca(input) {
    const contenedor = document.getElementById('preview-container-logo-marca');
    const boton = document.getElementById('quitar-logo-marca');
    if (!contenedor || !boton || !input.files || !input.files[0]) return;
    const archivo = input.files[0];
    if (!['image/jpeg', 'image/png', 'image/webp'].includes(archivo.type)) {
        input.value = '';
        alert('Selecciona un logo JPG, PNG o WEBP.');
        return;
    }
    if (archivo.size > 2 * 1024 * 1024) {
        input.value = '';
        alert('El logo no debe superar los 2 MB.');
        return;
    }
    const lector = new FileReader();
    lector.onload = function (e) {
        contenedor.innerHTML = `
            <img src="${e.target.result}" class="w-full h-full object-contain p-2" alt="Vista previa del logo">`;
        boton.classList.remove('hidden');
        boton.classList.add('flex');
    };

    lector.readAsDataURL(archivo);
}

function quitarLogoMarca(event) {
    event.preventDefault();
    event.stopPropagation();
    const input = document.getElementById('logo_marca');
    const contenedor = document.getElementById('preview-container-logo-marca');
    const boton = document.getElementById('quitar-logo-marca');
    if (!input || !contenedor || !boton) return;
    input.value = '';
    contenedor.innerHTML = `
        <i class="fa-solid fa-image text-3xl text-slate-300"></i><span class="text-xs text-slate-400 mt-2">Subir logo</span>`;
    boton.classList.add('hidden');
    boton.classList.remove('flex');
}
window.mostrarLogoMarca = mostrarLogoMarca;
window.quitarLogoMarca = quitarLogoMarca;

//Editar Imagen de Marca
function mostrarLogoMarcaEdicion(input, id) {
    const contenedor = document.getElementById('preview-container-logo-marca-edit-' + id);
    const boton = document.getElementById('quitar-logo-marca-edit-' + id);
    if (!contenedor || !boton || !input.files || !input.files[0]) return;
    const archivo = input.files[0];
    if (!['image/jpeg', 'image/png', 'image/webp'].includes(archivo.type)) {
        input.value = '';
        alert('Selecciona un logo JPG, PNG o WEBP.');
        return;
    }
    if (archivo.size > 2 * 1024 * 1024) {
        input.value = '';
        alert('El logo no debe superar los 2 MB.');
        return;
    }
    const lector = new FileReader();
    lector.onload = function (e) {
        contenedor.innerHTML = `
            <img src="${e.target.result}" class="w-full h-full object-contain p-2"alt="Vista previa del logo">`;
        boton.classList.remove('hidden');
        boton.classList.add('flex');
    };
    lector.readAsDataURL(archivo);
}

function quitarLogoMarcaEdicion(event, id) {
    event.preventDefault();
    event.stopPropagation();
    const input = document.getElementById('logo_marca_edit_' + id);
    const contenedor = document.getElementById('preview-container-logo-marca-edit-' + id);
    const boton = document.getElementById('quitar-logo-marca-edit-' + id);
    if (!input || !contenedor || !boton) return;
    input.value = '';
    contenedor.innerHTML = `<i class="fa-solid fa-image text-3xl text-slate-300"></i><span class="text-xs text-slate-400 mt-2">Subir logo</span>`;
    boton.classList.add('hidden');
    boton.classList.remove('flex');
}
window.mostrarLogoMarcaEdicion = mostrarLogoMarcaEdicion;
window.quitarLogoMarcaEdicion = quitarLogoMarcaEdicion;
