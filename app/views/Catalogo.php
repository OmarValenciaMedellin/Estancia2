<!DOCTYPE html>
<html class="light" lang="en">
  <head>
    <!-- Configuración básica del documento -->
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Coti Express - Catalog</title>

    <!-- TailwindCSS desde CDN con plugins -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

    <!-- Fuente principal del proyecto -->
    <link
      href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300;400;500;600;700;800;900&display=swap"
      rel="stylesheet"
    />

    <!-- Íconos Material Symbols -->
    <link
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"
      rel="stylesheet"
    />

    <!-- Configuración personalizada de Tailwind -->
    <script id="tailwind-config">
      tailwind.config = {
        darkMode: "class", // Activa modo oscuro por clase
        theme: {
          extend: {
            colors: {
              primary: "#13a4ec",
              "background-light": "#f6f7f8",
              "background-dark": "#101c22",
            },
            fontFamily: {
              display: ["Work Sans"],
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

    <!-- Estilo extra para botones con gradiente -->
    <style>
      .gradient-bg {
        background: linear-gradient(to right, #13a4ec, #28b485);
      }
    </style>
  </head>

  <body
    class="bg-background-light dark:bg-background-dark font-display text-[#111618] dark:text-white"
  >
    <!-- Formulario que envía a la ruta "catalogo" -->
    <form action="index.php?action=catalogo" method="POST">
      <div
        class="relative flex h-auto min-h-screen w-full flex-col group/design-root overflow-x-hidden"
      >
        <div class="layout-container flex h-full grow flex-col">
          
          <!-- HEADER / NAVBAR -->
          <header
            class="flex items-center justify-between whitespace-nowrap border-b border-solid border-b-[#f0f3f4] dark:border-b-[#2a3a44] px-10 py-3 bg-white dark:bg-background-dark sticky top-0 z-10"
          >
            <!-- Logo + título -->
            <div class="flex items-center gap-4 text-[#111618] dark:text-white">
              <div class="size-6 text-primary">
                <span class="material-symbols-outlined !text-3xl">hexagon</span>
              </div>
              <h2
                class="text-[#111618] dark:text-white text-lg font-bold leading-tight tracking-[-0.015em]"
              >
                Coti Express
              </h2>
            </div>

            <!-- Botones de login y registro -->
            <div class="flex flex-1 justify-end gap-4 items-center">
              <a
                class="flex max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 gradient-bg text-white gap-2 text-sm font-bold leading-normal tracking-[0.015em] min-w-0 px-4"
                href="index.php?action=login"
              >
                <span class="truncate">Iniciar Sesion</span>
              </a>

              <a
                class="flex max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 gradient-bg text-white gap-2 text-sm font-bold leading-normal tracking-[0.015em] min-w-0 px-4"
                href="index.php?action=insert"
              >
                <span class="truncate">Registrar</span>
              </a>
            </div>
          </header>

          <!-- CONTENIDO PRINCIPAL -->
          <main class="flex-1 p-6 lg:p-10">
            
            <!-- Título y subtítulo -->
            <div class="flex flex-wrap justify-between gap-4 items-center mb-8">
              <div class="flex flex-col gap-1">
                <p
                  class="text-[#111618] dark:text-white text-4xl font-black leading-tight tracking-[-0.033em]"
                >
                  Catálogo de Productos
                </p>
                <p
                  class="text-[#617c89] dark:text-gray-400 text-base font-normal leading-normal"
                >
                  Explore nuestra selección de materiales de alta calidad
                </p>
              </div>
            </div>

            <!-- GRID DE PRODUCTOS -->
            <div class="grid grid-cols-[repeat(auto-fit,minmax(250px,1fr))] gap-6">
              
              <!-- Card 1: Mármol -->
              <div
                class="flex flex-col gap-3 pb-3 bg-white dark:bg-background-dark rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300 overflow-hidden"
              >
                <!-- Imagen del producto -->
                <div
                  class="w-full bg-center bg-no-repeat aspect-video bg-cover"
                  data-alt="Marble Countertop"
                  style="
                    background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuC2myVdup0ednHaimPMQiHUt46_EyIKQCzzBs6wtMdTfs38Qk9jp26GoQCud3CJKJPPv5dxjmGGlKogI-RtA9Tu14lkz1Ur_VZBONplqD3f5msEzqLWSuXMpR0Rt9z5tb-_WP-Il7ewTQKVhU7K6pThIeQ5ofVxmKA8VgyTP8YgrVmPN9OHswBAuW-mPnBH492LHDbHGO6v__rLhmxD-kIcsgvee1YMMDiDwQKyO7o_oXFVWiAtXS-Naky2wYHLoI_n4EEpnq0sHw');
                  "
                ></div>

                <!-- Información del producto -->
                <div class="p-4 flex flex-col flex-1">
                  <p class="text-[#111618] dark:text-white text-lg font-bold leading-normal">
                    Encimera de Mármol
                  </p>
                  <p
                    class="text-[#617c89] dark:text-gray-400 text-sm font-normal leading-normal mt-1 flex-grow"
                  >
                    Elegante y duradera, perfecta para cocinas modernas.
                  </p>

                  <!-- Detalles extra -->
                  <div class="text-sm text-[#617c89] dark:text-gray-400 mt-4">
                    <p><b>Uso:</b> Cocina</p>
                    <p><b>Medidas:</b> Personalizable</p>
                    <p class="font-bold text-[#111618] dark:text-white mt-2">
                      $150.00 / m²
                    </p>
                  </div>
                </div>
              </div>

              <!-- Card 2: Piso de Madera -->
              <div
                class="flex flex-col gap-3 pb-3 bg-white dark:bg-background-dark rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300 overflow-hidden"
              >
                <div
                  class="w-full bg-center bg-no-repeat aspect-video bg-cover"
                  data-alt="Hardwood Flooring"
                  style="
                    background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAUkfAMzj5aiOS5SdzDoT2kmRVI5C0dlz7B_6GxXwQkrMOJBLKfj_3wZR29_px0eRvmxUqvmvcI9Yx_WrxEIrKIH1XpUHtgbHuUrSjfKX-ALRla3e3G6AufO7ltIExN2-NQ0bPaoUy1rzt_quh7cBArCxz7O-1k09GVyT0Oo6URu12mQdF2FdnXS7e5KYrPhnX_ewXBahTq7tEKSwBsVlXAo5gj9RJNFaWsZxsFQRifGd-VvkhNQFe1wIy2jYAOVh701MBlZK_wBg');
                  "
                ></div>

                <div class="p-4 flex flex-col flex-1">
                  <p class="text-[#111618] dark:text-white text-lg font-bold leading-normal">
                    Piso de Madera
                  </p>
                  <p
                    class="text-[#617c89] dark:text-gray-400 text-sm font-normal leading-normal mt-1 flex-grow"
                  >
                    Clásico y atemporal, añade calidez y carácter a cualquier habitación.
                  </p>

                  <div class="text-sm text-[#617c89] dark:text-gray-400 mt-4">
                    <p><b>Uso:</b> Sala de estar, Dormitorio</p>
                    <p><b>Medidas:</b> Tablones de 12cm x 120cm</p>
                    <p class="font-bold text-[#111618] dark:text-white mt-2">
                      $120.00 / m²
                    </p>
                  </div>
                </div>
              </div>

              <!-- Card 3: Encimera de Cuarzo -->
              <div
                class="flex flex-col gap-3 pb-3 bg-white dark:bg-background-dark rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300 overflow-hidden"
              >
                <div
                  class="w-full bg-center bg-no-repeat aspect-video bg-cover"
                  data-alt="Quartz Countertop"
                  style="
                    background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDPrFDfF2J2BGvI5IyoovFL0mfgu7pMm5ML9HNKMPoCIL5yppQYZsC_zO98DBSUsTXIAYriCT3jBrDyGDRjSwpwLMUtKYsKALk2S56TuYVXi6JaX15RoEBRhWNlJoWBC55mTTwpl5gCbMlJ4GxX2OAAwkdfvZW8C2-isg1n9-EGeDmxcP4AU5vZeI1ZDhhBfaL_HL7CB8ALSwSe1u31PHAQrCtkOUGHBWoLW11fISWMZt01SW29b9r68CUh3u_MQqnczvwbew69_w');
                  "
                ></div>

                <div class="p-4 flex flex-col flex-1">
                  <p class="text-[#111618] dark:text-white text-lg font-bold leading-normal">
                    Encimera de Cuarzo
                  </p>
                  <p
                    class="text-[#617c89] dark:text-gray-400 text-sm font-normal leading-normal mt-1 flex-grow"
                  >
                    Diseñada para la belleza y el rendimiento.
                  </p>

                  <div class="text-sm text-[#617c89] dark:text-gray-400 mt-4">
                    <p><b>Uso:</b> Cocina, Baño</p>
                    <p><b>Medidas:</b> Personalizable</p>
                    <p class="font-bold text-[#111618] dark:text-white mt-2">
                      $130.00 / m²
                    </p>
                  </div>
                </div>
              </div>

              <!-- Card 4: Azulejo de Porcelana -->
              <div
                class="flex flex-col gap-3 pb-3 bg-white dark:bg-background-dark rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300 overflow-hidden"
              >
                <div
                  class="w-full bg-center bg-no-repeat aspect-video bg-cover"
                  data-alt="Porcelain Tile"
                  style="
                    background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAcZQecneoMzjq4E-Wrv8hhNaASpfqNTtLKqtuplgXLsKC6mdPa1-ZmmNusUF3_soalxhgY2wG9J0g8JoF4TFF5C05Sl0lyoIQLlYA0Jbhd2Tx-Zgp6-lrxo-DFmXNoo2k7uwQXR8uRw6xCdYISNSDBSAea7veupxPnVdx1vAZ46E2fM7QbkYhM1USHkR4ocBNQB3vmEjxoCdIrQZGSXwPqacf2ZRWw0brfLHPJThOrE1DoBe8io50cSMKqcH0xRV5mCF64Aez6aA');
                  "
                ></div>

                <div class="p-4 flex flex-col flex-1">
                  <p class="text-[#111618] dark:text-white text-lg font-bold leading-normal">
                    Azulejo de Porcelana
                  </p>
                  <p
                    class="text-[#617c89] dark:text-gray-400 text-sm font-normal leading-normal mt-1 flex-grow"
                  >
                    Versátil y elegante, adecuado para suelos y paredes.
                  </p>

                  <div class="text-sm text-[#617c89] dark:text-gray-400 mt-4">
                    <p><b>Uso:</b> Baño, Cocina</p>
                    <p><b>Medidas:</b> 60cm x 60cm</p>
                    <p class="font-bold text-[#111618] dark:text-white mt-2">
                      $80.00 / m²
                    </p>
                  </div>
                </div>
              </div>

              <!-- Card 5: Piso de Vinilo -->
              <div
                class="flex flex-col gap-3 pb-3 bg-white dark:bg-background-dark rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300 overflow-hidden"
              >
                <div
                  class="w-full bg-center bg-no-repeat aspect-video bg-cover"
                  data-alt="Luxury Vinyl Plank"
                  style="
                    background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDk6DyjZu7effZU7mMwcksN8C0SAlfS-t0_TAo0kav-N3ZEF4Qfhw6GCU8niv7pfAgch-F3psJm26718w7BTzzUJbL4dVokzblAsuh4BR1reUkxyFlQQ6A9CoojkNPAvV9uH9KwLsSs-HLutIxc7CHgJYU3HBqtMK9wo17EOqoW5jm8Oa1gUvj4K79hRYaM4t2rEFgtpkuDDBZw1ZqlbDK3vv_dYmWoMuWd4BX_flwk8tykXM4w3jCahRqvRjSNKS-EvuYDFJ0Q3g');
                  "
                ></div>

                <div class="p-4 flex flex-col flex-1">
                  <p class="text-[#111618] dark:text-white text-lg font-bold leading-normal">
                    Piso de Vinilo de Lujo
                  </p>
                  <p
                    class="text-[#617c89] dark:text-gray-400 text-sm font-normal leading-normal mt-1 flex-grow"
                  >
                    Impermeable y duradero, ideal para zonas de alto tráfico.
                  </p>

                  <div class="text-sm text-[#617c89] dark:text-gray-400 mt-4">
                    <p><b>Uso:</b> Todas las áreas</p>
                    <p><b>Medidas:</b> Tablones de 15cm x 122cm</p>
                    <p class="font-bold text-[#111618] dark:text-white mt-2">
                      $60.00 / m²
                    </p>
                  </div>
                </div>
              </div>

              <!-- Card 6: Encimera de Granito -->
              <div
                class="flex flex-col gap-3 pb-3 bg-white dark:bg-background-dark rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300 overflow-hidden"
              >
                <div
                  class="w-full bg-center bg-no-repeat aspect-video bg-cover"
                  data-alt="Granite Countertop"
                  style="
                    background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuCJ0PwGPVuTr0s9hSz3gOZL9H7dPPN-vsrbYg_hzazzfQc9ij3g7ygihUGi7CZJaXJ8mdHccIawQXRODyY7V4BJ-xew9g8AiVrKEW_dEhn27a9Y1BZ2IYbkjm12JGUsHhdsITuLMGNgpZY6fLpuRUjP9JxExE8Y_5aybZ92rMYrfkXjvJPRlEuuoCz91gFe9R5l7KIda5Rczxls2hKH8Ut8sLaUi51SlREIhqoqsoOELnxHL8Oq2qv1vXJVlCWvNjaD4CRoP9soAg');
                  "
                ></div>

                <div class="p-4 flex flex-col flex-1">
                  <p class="text-[#111618] dark:text-white text-lg font-bold leading-normal">
                    Encimera de Granito
                  </p>
                  <p
                    class="text-[#617c89] dark:text-gray-400 text-sm font-normal leading-normal mt-1 flex-grow"
                  >
                    Una piedra natural con patrones y colores únicos.
                  </p>

                  <div class="text-sm text-[#617c89] dark:text-gray-400 mt-4">
                    <p><b>Uso:</b> Cocina</p>
                    <p><b>Medidas:</b> Personalizable</p>
                    <p class="font-bold text-[#111618] dark:text-white mt-2">
                      $140.00 / m²
                    </p>
                  </div>
                </div>
              </div>

            </div>
          </main>
        </div>
      </div>
    </form>
  </body>
</html>
