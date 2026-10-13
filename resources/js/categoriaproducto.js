
function mostrarImagenCategoria(input) {
    const container = document.getElementById('preview-container-imagen');
    const btnQuitar = document.getElementById('quitar-imagen');

    if (!container || !btnQuitar) {
        console.error('No se encontró el contenedor de imagen o el botón para quitarla.');
        return;
    }
    if (input.files && input.files[0]) {
        const archivo = input.files[0];

        if (!archivo.type.startsWith('image/')) {
            alert('Selecciona un archivo de imagen válido.');
            input.value = '';
            return;
        }
        const reader = new FileReader();
        reader.onload = function (e) {
            container.innerHTML = `<img src="${e.target.result}"class="w-full h-full object-cover"alt="Vista previa"> `;
            btnQuitar.classList.remove('hidden');
            btnQuitar.classList.add('flex');
        };
        reader.readAsDataURL(archivo);
    }
}

function quitarImagen(event) {
    event.preventDefault();
    event.stopPropagation();
    const input = document.getElementById('imagen');
    const container = document.getElementById('preview-container-imagen');
    const btnQuitar = document.getElementById('quitar-imagen');
    if (!input || !container || !btnQuitar) return;
    input.value = '';
    container.innerHTML = `<span class="text-4xl font-light text-slate-300">+</span><span class="text-xs text-slate-400 mt-2">Subir imagen</span>`;
    btnQuitar.classList.add('hidden');
    btnQuitar.classList.remove('flex');
}
window.mostrarImagenCategoria = mostrarImagenCategoria;
window.quitarImagen = quitarImagen;

//Editar Foto de categoria
function mostrarImagenCategoriaEdicion(input, id) {
    const contenedor = document.getElementById('preview-container-imagen-edit-' + id);
    const botonQuitar = document.getElementById('quitar-imagen-edit-' + id);
    if (!contenedor || !botonQuitar) {
        console.error('No se encontró la vista previa de la categoría:', id);
        return;
    }
    if (!input.files || !input.files[0]) return;
    const archivo = input.files[0];
    if (!['image/jpeg', 'image/png', 'image/webp'].includes(archivo.type)) {
        input.value = ''; alert('Selecciona una imagen JPG, PNG o WEBP.');
        return;
    }
    if (archivo.size > 2 * 1024 * 1024) {
        input.value = ''; alert('La imagen no debe superar los 2 MB.');
        return;
    }
    const lector = new FileReader();
    lector.onload = function (e) {
        contenedor.innerHTML = `
            <img src="${e.target.result}" class="w-full h-full object-cover" alt="Vista previa">`;
        botonQuitar.classList.remove('hidden');
        botonQuitar.classList.add('flex');
    };
    lector.readAsDataURL(archivo);
}

function quitarImagenEdicion(event, id) {
    event.preventDefault();
    event.stopPropagation();
    const input = document.getElementById('imagen_edit_' + id);
    const contenedor = document.getElementById(
        'preview-container-imagen-edit-' + id
    );
    const boton = document.getElementById('quitar-imagen-edit-' + id);
    if (!input || !contenedor || !boton) return;
    input.value = '';
    contenedor.innerHTML = `
        <span class="text-4xl font-light text-slate-300">+</span>
        <span class="text-xs text-slate-400 mt-2">Subir imagen</span>`;
    boton.classList.add('hidden');
    boton.classList.remove('flex');
}

// Hacer accesibles las funciones desde los eventos del HTML.
window.mostrarImagenCategoriaEdicion = mostrarImagenCategoriaEdicion;
window.quitarImagenEdicion = quitarImagenEdicion;


