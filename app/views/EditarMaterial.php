<!DOCTYPE html>
<html class="light" lang="es">
  <head>
    <!-- Config básica -->
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Editar Material - Coti Express</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

    <!-- Fuentes / Iconos -->
    <link
      href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500;600;700;800;900&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"
      rel="stylesheet"
    />

    <!-- Tailwind config -->
    <script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            colors: {
              primary: "#13c8ec",
              secondary: "#22c55e",
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

  <body class="bg-background-light dark:bg-background-dark font-display text-[#111718] dark:text-white/90">
    <div class="relative flex min-h-screen w-full">

      <!-- =========================
           SIDENAV
      ========================== -->
      <nav class="w-64 flex-shrink-0 border-r border-[#dbe4e6] dark:border-white/10 bg-white dark:bg-background-dark">
        <div class="flex h-full flex-col justify-between p-4 sticky top-0">

          <!-- Logo + Menú principal -->
          <div class="flex flex-col gap-4">

            <!-- Logo -->
            <div class="flex items-center gap-3 px-3 py-2">
              <div
                class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10"
                data-alt="Coti Express logo"
                style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBtmvHsnCg_FP0k1XHY5CfMvDz30LYyw_ryh3Z1EF6URSuKum1DpBzFOJdJQJaAOsXAaBtMCdUR3rO64n1xipOigizSdDCFC_OinA0xpuLEZtycHxjrZZkuA1kiQAIyRzf1CDJgG-Ud1psE0xuYH6BjLX1yV_jKrhXDGvwhe5mx1fQ86mOXsUpgymEtJ1eQx1TNrwephrq5Bebr_9mAMgZn5hIDTwURV8D1M0z7dtOtHJ6xivQ5ZdiO-MJNYeTxaXpVEUj4LedVsQ');"
              ></div>

              <div class="flex flex-col">
                <h1 class="text-[#111718] dark:text-white text-base font-bold leading-normal">
                  Coti Express
                </h1>
                <p class="text-[#618389] dark:text-white/60 text-sm font-normal leading-normal">
                  Gestión de Vidrios
                </p>
              </div>
            </div>

            <!-- Menú -->
            <div class="flex flex-col gap-2">
              <a
                href="#"
                class="flex items-center gap-3 px-3 py-2 text-[#111718] dark:text-white/90 hover:bg-black/5 dark:hover:bg-white/5 rounded-lg"
              >
                <span class="material-symbols-outlined text-xl">dashboard</span>
                <p class="text-sm font-medium leading-normal">Dashboard</p>
              </a>

              <a
                href="#"
                class="flex items-center gap-3 px-3 py-2 text-[#111718] dark:text-white/90 hover:bg-black/5 dark:hover:bg-white/5 rounded-lg"
              >
                <span class="material-symbols-outlined text-xl">request_quote</span>
                <p class="text-sm font-medium leading-normal">Cotizaciones</p>
              </a>

              <a
                href="#"
                class="flex items-center gap-3 px-3 py-2 rounded-lg bg-gradient-to-r from-primary/20 to-secondary/20 text-primary dark:text-secondary-400"
              >
                <span
                  class="material-symbols-outlined text-xl"
                  style="font-variation-settings: 'FILL' 1;"
                >
                  inventory_2
                </span>
                <p class="text-sm font-medium leading-normal">Materiales</p>
              </a>

              <a
                href="#"
                class="flex items-center gap-3 px-3 py-2 text-[#111718] dark:text-white/90 hover:bg-black/5 dark:hover:bg-white/5 rounded-lg"
              >
                <span class="material-symbols-outlined text-xl">groups</span>
                <p class="text-sm font-medium leading-normal">Clientes</p>
              </a>
            </div>
          </div>

          <!-- Configuración / Sesión -->
          <div class="flex flex-col gap-1">
            <a
              href="#"
              class="flex items-center gap-3 px-3 py-2 text-[#111718] dark:text-white/90 hover:bg-black/5 dark:hover:bg-white/5 rounded-lg"
            >
              <span class="material-symbols-outlined text-xl">settings</span>
              <p class="text-sm font-medium leading-normal">Ajustes</p>
            </a>

            <a
              href="#"
              class="flex items-center gap-3 px-3 py-2 text-[#111718] dark:text-white/90 hover:bg-black/5 dark:hover:bg-white/5 rounded-lg"
            >
              <span class="material-symbols-outlined text-xl">support_agent</span>
              <p class="text-sm font-medium leading-normal">Soporte</p>
            </a>

            <a
              href="#"
              class="flex items-center gap-3 px-3 py-2 text-red-500 hover:bg-red-500/10 rounded-lg"
            >
              <span class="material-symbols-outlined text-xl">logout</span>
              <p class="text-sm font-medium leading-normal">Cerrar Sesión</p>
            </a>
          </div>
        </div>
      </nav>

      <!-- =========================
           CONTENIDO PRINCIPAL
      ========================== -->
      <main class="flex-1 p-6 lg:p-10">
        <div class="max-w-4xl mx-auto">

          <!-- Header de la vista -->
          <div class="mb-8">
            <a
              href="index.php?action=consultMaterial"
              class="inline-flex items-center gap-2 text-sm text-[#618389] dark:text-white/60 hover:text-primary dark:hover:text-primary mb-2"
            >
              <span class="material-symbols-outlined">arrow_back</span>
              Volver a Materiales
            </a>

            <h1 class="text-[#111718] dark:text-white text-4xl font-black leading-tight tracking-[-0.033em]">
              Editar Material
            </h1>
          </div>

          <!-- Card formulario -->
          <section class="bg-white dark:bg-background-dark/80 p-6 sm:p-8 rounded-xl shadow-sm">
            <h2 class="text-[#111718] dark:text-white text-[22px] font-bold leading-tight tracking-[-0.015em] pb-6">
              Información del Material: <?php echo $row['Nombre']; ?>
            </h2>

            <form
              method="POST"
              action="index.php?action=actuMaterial"
              class="grid grid-cols-1 md:grid-cols-2 gap-6"
            >
              <!-- ID oculto -->
              <input
                type="hidden"
                name="id_material"
                value="<?php echo $row['id_material']; ?>"
              />

              <!-- Nombre -->
              <label class="flex flex-col">
                <p class="text-[#111718] dark:text-white/90 text-sm font-medium leading-normal pb-2">
                  Nombre del material
                </p>
                <input
                  class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#111718] dark:text-white dark:bg-white/5 focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-[#dbe4e6] dark:border-white/10 bg-white h-11 placeholder:text-[#618389] px-3 text-base font-normal leading-normal"
                  placeholder=""
                  value="<?php echo $row['Nombre']; ?>"
                  name="nombre"
                  type="text"
                />
              </label>

              <!-- Categoría -->
              <div class="relative flex flex-col">
                <p class="text-[#111718] dark:text-white/90 text-sm font-medium leading-normal pb-2">
                  Categoría
                </p>
                <select
                  name="Categoria"
                  class="form-select appearance-none w-full rounded-lg text-[#111718] dark:text-white dark:bg-white/5 border border-[#dbe4e6] dark:border-white/10 h-11 px-3 text-base"
                >
                  <option>Seleccionar categoría</option>
                  <option value="Vidrio templado">Vidrio templado</option>
                  <option value="Perfil de aluminio">Perfil de aluminio</option>
                  <option value="Silicona">Silicona</option>
                </select>
                <span
                  class="material-symbols-outlined text-[#618389] absolute right-3 top-[38px] pointer-events-none"
                >
                  expand_more
                </span>
              </div>

              <!-- Unidad de medida -->
              <div class="relative flex flex-col">
                <p class="text-[#111718] dark:text-white/90 text-sm font-medium leading-normal pb-2">
                  Unidad de medida
                </p>
                <select
                  name="UnidadMedida"
                  class="form-select appearance-none w-full rounded-lg text-[#111718] dark:text-white dark:bg-white/5 border border-[#dbe4e6] dark:border-white/10 h-11 px-3 text-base"
                >
                  <option>Seleccionar unidad</option>
                  <option value="m²">m²</option>
                  <option value="Metro lineal">Metro lineal</option>
                  <option value="Unidad">Unidad</option>
                </select>
                <span
                  class="material-symbols-outlined text-[#618389] absolute right-3 top-[38px] pointer-events-none"
                >
                  expand_more
                </span>
              </div>

              <!-- Costo -->
              <label class="flex flex-col">
                <p class="text-[#111718] dark:text-white/90 text-sm font-medium leading-normal pb-2">
                  Costo
                </p>
                <div class="relative">
                  <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-[#618389]">
                    S/
                  </span>
                  <input
                    class="form-input pl-8 flex w-full rounded-lg text-[#111718] dark:text-white dark:bg-white/5 border border-[#dbe4e6] dark:border-white/10 h-11 px-3 text-base"
                    placeholder="0.00"
                    type="text"
                    value="<?php echo $row['Costo']; ?>"
                    name="Costo"
                  />
                </div>
              </label>

              <!-- Cantidad -->
              <label class="flex flex-col">
                <p class="text-[#111718] dark:text-white/90 text-sm font-medium leading-normal pb-2">
                  Cantidad
                </p>
                <input
                  class="form-input flex w-full rounded-lg text-[#111718] dark:text-white dark:bg-white/5 border border-[#dbe4e6] dark:border-white/10 h-11 px-3 text-base"
                  placeholder="0"
                  type="text"
                  value="<?php echo $row['Cantidad']; ?>"
                  name="Cantidad"
                />
              </label>

              <!-- Descripción -->
              <label class="flex flex-col md:col-span-2">
                <p class="text-[#111718] dark:text-white/90 text-sm font-medium leading-normal pb-2">
                  Descripción
                </p>
                <textarea
                  name="Descripcion"
                  class="form-textarea flex w-full rounded-lg text-[#111718] dark:text-white dark:bg-white/5 border border-[#dbe4e6] dark:border-white/10 p-3 text-base"
                  placeholder="Detalles adicionales del material..."
                  rows="3"
                ><?php echo htmlspecialchars($row['Descripcion']); ?></textarea>
              </label>

              <!-- Botones -->
              <div class="md:col-span-2 flex justify-end items-center gap-4 pt-4">
                <button
                  class="flex items-center justify-center h-11 px-6 bg-transparent text-[#618389] dark:text-white/70 rounded-lg font-semibold text-sm hover:bg-black/5 dark:hover:bg-white/5 transition-colors"
                  type="button"
                >
                  Cancelar
                </button>

                <button
                  type="submit"
                  name="editar"
                  class="flex items-center justify-center gap-2 h-11 px-6 bg-gradient-to-r from-primary to-secondary text-white rounded-lg font-semibold text-sm hover:opacity-90 transition-opacity shadow-lg shadow-primary/20"
                >
                  <span class="material-symbols-outlined">save</span>
                  Guardar Cambios
                </button>
              </div>
            </form>
          </section>
        </div>
      </main>
    </div>
  </body>
</html>
