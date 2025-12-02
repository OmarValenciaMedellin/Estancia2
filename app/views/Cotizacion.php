<?php
// ===============================
// Preparamos variables de la vista
// ===============================

// Aquí se guardarán las cotizaciones ya convertidas a array
$listaCotizaciones = [];

// Acumuladores globales para mostrar totales
$subtotalGlobal  = 0;
$impuestosGlobal = 0;
$totalGlobal     = 0;

// Si viene $cotizaciones desde el controlador, las recorremos
if (isset($cotizaciones) && $cotizaciones && $cotizaciones->num_rows > 0) {
    while ($row = $cotizaciones->fetch_assoc()) {

        // Guardamos cada fila en un array para usarlo después
        $listaCotizaciones[] = $row;

        // Sumamos los montos para el resumen final
        $subtotalGlobal  += (float)$row['Subtotal'];
        $impuestosGlobal += (float)$row['Impuestos'];
        $totalGlobal     += (float)$row['Total'];
    }
}
?>
<!DOCTYPE html>
<html class="light" lang="es">
<head>
    <!-- Config básica -->
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Coti Express - Cotizador</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

    <!-- Fuente -->
    <link
        href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet"
    />

    <!-- Iconos -->
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"
        rel="stylesheet"
    />

    <script>
        // Config Tailwind para tema y colores
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: {
                            DEFAULT: "#2A6F97",
                            light: "#66A182",
                        },
                        "background-light": "#f6f8f8",
                        "background-dark": "#101f22",
                    },
                    fontFamily: {
                        display: ["Work Sans", "sans-serif"],
                    },
                    borderRadius: {
                        DEFAULT: "0.5rem",
                        lg: "0.75rem",
                        xl: "1rem",
                        full: "9999px",
                    },
                },
            },
        };
    </script>

    <style>
        /* Fondo con gradiente para botones */
        .gradient-bg {
            background-image: linear-gradient(to right, #2a6f97, #66a182);
        }

        /* Ajuste de iconos */
        .material-symbols-outlined {
            font-variation-settings:
                "FILL" 0,
                "wght" 400,
                "GRAD" 0,
                "opsz" 24;
        }
    </style>
</head>

<body class="bg-background-light dark:bg-background-dark font-display text-[#212529] dark:text-white">
    <div class="relative flex h-auto min-h-screen w-full flex-col overflow-x-hidden">
        <div class="layout-container flex h-full grow flex-col">

            <!-- ===============================
                 HEADER / NAV
            ================================ -->
            <header
                class="flex items-center justify-between whitespace-nowrap border-b border-solid border-b-[#f0f4f4] dark:border-b-gray-800 px-10 py-3 bg-white dark:bg-background-dark"
            >
                <!-- Logo -->
                <div class="flex items-center gap-4 text-[#111718] dark:text-white">
                    <div class="size-6 text-primary">
                        <svg fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M6 6H42L36 24L42 42H6L12 24L6 6Z"
                                fill="currentColor"
                            ></path>
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold leading-tight tracking-[-0.015em]">
                        Coti Express
                    </h2>
                </div>

                <!-- Menú central -->
                <div class="flex flex-1 justify-center gap-8">
                    <div class="flex items-center gap-9">
                        <?php
                        // Iniciamos sesión para saber el cargo del usuario
                        session_start();

                        // Si es admin, mostramos link extra
                        if ($_SESSION['Cargo'] === 'administrador'): ?>
                            <a
                                class="text-sm font-medium leading-normal text-gray-500 dark:text-gray-400 hover:text-primary dark:hover:text-primary-light"
                                href="index.php?action=inicio"
                            >
                                PaginaPrincipal
                            </a>
                        <?php endif; ?>

                        <!-- Links comunes -->
                        <a
                            class="text-sm font-medium leading-normal text-gray-500 dark:text-gray-400 hover:text-primary dark:hover:text-primary-light"
                            href="index.php?action=consultMaterial"
                        >
                            Materiales
                        </a>
                        <a
                            class="text-sm font-medium leading-normal text-gray-500 dark:text-gray-400 hover:text-primary dark:hover:text-primary-light"
                            href="index.php?action=consultCliente"
                        >
                            Clientes
                        </a>
                        <a
                            class="text-sm font-medium leading-normal text-gray-500 dark:text-gray-400 hover:text-primary dark:hover:text-primary-light"
                            href="index.php?action=inventario"
                        >
                            Inventario
                        </a>
                    </div>
                </div>

                <!-- Botón home -->
                <button
                    class="flex items-center justify-center rounded-full h-10 w-10 bg-[#f0f4f4] dark:bg-gray-800 text-[#111718] dark:text-white"
                    onclick="window.location.href='index.php?action=inicio'"
                    title="Volver al Panel"
                >
                    <span class="material-symbols-outlined">home</span>
                </button>
            </header>

            <!-- ===============================
                 MAIN (ASIDE + CONTENIDO)
            ================================ -->
            <main class="flex flex-1">

                <!-- ===== ASIDE DE MATERIALES ===== -->
                <aside
                    class="w-1/4 max-w-sm flex-shrink-0 bg-white dark:bg-background-dark p-6 border-r border-solid border-r-[#f0f4f4] dark:border-r-gray-800 flex flex-col gap-6"
                >
                    <h3 class="text-lg font-semibold leading-normal text-[#111718] dark:text-white">
                        Materiales Disponibles
                    </h3>

                    <!-- Buscador de materiales -->
                    <div class="relative">
                        <input
                            id="buscadorMaterial"
                            class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#111718] dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary bg-[#f0f4f4] dark:bg-gray-800 focus:border-none h-12 placeholder:text-gray-500 dark:placeholder:text-gray-400 p-4 text-sm font-normal leading-normal pl-10"
                            placeholder="Buscar material..."
                            type="text"
                        />
                        <span
                            class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400"
                        >
                            search
                        </span>
                    </div>

                    <!-- Lista de materiales desde BD -->
                    <div
                        id="listaMateriales"
                        class="flex flex-col gap-2 overflow-y-auto pr-2 -mra-2 max-h-[70vh]"
                    >
                        <?php if (isset($materiales) && $materiales && $materiales->num_rows > 0): ?>
                            <?php while ($m = $materiales->fetch_assoc()): ?>
                                <div
                                    class="flex items-center justify-between gap-3 p-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 cursor-pointer transition-colors group"
                                    data-role="material-item"
                                    data-nombre="<?php echo htmlspecialchars($m['Nombre']); ?>"
                                    data-costo="<?php echo htmlspecialchars($m['Costo']); ?>"
                                    data-unidad="<?php echo htmlspecialchars($m['UnidadMedida']); ?>"
                                >
                                    <div class="flex items-center gap-3 flex-1">
                                        <span class="material-symbols-outlined text-primary">
                                            inventory_2
                                        </span>

                                        <div class="flex-1">
                                            <p class="text-sm font-medium leading-normal text-[#111718] dark:text-white">
                                                <?php echo htmlspecialchars($m['Nombre']); ?>
                                            </p>

                                            <p class="text-xs text-gray-600 dark:text-gray-300">
                                                <?php
                                                // Mostramos costo formateado
                                                $costo = (float)$m['Costo'];
                                                echo '$' . number_format($costo, 2, '.', ',') .
                                                     ' / ' . htmlspecialchars($m['UnidadMedida']);
                                                ?>
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Botón para agregar al cotizador (solo UI aquí) -->
                                    <button
                                        class="flex items-center justify-center rounded-full h-8 w-8 bg-primary/10 text-primary opacity-0 group-hover:opacity-100 transition-opacity"
                                        type="button"
                                        title="Agregar a cotización"
                                    >
                                        <span class="material-symbols-outlined text-base">add</span>
                                    </button>
                                </div>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                No hay materiales registrados.
                            </p>
                        <?php endif; ?>
                    </div>
                </aside>

                <!-- ===== CONTENIDO PRINCIPAL ===== -->
                <div class="flex-1 flex flex-col p-8">

                    <!-- Título + botón nueva cotización -->
                    <div class="flex justify-between items-center mb-6">
                        <p class="text-4xl font-black leading-tight tracking-[-0.033em]">
                            Cotización Actual
                        </p>

                        <button
                            class="flex max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 gradient-bg text-white gap-2 text-sm font-bold leading-normal tracking-[0.015em] px-6 shadow-lg shadow-primary/30 hover:shadow-xl hover:shadow-primary/40 transition-shadow"
                            type="button"
                            onclick="window.location.href='index.php?action=cotizacion&step=1'"
                        >
                            <span class="material-symbols-outlined">add</span>
                            Nueva Cotización
                        </button>
                    </div>

                    <!-- ===============================
                         HISTORIAL DE COTIZACIONES
                    ================================ -->
                    <div class="mt-10">
                        <h3 class="text-xl font-semibold mb-4">
                            Historial de cotizaciones
                        </h3>

                        <?php if (!empty($listaCotizaciones)): ?>
                            <div
                                class="overflow-x-auto bg-white dark:bg-background-dark rounded-xl shadow-sm border border-gray-200 dark:border-gray-700"
                            >
                                <table class="min-w-full text-sm">
                                    <thead class="bg-gray-50 dark:bg-gray-900/60">
                                        <tr>
                                            <th class="px-4 py-3">#</th>
                                            <th class="px-4 py-3">Cliente</th>
                                            <th class="px-4 py-3">Materiales</th>
                                            <th class="px-4 py-3 text-right">Subtotal</th>
                                            <th class="px-4 py-3 text-right">Descuento</th>
                                            <th class="px-4 py-3 text-right">Mano de obra</th>
                                            <th class="px-4 py-3 text-right">Impuestos</th>
                                            <th class="px-4 py-3 text-right">Total</th>
                                            <th class="px-4 py-3 text-center">Acciones</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php foreach ($listaCotizaciones as $row): ?>
                                            <tr class="border-t hover:bg-gray-50 dark:hover:bg-gray-900/40">
                                                <td class="px-4 py-2">
                                                    <?php echo $row['id_cotizacion']; ?>
                                                </td>

                                                <td class="px-4 py-2">
                                                    <?php
                                                    // Nombre completo del cliente
                                                    echo htmlspecialchars(($row['Nombre'] ?? '') . ' ' . ($row['Apellido'] ?? ''));
                                                    ?>
                                                </td>

                                                <td class="px-4 py-2 text-sm text-gray-600 dark:text-gray-300">
                                                    <?php
                                                    // Si hay materiales concatenados, los separamos en líneas
                                                    if (!empty($row['DetallesMateriales'])) {
                                                        $itemsDet = explode(' | ', $row['DetallesMateriales']);
                                                        foreach ($itemsDet as $item) {
                                                            echo "<div>$item</div>";
                                                        }
                                                    } else {
                                                        echo "<span class='text-gray-400'>Sin materiales</span>";
                                                    }
                                                    ?>
                                                </td>

                                                <td class="px-4 py-2 text-right">
                                                    <?php echo '$' . number_format((float)$row['Subtotal'], 2); ?>
                                                </td>

                                                <td class="px-4 py-2 text-right">
                                                    <?php echo '$' . number_format((float)$row['Descuento'], 2); ?>
                                                </td>

                                                <td class="px-4 py-2 text-right">
                                                    <?php echo '$' . number_format((float)$row['Mano_obra'], 2); ?>
                                                </td>

                                                <td class="px-4 py-2 text-right">
                                                    <?php echo '$' . number_format((float)$row['Impuestos'], 2); ?>
                                                </td>

                                                <td class="px-4 py-2 text-right font-semibold">
                                                    <?php echo '$' . number_format((float)$row['Total'], 2); ?>
                                                </td>

                                                <!-- Acciones -->
                                                <td class="px-4 py-2">
                                                    <div class="flex gap-2 justify-center">

                                                        <!-- Eliminar cotización -->
                                                        <a
                                                            href="index.php?action=eliminarCotizacion&id=<?php echo $row['id_cotizacion']; ?>"
                                                            onclick="return confirm('¿Seguro que deseas eliminar esta cotización?');"
                                                        >
                                                            <button class="p-2 rounded-lg bg-red-100 text-red-600 hover:bg-red-200">
                                                                <span class="material-symbols-outlined">delete</span>
                                                            </button>
                                                        </a>

                                                        <!-- PDF individual -->
                                                        <a href="index.php?action=pdfCotizacion&id=<?php echo $row['id_cotizacion']; ?>">
                                                            <button class="p-2 rounded-lg bg-green-100 text-green-600 hover:bg-green-200">
                                                                <span class="material-symbols-outlined">picture_as_pdf</span>
                                                            </button>
                                                        </a>

                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Aún no hay cotizaciones guardadas.
                            </p>
                        <?php endif; ?>
                    </div>
                    <!-- FIN HISTORIAL -->

                    <!-- ===============================
                         RESUMEN GLOBAL DE TOTALES
                    ================================ -->
                    <?php if ($subtotalGlobal > 0): ?>
                        <div class="mt-auto pt-6">
                            <div class="grid grid-cols-2 gap-x-12 gap-y-4">
                                <div class="col-start-2 space-y-3">

                                    <div class="flex justify-between items-center text-sm">
                                        <span class="text-gray-600 dark:text-gray-400">Subtotal</span>
                                        <span class="font-medium text-[#111718] dark:text-white">
                                            <?php echo '$' . number_format($subtotalGlobal, 2); ?>
                                        </span>
                                    </div>

                                    <div class="flex justify-between items-center text-sm">
                                        <span class="text-gray-600 dark:text-gray-400">Impuestos</span>
                                        <span class="font-medium text-[#111718] dark:text-white">
                                            <?php echo '$' . number_format($impuestosGlobal, 2); ?>
                                        </span>
                                    </div>

                                    <div class="border-t border-dashed border-gray-300 dark:border-gray-700 my-2"></div>

                                    <div class="flex justify-between items-center text-2xl font-bold">
                                        <span class="gradient-bg bg-clip-text text-transparent">TOTAL</span>
                                        <span class="gradient-bg bg-clip-text text-transparent">
                                            <?php echo '$' . number_format($totalGlobal, 2); ?>
                                        </span>
                                    </div>

                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- ===============================
                         BOTONES / REPORTES PDF
                    ================================ -->
                    <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700 flex flex-col gap-4">

                        <!-- Form para PDF general filtrado por fechas -->
                        <form
                            method="get"
                            action="index.php"
                            class="flex flex-wrap gap-3 items-end bg-white/70 dark:bg-gray-900/40 p-4 rounded-lg border border-gray-200 dark:border-gray-700"
                        >
                            <input type="hidden" name="action" value="pdfGeneralCotizaciones">

                            <label class="text-sm flex flex-col">
                                Fecha inicio
                                <input
                                    type="date"
                                    name="inicio"
                                    required
                                    class="rounded border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 p-2"
                                >
                            </label>

                            <label class="text-sm flex flex-col">
                                Fecha fin
                                <input
                                    type="date"
                                    name="fin"
                                    required
                                    class="rounded border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 p-2"
                                >
                            </label>

                            <button
                                type="submit"
                                class="flex items-center justify-center rounded-lg h-10 md:h-12 bg-[#005f86] text-white gap-2 text-sm font-bold px-6 hover:bg-[#004966] transition-colors"
                            >
                                <span class="material-symbols-outlined">picture_as_pdf</span>
                                Generar PDF General
                            </button>
                        </form>
                        <!-- Form PDF clientes con más cotizaciones (filtro por N) -->
                            <form
                                method="get"
                                action="index.php"
                                class="flex flex-wrap gap-3 items-end bg-white/70 dark:bg-gray-900/40 p-4 rounded-lg border border-gray-200 dark:border-gray-700"
                            >
                                <input type="hidden" name="action" value="pdfClientesMasCotizaciones">

                                <label class="text-sm flex flex-col">
                                    Mínimo de cotizaciones
                                    <input
                                        type="number"
                                        name="min"
                                        min="1"
                                        required
                                        placeholder="Ej. 10"
                                        class="rounded border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 p-2 w-40"
                                    >
                                </label>

                                <button
                                    type="submit"
                                    class="flex items-center justify-center rounded-lg h-10 md:h-12 bg-[#005f86] text-white gap-2 text-sm font-bold px-6 hover:bg-[#004966] transition-colors"
                                >
                                    <span class="material-symbols-outlined">picture_as_pdf</span>
                                    PDF Clientes Top
                                </button>
                            </form>
                        <!-- Botón PDF de materiales más usados -->
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                            <div class="flex flex-wrap gap-3 justify-start md:justify-end w-full">
                                <a href="index.php?action=pdfGraficaMateriales" class="ml-auto">
                                    <button
                                        class="flex items-center justify-center rounded-lg h-12 bg-purple-600 text-white gap-2 text-sm font-bold px-6 hover:bg-purple-700 transition-colors"
                                        type="button"
                                    >
                                        <span class="material-symbols-outlined">bar_chart</span>
                                        PDF Gráfica
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </main>
        </div>
    </div>

    <!-- ===============================
         JS: Buscador de materiales (aside)
    ================================ -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const input = document.getElementById("buscadorMaterial");
            const items = document.querySelectorAll('[data-role="material-item"]');

            // Si no hay input o materiales no hace nada
            if (!input || !items.length) return;

            // Filtra materiales por nombre mientras escribes
            input.addEventListener("input", function () {
                const q = this.value.toLowerCase().trim();

                items.forEach((item) => {
                    const nombre = item.dataset.nombre.toLowerCase();
                    item.style.display = nombre.includes(q) ? "" : "none";
                });
            });
        });
    </script>
</body>
</html>
