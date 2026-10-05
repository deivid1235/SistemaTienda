window.toggleSubpermisos = function(button) {
    const group = button.closest('.permission-group');
    const container = group.querySelector('.subpermisos-container');
    const svg = button.querySelector('svg');

    if (container.style.display === 'none') {
        container.style.display = 'block';
        svg.style.transform = 'rotate(90deg)';
    } else {
        container.style.display = 'none';
        svg.style.transform = 'rotate(0deg)';
    }
};

window.togglePermisosModulo = function(checkbox) {
    const group = checkbox.closest('.permission-group');
    const permisos = group.querySelectorAll('.permiso-checkbox');

    permisos.forEach(function(permiso) {
        permiso.checked = checkbox.checked;
    });
};

window.actualizarModulo = function(checkbox) {
    const group = checkbox.closest('.permission-group');
    const modulo = group.querySelector('.modulo-checkbox');
    const permisos = group.querySelectorAll('.permiso-checkbox');

    const todosMarcados = Array.from(permisos).every(function(permiso) {
        return permiso.checked;
    });

    modulo.checked = todosMarcados;
};
//Foto
window.mostrarFoto = function(input) {
    const preview = document.getElementById('preview-container');
    const quitar = document.getElementById('quitar-foto');

    if (input.files && input.files[0]) {
        const archivo = input.files[0];
        const imagen = document.createElement('img');
        imagen.src = URL.createObjectURL(archivo);
        imagen.className = 'w-full h-full object-cover';
        preview.innerHTML = '';
        preview.appendChild(imagen);
        quitar.classList.remove('hidden');
        quitar.classList.add('flex');
    }
};

window.quitarFoto = function(event) {
    event.preventDefault();
    event.stopPropagation();
    const input = document.getElementById('foto');
    const preview = document.getElementById('preview-container');
    const quitar = document.getElementById('quitar-foto');
    input.value = '';
    preview.innerHTML = '<span class="text-4xl font-light text-slate-300">x</span>';
    quitar.classList.remove('flex');
    quitar.classList.add('hidden');
};

window.mostrarFotoEditar = function(input, usuarioId) {
    const preview = document.getElementById('preview-container-edit-' + usuarioId);

    if (input.files && input.files[0]) {
        const archivo = input.files[0];
        const imagen = document.createElement('img');

        imagen.src = URL.createObjectURL(archivo);
        imagen.className = 'w-full h-full object-cover';

        preview.innerHTML = '';
        preview.appendChild(imagen);
    }
};

window.quitarFotoEditar = function(event, usuarioId) {
    event.preventDefault();
    event.stopPropagation();

    const input = document.getElementById('foto_edit_' + usuarioId);
    const preview = document.getElementById('preview-container-edit-' + usuarioId);

    input.value = '';

    preview.innerHTML = '<span class="text-4xl font-light text-slate-300">x</span>';
};