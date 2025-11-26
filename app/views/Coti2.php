<?php
// Variables esperadas:
// $materiales -> mysqli_result de UserModel::consultarMaterial()
// En sesión ya está $_SESSION['cotizacion']['cliente'] y ['cliente_id'].

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// mensaje de error que puso el controlador (stock insuficiente, etc.)
$mensaje_error = $_SESSION['cotizacion_error'] ?? '';
unset($_SESSION['cotizacion_error']);

// Pasamos materiales a un array para mandarlos a JS
$listaMateriales = [];
if ($materiales && $materiales->num_rows > 0) {
    while ($m = $materiales->fetch_assoc()) {
        $listaMateriales[] = $m;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Coti Express - Crear Nueva Cotización</title>

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

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
    <div class="relative flex h-auto min-h-screen w-full flex-col bg-background-light dark:bg-background-dark group/design-root overflow-x-hidden">
      <div class="layout-container flex h-full grow flex-col">

        <header class="flex items-center justify-between whitespace-nowrap border-b border-solid border-slate-200 dark:border-slate-800 bg-white dark:bg-background-dark px-6 sm:px-10 py-3">
          <div class="flex items-center gap-4 text-slate-800 dark:text-white">
            <div class="size-6 text-primary">
              <svg fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                <path d="M6 6H42L36 24L42 42H6L12 24L6 6Z" fill="currentColor"></path>
              </svg>
            </div>
            <h2 class="text-slate-800 dark:text-white text-lg font-bold leading-tight tracking-[-0.015em]">Coti Express</h2>
          </div>

          <div class="flex flex-1 justify-end gap-4 sm:gap-6">
            <div class="flex gap-2">
              <button class="flex max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 bg-slate-100 dark:bg-slate-800 text-slate-800 dark:text-white gap-2 text-sm font-bold leading-normal tracking-[0.015em] min-w-0 px-2.5" type="button">
                <span class="material-symbols-outlined text-slate-600 dark:text-slate-300">notifications</span>
              </button>
              <button class="flex max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 bg-slate-100 dark:bg-slate-800 text-slate-800 dark:text-white gap-2 text-sm font-bold leading-normal tracking-[0.015em] min-w-0 px-2.5" type="button">
                <span class="material-symbols-outlined text-slate-600 dark:text-slate-300">help</span>
              </button>
            </div>
          </div>
        </header>

        <main class="px-4 sm:px-6 lg:px-8 flex flex-1 justify-center py-5">
          <div class="layout-content-container flex flex-col w-full max-w-4xl flex-1 gap-6">

            <div>
              <p class="text-slate-900 dark:text-white text-4xl font-black leading-tight tracking-[-0.033em]">
                Crear Nueva Cotización
              </p>
            </div>

            <?php if (!empty($mensaje_error)): ?>
              <div class="rounded-lg bg-red-100 border border-red-300 text-red-700 px-4 py-3 text-sm">
                <?php echo $mensaje_error; ?>
              </div>
            <?php endif; ?>

            <div class="flex flex-col gap-3 pt-4">
              <div class="flex flex-col sm:flex-row gap-6 justify-between">
                <p class="text-slate-800 dark:text-slate-200 text-base font-medium leading-normal">
                  Paso 2 de 4: Materiales
                </p>
              </div>

              <div class="rounded bg-slate-200 dark:bg-slate-700 h-2 w-full">
                <div class="h-2 rounded bg-primary" style="width: 50%;"></div>
              </div>
            </div>

            <div class="bg-white dark:bg-slate-900/70 rounded-xl shadow-sm border border-slate-200 dark:border-slate-800 p-6 sm:p-8 flex flex-col gap-8">
              <div class="flex flex-col gap-6">

                <h2 class="text-slate-800 dark:text-white text-[22px] font-bold leading-tight tracking-[-0.015em] pb-2 border-b border-slate-200 dark:border-slate-800">
                  Selección de Materiales y Cantidades
                </h2>

                <form method="post" action="index.php?action=cotizacion&step=2" class="flex flex-col gap-6" id="formMateriales">

                  <!-- Buscador -->
                  <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-start">
                    <div class="md:col-span-2 relative">
                      <label class="flex flex-col min-w-40 w-full">
                        <span class="text-sm font-medium text-slate-600 dark:text-slate-400 mb-1.5">Buscar materiales</span>
                        <div class="flex w-full flex-1 items-stretch rounded-lg h-12">
                          <div class="text-slate-500 dark:text-slate-400 flex border-none bg-slate-100 dark:bg-slate-800 items-center justify-center pl-4 rounded-l-lg border-r-0">
                            <span class="material-symbols-outlined">search</span>
                          </div>
                          <input
                            id="filtroMateriales"
                            class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-r-lg text-slate-800 dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border-none bg-slate-100 dark:bg-slate-800 h-full placeholder:text-slate-500 dark:placeholder:text-slate-400 px-4 pl-2 text-base font-normal leading-normal"
                            placeholder="Escribe para buscar material..."
                            type="text"
                            autocomplete="off"
                          />
                        </div>
                      </label>
                    </div>

                    <div>
                      <p class="text-xs text-slate-500 dark:text-slate-400">
                        Busca un material, selecciónalo y llena sus medidas/cantidad.
                      </p>
                    </div>
                  </div>

                  <!-- ✅ NUEVO: SECCIÓN DE SELECCIONADOS -->
                  <div id="panelSeleccionados" class="hidden">
                    <h3 class="text-sm font-bold text-slate-800 dark:text-white mb-2">
                      Materiales seleccionados
                    </h3>

                    <div id="listaSeleccionados" class="flex flex-col gap-3"></div>

                    <div class="border-t border-slate-200 dark:border-slate-800 my-3"></div>
                  </div>

                  <!-- Resultados (vacío al inicio) -->
                  <div class="flex flex-col gap-4" id="listaMateriales"></div>

                  <!-- Inputs ocultos para seleccionados -->
                  <div id="inputsSeleccionados"></div>

                  <!-- Nota subtotal -->
                  <div class="flex justify-end pt-4 border-t border-slate-200 dark:border-slate-800">
                    <p class="text-sm text-slate-500 dark:text-slate-400 italic">
                      El subtotal se calculará automáticamente en el siguiente paso.
                    </p>
                  </div>

                  <!-- Botones -->
                  <div class="flex justify-between gap-4 pt-6 border-t border-slate-200 dark:border-slate-800">
                    <a
                      href="index.php?action=cotizacion&step=1"
                      class="flex max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 border border-slate-300 dark:border-slate-700 bg-transparent text-slate-600 dark:text-slate-300 gap-2 text-sm font-bold leading-normal tracking-[0.015em] min-w-0 px-6 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors"
                    >
                      <span class="material-symbols-outlined">arrow_back</span>
                      <span>Volver</span>
                    </a>

                    <button
                      type="submit"
                      class="flex max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 bg-primary text-white gap-2 text-sm font-bold leading-normal tracking-[0.015em] min-w-0 px-6 hover:opacity-90 transition-opacity"
                    >
                      <span>Siguiente</span>
                      <span class="material-symbols-outlined">arrow_forward</span>
                    </button>
                  </div>
                </form>
              </div>
            </div>

          </div>
        </main>
      </div>
    </div>

    <script>
      const materiales = <?php echo json_encode($listaMateriales, JSON_UNESCAPED_UNICODE); ?>;

      const inputBuscador = document.getElementById("filtroMateriales");
      const lista = document.getElementById("listaMateriales");
      const inputsSeleccionados = document.getElementById("inputsSeleccionados");

      const panelSeleccionados = document.getElementById("panelSeleccionados");
      const listaSeleccionados = document.getElementById("listaSeleccionados");

      // seleccionados por id_material
      // cada item: { ancho, alto, cantidad, nombre, unidad, costo }
      const seleccionados = new Map();

      function renderResultados(items) {
        lista.innerHTML = "";

        if (!items.length) {
          lista.innerHTML = `
            <p class="text-sm text-slate-500 dark:text-slate-400">
              No hay resultados.
            </p>`;
          return;
        }

        items.forEach((m) => {
          const id = String(m.id_material);
          const nombre = m.Nombre;
          const costo = parseFloat(m.Costo || 0).toFixed(2);
          const unidad = m.UnidadMedida;

          const yaSeleccionado = seleccionados.has(id);
          const dataSel = yaSeleccionado ? seleccionados.get(id) : { ancho:0, alto:0, cantidad:0 };

          const card = document.createElement("div");
          card.className = "bg-slate-50 dark:bg-slate-800/50 rounded-lg p-4 border border-slate-200 dark:border-slate-800";

          card.innerHTML = `
            <div class="flex flex-col sm:flex-row gap-4 items-start">
              <div class="flex-1">
                <h3 class="font-bold text-slate-800 dark:text-white">${nombre}</h3>
                <p class="text-sm text-slate-500 dark:text-slate-400">
                  $${costo} por ${unidad}
                </p>
              </div>

              <label class="flex items-center gap-2 text-sm font-medium text-slate-700 dark:text-slate-200">
                <input type="checkbox" class="chkMaterial" data-id="${id}" ${yaSeleccionado ? "checked" : ""}>
                Seleccionar
              </label>

              <label class="flex flex-col min-w-20">
                <span class="text-xs font-medium text-slate-600 dark:text-slate-400 mb-1">Ancho (cm)</span>
                <input
                  class="form-input w-full rounded-md text-sm text-slate-800 dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 h-10 px-3 inpAncho"
                  type="number"
                  step="0.01"
                  value="${dataSel.ancho ?? 0}"
                  data-id="${id}"
                  ${yaSeleccionado ? "" : "disabled"}
                />
              </label>

              <label class="flex flex-col min-w-20">
                <span class="text-xs font-medium text-slate-600 dark:text-slate-400 mb-1">Alto (cm)</span>
                <input
                  class="form-input w-full rounded-md text-sm text-slate-800 dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 h-10 px-3 inpAlto"
                  type="number"
                  step="0.01"
                  value="${dataSel.alto ?? 0}"
                  data-id="${id}"
                  ${yaSeleccionado ? "" : "disabled"}
                />
              </label>

              <label class="flex flex-col min-w-20">
                <span class="text-xs font-medium text-slate-600 dark:text-slate-400 mb-1">Cantidad</span>
                <input
                  class="form-input w-full rounded-md text-sm text-slate-800 dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 h-10 px-3 inpCantidad"
                  type="number"
                  value="${dataSel.cantidad ?? 0}"
                  min="0"
                  data-id="${id}"
                  ${yaSeleccionado ? "" : "disabled"}
                />
              </label>
            </div>
          `;

          lista.appendChild(card);
        });

        wireEventosResultados();
      }

      function wireEventosResultados() {
        // checkbox seleccionar
        document.querySelectorAll(".chkMaterial").forEach(chk => {
          chk.addEventListener("change", e => {
            const id = e.target.dataset.id;
            const mat = materiales.find(x => String(x.id_material) === String(id));

            const ancho = document.querySelector(`.inpAncho[data-id="${id}"]`);
            const alto = document.querySelector(`.inpAlto[data-id="${id}"]`);
            const cantidad = document.querySelector(`.inpCantidad[data-id="${id}"]`);

            if (e.target.checked) {
              ancho.disabled = false;
              alto.disabled = false;
              cantidad.disabled = false;

              // guarda registro con meta
              seleccionados.set(id, {
                ancho: parseFloat(ancho.value || 0),
                alto: parseFloat(alto.value || 0),
                cantidad: parseInt(cantidad.value || 0),
                nombre: mat?.Nombre || '',
                unidad: mat?.UnidadMedida || '',
                costo: parseFloat(mat?.Costo || 0)
              });
            } else {
              ancho.disabled = true;
              alto.disabled = true;
              cantidad.disabled = true;
              seleccionados.delete(id);
            }

            syncHiddenInputs();
            renderSeleccionados();
          });
        });

        // inputs numéricos
        document.querySelectorAll(".inpAncho, .inpAlto, .inpCantidad").forEach(inp => {
          inp.addEventListener("input", e => {
            const id = e.target.dataset.id;
            if (!seleccionados.has(id)) return;

            const reg = seleccionados.get(id);

            if (e.target.classList.contains("inpAncho")) reg.ancho = parseFloat(e.target.value || 0);
            if (e.target.classList.contains("inpAlto"))  reg.alto  = parseFloat(e.target.value || 0);
            if (e.target.classList.contains("inpCantidad")) reg.cantidad = parseInt(e.target.value || 0);

            seleccionados.set(id, reg);

            syncHiddenInputs();
            renderSeleccionados();
          });
        });
      }

      function renderSeleccionados() {
        if (seleccionados.size === 0) {
          panelSeleccionados.classList.add("hidden");
          listaSeleccionados.innerHTML = "";
          return;
        }

        panelSeleccionados.classList.remove("hidden");
        listaSeleccionados.innerHTML = "";

        seleccionados.forEach((val, id) => {
          const item = document.createElement("div");
          item.className = "bg-white dark:bg-slate-800 rounded-lg border border-slate-200 dark:border-slate-700 p-3 flex flex-col sm:flex-row sm:items-center gap-3 justify-between";

          item.innerHTML = `
            <div class="flex-1">
              <p class="font-semibold text-slate-800 dark:text-white">${val.nombre}</p>
              <p class="text-xs text-slate-500 dark:text-slate-400">
                Ancho: ${val.ancho} cm · Alto: ${val.alto} cm · Cant: ${val.cantidad}
              </p>
            </div>

            <button
              type="button"
              class="px-3 py-1.5 text-xs font-bold rounded bg-red-100 text-red-700 hover:bg-red-200"
              data-remove-id="${id}"
            >
              Quitar
            </button>
          `;

          listaSeleccionados.appendChild(item);
        });

        // evento quitar
        document.querySelectorAll("[data-remove-id]").forEach(btn => {
          btn.addEventListener("click", e => {
            const id = e.target.dataset.removeId;
            seleccionados.delete(id);

            // si el material está visible en resultados, desmarca y deshabilita inputs
            const chk = document.querySelector(`.chkMaterial[data-id="${id}"]`);
            if (chk) {
              chk.checked = false;

              const ancho = document.querySelector(`.inpAncho[data-id="${id}"]`);
              const alto = document.querySelector(`.inpAlto[data-id="${id}"]`);
              const cantidad = document.querySelector(`.inpCantidad[data-id="${id}"]`);
              if (ancho) ancho.disabled = true;
              if (alto) alto.disabled = true;
              if (cantidad) cantidad.disabled = true;
            }

            syncHiddenInputs();
            renderSeleccionados();
          });
        });
      }

      // crea inputs ocultos SOLO de seleccionados
      function syncHiddenInputs() {
        inputsSeleccionados.innerHTML = "";
        seleccionados.forEach((val, id) => {
          inputsSeleccionados.innerHTML += `
            <input type="hidden" name="id_material[]" value="${id}">
            <input type="hidden" name="ancho[]" value="${val.ancho}">
            <input type="hidden" name="alto[]" value="${val.alto}">
            <input type="hidden" name="cantidad[]" value="${val.cantidad}">
          `;
        });
      }

      // buscador: no muestra nada si está vacío
      inputBuscador.addEventListener("input", () => {
        const q = inputBuscador.value.toLowerCase().trim();

        if (!q) {
          lista.innerHTML = "";
          return;
        }

        const filtrados = materiales.filter(m =>
          (m.Nombre || "").toLowerCase().includes(q)
        );

        renderResultados(filtrados);
      });
    </script>
  </body>
</html>
