<?php
  // ===========================================================================
  // KPIs / Listados para Dashboard (Cotizaciones / Clientes / Materiales)
  // ===========================================================================

  require_once 'app/models/UserModel.php'; // si no lo tienes ya incluido
  // $connection ya lo tienes creado según mostraste
  $model = new UserModel($connection);

  // Total de clientes (como “Clientes Nuevos” de momento)
  $clientesTotal = $model->contarClientes();

  // Últimos 5 clientes registrados (por id_Cliente desc)
  $clientesRecientes = $model->listarClientesRecientes(5);

  // Cotizaciones
  $valorTotalCotizado   = $model->valorTotalCotizaciones();
  $cotizacionesRecientes = $model->listarCotizacionesRecientes(5);
  $cotizacionesActivas   = $model->contarCotizaciones();

  // Materiales - más usados
  $materialesMasUsados  = $model->listarMaterialesMasUsados(5);
?>

<?php
  // ===========================================================================
  // KPIs / Listados para Inventario (se reusa en dashboard)
  // ===========================================================================

  require_once __DIR__ . '/../models/UserModel.php';
  $model = new UserModel($connection);

  // Umbral de bajo stock
  $UMBRAL_STOCK = 10;

  // KPIs
  $totalMateriales      = $model->contarMateriales();
  $bajoStockCount       = $model->contarMaterialesBajoStock($UMBRAL_STOCK);
  $valorInventarioTotal = $model->valorTotalInventario();

  // Listados
  $materialesRecientes  = $model->listarMaterialesRecientes(5);
  $criticos             = $model->listarMaterialesBajoStock(5, $UMBRAL_STOCK);

  // Helper para moneda MXN
  function mxn($n) {
    return '$' . number_format((float)$n, 2, '.', ',');
  }
?>

<!DOCTYPE html>
<html class="light" lang="es">
<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>Panel de Control - Coti Express</title>

  <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

  <link
    href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500;600;700&display=swap"
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
    }
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

