// evaluar.js

// Elementos del DOM
const tipoSelect = document.getElementById('tipoCalificacion');
const starsSelector = document.getElementById('starsSelector');
const agregarBtn = document.getElementById('agregarCalificacion');
const listaCalificaciones = document.getElementById('listaCalificaciones');
const descripcion = document.getElementById('descripcion');
const contadorDescripcion = document.getElementById('contadorDescripcion');
const enviarBtn = document.getElementById('enviarEvaluacion');
const limpiarBtn = document.getElementById('limpiarFormulario');

const usuarioInput = document.getElementById('usuario');
const emailInput = document.getElementById('email');
const articuloInput = document.getElementById('articulo');

let calificacionActual = 0; // estrellas seleccionadas
let calificaciones = [];     // array de objetos {tipo, estrellas}

// === Funciones ===

// Manejo de estrellas seleccionables
starsSelector.querySelectorAll('span').forEach(star => {
    star.addEventListener('click', () => {
        calificacionActual = parseInt(star.dataset.value);
        actualizarEstrellas();
        habilitarAgregar();
    });
});

function actualizarEstrellas() {
    starsSelector.querySelectorAll('span').forEach(star => {
        star.classList.toggle('active', parseInt(star.dataset.value) <= calificacionActual);
    });
}

// Habilitar o deshabilitar botón agregar
function habilitarAgregar() {
    const tipo = tipoSelect.value;
    agregarBtn.disabled = !tipo || calificaciones.some(c => c.tipo === tipo) || calificacionActual === 0;
}

// Agregar calificación a la lista
agregarBtn.addEventListener('click', () => {
    const tipo = tipoSelect.value;
    if (!tipo || calificacionActual === 0 || calificaciones.some(c => c.tipo === tipo)) return;

    const calObj = { tipo, estrellas: calificacionActual };
    calificaciones.push(calObj);
    renderizarLista();
    tipoSelect.value = '';
    calificacionActual = 0;
    actualizarEstrellas();
    habilitarAgregar();
    validarEnviar();
});

function renderizarLista() {
    listaCalificaciones.innerHTML = '';
    calificaciones.forEach((c, idx) => {
        const li = document.createElement('li');

        const tipoSpan = document.createElement('span');
        tipoSpan.textContent = c.tipo;
        tipoSpan.style.fontWeight = '600';

        const estrellasDiv = document.createElement('div');
        estrellasDiv.classList.add('stars');
        for (let i = 1; i <= 5; i++) {
            const s = document.createElement('span');
            s.textContent = '★';
            if (i <= c.estrellas) s.classList.add('active');
            s.addEventListener('click', () => {
                calificaciones[idx].estrellas = i;
                renderizarLista();
            });
            estrellasDiv.appendChild(s);
        }

        const eliminarBtn = document.createElement('button');
        eliminarBtn.textContent = 'Eliminar';
        eliminarBtn.addEventListener('click', () => {
            calificaciones.splice(idx, 1);
            renderizarLista();
            habilitarAgregar();
            validarEnviar();
        });

        li.appendChild(tipoSpan);
        li.appendChild(estrellasDiv);
        li.appendChild(eliminarBtn);
        listaCalificaciones.appendChild(li);
    });
}

// Actualizar contador de descripción y validar longitud
descripcion.addEventListener('input', () => {
    const len = descripcion.value.length;
    contadorDescripcion.textContent = `${len} / 200`;
    if (len > 200) {
        contadorDescripcion.style.color = 'red';
    } else {
        contadorDescripcion.style.color = 'var(--muted)';
    }
    validarEnviar();
});

// Validar campos obligatorios y al menos una calificación
function validarEnviar() {
    const valido = usuarioInput.value.trim() && emailInput.value.trim() &&
        calificaciones.length > 0 && descripcion.value.length <= 300;
    enviarBtn.disabled = !valido;
}

// Botón enviar evaluación
enviarBtn.addEventListener('click', () => {
    const evaluacion = {
        usuario: usuarioInput.value.trim(),
        email: emailInput.value.trim(),
        articulo: articuloInput.value,
        calificaciones: [...calificaciones],
        descripcion: descripcion.value.trim()
    };

    // Guardar en localStorage
    const storageKey = 'evaluaciones';
    let todasEvaluaciones = JSON.parse(localStorage.getItem(storageKey)) || [];
    todasEvaluaciones.push(evaluacion);
    localStorage.setItem(storageKey, JSON.stringify(todasEvaluaciones));

    alert(`¡Evaluación enviada con éxito!\nUsuario: ${evaluacion.usuario}\nArtículo: ${evaluacion.articulo}`);

    // Reset parcial
    calificaciones = [];
    renderizarLista();
    tipoSelect.value = '';
    calificacionActual = 0;
    actualizarEstrellas();
    usuarioInput.value = '';
    emailInput.value = '';
    descripcion.value = '';
    contadorDescripcion.textContent = '0 / 200';
    validarEnviar();
});

// Botón limpiar todo
limpiarBtn.addEventListener('click', () => {
    if (confirm('¿Seguro que quieres limpiar todos los datos del formulario?')) {
        calificaciones = [];
        renderizarLista();
        tipoSelect.value = '';
        calificacionActual = 0;
        actualizarEstrellas();
        usuarioInput.value = '';
        emailInput.value = '';
        descripcion.value = '';
        contadorDescripcion.textContent = '0 / 200';
        validarEnviar();
    }
});

// Activar botón agregar al cambiar select
tipoSelect.addEventListener('change', habilitarAgregar);
