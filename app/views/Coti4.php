<?php
// Inicia sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Trae la cotización guardada en sesión
$cot     = $_SESSION['cotizacion'] ?? [];
$cliente = $cot['cliente'] ?? null;

// Lista de materiales cotizados (detalles)
$items = $cot['detalles'] ?? [];

// Fecha ISO (YYYY-mm-dd) o la de hoy si no existe
$fecha_iso = $cot['fecha'] ?? date('Y-m-d');

// Formato bonito de fecha en español
setlocale(LC_TIME, 'es_MX.UTF-8', 'es_ES.UTF-8', 'es_ES', 'spanish');
$timestamp   = strtotime($fecha_iso);
$fecha_larga = strftime('%e de %B, %Y', $timestamp);

// Valores para resumen de totales
$subtotal       = (float)($cot['subtotal'] ?? 0);
$descuento_porc = (float)($cot['descuento_porc'] ?? 0);
$impuestos_porc = (float)($cot['impuestos_porc'] ?? 16);
$mano_obra_val  = (float)($cot['mano_obra'] ?? 0);
$notas          = $cot['notas'] ?? '';

// Recalcula totales solo para mostrar en pantalla
$monto_descuento = ($descuento_porc / 100.0) * $subtotal;
$base            = $subtotal - $monto_descuento + $mano_obra_val;
$monto_impuestos = ($impuestos_porc / 100.0) * $base;
$total_calc      = $base + $monto_impuestos;

