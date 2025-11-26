<!DOCTYPE html>
<html class="light" lang="es">
<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>Coti Express - Iniciar Sesión</title>
  <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
  <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500;700&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
  <script id="tailwind-config">
    tailwind.config = {
      darkMode: "class",
      theme: {
        extend: {
          colors: {
            primary: "#13a4ec",
            "background-light": "#f6f7f8",
            "background-dark": "#101c22",
          },
          fontFamily: {
            display: ["Work Sans", "Noto Sans", "sans-serif"]
          },
          borderRadius: {
            DEFAULT: "0.25rem",
            lg: "0.5rem",
            xl: "0.75rem",
            full: "9999px"
          },
        },
      },
    }
  </script>
</head>
<body class="bg-background-light dark:bg-background-dark">
  <div class="relative flex min-h-screen w-full flex-col overflow-x-hidden bg-gradient-to-br from-[#003366] to-[#008080]" style='font-family: "Work Sans", "Noto Sans", sans-serif;'>
    <div class="flex flex-1 justify-center items-center py-5 px-4">
      <div class="max-w-[480px] w-full bg-white/10 backdrop-blur-sm p-8 rounded-xl shadow-2xl flex flex-col">
        
        <!-- Logo -->
        <div class="flex justify-center mb-6">
          <div class="w-24 h-24 bg-center bg-no-repeat bg-contain"
               style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAcojpaEKzE8Wy8d6-Yn42hfvCXQg99Yy4AeOCVgAZTsXR40Mc7tgvRgcUAKM-X9NYbXqgv-BTKgau1JUmN_k7OBsPkgFYfHtHoOYUB1GQ-YVEpo96TSon82QjKAbaHZAx7DP38nDUdlNZprm0K8cDKnk1wZ1Kh64BcrJIREqxzoRxxevYmRxkssy7fEYlBTHiIHh_6KeosyzMDD5NaGHZ2hXk4IAPL6czhromytPKUDBglBM8Lizm5FgrWpPX9AYv32PirPpav8g");'>
          </div>
        </div>

        <!-- Formulario -->
        <form action="index.php?action=login" method="POST">
          <h1 class="text-white text-3xl font-bold text-center pb-6">Bienvenido a Coti Express</h1>
          
          <!-- Usuario -->
          <label class="flex flex-col w-full mb-4">
            <p class="text-white text-base font-medium pb-2">Usuario o Correo Electrónico</p>
            <div class="relative">
              <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-[#617c89]">person</span>
              <input
                class="form-input w-full rounded-lg text-[#111618] focus:ring-2 focus:ring-[#00C853] border-none bg-[#F0F0F0] h-14 pl-12 p-4 text-base"
                placeholder="Tu usuario o correo"
                name="nombre"
                required
              />
            </div>
          </label>

          <!-- Contraseña -->
          <label class="flex flex-col w-full mb-2">
            <p class="text-white text-base font-medium pb-2">Contraseña</p>
            <div class="relative">
              <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-[#617c89]">lock</span>
              <input
                id="password"
                class="form-input w-full rounded-lg text-[#111618] focus:ring-2 focus:ring-[#00C853] border-none bg-[#F0F0F0] h-14 pl-12 pr-12 p-4 text-base"
                placeholder="Tu contraseña"
                type="password"
                name="pass"
                required
              />
              <button
                id="toggle-pass"
                type="button"
                class="absolute right-4 top-1/2 -translate-y-1/2 text-[#617c89]"
                aria-label="Mostrar u ocultar contraseña">
                <span class="material-symbols-outlined">visibility</span>
              </button>
            </div>
          </label>

          <div class="w-full flex justify-end mt-1">
            <a class="text-white/80 hover:text-white text-sm font-medium" href="#">¿Olvidaste tu contraseña?</a>
          </div>

          <!-- Botón -->
          <div class="flex w-full py-3 mt-4">
            <button
              type="submit"
              href="index.php?action=inicio"
              class="w-full h-14 bg-[#00C853] hover:bg-green-600 transition-colors duration-300 text-white text-lg font-bold rounded-lg shadow-lg">
              Iniciar Sesión
            </button>
          </div>

          <!-- Separador -->
          <div class="flex items-center w-full my-4">
            <hr class="flex-grow border-t border-white/30" />
            <span class="px-4 text-white/80 text-sm">o</span>
            <hr class="flex-grow border-t border-white/30" />
          </div>
        </form>

        <!-- Registro -->
        <div class="text-center w-full">
          <p class="text-white/80">
            ¿No tienes una cuenta?
            <a class="font-bold text-white hover:underline" href="index.php?action=insert">Regístrate aquí</a>
          </p>
          <p class="text-white/80">
            !Regresar al Catalogo!
            <a class="font-bold text-white hover:underline" href="index.php?action=catalogo">Catalogo</a>
          </p>
        </div>
      </div>
    </div>
  </div>

  <!-- Toggle mostrar/ocultar contraseña -->
  <script>
    (function () {
      const passInput = document.getElementById('password');
      const toggleBtn = document.getElementById('toggle-pass');
      if (!passInput || !toggleBtn) return;
      const icon = toggleBtn.querySelector('.material-symbols-outlined');

      toggleBtn.addEventListener('click', () => {
        const showing = passInput.type === 'text';
        passInput.type = showing ? 'password' : 'text';
        icon.textContent = showing ? 'visibility' : 'visibility_off';
      });
    })();
  </script>
</body>
</html>
