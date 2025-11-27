<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Coti Express - Registro de Usuario</title>

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

    <link
      href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500;700;800;900&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&family=Lato:wght@400&display=swap"
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
              "text-main": "#212121",
              "text-secondary": "#757575",
              error: "#ef5350",
            },
            fontFamily: {
              display: ["Work Sans", "Noto Sans", "sans-serif"],
              title: ["Poppins", "sans-serif"],
              body: ["Lato", "sans-serif"],
            },
            borderRadius: {
              DEFAULT: "0.5rem",
              lg: "0.75rem",
              xl: "1rem",
              full: "9999px",
            },
            gradientColorStops: {
              "gradient-start": "#e0f7fa",
              "gradient-end": "#e8f5e9",
              "button-start": "#0288d1",
              "button-end": "#009688",
            },
          },
        },
      };
    </script>

    <style>
      body {
        font-family: "Lato", sans-serif;
      }
      h1,
      h2,
      h3,
      h4,
      h5,
      h6 {
        font-family: "Poppins", sans-serif;
      }
    </style>
  </head>

  <body class="bg-gradient-to-br from-gradient-start to-gradient-end">
    <div
      class="relative flex h-auto min-h-screen w-full flex-col overflow-x-hidden"
    >
      <div class="layout-container flex h-full grow flex-col">
        <div class="flex flex-1 justify-center py-5">
          <div
            class="layout-content-container flex flex-col max-w-[960px] flex-1 bg-white/70 backdrop-blur-sm rounded-xl shadow-2xl"
          >
            <!-- Header -->
            <header
              class="flex items-center justify-between whitespace-nowrap border-b border-solid border-b-[#f0f4f4] px-10 py-4"
            >
              <div class="flex items-center gap-4 text-text-main">
                <div class="size-6 text-[#0288d1]">
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
                  class="text-text-main text-xl font-bold font-title tracking-[-0.015em]"
                >
                  Coti Express
                </h2>
              </div>
            </header>

            <!-- Main -->
            <main class="flex-1 px-4 sm:px-10 py-8">
              <div class="flex flex-wrap justify-between gap-3 p-4">
                <div class="flex w-full flex-col gap-3 text-center">
                  <p
                    class="text-text-main text-4xl font-black font-title tracking-tighter"
                  >
                    Crear cuenta Vendedor
                  </p>
                  <p
                    class="text-text-secondary text-base font-normal leading-normal font-body"
                  >
                    Regístrate para empezar a gestionar tus cotizaciones de forma
                    eficiente.
                  </p>
                </div>
              </div>

              <!-- Formulario -->
              <div id="user-form">
                <!-- IMPORTANTE: usa una acción que exista en tu router (index.php) -->
                <form
                  class="space-y-6 p-4"
                  action="index.php?action=insertVendedor"
                  method="POST"
                >
                  <div
                    class="flex flex-col sm:flex-row max-w-full flex-wrap items-start gap-4"
                  >
                    <div class="flex flex-col min-w-40 flex-1">
                      <label
                        class="font-body text-sm font-medium leading-normal text-text-main pb-2"
                        for="user-nombre"
                        >Nombre</label
                      >
                      <input
                        id="user-nombre"
                        name="nombre"
                        placeholder="Juan"
                        type="text"
                        required
                        class="form-input flex w-full min-w-0 flex-1 overflow-hidden rounded-lg text-text-main focus:outline-0 focus:ring-2 focus:ring-[#0288d1]/50 border border-[#dbe4e6] bg-white focus:border-[#0288d1] h-12 p-3 placeholder:text-text-secondary/70 text-base font-normal font-body transition-all"
                      />
                    </div>

                    <div class="flex flex-col min-w-40 flex-1">
                      <label
                        class="font-body text-sm font-medium leading-normal text-text-main pb-2"
                        for="user-apellido"
                        >Apellido</label
                      >
                      <input
                        id="user-apellido"
                        name="apellido"
                        placeholder="Pérez"
                        type="text"
                        required
                        class="form-input flex w-full min-w-0 flex-1 overflow-hidden rounded-lg text-text-main focus:outline-0 focus:ring-2 focus:ring-[#0288d1]/50 border border-[#dbe4e6] bg-white focus:border-[#0288d1] h-12 p-3 placeholder:text-text-secondary/70 text-base font-normal font-body transition-all"
                      />
                    </div>
                  </div>

                  <div
                    class="flex flex-col sm:flex-row max-w-full flex-wrap items-start gap-4"
                  >
                    <div class="flex flex-col min-w-40 flex-1">
                      <label
                        class="font-body text-sm font-medium leading-normal text-text-main pb-2"
                        for="user-matricula"
                        >Matrícula</label
                      >
                      <input
                        id="user-matricula"
                        name="matricula"
                        placeholder="Ej. A01234567"
                        type="text"
                        required
                        class="form-input flex w-full min-w-0 flex-1 overflow-hidden rounded-lg text-text-main focus:outline-0 focus:ring-2 focus:ring-[#0288d1]/50 border border-[#dbe4e6] bg-white focus:border-[#0288d1] h-12 p-3 placeholder:text-text-secondary/70 text-base font-normal font-body transition-all"
                      />
                    </div>

                    <div class="flex flex-col min-w-40 flex-1">
                      <label
                        class="font-body text-sm font-medium leading-normal text-text-main pb-2"
                        for="user-cargo"
                        >Cargo</label
                      >
                      <input
                        id="user-cargo"
                        name="cargo"
                        placeholder="Ej. Gerente de Ventas"
                        type="text"
                        required
                        class="form-input flex w-full min-w-0 flex-1 overflow-hidden rounded-lg text-text-main focus:outline-0 focus:ring-2 focus:ring-[#0288d1]/50 border border-[#dbe4e6] bg-white focus:border-[#0288d1] h-12 p-3 placeholder:text-text-secondary/70 text-base font-normal font-body transition-all"
                      />
                    </div>
                  </div>

                  <div class="flex max-w-full flex-wrap items-start gap-4">
                    <div class="flex flex-col min-w-40 flex-1">
                      <label
                        class="font-body text-sm font-medium leading-normal text-text-main pb-2"
                        for="user-email"
                        >Correo Electrónico</label
                      >
                      <input
                        id="user-email"
                        name="correo"
                        placeholder="tu.correo@ejemplo.com"
                        type="email"
                        required
                        class="form-input flex w-full min-w-0 flex-1 overflow-hidden rounded-lg text-text-main focus:outline-0 focus:ring-2 focus:ring-[#0288d1]/50 border border-[#dbe4e6] bg-white focus:border-[#0288d1] h-12 p-3 placeholder:text-text-secondary/70 text-base font-normal font-body transition-all"
                      />
                    </div>
                  </div>

                  <div
                    class="flex flex-col sm:flex-row max-w-full flex-wrap items-start gap-4"
                  >
                    <div class="flex flex-col min-w-40 flex-1">
                      <label
                        class="font-body text-sm font-medium leading-normal text-text-main pb-2"
                        for="user-password"
                        >Contraseña</label
                      >
                      <div class="relative w-full">
                        <input
                          id="user-password"
                          name="pass"
                          placeholder="Tu contr"
                          type="password"
                          required
                          class="form-input flex w-full min-w-0 flex-1 overflow-hidden rounded-lg text-text-main focus:outline-0 focus:ring-2 focus:ring-[#0288d1]/50 border border-[#dbe4e6] bg-white focus:border-[#0288d1] h-12 p-3 pr-10 placeholder:text-text-secondary/70 text-base font-normal font-body transition-all"
                        />

                        <button
                          id="toggle-pass"
                          type="button"
                          class="absolute inset-y-0 right-0 flex items-center pr-3 text-text-secondary"
                          aria-label="Mostrar u ocultar contraseña"
                        >
                          <span class="material-symbols-outlined"
                            >visibility</span
                          >
                        </button>
                      </div>
                    </div>
                  </div>

                  <script>
                    const togglePass = document.getElementById("toggle-pass");
                    const inputPass = document.getElementById("user-password");
                    const icon = togglePass.querySelector(
                      ".material-symbols-outlined"
                    );

                    togglePass.addEventListener("click", () => {
                      const isPassword = inputPass.type === "password";
                      inputPass.type = isPassword ? "text" : "password";
                      icon.textContent = isPassword
                        ? "visibility_off"
                        : "visibility"; // cambia el ícono
                    });
                  </script>

                  <center>
                    <button
                      type="submit"
                      name="registro"
                      class="flex w-full min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-4 bg-gradient-to-r from-button-start to-button-end text-white text-base font-bold leading-normal tracking-[0.015em] hover:opacity-90 transition-opacity shadow-lg"
                    >
                      <span class="truncate font-body"
                        >Registrar vendedor</span
                      >
                    </button>

                    <br /><br />

                    <a
                      href="index.php?action=inicio"
                      class="flex w-full min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-4 bg-gradient-to-r from-button-start to-button-end text-white text-base font-bold leading-normal tracking-[0.015em] hover:opacity-90 transition-opacity shadow-lg"
                    >
                      Regresar
                    </a>
                  </center>
                </form>
              </div>
            </main>

            <!-- Footer -->
            <footer
              class="text-center py-4 border-t border-solid border-t-[#f0f4f4]"
            >
              <p class="text-sm text-text-secondary font-body">
                © 2024 Coti Express. Todos los derechos reservados.
              </p>
            </footer>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
