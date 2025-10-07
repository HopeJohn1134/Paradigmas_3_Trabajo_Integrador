// DOM
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


// estrellas seleccionables
starsSelector.querySelectorAll('span').forEach(star => {
    star.addEventListener('click', () => {
        calificacionActual = parseInt(star.dataset.value);
        actualizarEstrellas();
        habilitarAgregar();
    });
});

//un intento por hacer que se iluminen las estrellas de la izquierda a la selecionada/
//intento fallido
starsSelector.querySelectorAll('span').forEach(star => {
    star.addEventListener('mouseenter', () => {
        const hoverValue = parseInt(star.dataset.value);
        starsSelector.querySelectorAll('span').forEach(s => {
            s.classList.toggle('hover', parseInt(s.dataset.value) <= hoverValue);
        });
    });

    star.addEventListener('mouseleave', () => {
        starsSelector.querySelectorAll('span').forEach(s => s.classList.remove('hover'));
    });
    actualizarEstrellas();
});

function actualizarEstrellas() {
    starsSelector.querySelectorAll('span').forEach(star => {
        star.classList.toggle('active', parseInt(star.dataset.value) <= calificacionActual);
    });
}

function habilitarAgregar() {
    const tipo = tipoSelect.value;
    const tipoRepetido = calificaciones.some(c => c.tipo === tipo);
    const invalido = !tipo || tipoRepetido || calificacionActual === 0;
    agregarBtn.disabled = invalido;
}

// Validar campos obligatorios y al menos una calificación
function validarEnviar() {//capaz debería evaluar solo cuando se hace hover al boton de enviar
    const valido = usuarioInput.value.trim() && emailInput.value.trim() &&
        calificaciones.length > 0 && descripcion.value.length <= 300;
    enviarBtn.disabled = !valido;
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
descripcion.addEventListener('input', () => {//actualiza en cada cambio del input

    const len = descripcion.value.length;
    contadorDescripcion.textContent = `${len} / 200`;
    if (len > 200) {
        contadorDescripcion.style.color = 'red';
    } else {
        contadorDescripcion.style.color = 'var(--muted)';
    }
    validarEnviar();
});

//enviar evaluación
enviarBtn.addEventListener('click', () => {
    validarEnviar();
    if (enviarBtn.disabled == true) return;
    const evaluacion = {
        usuario: usuarioInput.value.trim(),
        email: emailInput.value.trim(),
        articulo: articuloInput.value,
        calificaciones: [...calificaciones],
        descripcion: descripcion.value.trim()
    };

    // no hay base de datos así que no hace nada, solo verifico que sea enviable
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

// limpiar todo
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

tipoSelect.addEventListener('change', habilitarAgregar);