<body class="bg-background-light dark:bg-background-dark font-display">
  <div class="relative flex min-h-screen w-full flex-col">
    <div class="flex h-full grow flex-row">

      <!-- SIDEBAR -->
      <aside
        class="flex h-screen min-h-[700px] flex-col justify-between bg-white dark:bg-background-dark p-4 sticky top-0"
      >
        <div class="flex flex-col gap-4">
          <!-- Logo -->
          <div class="flex items-center gap-3">
            <div
              class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10"
              data-alt="Coti Express company logo"
              style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDrnZUcCT6FuaVX629esguId1WzBUS1c2V6ynATbOh_JwKcSA4qdX6GhNT7xdVtP69qPjK6OuEOBiWgXKZI2VTmjlbXExkXWJGJF71ab6EhXhlepyEhBqP4tDmDbbLgLHpCsWyiWY1MKDZVL9Rw_7nNOIAiEOCnj9XZYd9QSyJlxNXV7toRkRt0VKn4ddP32oPhEQ3iJlZYBbIppK93S5LTjzSJx9wiArOvRzvCFMCvJbfN5odHa-xod_-S9ScEz_jxKAx8NiSnFg');"
            ></div>
            <h1 class="text-base font-medium leading-normal text-gray-900 dark:text-white">
              Coti Express
            </h1>
          </div>

          <!-- Navegación -->
          <nav class="flex flex-col gap-2">
            <a
              class="flex items-center gap-3 px-3 py-2 rounded-lg bg-primary/20 dark:bg-primary/30"
              href="#"
            >
              <span class="material-symbols-outlined text-gray-900 dark:text-white">
                dashboard
              </span>
              <p class="text-sm font-medium leading-normal text-gray-900 dark:text-white">
                Panel de Control
              </p>
            </a>

            <a
              class="flex items-center gap-3 px-3 py-2"
              href="index.php?action=cotizaciones"
            >
              <span class="material-symbols-outlined text-gray-500 dark:text-gray-400">
                request_quote
              </span>
              <p class="text-sm font-medium leading-normal text-gray-500 dark:text-gray-400">
                Cotizador
              </p>
            </a>

            <a
              class="flex items-center gap-3 px-3 py-2"
              href="index.php?action=inventario"
            >
              <span class="material-symbols-outlined text-gray-500 dark:text-gray-400">
                inventory_2
              </span>
              <p class="text-sm font-medium leading-normal text-gray-500 dark:text-gray-400">
                Inventario
              </p>
            </a>

            <a
              class="flex items-center gap-3 px-3 py-2"
              href="index.php?action=consultCliente"
            >
              <span class="material-symbols-outlined text-gray-500 dark:text-gray-400">
                group
              </span>
              <p class="text-sm font-medium leading-normal text-gray-500 dark:text-gray-400">
                Clientes
              </p>
            </a>

    

            <a
              class="flex items-center gap-3 px-3 py-2"
              href="index.php?action=consultVendedor"
            >
              <span class="material-symbols-outlined text-gray-500 dark:text-gray-400">
                group
              </span>
              <p class="text-sm font-medium leading-normal text-gray-500 dark:text-gray-400">
                Vendedores
              </p>
            </a>

            <a
              class="flex items-center gap-3 px-3 py-2"
              href="index.php?action=consultMaterial"
            >
              <span class="material-symbols-outlined text-gray-500 dark:text-gray-400">
                inventory_2
              </span>
              <p class="text-sm font-medium leading-normal text-gray-500 dark:text-gray-400">
                Materiales
              </p>
            </a>
          </nav>
        </div>

        <!-- Ajustes / Logout -->
        <div class="flex flex-col gap-2">
          <a class="flex items-center gap-3 px-3 py-2" href="#">
            <span class="material-symbols-outlined text-gray-500 dark:text-gray-400">
              settings
            </span>
            <p class="text-sm font-medium leading-normal text-gray-500 dark:text-gray-400">
              Configuración
            </p>
          </a>

          <a class="flex items-center gap-3 px-3 py-2" href="index.php?action=login">
            <span class="material-symbols-outlined text-gray-500 dark:text-gray-400">
              logout
            </span>
            <p class="text-sm font-medium leading-normal text-gray-500 dark:text-gray-400">
              Cerrar Sesión
            </p>
          </a>
        </div>
      </aside>

      <!-- MAIN -->
      <main class="flex-1">
        <!-- Topbar -->
        <header
          class="flex items-center justify-between whitespace-nowrap border-b border-solid border-gray-200 dark:border-gray-800 px-10 py-3 bg-white dark:bg-background-dark sticky top-0"
        >
          <div class="flex items-center gap-4 text-gray-900 dark:text-white">
            <h2 class="text-lg font-bold leading-tight tracking-[-0.015em]">
              Panel de Control
            </h2>
          </div>

          <div class="flex flex-1 justify-end gap-4">
            <!-- Search -->
            <label class="flex flex-col min-w-40 !h-10 max-w-64">
              <div class="flex w-full flex-1 items-stretch rounded-lg h-full">
                <div
                  class="text-gray-500 dark:text-gray-400 flex border-none bg-gray-100 dark:bg-gray-800 items-center justify-center pl-4 rounded-l-lg border-r-0"
                >
                  <span class="material-symbols-outlined">search</span>
                </div>

                <input
                  class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-gray-900 dark:text-white focus:outline-0 focus:ring-0 border-none bg-gray-100 dark:bg-gray-800 focus:border-none h-full placeholder:text-gray-500 dark:placeholder:text-gray-400 px-4 rounded-l-none border-l-0 pl-2 text-base font-normal leading-normal"
                  placeholder="Buscar..."
                  value=""
                />
              </div>
            </label>

            <!-- Notifications -->
            <button
              class="flex max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-white gap-2 text-sm font-bold leading-normal tracking-[0.015em] min-w-0 px-2.5"
            >
              <span class="material-symbols-outlined">notifications</span>
            </button>

            <!-- Avatar -->
            <div
              class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10"
              data-alt="User profile picture"
              style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuD9rKH7Y41zmZ96Nsyd3D8XjiUVE-Oztm-LzZ6a_zTFhMmcINDEmipJdLNBdHsoyuVdEz9bAz52M9a9bc0RclEY6gesT_6Xe-aS9hLiTnfW7tst6vXugiwnz8nl2zBXoqz9uLDx39gl1zptOwWWxNNOgsqdoUktHwBjhz0BWj3iBxedts2YSKK_pw-x1Juc_FMJKHZKi9vBHhVxN47Hz3XbnEgkdJPORHkb1VpOfx7jYrqlg1QSg5k-uIae213yV-pO885ZjtSDvA');"
            ></div>
          </div>
        </header>

        <!-- Content -->
        <div class="p-6 md:p-10">

          <!-- KPIs -->
          <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-6">
            <!-- Cotizaciones Activas -->
            <div class="flex flex-col gap-2 rounded-xl p-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
              <p class="text-base font-medium leading-normal text-gray-900 dark:text-white">
                Cotizaciones Activas
              </p>
              <p class="text-2xl font-bold leading-tight tracking-light text-gray-900 dark:text-white">
                <?php echo (int)$cotizacionesActivas; ?>
              </p>
            </div>

            <!-- Valor Total Cotizado -->
            <div class="flex flex-col gap-2 rounded-xl p-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
              <p class="text-base font-medium leading-normal text-gray-900 dark:text-white">
                Valor Total Cotizado
              </p>
              <p class="text-2xl font-bold leading-tight tracking-light text-gray-900 dark:text-white">
                <?php echo mxn($valorTotalCotizado); ?>
              </p>
            </div>

            <!-- Clientes Registrados -->
            <div class="flex flex-col gap-2 rounded-xl p-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
              <p class="text-base font-medium leading-normal text-gray-900 dark:text-white">
                Clientes Registrados
              </p>
              <p class="text-2xl font-bold leading-tight tracking-light text-gray-900 dark:text-white">
                <?php echo $clientesTotal; ?>
              </p>
              <p class="text-xs text-gray-500 dark:text-gray-400">
                Total en base de datos
              </p>
            </div>

            <!-- Materiales bajo stock -->
            <div class="flex flex-col gap-4 p-6 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700">
              <h3 class="text-base font-medium leading-normal text-gray-900 dark:text-white">
                Materiales con Bajo Stock (≤ <?php echo (int)$UMBRAL_STOCK; ?>)
              </h3>

              <ul class="space-y-3">
                <?php if (!empty($criticos)): ?>
                  <?php foreach ($criticos as $m): ?>
                    <li class="flex items-center justify-between">
                      <div class="flex flex-col">
                        <span class="text-sm text-gray-700 dark:text-gray-300">
                          <?php echo htmlspecialchars($m['Nombre']); ?>
                        </span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">
                          <?php echo htmlspecialchars($m['Categoria'] ?? ''); ?>
                        </span>
                      </div>

                      <span
                        class="px-2 py-1 text-xs font-medium rounded-full
                          <?php echo ((int)$m['Cantidad'] <= 2)
                            ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300'
                            : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300'; ?>"
                      >
                        <?php echo (int)$m['Cantidad']; ?> u
                      </span>
                    </li>
                  <?php endforeach; ?>
                <?php else: ?>
                  <li class="text-sm text-gray-500 dark:text-gray-400">
                    No hay materiales críticos.
                  </li>
                <?php endif; ?>
              </ul>

              <a href="index.php?action=inventario" class="text-sm font-medium text-primary hover:underline">
                Ver inventario completo
              </a>
            </div>
          </div>

          <!-- BOTONES PRINCIPALES -->
          <div class="flex flex-wrap gap-6 mb-6">
            <!-- Nueva Cotización -->
            <button
              type="button"
              class="flex min-w-[84px] max-w-[480px] flex-1 cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-5
                     bg-primary text-white text-base font-bold leading-normal tracking-[0.015em]
                     hover:bg-[#0fbde0] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary/40 active:opacity-90"
            >
              <a href="index.php?action=cotizaciones" class="truncate">
                Nueva Cotización
              </a>
            </button>

            <!-- Agregar Vendedor -->
            <button
              type="button"
              class="flex min-w-[84px] max-w-[480px] flex-1 cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-5
                     bg-primary text-white text-base font-bold leading-normal tracking-[0.015em]
                     hover:bg-[#0fbde0] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary/40 active:opacity-90"
            >
              <a href="index.php?action=insertVendedor" class="truncate">
                Agregar Vendedor o administrador
              </a>
            </button>

            <!-- Ver Inventario -->
            <button
              type="button"
              class="flex min-w-[84px] max-w-[480px] flex-1 cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-5
                     bg-primary text-white text-base font-bold leading-normal tracking-[0.015em]
                     hover:bg-[#0fbde0] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary/40 active:opacity-90"
            >
              <a href="index.php?action=inventario" class="truncate">
                Ver Inventario
              </a>
            </button>
          </div>

          <!-- RESPALDO / RESTAURAR BD -->
          <div class="flex flex-wrap gap-4 mb-8">
            <!-- Respaldo -->
            <button
              type="button"
              class="flex md:w-auto w-full max-w-[260px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-11 px-4
                     bg-emerald-600 text-white text-sm font-bold leading-normal tracking-[0.015em]
                     hover:bg-emerald-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-400/70 active:opacity-90"
            >
              <a href="index.php?action=respaldoBD" class="flex items-center gap-2 truncate">
                <span class="material-symbols-outlined text-base">backup</span>
                <span>Respaldar Base de Datos</span>
              </a>
            </button>

            <!-- Restaurar -->
            <button
              type="button"
              class="flex md:w-auto w-full max-w-[260px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-11 px-4
                     bg-orange-500 text-white text-sm font-bold leading-normal tracking-[0.015em]
                     hover:bg-orange-600 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-orange-400/70 active:opacity-90"
              onclick="return confirm('¿Seguro que deseas restaurar la base de datos desde el respaldo más reciente?');"
            >
              <a href="index.php?action=restaurarBD" class="flex items-center gap-2 truncate">
                <span class="material-symbols-outlined text-base">history</span>
                <span>Restaurar Base de Datos</span>
              </a>
            </button>
          </div>

          <!-- BLOQUES: Materiales más usados / Últimos clientes -->
          <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Materiales más usados -->
            <div class="flex flex-col gap-4 p-6 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700">
              <h3 class="text-base font-medium leading-normal text-gray-900 dark:text-white">
                Materiales Más Usados
              </h3>

              <ul class="space-y-4">
                <?php if (!empty($materialesMasUsados)): ?>
                  <?php
                    // máximo uso para calcular porcentaje
                    $maxUso = max(array_column($materialesMasUsados, 'total_usada'));
                  ?>

                  <?php foreach ($materialesMasUsados as $m): ?>
                    <?php
                      $porc = ($maxUso > 0)
                        ? round(($m['total_usada'] / $maxUso) * 100)
                        : 0;
                    ?>
                    <li class="flex items-center justify-between">
                      <span class="text-sm text-gray-700 dark:text-gray-300">
                        <?php echo htmlspecialchars($m['Nombre']); ?>
                      </span>

                      <div class="w-2/5 h-2 bg-gray-200 dark:bg-gray-700 rounded-full">
                        <div
                          class="h-2 bg-primary rounded-full"
                          style="width: <?php echo $porc; ?>%"
                        ></div>
                      </div>
                    </li>
                  <?php endforeach; ?>
                <?php else: ?>
                  <li class="text-sm text-gray-500 dark:text-gray-400">
                    No hay datos de uso de materiales todavía.
                  </li>
                <?php endif; ?>
              </ul>
            </div>

            <!-- Últimos clientes -->
            <div class="flex flex-col gap-4 p-6 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700">
              <h3 class="text-base font-medium leading-normal text-gray-900 dark:text-white">
                Últimos Clientes
              </h3>

              <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                <?php if (!empty($clientesRecientes)): ?>
                  <?php foreach ($clientesRecientes as $c): ?>
                    <li class="py-2">
                      <p class="text-sm text-gray-700 dark:text-gray-300">
                        <?php echo htmlspecialchars($c['nombre'] . ' ' . $c['apellido']); ?>
                      </p>
                      <p class="text-xs text-gray-500 dark:text-gray-400">
                        <?php echo 'ID #' . (int)$c['id_Cliente']; ?>
                        <?php if (!empty($c['correo'])): ?>
                          · <?php echo htmlspecialchars($c['correo']); ?>
                        <?php endif; ?>
                      </p>
                    </li>
                  <?php endforeach; ?>
                <?php else: ?>
                  <li class="py-2 text-sm text-gray-500 dark:text-gray-400">
                    Sin registros.
                  </li>
                <?php endif; ?>
              </ul>

              <a href="index.php?action=consultCliente" class="text-sm font-medium text-primary hover:underline">
                Ver todos los clientes
              </a>
            </div>
          </div>

          <!-- Cotizaciones recientes -->
          <div class="mt-6 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="p-6">
              <h3 class="text-base font-medium leading-normal text-gray-900 dark:text-white">
                Cotizaciones Recientes
              </h3>
            </div>

            <div class="overflow-x-auto">
              <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                  <tr>
                    <th class="px-6 py-3" scope="col">ID Cotización</th>
                    <th class="px-6 py-3" scope="col">Cliente</th>
                    <th class="px-6 py-3" scope="col">Fecha</th>
                  </tr>
                </thead>

                <tbody>
                  <?php if (!empty($cotizacionesRecientes)): ?>
                    <?php foreach ($cotizacionesRecientes as $c): ?>
                      <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th
                          class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                          scope="row"
                        >
                          #COT-<?php echo str_pad($c['id_cotizacion'], 4, '0', STR_PAD_LEFT); ?>
                        </th>

                        <td class="px-6 py-4">
                          <?php echo htmlspecialchars($c['Nombre'] . ' ' . $c['Apellido']); ?>
                        </td>

                        <td class="px-6 py-4">
                          <?php echo htmlspecialchars($c['Fecha']); ?>
                          <!-- Si quieres formatear:
                            <?php // echo date('Y-m-d', strtotime($c['Fecha'])); ?>
                          -->
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  <?php else: ?>
                    <tr class="bg-white dark:bg-gray-800">
                      <td colspan="4" class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
                        No hay cotizaciones registradas.
                      </td>
                    </tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>

        </div>
      </main>
    </div>
  </div>
</body>
</html>
