<!DOCTYPE html>
<html class="light" lang="es">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Coti Express - Editar Vendedor</title>

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
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
            fontFamily: {
              display: ["Work Sans", "sans-serif"],
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
        font-variation-settings:
          "FILL" 0,
          "wght" 400,
          "GRAD" 0,
          "opsz" 24;
      }
    </style>
  </head>

  <body class="font-display bg-background-light dark:bg-background-dark">
    <div
      class="relative flex h-auto min-h-screen w-full flex-col group/design-root overflow-x-hidden"
    >
      <div class="layout-container flex h-full grow flex-col">
        <!-- Header -->
        <header
          class="sticky top-0 z-10 flex items-center justify-between whitespace-nowrap border-b border-solid border-border-light dark:border-border-dark px-6 md:px-10 py-3 bg-content-light/80 dark:bg-content-dark/80 backdrop-blur-sm"
        >
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
            <h2
              class="text-lg font-bold leading-tight tracking-[-0.015em]"
            >
              Coti Express
            </h2>
          </div>


          <div class="flex items-center gap-3">
            <button
              class="flex h-10 w-10 items-center justify-center rounded-full bg-background-light dark:bg-background-dark text-text-light-primary dark:text-text-dark-primary"
            >
              <span class="material-symbols-outlined text-xl">notifications</span>
            </button>
            <button
              class="flex h-10 w-10 items-center justify-center rounded-full bg-background-light dark:bg-background-dark text-text-light-primary dark:text-text-dark-primary"
            >
              <span class="material-symbols-outlined text-xl">settings</span>
            </button>
            <div
              class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10"
              data-alt="User avatar with abstract gradient background"
              style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDjAEaInza_qF6xnpKmPjcwznLTH8Cp8wd2v2Gb6cTSr-Vcw4NgTWPEIf-KCrnqTyVFpCVqcKQPghG81VbKNP6q9eX_DWk9d2MCEJge-rx3w4X1jVcekPXPCeQpPRsoT49bbybrE4eENbZ-ZmNqq0KzjUBUcbE0pPI7SgRvRZfTUedinJnk0-9JsGSqlxp3nizLKjQp4nTcXJ7IOyz8lKxfnd7N4LcKO2mcdvcB8iQz_i14CPCepmuGxeGO1H8BIAVy1XBv7GUSqg');"
            ></div>
          </div>
        </header>

        <!-- Main content -->
        <main class="flex flex-1 justify-center p-4 sm:p-6 md:p-8">
          <div
            class="layout-content-container flex flex-col w-full max-w-4xl flex-1 gap-6"
          >
            <div class="flex flex-col gap-2">
              <h1 class="text-text-light-primary dark:text-text-dark-primary text-4xl font-black leading-tight tracking-[-0.033em]">
                Editar  Vendedor: <?php echo $row['Nombre']; ?>
              </h1>
              <p class="text-text-light-secondary dark:text-text-dark-secondary text-base font-normal leading-normal">
                Actualiza la información de <?php echo $row['Nombre']; ?>.
              </p>
            </div>

            <div
              class="flex flex-col gap-6 rounded-xl border border-border-light dark:border-border-dark bg-content-light dark:bg-content-dark p-6 sm:p-8 shadow-sm"
            >
              <form class="flex flex-col gap-6" action="index.php?action=actuVendedor" method="POST">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="flex flex-col gap-2">

                        <input type="hidden" name="id_Usuario" value="<?php echo $row['id_Usuario']; ?>">

                        <label for="Nombre" class="text-sm font-medium text-text-light-primary dark:text-text-dark-primary"
                        >Nombre</label>
                        <input
                        name="Nombre"
                        type="text"
                        value="<?php echo $row['Nombre']; ?>"
                        class="form-input w-full rounded-lg h-12 px-4 border border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark text-text-light-primary dark:text-text-dark-primary focus:ring-2 focus:ring-primary/50 placeholder:text-text-light-secondary dark:placeholder:text-text-dark-secondary"
                        />
                        </div>

                    <div class="flex flex-col gap-2">
                        <label for="Apellido" class="text-sm font-medium text-text-light-primary dark:text-text-dark-primary"
                        >Apellido</label>
                        <input
                        name="Apellido"
                        type="text"
                        value="<?php echo $row['Apellido']; ?>"
                        class="form-input w-full rounded-lg h-12 px-4 border border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark text-text-light-primary dark:text-text-dark-primary focus:ring-2 focus:ring-primary/50 placeholder:text-text-light-secondary dark:placeholder:text-text-dark-secondary"
                        />
                    </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div class="flex flex-col gap-2">
                        <label
                            for="Matricula"
                            class="text-sm font-medium text-text-light-primary dark:text-text-dark-primary"
                            >Matricula</label
                        >
                        <input
                            name="Matricula"
                            type="tel"
                            value="<?php echo $row['Matricula']; ?>"
                            class="form-input w-full rounded-lg h-12 px-4 border border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark text-text-light-primary dark:text-text-dark-primary focus:ring-2 focus:ring-primary/50 placeholder:text-text-light-secondary dark:placeholder:text-text-dark-secondary"
                        />
                        </div>

                        <div class="flex flex-col gap-2">
                        <label
                            for="Correo"
                            class="text-sm font-medium text-text-light-primary dark:text-text-dark-primary"
                            >Correo Electrónico</label
                        >
                        <input
                            name="Correo"
                            type="email"
                            value="<?php echo $row['Correo']; ?>"
                            class="form-input w-full rounded-lg h-12 px-4 border border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark text-text-light-primary dark:text-text-dark-primary focus:ring-2 focus:ring-primary/50 placeholder:text-text-light-secondary dark:placeholder:text-text-dark-secondary"
                        />
                        </div>
                    </div>
                    
                    <div class="flex flex-col gap-2">
                        <label
                            for="Contrasena"
                            class="text-sm font-medium text-text-light-primary dark:text-text-dark-primary"
                            >Contraseña</label
                        >
                        <input
                            name="pass"
                            type="password"
                            value="<?php echo $row['pass']; ?>"
                            class="form-input w-full rounded-lg h-12 px-4 border border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark text-text-light-primary dark:text-text-dark-primary focus:ring-2 focus:ring-primary/50 placeholder:text-text-light-secondary dark:placeholder:text-text-dark-secondary"
                        />
                    </div>

                    <div class="flex flex-col sm:flex-row sm:justify-end gap-4 pt-4">

                    <button type="button">
                        <a href="index.php?action=consultVendedor"
                            class="h-12 px-6 rounded-lg bg-gradient-to-r from-teal-400 to-blue-500 text-white font-bold flex items-center justify-center gap-2 shadow-sm hover:opacity-90 transition-opacity">
                            <span class="truncate">Regresar</span>
                        </a>
                    </button>

                    <button type="submit"
                    class="h-12 px-6 rounded-lg bg-gradient-to-r from-teal-400 to-blue-500 text-white font-bold flex items-center justify-center gap-2 shadow-sm hover:opacity-90 transition-opacity"
                        name="editar"
                        >
                            <span class="truncate">Guardar Cambios</span>
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
