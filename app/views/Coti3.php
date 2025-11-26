<?php
// Variable esperada:
// $cot = $_SESSION['cotizacion'];
// Contiene subtotal y (si ya se calculó antes) descuento, mano_obra, impuestos, total.

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

$cot = $_SESSION['cotizacion'] ?? [];

$subtotal = isset($cot['subtotal']) ? (float)$cot['subtotal'] : 0;

$descuento_porc = isset($cot['descuento_porc']) ? (float)$cot['descuento_porc'] : 0;
$impuestos_porc = isset($cot['impuestos_porc']) ? (float)$cot['impuestos_porc'] : 16;
$mano_obra_val = isset($cot['mano_obra']) ? (float)$cot['mano_obra'] : '';
// ✅ Para cálculos (SIEMPRE número)
$mano_obra_val = isset($cot['mano_obra']) && is_numeric($cot['mano_obra'])
    ? (float)$cot['mano_obra']
    : 0;
$notas          = isset($cot['notas']) ? $cot['notas'] : '';

// Recalculo simple para mostrar (solo vista):
$monto_descuento = ($descuento_porc / 100.0) * $subtotal;
$base            = $subtotal - $monto_descuento + $mano_obra_val;
$monto_impuestos = ($impuestos_porc / 100.0) * $base;
$total_calc      = $base + $monto_impuestos;
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Coti Express - Crear Nueva Cotización</title>

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

    <script>
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            colors: {
              primary: "#13c8ec",
              "background-light": "#f6f8f8",
              "background-dark": "#101f22",
            },
            fontFamily: { display: ["Work Sans", "Noto Sans", "sans-serif"] },
            borderRadius: {
              DEFAULT: "0.25rem",
              lg: "0.5rem",
              xl: "0.75rem",
              full: "9999px",
            },
          },
        },
      };
    </script>

    <style>
      .material-symbols-outlined {
        font-variation-settings: "FILL" 0, "wght" 400, "GRAD" 0, "opsz" 24;
      }
    </style>
  </head>

  <body class="font-display">
    <div class="relative flex h-auto min-h-screen w-full flex-col bg-background-light dark:bg-background-dark overflow-x-hidden">
      <div class="layout-container flex h-full grow flex-col">

        <!-- HEADER -->
        <header class="flex items-center justify-between border-b border-slate-200 dark:border-slate-800 bg-white dark:bg-background-dark px-6 sm:px-10 py-3">
          <div class="flex items-center gap-4 text-slate-800 dark:text-white">
            <div class="size-6 text-primary">
              <svg fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                <path d="M6 6H42L36 24L42 42H6L12 24L6 6Z" fill="currentColor"></path>
              </svg>
            </div>
            <h2 class="text-lg font-bold leading-tight tracking-[-0.015em]">Coti Express</h2>
          </div>

          <div class="flex flex-1 justify-end gap-4 sm:gap-6">
            <div class="flex gap-2">
              <button class="flex items-center justify-center rounded-lg h-10 bg-slate-100 dark:bg-slate-800 text-slate-800 dark:text-white gap-2 text-sm font-bold px-2.5" type="button">
                <span class="material-symbols-outlined text-slate-600 dark:text-slate-300">notifications</span>
              </button>
              <button class="flex items-center justify-center rounded-lg h-10 bg-slate-100 dark:bg-slate-800 text-slate-800 dark:text-white gap-2 text-sm font-bold px-2.5" type="button">
                <span class="material-symbols-outlined text-slate-600 dark:text-slate-300">help</span>
              </button>
            </div>
          </div>
        </header>

        <!-- BODY -->
        <main class="px-4 sm:px-6 lg:px-8 flex flex-1 justify-center py-5">
          <div class="flex flex-col w-full max-w-4xl flex-1 gap-6">

            <div>
              <p class="text-slate-900 dark:text-white text-4xl font-black leading-tight tracking-[-0.033em]">
                Crear Nueva Cotización
              </p>
            </div>

            <!-- BARRA DE PROGRESO -->
            <div class="flex flex-col gap-3 pt-4">
              <div class="flex flex-col sm:flex-row gap-6 justify-between">
                <p class="text-slate-800 dark:text-slate-200 text-base font-medium leading-normal">
                  Paso 3 de 4: Detalles Adicionales
                </p>
              </div>

              <div class="rounded bg-slate-200 dark:bg-slate-700 h-2 w-full">
                <div class="h-2 rounded bg-primary" style="width: 75%;"></div>
              </div>
            </div>

            <div class="bg-white dark:bg-slate-900/70 rounded-xl shadow-sm border border-slate-200 dark:border-slate-800 p-6 sm:p-8 flex flex-col gap-6">

              <!-- ✅ ERRORES BACKEND -->
              <?php if (!empty($_SESSION['cotizacion_error'])): ?>
                <div class="bg-red-100 text-red-800 p-3 rounded-lg">
                  <?php echo $_SESSION['cotizacion_error']; ?>
                </div>
                <?php unset($_SESSION['cotizacion_error']); ?>
              <?php endif; ?>

              <!-- FORM -->
              <form method="post" action="index.php?action=cotizacion&step=3" class="flex flex-col gap-6">

                <h2 class="text-slate-800 dark:text-white text-[22px] font-bold leading-tight tracking-[-0.015em] pb-2 border-b border-slate-200 dark:border-slate-800">
                  Detalles Adicionales
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                  <div class="flex flex-col gap-6">

                    <!-- ✅ DESCUENTO -->
                    <label class="flex flex-col min-w-40 w-full">
                      <span class="text-sm font-medium text-slate-600 dark:text-slate-400 mb-1.5">
                        Descuento (%) *
                      </span>
                      <input
                        class="form-input w-full rounded-lg text-slate-800 dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 h-12 placeholder:text-slate-500 dark:placeholder:text-slate-400 px-4 text-base invalid:border-red-500 invalid:ring-red-500"
                        type="number"
                        name="descuento"
                        placeholder="Ej: 5"
                        required
                        min="0"
                        max="100"
                        step="0.01"
                        value="<?php echo htmlspecialchars($descuento_porc); ?>"
                      />
                    </label>

                    <!-- ✅ IMPUESTOS -->
                    <label class="flex flex-col min-w-40 w-full">
                      <span class="text-sm font-medium text-slate-600 dark:text-slate-400 mb-1.5">
                        Impuestos (%) *
                      </span>
                      <input
                        class="form-input w-full rounded-lg text-slate-800 dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 h-12 placeholder:text-slate-500 dark:placeholder:text-slate-400 px-4 text-base invalid:border-red-500 invalid:ring-red-500"
                        type="number"
                        name="impuestos"
                        placeholder="Ej: 16"
                        required
                        min="0"
                        max="100"
                        step="0.01"
                        value="<?php echo htmlspecialchars($impuestos_porc); ?>"
                      />
                    </label>

                    <label class="flex flex-col min-w-40 w-full">
                      <span class="text-sm font-medium text-slate-600 dark:text-slate-400 mb-1.5">
                        Costos de Mano de Obra
                      </span>

                      <div class="relative w-full">
                        <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-500 dark:text-slate-400">$</span>

                        <input
                          class="form-input w-full rounded-lg text-slate-800 dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 h-12 placeholder:text-slate-500 dark:placeholder:text-slate-400 px-4 pl-8 text-base font-normal leading-normal"
                          type="number"
                          name="mano_obra"
                          placeholder="0.00"
                          required
                          min="0"
                          step="0.01"
                          value="<?php echo htmlspecialchars($mano_obra_val_display); ?>"
                        />
                      </div>
                    </label>
                  </div>

                  <!-- ✅ NOTAS -->
                  <div class="flex flex-col gap-6">
                    <label class="flex flex-col min-w-40 w-full h-full">
                      <span class="text-sm font-medium text-slate-600 dark:text-slate-400 mb-1.5">
                        Notas o Comentarios
                      </span>
                      <textarea
                        class="form-textarea h-full w-full flex-1 rounded-lg text-slate-800 dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 placeholder:text-slate-500 dark:placeholder:text-slate-400 px-4 py-3 text-base"
                        name="notas"
                        placeholder="Añadir observaciones, condiciones especiales, etc."
                      ><?php echo htmlspecialchars($notas); ?></textarea>
                    </label>
                  </div>

                </div>

                <!-- RESUMEN -->
                <div class="flex justify-end pt-4 border-t border-slate-200 dark:border-slate-800">
                  <div class="flex flex-col items-end gap-2 text-right">

                    <div class="flex justify-between items-center w-64 text-sm">
                      <p class="text-slate-500 dark:text-slate-400">Subtotal:</p>
                      <p class="text-slate-700 dark:text-slate-300">$<?php echo number_format($subtotal, 2); ?></p>
                    </div>

                    <div class="flex justify-between items-center w-64 text-sm">
                      <p class="text-slate-500 dark:text-slate-400">
                        Descuento (<?php echo number_format($descuento_porc, 2); ?>%):
                      </p>
                      <p class="text-red-500 dark:text-red-400">-$<?php echo number_format($monto_descuento, 2); ?></p>
                    </div>

                    <div class="flex justify-between items-center w-64 text-sm">
                      <p class="text-slate-500 dark:text-slate-400">Mano de Obra:</p>
                      <p class="text-slate-700 dark:text-slate-300">$<?php echo number_format($mano_obra_val, 2); ?></p>
                    </div>

                    <div class="flex justify-between items-center w-64 text-sm">
                      <p class="text-slate-500 dark:text-slate-400">
                        Impuestos (<?php echo number_format($impuestos_porc, 2); ?>%):
                      </p>
                      <p class="text-slate-700 dark:text-slate-300">$<?php echo number_format($monto_impuestos, 2); ?></p>
                    </div>

                    <div class="flex justify-between items-center w-64 pt-2 mt-2 border-t border-slate-200 dark:border-slate-700">
                      <p class="text-lg font-bold text-slate-800 dark:text-white">TOTAL:</p>
                      <p class="text-2xl font-bold text-slate-900 dark:text-white">$<?php echo number_format($total_calc, 2); ?></p>
                    </div>

                  </div>
                </div>

                <!-- BOTONES -->
                <div class="flex justify-between gap-4 pt-6 border-t border-slate-200 dark:border-slate-800">
                  <a
                    href="index.php?action=cotizacion&step=2"
                    class="flex items-center justify-center rounded-lg h-12 border border-slate-300 dark:border-slate-700 bg-transparent text-slate-600 dark:text-slate-300 gap-2 text-sm font-bold px-6 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors"
                  >
                    <span class="material-symbols-outlined">arrow_back</span>
                    <span>Volver</span>
                  </a>

                  <button
                    type="submit"
                    class="flex items-center justify-center rounded-lg h-12 bg-primary text-white gap-2 text-sm font-bold px-6 hover:opacity-90 transition-opacity"
                  >
                    <span>Siguiente</span>
                    <span class="material-symbols-outlined">arrow_forward</span>
                  </button>
                </div>

              </form>
            </div>
          </div>
        </main>
      </div>
    </div>
  </body>
</html>
