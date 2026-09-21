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