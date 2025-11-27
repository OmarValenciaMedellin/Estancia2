<!DOCTYPE html>
<html class="light" lang="es">
  <head>
    <!-- Config básica -->
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Coti Express - Gestión de Clientes</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

    <!-- Fuentes -->
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link
      href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"
      rel="stylesheet"
    />

    <!-- Configuración Tailwind -->
    <script>
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            colors: {
              primary: "#13c8ec",
              "background-light": "#f6f8f8",
              "background-dark": "#101f22",
              success: "#28A745",
              danger: "#DC3545",
              "content-light": "#ffffff",
              "content-dark": "#1a2c2f",
              "text-light-primary": "#101f22",
              "text-dark-primary": "#f6f8f8",
              "text-light-secondary": "#6C757D",
              "text-dark-secondary": "#a0b4b8",
              "border-light": "#e3e8e8",
              "border-dark": "#2a3f43",
            },
            fontFamily: { display: ["Work Sans", "sans-serif"] },
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

  <body class="font-display bg-background-light dark:bg-background-dark">
    <div
      class="relative flex h-auto min-h-screen w-full flex-col group/design-root overflow-x-hidden"
    >
      <div class="layout-container flex h-full grow flex-col">

        <!-- =========================
             TOP NAVBAR
        ========================== -->
        <header
          class="sticky top-0 z-10 flex items-center justify-between whitespace-nowrap border-b border-solid border-border-light dark:border-border-dark px-6 md:px-10 py-3 bg-content-light/80 dark:bg-content-dark/80 backdrop-blur-sm"
        >
          <!-- Logo / Título -->
          <div
            class="flex items-center gap-4 text-text-light-primary dark:text-text-dark-primary"
          >
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
            <h2 class="text-lg font-bold leading-tight tracking-[-0.015em]">
              Coti Express
            </h2>
          </div>

          <!-- Menú -->
          <div class="hidden md:flex flex-1 justify-center items-center gap-9">
            <?php
              session_start();
              if ($_SESSION['Cargo'] === 'administrador'):
            ?>
              <a
                class="text-sm font-medium leading-normal text-gray-500 dark:text-gray-400 hover:text-primary dark:hover:text-primary-light"
                href="index.php?action=inicio"
              >
                PaginaPrincipal
              </a>
            <?php endif; ?>

            <a href="#" class="text-sm font-bold leading-normal text-primary">
              Clientes
            </a>

            <a
              href="index.php?action=consultVendedor"
              class="text-sm font-medium leading-normal text-text-light-primary dark:text-text-dark-primaryy"
            >
              Vendedor
            </a>

            <a
              href="index.php?action=cotizaciones"
              class="text-sm font-medium leading-normal text-text-light-primary dark:text-text-dark-primary"
            >
              Cotizaciones
            </a>

            <a
              href="index.php?action=consultMaterial"
              class="text-sm font-medium leading-normal text-text-light-primary dark:text-text-dark-primary"
            >
              Materiales
            </a>

            <a
              href="index.php?action=inventario"
              class="text-sm font-medium leading-normal text-text-light-primary dark:text-text-dark-primary"
            >
              Inventario
            </a>
          </div>

          <!-- Acciones / Avatar -->
          <div class="flex items-center gap-3">
            <button
              class="flex h-10 w-10 cursor-pointer items-center justify-center overflow-hidden rounded-full bg-background-light dark:bg-background-dark text-text-light-primary dark:text-text-dark-primary"
              type="button"
            >
              <span class="material-symbols-outlined text-xl">notifications</span>
            </button>

            <button
              class="flex h-10 w-10 cursor-pointer items-center justify-center overflow-hidden rounded-full bg-background-light dark:bg-background-dark text-text-light-primary dark:text-text-dark-primary"
              type="button"
            >
              <span class="material-symbols-outlined text-xl">settings</span>
            </button>

            <div
              class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10"
              style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDjAEaInza_qF6xnpKmPjcwznLTH8Cp8wd2v2Gb6cTSr-Vcw4NgTWPEIf-KCrnqTyVFpCVqcKQPghG81VbKNP6q9eX_DWk9d2MCEJge-rx3w4X1jVcekPXPCeQpPRsoT49bbybrE4eENbZ-ZmNqq0KzjUBUcbE0pPI7SgRvRZfTUedinJnk0-9JsGSqlxp3nizLKjQp4nTcXJ7IOyz8lKxfnd7N4LcKO2mcdvcB8iQz_i14CPCepmuGxeGO1H8BIAVy1XBv7GUSqg");'
            ></div>
          </div>
        </header>

        <!-- =========================
             MAIN CONTENT
        ========================== -->
        <main class="flex flex-1 justify-center p-4 sm:p-6 md:p-8">
          <div
            class="layout-content-container flex flex-col w-full max-w-7xl flex-1 gap-6"
          >
            <!-- Encabezado de página -->
            <div class="flex flex-wrap items-center justify-between gap-4">
              <h1
                class="text-text-light-primary dark:text-text-dark-primary text-4xl font-black leading-tight tracking-[-0.033em]"
              >
                Gestión de Clientes
              </h1>

              <button
                class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center gap-2 overflow-hidden rounded-lg h-10 px-4 bg-primary text-white text-sm font-bold leading-normal tracking-[0.015em] shadow-sm hover:opacity-90 transition-opacity"
                type="button"
              >
                <a href="index.php?action=insertCliente2">
                  <span class="material-symbols-outlined text-xl">add</span>
                  <span class="truncate">Agregar Nuevo</span>
                </a>
              </button>
            </div>

            <!-- Tabla de datos -->
            <div
              class="w-full overflow-x-auto rounded-xl border border-border-light dark:border-border-dark bg-content-light dark:bg-content-dark shadow-sm"
            >
              <table
                class="w-full text-left text-sm text-text-light-secondary dark:text-text-dark-secondary"
              >
                <thead
                  class="bg-background-light dark:bg-background-dark text-xs uppercase tracking-wider"
                >
                  <tr>
                    <th class="px-6 py-4 font-semibold">ID</th>
                    <th class="px-6 py-4 font-semibold">Nombre</th>
                    <th class="px-6 py-4 font-semibold">Apellido</th>
                    <th class="px-6 py-4 font-semibold">Teléfono</th>
                    <th class="px-6 py-4 font-semibold">Correo Electrónico</th>
                    <th class="px-6 py-4 font-semibold">Tipo</th>
                    <th class="px-6 py-4 font-semibold">Estado</th>
                    <th class="px-6 py-4 font-semibold text-center">
                      Acciones
                    </th>
                  </tr>
                </thead>

                <tbody class="divide-y divide-border-light dark:divide-border-dark">
                  <?php while ($row = $clientes->fetch_assoc()) { ?>
                    <tr class="hover:bg-background-light dark:hover:bg-background-dark">
                      <td
                        class="px-6 py-4 font-medium text-text-light-primary dark:text-text-dark-primary whitespace-nowrap"
                      >
                        <?php echo $row['id_Cliente']; ?>
                      </td>

                      <td
                        class="px-6 py-4 font-medium text-text-light-primary dark:text-text-dark-primary whitespace-nowrap"
                      >
                        <?php echo $row['Nombre']; ?>
                      </td>

                      <td
                        class="px-6 py-4 font-medium text-text-light-primary dark:text-text-dark-primary whitespace-nowrap"
                      >
                        <?php echo $row['Apellido']; ?>
                      </td>

                      <td class="px-6 py-4">
                        <?php echo $row['Telefono']; ?>
                      </td>

                      <td class="px-6 py-4">
                        <?php echo $row['Correo']; ?>
                      </td>

                      <td class="px-6 py-4">Cliente</td>

                      <td class="px-6 py-4">
                        <span
                          class="inline-flex items-center gap-1.5 rounded-full bg-success/20 px-2.5 py-0.5 text-xs font-medium text-success"
                        >
                          <span class="size-1.5 rounded-full bg-success"></span>
                          Activo
                        </span>
                      </td>

                      <!-- Acciones -->
                      <td class="px-6 py-4 text-center">
                        <div class="flex justify-center gap-2">

                          <!-- Editar -->
                          <button
                            class="p-2 rounded-lg hover:bg-primary/20 text-primary transition-colors"
                            type="button"
                          >
                            <a
                              href="index.php?action=actuCliente&id=<?php echo $row['id_Cliente']; ?>"
                            >
                              <span class="material-symbols-outlined text-xl">edit</span>
                            </a>
                          </button>

                          <!-- Eliminar -->
                          <a
                            href="index.php?action=deleteCliente&id=<?php echo $row['id_Cliente']; ?>"
                          >
                            <button
                              class="p-2 rounded-lg hover:bg-danger/20 text-danger transition-colors"
                              type="button"
                            >
                              <span class="material-symbols-outlined text-xl">delete</span>
                            </button>
                          </a>

                        </div>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </main>
      </div>
    </div>
  </body>
</html>
