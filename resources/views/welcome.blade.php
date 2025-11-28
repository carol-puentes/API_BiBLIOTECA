<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Prueba_Api') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

<h1>Consultar Préstamos</h1>

<button onclick="cargarPrestamos()">Cargar préstamos</button>

<table id="tablaPrestamos">
    <thead>
        <tr>
            <th>ID</th>
            <th>Usuario</th>
            <th>Libro</th>
            <th>Fecha Préstamo</th>
            <th>Fecha Devolución</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>

<script>
async function cargarPrestamos() {
    try {
        const response = await fetch("/api/prestamos");
        const text = await response.text();

        let data;
        try {
            data = JSON.parse(text);
        } catch (e) {
            console.warn("Respuesta no JSON:", text);
            return;
        }

        const tbody = document.querySelector("#tablaPrestamos tbody");
        tbody.innerHTML = ""; 

        const items = Object.values(data);

        if (items.length === 0) {
            tbody.innerHTML = `<tr><td colspan="6" style="text-align:center">No hay préstamos registrados</td></tr>`;
            return;
        }

        items.forEach(p => {
            const fila = `
                <tr>
                    <td>${p.id}</td>
                    <td>${p.identificacionUsuario}</td>
                    <td>${p.isbn}</td>
                    <td>—</td>
                    <td>${p.fechaMaximaDevolucion}</td>
                    <td>Activo</td>
                </tr>
            `;
            tbody.innerHTML += fila;
        });

    } catch (error) {
        console.error("Error cargando préstamos:", error);
        alert("Error al cargar los préstamos (ver consola).");
    }
}
</script>

</body>
</html>