// Error de sesión (si hubo problema al guardar)
$mensaje_error = $_SESSION['cotizacion_error'] ?? '';
unset($_SESSION['cotizacion_error']); // Limpia para que no se repita
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <!-- Meta básicos -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Coti Express - Crear Nueva Cotización</title>

    <!-- TailwindCSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

    <!-- Fuentes e iconos -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"
      rel="stylesheet"
    />

    <!-- Config Tailwind -->
    <script id="tailwind-config">
      tailwind.config = {
        darkMode: "class", // modo oscuro por clase
        theme: {
          extend: {
            colors: {
              primary: "#13c8ec",
              "background-light": "#f6f8f8",
              "background-dark": "#101f22",
            },
            fontFamily: {
              display: ["Work Sans", "Noto Sans", "sans-serif"],
            },
          },
        },
      };
    </script>

    <!-- Ajuste para iconos de Google -->
    <style>
      .material-symbols-outlined {
        font-variation-settings: "FILL" 0, "wght" 400, "GRAD" 0, "opsz" 24;
      }
    </style>
  </head>

  <body class="font-display">
    <div
      class="relative flex min-h-screen w-full flex-col bg-background-light dark:bg-background-dark"
    >
      <div class="layout-container flex h-full grow flex-col">

        <!-- HEADER -->
        <header
          class="flex items-center justify-between whitespace-nowrap border-b border-solid border-slate-200 dark:border-slate-800 bg-white dark:bg-background-dark px-6 sm:px-10 py-3"
        >
          <div class="flex items-center gap-4 text-slate-800 dark:text-white">
            <div class="size-6 text-primary">
              <svg
                fill="none"
                viewBox="0 0 48 48"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M6 6H42L36 24L42 42H6L12 24L6 6Z"
                  fill="currentColor"
                ></path>
              </svg>
            </div>
            <h2
              class="text-slate-800 dark:text-white text-lg font-bold leading-tight tracking-[-0.015em]"
            >
              Coti Express
            </h2>
          </div>
        </header>

        <!-- MAIN -->
        <main class="px-4 sm:px-6 lg:px-8 flex flex-1 justify-center py-5">
          <div
            class="layout-content-container flex flex-col w-full max-w-4xl flex-1 gap-6"
          >
            <!-- Título -->
            <div>
              <p
                class="text-slate-900 dark:text-white text-4xl font-black leading-tight tracking-[-0.033em]"
              >
                Crear Nueva Cotización
              </p>
            </div>

            <!-- Mensaje de error si existe -->
            <?php if (!empty($mensaje_error)): ?>
              <div
                class="rounded-lg bg-red-100 border border-red-300 text-red-700 px-4 py-3 text-sm"
              >
                <?php echo $mensaje_error; ?>
              </div>
            <?php endif; ?>

            <!-- Barra de progreso -->
            <div class="flex flex-col gap-3 pt-4">
              <div class="flex flex-col sm:flex-row gap-6 justify-between">
                <p
                  class="text-slate-800 dark:text-slate-200 text-base font-medium leading-normal"
                >
                  Paso 4 de 4: Revisión y Confirmación
                </p>
              </div>

              <div class="rounded bg-slate-200 dark:bg-slate-700 h-2 w-full">
                <div class="h-2 rounded bg-primary" style="width: 100%;"></div>
              </div>
            </div>

            <!-- Card principal -->
            <div
              class="bg-white dark:bg-slate-900/70 rounded-xl shadow-sm border border-slate-200 dark:border-slate-800 p-6 sm:p-8 flex flex-col gap-8"
            >
              <!-- Form para guardar definitivamente -->
              <form
                method="post"
                action="index.php?action=guardarCotizacion"
                class="flex flex-col gap-6"
              >
                <!-- Cliente + notas -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                  
                  <!-- Datos cliente -->
                  <div class="flex flex-col gap-2">
                    <h3
                      class="text-base font-bold text-slate-800 dark:text-white mb-2"
                    >
                      Detalles del Cliente
                    </h3>

                    <?php if ($cliente): ?>
                      <div
                        class="text-sm space-y-1.5 text-slate-600 dark:text-slate-300"
                      >
                        <p>
                          <strong>Nombre:</strong>
                          <?php echo htmlspecialchars($cliente['Nombre'].' '.$cliente['Apellido']); ?>
                        </p>
                        <p>
                          <strong>Correo:</strong>
                          <?php echo htmlspecialchars($cliente['Correo']); ?>
                        </p>
                        <p>
                          <strong>Teléfono:</strong>
                          <?php echo htmlspecialchars($cliente['Telefono']); ?>
                        </p>
                      </div>
                    <?php else: ?>
                      <p class="text-sm text-red-500">
                        No hay cliente seleccionado.
                      </p>
                    <?php endif; ?>
                  </div>

                  <!-- Notas -->
                  <div class="flex flex-col gap-2">
                    <h3
                      class="text-base font-bold text-slate-800 dark:text-white mb-2"
                    >
                      Notas / Comentarios
                    </h3>

                    <p
                      class="text-sm text-slate-600 dark:text-slate-300 italic"
                    >
                      <?php echo nl2br(htmlspecialchars($notas)); ?>
                    </p>
                  </div>
                </div>

                <!-- Tabla de materiales -->
                <div class="flex flex-col gap-2">
                  <h3
                    class="text-base font-bold text-slate-800 dark:text-white mb-2"
                  >
                    Materiales Cotizados
                  </h3>

                  <!-- Fecha de generación -->
                  <h3
                    class="text-base font-bold text-slate-800 dark:text-white mb-2 text-right"
                  >
                    <strong>Fecha de Generación:</strong>
                    <?php echo htmlspecialchars($fecha_larga); ?>
                  </h3>

                  <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                      <thead
                        class="bg-slate-50 dark:bg-slate-800 text-xs text-slate-500 dark:text-slate-400 uppercase"
                      >
                        <tr>
                          <th class="px-4 py-3">Material</th>
                          <th class="px-4 py-3 text-center">Ancho (cm)</th>
                          <th class="px-4 py-3 text-center">Alto (cm)</th>
                          <th class="px-4 py-3 text-center">Cantidad</th>
                          <th class="px-4 py-3 text-right">Precio Unitario</th>
                          <th class="px-4 py-3 text-right">Subtotal</th>
                        </tr>
                      </thead>

                      <tbody class="divide-y divide-slate-200 dark:divide-slate-800">
                        <?php foreach ($items as $it): ?>
                          <tr class="text-slate-700 dark:text-slate-300">
                            <td class="px-4 py-3 font-medium">
                              <?php echo htmlspecialchars($it['nombre']); ?>
                            </td>
                            <td class="px-4 py-3 text-center">
                              <?php echo number_format((float)$it['ancho_cm'], 2); ?>
                            </td>
                            <td class="px-4 py-3 text-center">
                              <?php echo number_format((float)$it['alto_cm'], 2); ?>
                            </td>
                            <td class="px-4 py-3 text-center">
                              <?php echo (int)$it['cantidad']; ?>
                            </td>
                            <td class="px-4 py-3 text-right">
                              $<?php echo number_format((float)$it['precio_unitario'], 2); ?>
                            </td>
                            <td class="px-4 py-3 text-right font-semibold">
                              $<?php echo number_format((float)$it['subtotal'], 2); ?>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>

                <!-- Resumen de totales -->
                <div
                  class="flex flex-col items-end pt-4 border-t border-slate-200 dark:border-slate-800"
                >
                  <div class="flex flex-col items-end gap-2 text-right w-full max-w-sm">

                    <div class="flex justify-between items-center w-full text-sm">
                      <p class="text-slate-500 dark:text-slate-400">
                        Subtotal Materiales:
                      </p>
                      <p class="text-slate-700 dark:text-slate-300">
                        $<?php echo number_format($subtotal, 2); ?>
                      </p>
                    </div>

                    <div class="flex justify-between items-center w-full text-sm">
                      <p class="text-slate-500 dark:text-slate-400">
                        Descuento (<?php echo number_format($descuento_porc, 2); ?>%):
                      </p>
                      <p class="text-red-500 dark:text-red-400">
                        - $<?php echo number_format($monto_descuento, 2); ?>
                      </p>
                    </div>

                    <div class="flex justify-between items-center w-full text-sm">
                      <p class="text-slate-500 dark:text-slate-400">
                        Mano de Obra:
                      </p>
                      <p class="text-slate-700 dark:text-slate-300">
                        $<?php echo number_format($mano_obra_val, 2); ?>
                      </p>
                    </div>

                    <div class="flex justify-between items-center w-full text-sm">
                      <p class="text-slate-500 dark:text-slate-400">
                        Impuestos (<?php echo number_format($impuestos_porc, 2); ?>%):
                      </p>
                      <p class="text-slate-700 dark:text-slate-300">
                        $<?php echo number_format($monto_impuestos, 2); ?>
                      </p>
                    </div>

                    <!-- Total final -->
                    <div
                      class="flex justify-between items-center w-full p-4 mt-4 bg-slate-50 dark:bg-slate-800/50 rounded-lg"
                    >
                      <p class="text-xl font-bold text-slate-800 dark:text-white">
                        TOTAL:
                      </p>
                      <p
                        class="text-4xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-teal-400 to-blue-500"
                      >
                        $<?php echo number_format($total_calc, 2); ?>
                      </p>
                    </div>
                  </div>
                </div>

                <!-- Botones finales -->
                <div
                  class="flex flex-col-reverse sm:flex-row sm:justify-between items-center gap-4 pt-6 border-t border-slate-200 dark:border-slate-800"
                >
                  <!-- Botones izq -->
                  <div class="flex gap-4">
                    <a
                      href="index.php?action=cotizacion&step=3"
                      class="flex max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 border border-slate-300 dark:border-slate-700 bg-transparent text-slate-600 dark:text-slate-300 gap-2 text-sm font-bold px-6 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors"
                    >
                      <span class="material-symbols-outlined">arrow_back</span>
                      <span>Volver</span>
                    </a>

                    <!-- Cancelar y regresar a cotizaciones -->
                    <button
                      type="button"
                      class="flex max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 bg-transparent text-red-600 dark:text-red-500 gap-2 text-sm font-bold px-6 hover:bg-red-50 dark:hover:bg-red-500/10 transition-colors"
                      onclick="window.location.href='index.php?action=cotizaciones';"
                    >
                      <span>Cancelar</span>
                    </button>
                  </div>

                  <!-- Botón guardar definitivo -->
                  <div class="flex flex-col sm:flex-row w-full sm:w-auto gap-4">
                    <button
                      type="submit"
                      class="flex w-full sm:w-auto max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 bg-gradient-to-r from-teal-400 to-blue-500 text-white gap-2 text-sm font-bold px-6 hover:opacity-90 transition-opacity"
                    >
                      <span class="material-symbols-outlined">save</span>
                      <span>Guardar Cotización</span>
                    </button>
                  </div>
                </div>

              </form>
            </div>
          </div>
        </main>
      </div>
    </div>
  </body>
</html>
