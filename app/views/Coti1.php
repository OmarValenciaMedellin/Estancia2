<?php
// Variables esperadas:
// $q         -> cadena de búsqueda (puede ser vacía)
// $clientes  -> mysqli_result de UserModel::buscarClientes($q)
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0"
    />
    <title>Coti Express - Crear Nueva Cotización</title>

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link
      rel="preconnect"
      href="https://fonts.gstatic.com"
      crossorigin
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"
      rel="stylesheet"
    />

    <script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
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
    <div
      class="relative flex h-auto min-h-screen w-full flex-col bg-background-light dark:bg-background-dark group/design-root overflow-x-hidden"
    >
      <div class="layout-container flex h-full grow flex-col">
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
          <div class="flex flex-1 justify-end gap-4 sm:gap-6">
            <div class="flex gap-2">
              <button
                class="flex max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 bg-slate-100 dark:bg-slate-800 text-slate-800 dark:text-white gap-2 text-sm font-bold leading-normal tracking-[0.015em] min-w-0 px-2.5"
                type="button"
              >
                <span
                  class="material-symbols-outlined text-slate-600 dark:text-slate-300"
                  >notifications</span
                >
              </button>
              <button
                class="flex max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 bg-slate-100 dark:bg-slate-800 text-slate-800 dark:text-white gap-2 text-sm font-bold leading-normal tracking-[0.015em] min-w-0 px-2.5"
                type="button"
              >
                <span
                  class="material-symbols-outlined text-slate-600 dark:text-slate-300"
                  >help</span
                >
              </button>
            </div>
          </div>
        </header>

        <main
          class="px-4 sm:px-6 lg:px-8 flex flex-1 justify-center py-5"
        >
          <div
            class="layout-content-container flex flex-col w-full max-w-4xl flex-1 gap-6"
          >
            <div>
              <p
                class="text-slate-900 dark:text-white text-4xl font-black leading-tight tracking-[-0.033em]"
              >
                Crear Nueva Cotización
              </p>
            </div>

            <div class="flex flex-col gap-3 pt-4">
              <div
                class="flex flex-col sm:flex-row gap-6 justify-between"
              >
                <p
                  class="text-slate-800 dark:text-slate-200 text-base font-medium leading-normal"
                >
                  Paso 1 de 4: Cliente
                </p>
              </div>

              <div
                class="rounded bg-slate-200 dark:bg-slate-700 h-2 w-full"
              >
                <div
                  class="h-2 rounded bg-primary"
                  style="width: 25%;"
                ></div>
              </div>
            </div>

            <div
              class="bg-white dark:bg-slate-900/70 rounded-xl shadow-sm border border-slate-200 dark:border-slate-800 p-6 sm:p-8 flex flex-col gap-8"
            >
              <div class="flex flex-col gap-6">
                <h2
                  class="text-slate-800 dark:text-white text-[22px] font-bold leading-tight tracking-[-0.015em] pb-2 border-b border-slate-200 dark:border-slate-800"
                >
                  Seleccionar Cliente
                </h2>

                <!-- BUSCADOR (GET) -->
                <form
                  method="get"
                  action="index.php"
                  class="grid grid-cols-1 md:grid-cols-3 gap-4 items-start"
                >
                  <input type="hidden" name="action" value="cotizacion" />
                  <input type="hidden" name="step" value="1" />

                  <div class="md:col-span-2 relative">
                    <label class="flex flex-col min-w-40 w-full">
                      <span
                        class="text-sm font-medium text-slate-600 dark:text-slate-400 mb-1.5"
                        >Buscar cliente existente</span
                      >
                      <div
                        class="flex w-full flex-1 items-stretch rounded-lg h-12"
                      >
                        <div
                          class="text-slate-500 dark:text-slate-400 flex border-none bg-slate-100 dark:bg-slate-800 items-center justify-center pl-4 rounded-l-lg border-r-0"
                        >
                          <span class="material-symbols-outlined"
                            >search</span
                          >
                        </div>
                        <input
                          class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-r-lg text-slate-800 dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border-none bg-slate-100 dark:bg-slate-800 h-full placeholder:text-slate-500 dark:placeholder:text-slate-400 px-4 pl-2 text-base font-normal leading-normal"
                          placeholder="Buscar por nombre, correo o ID"
                          name="q"
                          value="<?php echo htmlspecialchars($q ?? ''); ?>"
                        />
                      </div>
                    </label>
                  </div>

                  <div class="flex items-end">
                    <button
                      type="submit"
                      class="flex max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 bg-primary text-white gap-2 text-sm font-bold leading-normal tracking-[0.015em] min-w-0 px-4 hover:opacity-90 transition-opacity w-full"
                    >
                      <span class="material-symbols-outlined">search</span>
                      <span>Buscar</span>
                    </button>
                  </div>
                </form>

                <!-- LISTA DE CLIENTES -->
                <div class="mt-4">
                  <?php if ($clientes && $clientes->num_rows > 0): ?>
                    <ul
                      class="divide-y divide-slate-100 dark:divide-slate-700 rounded-lg border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900/40"
                    >
                      <?php while ($c = $clientes->fetch_assoc()): ?>
                        <li
                          class="p-3 sm:p-4 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 hover:bg-slate-100 dark:hover:bg-slate-800/60 transition-colors"
                        >
                          <div>
                            <p
                              class="font-medium text-slate-800 dark:text-white"
                            >
                              <?php echo htmlspecialchars($c['Nombre'].' '.$c['Apellido']); ?>
                            </p>
                            <p
                              class="text-sm text-slate-500 dark:text-slate-400"
                            >
                              <?php echo htmlspecialchars($c['Correo']); ?>
                              ·
                              <?php echo htmlspecialchars($c['Telefono']); ?>
                            </p>
                          </div>

                          <form
                            method="post"
                            action="index.php?action=cotizacion&step=1"
                          >
                            <input
                              type="hidden"
                              name="cliente_id"
                              value="<?php echo (int)$c['id_Cliente']; ?>"
                            />
                            <button
                              type="submit"
                              class="flex max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 bg-primary text-white gap-2 text-xs sm:text-sm font-bold leading-normal tracking-[0.015em] min-w-0 px-3 sm:px-4 hover:opacity-90 transition-opacity"
                            >
                              <span
                                class="material-symbols-outlined text-sm"
                                >person</span
                              >
                              <span>Usar este cliente</span>
                            </button>
                          </form>
                        </li>
                      <?php endwhile; ?>
                    </ul>
                  <?php else: ?>
                    <p
                      class="text-sm text-slate-500 dark:text-slate-400 mt-2"
                    >
                      No se encontraron clientes con ese criterio.
                    </p>
                  <?php endif; ?>
                </div>
              </div>

              <div
                class="flex justify-between gap-4 pt-6 border-t border-slate-200 dark:border-slate-800"
              >
                <a
                  href="index.php?action=inicio"
                  class="flex max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 border border-slate-300 dark:border-slate-700 bg-transparent text-slate-600 dark:text-slate-300 gap-2 text-sm font-bold leading-normal tracking-[0.015em] min-w-0 px-6 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors"
                >
                  <span class="material-symbols-outlined">arrow_back</span>
                  <span>Volver al inicio</span>
                </a>

                <p class="text-xs text-slate-500 dark:text-slate-400">
                  Selecciona un cliente para continuar al Paso 2.
                </p>
              </div>
            </div>
          </div>
        </main>
      </div>
    </div>
  </body>
</html>
