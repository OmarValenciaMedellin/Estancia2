<!DOCTYPE html>
<html class="light" lang="es">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Gestión de Materiales - Coti Express</title>

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link
      href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500;600;700;800;900&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"
      rel="stylesheet"
    />

    <style>
      .material-symbols-outlined {
        font-variation-settings: "FILL" 0, "wght" 400, "GRAD" 0, "opsz" 24;
      }
    </style>

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
  </head>

  <body
    class="bg-background-light dark:bg-background-dark font-display text-[#111718] dark:text-white/90"
  >
    <div class="relative flex min-h-screen w-full">
      <!-- SideNavBar -->
      <nav
        class="w-64 flex-shrink-0 border-r border-[#dbe4e6] dark:border-white/10 bg-white dark:bg-background-dark"
      >
        <div class="flex h-full flex-col justify-between p-4 sticky top-0">
          <div class="flex flex-col gap-4">
            <div class="flex items-center gap-3 px-3 py-2">
              <div
                class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10"
                data-alt="Coti Express logo"
                style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBtmvHsnCg_FP0k1XHY5CfMvDz30LYyw_ryh3Z1EF6URSuKum1DpBzFOJdJQJaAOsXAaBtMCdUR3rO64n1xipOigizSdDCFC_OinA0xpuLEZtycHxjrZZkuA1kiQAIyRzf1CDJgG-Ud1psE0xuYH6BjLX1yV_jKrhXDGvwhe5mx1fQ86mOXsUpgymEtJ1eQx1TNrwephrq5Bebr_9mAMgZn5hIDTwURV8D1M0z7dtOtHJ6xivQ5ZdiO-MJNYeTxaXpVEUj4LedVsQ');"
              ></div>
              <div class="flex flex-col">
                <h1
                  class="text-[#111718] dark:text-white text-base font-bold leading-normal"
                >
                  Coti Express
                </h1>
                <p
                  class="text-[#618389] dark:text-white/60 text-sm font-normal leading-normal"
                >
                  Gestión de Vidrios
                </p>
              </div>
            </div>

            <div class="flex flex-col gap-2">
              <?php
                session_start();
                if($_SESSION['Cargo'] === 'administrador'): ?>
              <a
                class="text-sm font-medium leading-normal flex items-center gap-3 px-3 py-2 text-[#111718] dark:text-white/90 hover:bg-black/5 dark:hover:bg-white/5 rounded-lg"
                href="index.php?action=inicio"
              >
                <span class="material-symbols-outlined text-xl">dashboard</span>
                PaginaPrincipal
              </a>
              <?php endif;?>

              <a
                href="index.php?action=cotizaciones"
                class="flex items-center gap-3 px-3 py-2 text-[#111718] dark:text-white/90 hover:bg-black/5 dark:hover:bg-white/5 rounded-lg"
              >
                <span class="material-symbols-outlined text-xl"
                  >request_quote</span
                >
                <p class="text-sm font-medium leading-normal">Cotizaciones</p>
              </a>

              <a
                href="index.php?action=consultMaterial"
                class="flex items-center gap-3 px-3 py-2 rounded-lg bg-primary/20 text-primary"
              >
                <span
                  class="material-symbols-outlined text-xl"
                  style="font-variation-settings: 'FILL' 1;"
                  >inventory_2</span
                >
                <p class="text-sm font-medium leading-normal">Materiales</p>
              </a>

              <a
                href="index.php?action=consultCliente"
                class="flex items-center gap-3 px-3 py-2 text-[#111718] dark:text-white/90 hover:bg-black/5 dark:hover:bg-white/5 rounded-lg"
              >
                <span class="material-symbols-outlined text-xl">groups</span>
                <p class="text-sm font-medium leading-normal">Clientes</p>
              </a>

              <a
                class="flex items-center gap-3 px-3 py-2 text-[#111718] dark:text-white/90 hover:bg-black/5 dark:hover:bg-white/5 rounded-lg"
                href="index.php?action=consultVendedor"
              >
                <span class="material-symbols-outlined text-xl">groups</span>
                <p class="text-sm font-medium leading-normal">Vendedores</p>
              </a>

              <a
                class="flex items-center gap-3 px-3 py-2 text-[#111718] dark:text-white/90 hover:bg-black/5 dark:hover:bg-white/5 rounded-lg"
                href="index.php?action=inventario"
              >
                <span
                  class="material-symbols-outlined text-gray-500 dark:text-gray-400"
                  >inventory_2</span
                >
                <p
                  class="text-sm font-medium leading-normal text-gray-500 dark:text-gray-400 hover:bg-black/5 dark:hover:bg-white/5 rounded-lg"
                >
                  Inventario
                </p>
              </a>
            </div>
          </div>

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
              <span class="material-symbols-outlined text-xl"
                >support_agent</span
              >
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

      <!-- Main Content -->
      <main class="flex-1 p-6 lg:p-10">
        <div class="max-w-7xl mx-auto">
          <!-- PageHeading -->
          <div class="flex flex-wrap justify-between gap-3 mb-8">
            <p
              class="text-[#111718] dark:text-white text-4xl font-black leading-tight tracking-[-0.033em]"
            >
              Gestión de Materiales
            </p>
          </div>

          <!-- Form Section -->
          <section
            class="bg-white dark:bg-background-dark/80 p-6 rounded-xl shadow-sm mb-10"
          >
            <h2
              class="text-[#111718] dark:text-white text-[22px] font-bold leading-tight tracking-[-0.015em] pb-6"
            >
              Añadir Nuevo Material
            </h2>

            <form
              method="POST"
              action="index.php?action=insertMaterial"
              class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6"
            >
              <!-- Nombre -->
              <label class="flex flex-col">
                <p
                  class="text-[#111718] dark:text-white/90 text-sm font-medium leading-normal pb-2"
                >
                  Nombre del material
                </p>
                <input
                  class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#111718] dark:text-white dark:bg-white/5 focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-[#dbe4e6] dark:border-white/10 bg-white h-11 placeholder:text-[#618389] px-3 text-base font-normal leading-normal"
                  placeholder="ej. Vidrio Templado 6mm"
                  name="Nombre"
                  required
                />
              </label>

              <!-- Categoría -->
              <div class="relative flex flex-col">
                <p
                  class="text-[#111718] dark:text-white/90 text-sm font-medium leading-normal pb-2"
                >
                  Categoría
                </p>
                <select
                  name="Categoria"
                  class="form-select appearance-none w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#111718] dark:text-white dark:bg-white/5 focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-[#dbe4e6] dark:border-white/10 bg-white h-11 placeholder:text-[#618389] px-3 text-base font-normal leading-normal"
                  required
                >
                  <option value="">Seleccionar categoría</option>
                  <option>Vidrio templado</option>
                  <option>Perfil de aluminio</option>
                  <option>Silicona</option>
                </select>
                <span
                  class="material-symbols-outlined text-[#618389] absolute right-3 top-[38px] pointer-events-none"
                  >expand_more</span
                >
              </div>

              <!-- Unidad de medida -->
              <div class="relative flex flex-col">
                <p
                  class="text-[#111718] dark:text-white/90 text-sm font-medium leading-normal pb-2"
                >
                  Unidad de medida
                </p>
                <select
                  name="UnidadMedida"
                  class="form-select appearance-none w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#111718] dark:text-white dark:bg-white/5 focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-[#dbe4e6] dark:border-white/10 bg-white h-11 placeholder:text-[#618389] px-3 text-base font-normal leading-normal"
                  required
                >
                  <option value="">Seleccionar unidad</option>
                  <option>m²</option>
                  <option>Metro lineal</option>
                  <option>Unidad</option>
                </select>
                <span
                  class="material-symbols-outlined text-[#618389] absolute right-3 top-[38px] pointer-events-none"
                  >expand_more</span
                >
              </div>

              <!-- Precio unitario -->
              <label class="flex flex-col">
                <p
                  class="text-[#111718] dark:text-white/90 text-sm font-medium leading-normal pb-2"
                >
                  Precio unitario
                </p>
                <div class="relative">
                  <span
                    class="absolute inset-y-0 left-0 flex items-center pl-3 text-[#618389]"
                    >S/</span
                  >
                  <input
                    class="form-input pl-8 flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#111718] dark:text-white dark:bg-white/5 focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-[#dbe4e6] dark:border-white/10 bg-white h-11 placeholder:text-[#618389] px-3 text-base font-normal leading-normal"
                    placeholder="0.00"
                    type="number"
                    name="Costo"
                    step="0.01"
                    min="0"
                    required
                  />
                </div>
              </label>

              <!-- Cantidad -->
              <label class="flex flex-col">
                <p
                  class="text-[#111718] dark:text-white/90 text-sm font-medium leading-normal pb-2"
                >
                  Cantidad en stock
                </p>
                <input
                  class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#111718] dark:text-white dark:bg-white/5 focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-[#dbe4e6] dark:border-white/10 bg-white h-11 placeholder:text-[#618389] px-3 text-base font-normal leading-normal"
                  placeholder="0"
                  type="number"
                  name="Cantidad"
                  min="0"
                  step="1"
                  oninput="this.value = this.value.replace(/[^0-9]/g,'')"
                  required
                />
              </label>

              <!-- Descripción -->
              <label class="flex flex-col md:col-span-2 lg:col-span-3">
                <p
                  class="text-[#111718] dark:text-white/90 text-sm font-medium leading-normal pb-2"
                >
                  Descripción
                </p>
                <textarea
                  name="Descripcion"
                  class="form-textarea flex w-full min-w-0 flex-1 resize-y overflow-hidden rounded-lg text-[#111718] dark:text-white dark:bg-white/5 focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-[#dbe4e6] dark:border-white/10 bg-white placeholder:text-[#618389] p-3 text-base font-normal leading-normal"
                  placeholder="Detalles adicionales del material..."
                  rows="3"
                  required
                ></textarea>
              </label>

              <!-- Botón -->
              <div class="md:col-span-2 lg:col-span-3 flex justify-end">
                <button
                  type="submit"
                  class="flex items-center justify-center gap-2 h-11 px-6 bg-primary text-white rounded-lg font-semibold text-sm hover:bg-opacity-90 transition-colors"
                >
                  <span class="material-symbols-outlined">add_circle</span>
                  Guardar Material
                </button>
              </div>

              <input type="hidden" name="registroMaterial" value="1" />
            </form>
          </section>

          <!-- Table Section -->
          <section>
            <div
              class="flex flex-col md:flex-row justify-between items-center gap-4 mb-6"
            >
              <h2
                class="text-[#111718] dark:text-white text-[22px] font-bold leading-tight tracking-[-0.015em]"
              >
                Inventario de Materiales
              </h2>

              <div class="relative w-full md:w-72">
                <span
                  class="material-symbols-outlined text-[#618389] absolute left-3 top-1/2 -translate-y-1/2"
                  >search</span
                >
                <input
                  class="form-input pl-10 flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#111718] dark:text-white dark:bg-background-dark/80 focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-[#dbe4e6] dark:border-white/10 bg-white h-11 placeholder:text-[#618389] pr-3 text-base font-normal leading-normal"
                  placeholder="Buscar por nombre o código..."
                  value=""
                />
              </div>
            </div>

            <div
              class="bg-white dark:bg-background-dark/80 rounded-xl shadow-sm overflow-hidden"
            >
              <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                  <thead class="bg-black/5 dark:bg-white/5">
                    <tr>
                      <th
                        class="px-6 py-4 font-semibold text-[#111718] dark:text-white/90"
                        scope="col"
                      >
                        Código
                      </th>
                      <th
                        class="px-6 py-4 font-semibold text-[#111718] dark:text-white/90"
                        scope="col"
                      >
                        Nombre
                      </th>
                      <th
                        class="px-6 py-4 font-semibold text-[#111718] dark:text-white/90"
                        scope="col"
                      >
                        Categoría
                      </th>
                      <th
                        class="px-6 py-4 font-semibold text-[#111718] dark:text-white/90"
                        scope="col"
                      >
                        UnidadMedida
                      </th>
                      <th
                        class="px-6 py-4 font-semibold text-[#111718] dark:text-white/90"
                        scope="col"
                      >
                        Costo
                      </th>
                      <th
                        class="px-6 py-4 font-semibold text-[#111718] dark:text-white/90"
                        scope="col"
                      >
                        Cantidad
                      </th>
                      <th
                        class="px-6 py-4 font-semibold text-[#111718] dark:text-white/90"
                        scope="col"
                      >
                        Descripcion
                      </th>
                      <th
                        class="px-6 py-4 font-semibold text-[#111718] dark:text-white/90 text-right"
                        scope="col"
                      >
                        Acciones
                      </th>
                    </tr>
                  </thead>

                  <tbody>
                    <?php
                      if (!isset($materiales)) {
                          $materiales = null;
                      }

                      if ($materiales && $materiales->num_rows > 0):
                          while ($row = $materiales->fetch_assoc()):
                    ?>
                    <tr>
                      <td><?php echo $row['id_material']; ?></td>
                      <td><?php echo $row['Nombre']; ?></td>
                      <td><?php echo $row['Categoria']; ?></td>
                      <td><?php echo $row['UnidadMedida']; ?></td>
                      <td><?php echo $row['Costo']; ?></td>
                      <td><?php echo $row['Cantidad']; ?></td>
                      <td><?php echo $row['Descripcion']; ?></td>

                      <td class="px-6 py-4 text-center">
                        <div class="flex justify-center gap-2">
                          <button
                            class="p-2 rounded-lg hover:bg-primary/20 text-primary transition-colors"
                          >
                            <a
                              href="index.php?action=actuMaterial&id=<?php echo $row['id_material'] ?>"
                            >
                              <span
                                class="material-symbols-outlined text-xl"
                                >edit</span
                              >
                            </a>
                          </button>

                          <a
                            href="index.php?action=deleteMaterial&id=<?php echo $row['id_material']; ?>"
                          >
                            <button
                              class="p-2 rounded-lg hover:bg-danger/20 text-danger transition-colors"
                            >
                              <span
                                class="material-symbols-outlined text-xl"
                                >delete</span
                              >
                            </button>
                          </a>
                        </div>
                      </td>
                    </tr>

                    <?php
                          endwhile;
                      else:
                    ?>
                    <tr>
                      <td
                        colspan="6"
                        class="text-center py-6 text-[#618389]"
                      >
                        No hay materiales registrados.
                      </td>
                    </tr>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </section>
        </div>
      </main>
    </div>
  </body>
</html>
