<?php /* app/views/InventarioReporte.php */ ?>
<!DOCTYPE html>
<html class="light" lang="es">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Inventario - Coti Express</title>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500;700;900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            colors: {
              primary: "#13c8ec",
              "background-light": "#f6f8f8",
              "background-dark": "#101f22",
              "gradient-start": "#43cea2",
              "gradient-end": "#185a9d",
            },
            fontFamily: { display: ["Work Sans", "Noto Sans", "sans-serif"] },
            borderRadius: { DEFAULT: "0.25rem", lg: "0.5rem", xl: "0.75rem", full: "9999px" },
          },
        },
      };
    </script>
  </head>

  <body class="font-display">
    <div class="relative flex h-auto min-h-screen w-full flex-col group/design-root overflow-x-hidden bg-gradient-to-br from-gradient-start to-gradient-end">
      <div class="layout-container flex h-full grow flex-col">
        <div class="px-4 md:px-10 lg:px-40 flex flex-1 justify-center py-5">
          <div class="layout-content-container flex flex-col max-w-[960px] flex-1 bg-background-light/90 dark:bg-background-dark/90 rounded-xl shadow-2xl">

            <!-- Header -->
            <header class="flex items-center justify-between whitespace-nowrap border-b border-solid border-b-[#f0f4f4]/10 dark:border-b-[#f0f4f4]/10 px-6 sm:px-10 py-4">
              <div class="flex items-center gap-4 text-white">
                <div class="size-6 text-primary">
                  <svg fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg"><path d="M6 6H42L36 24L42 42H6L12 24L6 6Z" fill="currentColor"></path></svg>
                </div>
                <h2 class="text-white text-xl font-bold leading-tight tracking-[-0.015em]">Coti Express</h2>
              </div>

              <?php
                $action = $_GET['action'] ?? '';
              ?>
              <div class="hidden md:flex flex-1 justify-end gap-8">
                <div class="flex items-center gap-9">
                   <?php
                        session_start();
                        if($_SESSION['Cargo'] === 'administrador'): ?>
                         <a
                           <?php echo $action == 'inicio' ? 'text-blue-500 font-bold' : ''; ?> href="index.php?action=inicio">PaginaPrincipal
                        </a>
                        <?php endif;?>
                 
                  <a class="text-white/80 hover:text-white text-sm font-medium leading-normal <?php echo $action == '' ? 'text-blue-500 font-bold' : ''; ?>" href="index.php?action=cotizaciones">Cotizaciones</a>
                  <a class="text-white/80 hover:text-white text-sm font-medium leading-normal <?php echo $action == 'consultMaterial' ? 'text-blue-500 font-bold' : ''; ?>" href="index.php?action=consultMaterial">Materiales</a>
                  <a class="text-white/80 hover:text-white text-sm font-medium leading-normal <?php echo $action == 'consultCliente' ? 'text-blue-500 font-bold' : ''; ?>" href="index.php?action=consultCliente">Clientes</a>
                  <a class="text-white/80 hover:text-white text-sm font-medium leading-normal <?php echo $action == 'inventario' ? 'text-blue-500 font-bold' : ''; ?>" href="index.php?action=inventario">Inventario</a>
                </div>
              </div>
            </header>

            <!-- Main Content -->
            <main class="flex-1 p-4 sm:p-6 lg:p-10">
              <div class="flex flex-wrap justify-between items-center gap-4 mb-6">
                <p class="text-slate-800 dark:text-white text-4xl font-black leading-tight tracking-[-0.033em] min-w-72">
                  Inventario
                </p>
              </div>

              <!-- Alerts -->
              <?php if (isset($_GET['stock_added'])): ?>
                <div class="mb-4 px-4 py-2 rounded-lg bg-green-100 text-green-800 text-sm">
                  Stock actualizado correctamente.
                </div>
              <?php endif; ?>
              <?php if (isset($_GET['error_stock'])): ?>
                <div class="mb-4 px-4 py-2 rounded-lg bg-red-100 text-red-800 text-sm">
                  Error: <?php echo htmlspecialchars($_GET['error_stock'], ENT_QUOTES, 'UTF-8'); ?>
                </div>
              <?php endif; ?>

              <!-- Search and Add -->
              <div class="flex flex-col md:flex-row justify-between items-center gap-4 px-4 py-3 bg-white/80 dark:bg-black/20 rounded-lg mb-6">
                <form method="GET" action="index.php" class="relative w-full md:w-auto flex-grow">
                  <input type="hidden" name="action" value="inventario" />
                  <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">search</span>
                  <input
                    name="q"
                    value="<?php echo htmlspecialchars($q ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                    class="pl-10 pr-4 py-2 w-full bg-transparent border-0 focus:ring-0 text-slate-800 dark:text-white placeholder-gray-400 dark:placeholder-gray-500"
                    placeholder="Buscar por ID o nombre..."
                    type="text"
                  />
                </form>

                <a href="index.php?action=consultMaterial"
                   class="flex-shrink-0 flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-6 bg-gradient-to-r from-green-500 to-green-400 text-white text-sm font-bold leading-normal tracking-[0.015em] hover:opacity-90 transition-opacity">
                  <span class="truncate">Añadir Material</span>
                </a>
              </div>

              <!-- Table -->
              <div class="overflow-hidden rounded-lg border border-gray-200/50 dark:border-gray-700/50 bg-white/80 dark:bg-black/20 shadow-md">
                <div class="overflow-x-auto">
                  <table class="w-full">
                    <thead>
                      <tr class="bg-white/10 dark:bg-black/10">
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-gray-300 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-gray-300 uppercase tracking-wider">Material</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-gray-300 uppercase tracking-wider">Cantidad Disponible</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-gray-300 uppercase tracking-wider">Estado de Stock</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-gray-300 uppercase tracking-wider">Agregar</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        if (!isset($materiales)) $materiales = null;
                        if ($materiales && $materiales->num_rows > 0):
                          while ($row = $materiales->fetch_assoc()):
                      ?>
                        <tr class="border-t border-gray-100/60 dark:border-gray-800/60">
                          <td class="px-6 py-4"><?php echo (int)$row['id_material']; ?></td>
                          <td class="px-6 py-4"><?php echo htmlspecialchars($row['Nombre'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                          <td class="px-6 py-4"><?php echo (int)$row['Cantidad']; ?></td>
                          <td class="px-6 py-4">
                            <?php echo htmlspecialchars(estadoStock((int)$row['Cantidad']), ENT_QUOTES, 'UTF-8'); ?>
                          </td>
                          <td class="px-6 py-4">
                            <form method="POST" action="index.php?action=agregarStock" class="flex items-center gap-2">
                              <input type="hidden" name="id_material" value="<?php echo (int)$row['id_material']; ?>">
                              <input type="hidden" name="from_inventario" value="1">
                              <input type="hidden" name="q" value="<?php echo htmlspecialchars($q ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                              <input type="hidden" name="page" value="<?php echo (int)($page ?? 1); ?>">
                              <input
                                name="cantidad_sumar"
                                type="number"
                                min="1"
                                value="1"
                                class="w-20 h-9 rounded-lg border border-gray-300/70 bg-white/80 dark:bg-black/20 px-2 text-sm"
                                aria-label="Cantidad a agregar"
                                required
                              />
                              <button type="submit"
                                class="flex items-center justify-center gap-1 h-9 px-3 rounded-lg bg-green-500 hover:bg-green-600 text-white text-xs font-semibold">
                                <span class="material-symbols-outlined text-base">add</span>
                                Agregar
                              </button>
                            </form>
                          </td>
                        </tr>
                      <?php
                          endwhile;
                        else:
                      ?>
                        <tr>
                          <td colspan="5" class="text-center py-6 text-[#618389]">No hay materiales registrados.</td>
                        </tr>
                      <?php endif; ?>
                    </tbody>
                  </table>
                </div>
              </div>

              <!-- Paginación -->
              <?php if (($total_pages ?? 1) > 1): ?>
              <div class="flex items-center justify-center p-4 mt-4 text-slate-800 dark:text-white">
                <a class="flex size-10 items-center justify-center hover:bg-gray-200/50 dark:hover:bg-gray-700/50 rounded-full"
                   href="index.php?action=inventario&page=<?php echo max(1, ($page ?? 1) - 1); ?>&q=<?php echo urlencode($q ?? ''); ?>">
                  <span class="material-symbols-outlined">chevron_left</span>
                </a>

                <?php
                  $current = $page ?? 1;
                  $tp = $total_pages ?? 1;
                  // Rango simple (puedes mejorarlo a tu gusto)
                  $start = max(1, $current - 2);
                  $end   = min($tp, $current + 2);
                  for ($p=$start; $p <= $end; $p++):
                ?>
                  <a class="text-sm <?php echo $p === $current ? 'font-bold text-white bg-primary' : 'font-normal'; ?> leading-normal flex size-10 items-center justify-center rounded-full mx-1"
                     href="index.php?action=inventario&page=<?php echo $p; ?>&q=<?php echo urlencode($q ?? ''); ?>">
                     <?php echo $p; ?>
                  </a>
                <?php endfor; ?>

                <a class="flex size-10 items-center justify-center hover:bg-gray-200/50 dark:hover:bg-gray-700/50 rounded-full"
                   href="index.php?action=inventario&page=<?php echo min($tp, ($page ?? 1) + 1); ?>&q=<?php echo urlencode($q ?? ''); ?>">
                  <span class="material-symbols-outlined">chevron_right</span>
                </a>
              </div>
              <?php endif; ?>
            </main>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
