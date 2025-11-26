<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Coti Express - Registro de Cliente</title>

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500;700;800;900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&family=Lato:wght@400&display=swap" rel="stylesheet" />
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
      body { font-family: "Lato", sans-serif; }
      h1, h2, h3, h4, h5, h6 { font-family: "Poppins", sans-serif; }
    </style>
  </head>

  <body class="bg-gradient-to-br from-gradient-start to-gradient-end">
    <div class="relative flex h-auto min-h-screen w-full flex-col overflow-x-hidden">
      <div class="layout-container flex h-full grow flex-col">
        <div class="flex flex-1 justify-center py-5">
          <div class="layout-content-container flex flex-col max-w-[960px] flex-1 bg-white/70 backdrop-blur-sm rounded-xl shadow-2xl">
            <header class="flex items-center justify-between border-b border-solid border-b-[#f0f4f4] px-10 py-4">
              <div class="flex items-center gap-4 text-text-main">
                <div class="size-6 text-[#0288d1]">
                  <svg fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 6H42L36 24L42 42H6L12 24L6 6Z" fill="currentColor"></path>
                  </svg>
                </div>
                <h2 class="text-text-main text-xl font-bold font-title tracking-[-0.015em]">Coti Express</h2>
              </div>
              <div class="flex items-center gap-4">
                <p class="text-text-secondary text-sm hidden sm:block">¿Ya tienes una cuenta?</p>
                <button class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-transparent text-[#0288d1] border border-[#0288d1] hover:bg-[#0288d1] hover:text-white transition-colors text-sm font-bold leading-normal tracking-[0.015em]">
                  <a href="index.php?action=login" class="truncate">Iniciar Sesión</a>
                </button>
              </div>
            </header>

            <main class="flex-1 px-4 sm:px-10 py-8">
              <div class="flex flex-wrap justify-between gap-3 p-4">
                <div class="flex w-full flex-col gap-3 text-center">
                  <p class="text-text-main text-4xl font-black font-title tracking-tighter">Registro de Cliente</p>
                  <p class="text-text-secondary text-base font-normal leading-normal font-body">
                    Regístrate para empezar a gestionar tus cotizaciones de forma eficiente.
                  </p>
                </div>
              </div>

              <div class="mt-8">
                <form class="space-y-6 p-4" action="index.php?action=insertCliente" method="POST">
                  <div class="flex flex-col sm:flex-row max-w-full flex-wrap items-start gap-4">
                    <div class="flex flex-col min-w-40 flex-1">
                      <label class="font-body text-sm font-medium leading-normal text-text-main pb-2" for="client-nombre">Nombre</label>
                      <input
                        id="client-nombre"
                        name="nombre"
                        type="text"
                        placeholder="Ana"
                        class="form-input flex w-full min-w-0 flex-1 overflow-hidden rounded-lg text-text-main focus:outline-0 focus:ring-2 focus:ring-[#0288d1]/50 border border-[#dbe4e6] bg-white focus:border-[#0288d1] h-12 placeholder:text-text-secondary/70 p-3 text-base font-normal transition-all font-body"
                        required
                      />
                    </div>
                    <div class="flex flex-col min-w-40 flex-1">
                      <label class="font-body text-sm font-medium leading-normal text-text-main pb-2" for="client-apellido">Apellido</label>
                      <input
                        id="client-apellido"
                        name="apellido"
                        type="text"
                        placeholder="García"
                        class="form-input flex w-full min-w-0 flex-1 overflow-hidden rounded-lg text-text-main focus:outline-0 focus:ring-2 focus:ring-[#0288d1]/50 border border-[#dbe4e6] bg-white focus:border-[#0288d1] h-12 placeholder:text-text-secondary/70 p-3 text-base font-normal transition-all font-body"
                        required
                      />
                    </div>
                  </div>

                  <div class="flex flex-col sm:flex-row max-w-full flex-wrap items-start gap-4">
                    <div class="flex flex-col min-w-40 flex-1">
                      <label class="font-body text-sm font-medium leading-normal text-text-main pb-2" for="client-telefono">
                        Teléfono
                      </label>
                      <input
                      id="client-telefono"
                      name="telefono"
                      type="tel"
                      placeholder="Ej. 777 123 5678"
                      pattern="[0-9]{3} [0-9]{3} [0-9]{4}"
                      title="El formato debe ser: 777 123 5678"
                      class="form-input flex w-full min-w-0 flex-1 overflow-hidden rounded-lg text-text-main focus:outline-0 focus:ring-2 focus:ring-[#0288d1]/50 border border-[#dbe4e6] bg-white focus:border-[#0288d1] h-12 placeholder:text-text-secondary/70 p-3 text-base font-normal transition-all font-body"
                      required
                    />
                    </div>

                    <div class="flex flex-col min-w-40 flex-1">
                      <label class="font-body text-sm font-medium leading-normal text-text-main pb-2" for="client-email">Correo Electrónico</label>
                      <input
                        id="client-email"
                        name="correo"
                        type="email"
                        placeholder="tu.correo@cliente.com"
                        class="form-input flex w-full min-w-0 flex-1 overflow-hidden rounded-lg text-text-main focus:outline-0 focus:ring-2 focus:ring-[#0288d1]/50 border border-[#dbe4e6] bg-white focus:border-[#0288d1] h-12 placeholder:text-text-secondary/70 p-3 text-base font-normal transition-all font-body"
                        required
                      />
                    </div>
                  </div>

                  <div class="flex items-start p-1">
                    <div class="flex items-center h-5">
                      <input id="terms-client" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-[#0288d1]/50 text-[#009688]" required />
                    </div>
                    <label class="ml-3 text-sm font-medium text-text-secondary font-body" for="terms-client">
                      Acepto los
                      <a href="#" class="text-[#0288d1] hover:underline">Términos y Condiciones</a>
                      y
                      <a href="#" class="text-[#0288d1] hover:underline">Políticas de Privacidad</a>
                    </label>
                  </div>

                  <!-- Flag para que tu controlador detecte el envío -->
                  <input type="hidden" name="registroCliente" value="1" />

                  <center>
                    <button
                      type="submit"
                      class="flex w-full min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-4 bg-gradient-to-r from-button-start to-button-end text-white text-base font-bold leading-normal tracking-[0.015em] hover:opacity-90 transition-opacity shadow-lg">
                      <span class="truncate font-body">Registrar Cliente</span>
                    </button>

                    <br /><br />

                    <button type="submit" class="flex w-full min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-4 bg-gradient-to-r from-button-start to-button-end text-white text-base font-bold leading-normal tracking-[0.015em] hover:opacity-90 transition-opacity shadow-lg">
                    <a 
                      href="index.php?action=catalogo" 
                      class="flex w-full min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-4 bg-gradient-to-r from-button-start to-button-end text-white text-base font-bold leading-normal tracking-[0.015em] hover:opacity-90 transition-opacity shadow-lg">
                      <span class="truncate font-body">Regresar</span>
                    </a>
                    </button>

                  </center>
                </form>
              </div>
            </main>

            <footer class="text-center py-4 border-t border-solid border-t-[#f0f4f4]">
              <p class="text-sm text-text-secondary font-body">© 2024 Coti Express. Todos los derechos reservados.</p>
            </footer>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
