document.addEventListener("DOMContentLoaded", () => {
    const botonEvaluar = document.getElementById("botonEvaluar");
    const articuloNombre = document.getElementById("tituloArticulo").textContent.trim();

    botonEvaluar.addEventListener("click", () => {
        const url = `evaluar.html?articulo=${encodeURIComponent(articuloNombre)}`;
        window.location.href = url;
    });
});
