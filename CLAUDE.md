# Kiwi Store — reglas del proyecto

Tienda WooCommerce con tema de bloques propio (`themes/kiwi`). Costa Rica, español con voseo.

## Fuente de verdad
- `docs/design/README.md` manda. Vale el estado final: Revisión 6 > Revisión 5 > Revisión 4 > Revisión 3 > texto original.
- Las tablas «Qué queda derogado» derogan aunque el párrafo original no tenga la marca ⚠. Antes de implementar una sección, buscá si una revisión posterior la toca.
- Los `.dc.html` son referencia visual, no código. No copies sus estilos inline.
- Cuando el handoff habla de `assets/logo/` y `assets/icons/`, se refiere a `themes/kiwi/assets/`, la única copia que existe.
- Si el handoff no define algo, no lo inventes: preguntá.

## Sistema de diseño cerrado
- Usá solo tokens: `theme.json` y valores literales del handoff. No inventes color, tamaño, peso, interlínea, tracking, espaciado, radio, sombra, duración ni breakpoint. No derives («un paso más oscuro», «un poco más chico»). Si falta un valor, preguntá.
- Un valor del handoff que no está en `theme.json`: agregalo como preset en `theme.json` y usá la variable. Nunca hex ni px sueltos en CSS o en atributos de bloque.
- Radio `2px` en todo. `50%` solo en emblema, swatches, puntos y botón circular de favorito.
- Sombra única: `0 1px 3px rgba(28,35,30,.16)` en el favorito flotante. Nunca en cards ni botones.
- Tipografía: Archivo 500/600/700 (títulos, precios, botones, wordmark); Karla 400/500/700 (cuerpo, labels). Self-hosted. Precios siempre `tabular-nums`.
- Color con función fija:
  - `verde-kiwi`: único sólido de compra en la vista.
  - `lima-kiwi`: siempre con texto grafito. Un solo bloque lima sólido por vista.
  - `guayaba`: rebajas y badge del carrito; en estados de excepción, una vez por pantalla y solo como borde o anillo. Nunca botón primario, titular ni banner.
  - `indigo`: solo información de confianza.
  - `bruma`: bordes y divisores, nunca texto.
- Transiciones 200 ms `ease-out` (token `custom.transicion`), solo color/opacidad/sombra. Sin escala.
- Solo hay diseño a 375 y 1440 px. No inventes layouts intermedios: preguntá. Breakpoint único: 782 px (debajo, layout móvil; desde 782, escritorio).
- Logo del header: `kiwi-lockup-horizontal.svg` a 36 px de alto en móvil y escritorio. Footer: `kiwi-monocromo-negativo.svg` (falta la variante con aro lima).
- Logo: los SVG de `assets/logo/`. Bajo 32 px, `kiwi-emblema-reduccion.svg`. Sobre foto, aro crema sin caja. Nunca datos de contacto dentro de la marca.
- Evitá siempre: rosa pastel + dorado, degradados decorativos, foil, mármol, script, verde + marrón, ilustración literal de kiwi.

## Accesibilidad
- Contraste WCAG AA en todo par texto/fondo. Nunca texto blanco/crema sobre lima. `texto-debil` (#8A9189) solo ≥16 px o metadato no esencial; nunca a 14 px sobre crema. Placeholders en `texto-muted`.
- Excepción justificada, no revertir: sobre fondo `grafito` los placeholders van en `texto-debil`. `texto-muted` sobre grafito da 2,69:1 (no pasa AA); `texto-debil` sobre grafito da 4,96:1 (pasa). Aprobado por la dueña del proyecto (octubre 2026).
- Focus visible en todo control: anillo 2 px `verde-kiwi`, offset 2 px; sobre fondo oscuro, `lima-kiwi`.
- Hit targets ≥44 px.
- `placeholder` real en inputs, con label asociado.
- Talla: dos estados (normal / seleccionada), expuesto como radio o `aria-pressed`. Nunca `aria-disabled`.
- Botón solo-icono (copiar): nombre accesible; el estado «copiado» se muestra en el botón y se anuncia (`aria-live`).
- Iconos decorativos con `aria-hidden="true"`.

## Iconografía
- Solo los SVG de `themes/kiwi/assets/icons/`. Sin librerías de iconos.
- Iconos propios: grilla 24, trazo 1.75, terminaciones rectas, sin relleno, `currentColor`. El color lo fija el lienzo según el contexto:
  - `grafito`: utilidades del header (favoritos, carrito) y sobre lima (sello de la ficha).
  - `verde-kiwi`: franja de garantías y acentos de marca.
  - `crema`: dentro de botones `verde-kiwi` y sobre fondos oscuros.
  - `indigo`: información de confianza, como el reloj del aviso «Se confecciona por encargo» y el enlace «Guía de tallas».
  - `texto-muted`: fila de confianza secundaria de la ficha (iconos de 18 px).
  - `guayaba`: solo en el estado «Error de carga» del listado, junto a su borde guayaba (es el mismo uso único por pantalla).
  - `lima-kiwi`: solo favoritos sobre foto.
  - `texto-debil`: la lupa del buscador.
- Favoritos = destello de ocho radios. Nunca corazón. Es el único que puede ir lima sobre foto.
- «Quitar» es texto, nunca basurero.
- Lupa, chevron y candado existen desde la revisión 6. El chevron apunta abajo y se rota con `transform: rotate()` (derecha −90°, arriba 180°, izquierda 90°); su hit target es ≥44 px.
- Glifo de chat genérico: eliminado, no existe. Una acción que abre chat lleva el logo de WhatsApp; un aviso que informa (p. ej. «Se confecciona por encargo») lleva el reloj; un enlace «¿Dudas…?» va solo con texto.
- Icono que no existe en el set (regalo, alerta, menú): no lo dibujes ni lo importes. Preguntá.
- Prohibidos: percha, corona, diamante, labios, mariposas.

### Logos de terceros (revisión 6 del handoff)
- Un logo oficial de terceros entra en la iconografía **solo si cumple las ocho condiciones**:
  1. **Destino**: el clic abre ese servicio; no decora ni avala.
  2. **Duda real**: resuelve una ambigüedad que el texto no resuelve.
  3. **Archivo oficial** sin modificar: solo variantes publicadas por la marca. Sin recolorear, deformar ni recortar.
  4. **Con texto**, nunca solo.
  5. **Un logo a color por vista.**
  6. **Sin contagio**: su color no es token.
  7. **Registro**: toda marca tiene fila en la tabla del §3 de la revisión 6 (destino, archivo, versión, fecha de revisión de lineamientos, aprobación). Sin fila, no entra.
  8. **Fuera de alcance**: los medios de pago (SINPE, tarjetas) requieren una decisión propia.
- **Un logo a color por vista.** Si en la misma vista hay una segunda aparición, va en monocromo.
- **Sin contagio del color.** El verde de WhatsApp no es token: vive solo dentro del glifo. Nunca en fondos, bordes, hover, foco, activo ni texto. Hover, foco y activo no tocan el logo.
- WhatsApp es la única marca aprobada. Dos archivos: `whatsapp-color.svg` y `whatsapp-mono.svg` (`currentColor`).
  - Se renderiza a 20 px (mínimo 20 a color, 16 en monocromo), siempre con etiqueta de texto. No se compensa su peso óptico con tamaño ni contorno.
  - Va centrado con las mayúsculas de la etiqueta. Gap 10 en botones de 48/56 px y 8 en sellos. Espacio libre ≥4 px (o el de Meta, si es mayor).
  - A color solo sobre `crema`, `crema-alta`, `aviso` o `divisor`. Sobre `verde-kiwi`, `grafito`, fotos o avisos de error va en monocromo (`crema` o la tinta del texto).
  - Dónde va (tabla del §2 de la revisión 6):
    - A color: botón secundario de la ficha, sello de consulta de fecha, carrito y botón del checkout.
    - En gracias: el primero a color y un segundo en monocromo.
    - En monocromo: estados de excepción y footer.
    - Sin icono: el enlace en línea del checkout y las menciones en la línea de tiempo.
  - **Bloquea publicar:** los dos SVG del repo son marcadores de trazo, no los archivos oficiales de Meta, y la revisión de lineamientos figura como pendiente. Hay que reemplazarlos por los oficiales antes de publicar. Se pueden usar en desarrollo.

## Modelo de negocio (condiciona el código)
- **Sin inventario.** Todo se confecciona por encargo y nunca se agota. Productos sin gestión de stock, siempre comprables. No construyas: agotado, stock por talla, reposición, «últimas N», reserva, apartado, liberar stock, filtro de disponibilidad.
- **Sin plazo de entrega.** Ninguna fecha, rango ni estimado de entrega en UI, correos, metadatos ni datos estructurados. Sin filtro ni badge de entrega.
- **Envío plano ₡3.000 por pedido**, todo el país, en el mismo SINPE. Un solo método `flat_rate`. Sin zonas por destino, peso, clases, envío gratis ni contador de umbral.
- **SINPE Móvil manual, único medio de pago.** Pasarela offline (`bacs`, titulada «SINPE Móvil»). El pedido nace `on-hold`; `on-hold` → `processing` siempre a mano. Número, titular e instrucciones son opciones del método, nunca texto duro. Referencia = número de pedido. Monto = subtotal + ₡3.000.
- **Sin impuestos.** Precio publicado = precio final. Sin líneas de IVA, sin campos de factura electrónica (cédula, correo XML).
- Moneda CRC, separador de miles `.`, cero decimales: `₡12.500`.
- WhatsApp es salida secundaria para consultar, nunca un segundo camino de pago. En la ficha el botón dice «Preguntar por WhatsApp», nunca «Comprar» (decisión de la dueña, octubre 2026; pendiente que diseño corrija el lienzo).
- Número de WhatsApp: +506 8556 9119, **solo** en la constante `KIWI_WHATSAPP_NUMERO` del plugin `kiwi-whatsapp`. Plantillas, patterns y menús enlazan a `/whatsapp/`; el plugin lo reescribe a `https://wa.me/50685569119` al renderizar (y redirige si llega sin reescribir). Nunca escribas el número ni `wa.me` en una plantilla.
- **Ningún cron, tarea programada ni automatismo cambia el estado de un pedido. Nunca.** Con SINPE manual, un automatismo cancelaría pedidos ya pagados que todavía no se conciliaron. El aviso de las 24 h y la cancelación de las 48 h los hace la dueña a mano. El código puede, como mucho, señalarle en el admin qué pedidos llegaron a ese punto.
- No configures `woocommerce_hold_stock_minutes` ni nada que dispare la cancelación automática de Woo.
- Comprobante: un archivo, reemplazable, validado en cliente y servidor (MIME real). Un fallo de subida no cambia el estado del pedido.
- Tarjeta de regalo: cupón de un uso emitido al pasar a `processing`, nunca desde `on-hold`.
- Las cards declaran producto y precio; sin estrellas ni reseñas.

## Copy prohibido
- Cualquier plazo de entrega: días, rangos, «aproximadamente», «llega mañana», ejemplos de plazo. (Única cifra de tiempo permitida: devolución de dinero «de 24 a 48 h».)
- Envío gratis, umbrales, descuentos o regalos por monto.
- Agotado, disponible, últimas piezas/unidades, reservado, apartado, stock, «primero en pagar», «se vendió».
- Tarjeta de crédito/débito, IVA, factura, Hacienda.
- «Pagar» en el botón del checkout (es «Confirmar pedido»). «Gracias por tu compra» en la página de pedido recibido (es «Falta un paso»).
- «Cancelar» en cualquier vista del cliente.
- En problemas de pago: «error», «falló», «no se procesó», códigos de error, «te equivocaste».
- Cuentas regresivas. El tiempo va como fecha exacta y relativo («hace 1 día»).
- Montos hipotéticos: «desde», «hasta», «estimado».
- Políticas que nadie definió (vigencia o saldo de la tarjeta de regalo, compensaciones, plazos nuevos). Si el copy necesita un dato que no existe, preguntá.

## Implementación
- No modifiques el core de WordPress ni de WooCommerce. No sobreescribas plantillas PHP de Woo desde el tema.
- Carrito y checkout: bloques nativos de Woo, restilizados con tokens. No reordenes campos por PHP. Extendé con hooks, Store API y los puntos de extensión de los bloques.
- Lógica propia en plugins `kiwi-*`, uno por responsabilidad, en `./plugins/kiwi-*/` en la raíz del repo. `functions.php` del tema solo para presentación (enqueue, patterns, estilos de bloque), nunca lógica de negocio.
- No montes `./plugins` sobre `wp-content/plugins`: taparía WooCommerce, que vive en el volumen. `./plugins` se monta en `/var/www/kiwi-plugins`, y `docker/wordpress-entrypoint.sh` enlaza cada `kiwi-*` dentro de `wp-content/plugins` al arrancar. Si creás o borrás un plugin, corré `docker compose up -d --force-recreate wordpress`.
- Estilos: primero `theme.json`; CSS solo para lo que `theme.json` no expresa, con `var(--wp--preset--*)`.
- Textos de PHP traducibles con text domain `kiwi` (tema) o el del plugin.
- No instales plugins de terceros sin preguntar.
- Carrito del header: bloque `kiwi/carrito` de `kiwi-header`, no el mini-cart de Woo (su único destino sin panel es el checkout, y redirigirlo depende de una clave interna). El conteo lo renderiza el servidor; el JS solo lo actualiza con eventos públicos (`wc-blocks_added_to_cart`, `wc-blocks_removed_from_cart`) y `GET /wc/store/v1/cart`. Nada de claves ni eventos internos de Woo.
- Limitación conocida, aceptada (no es pendiente): cambiar cantidades en la página de carrito no actualiza el badge del header hasta recargar o navegar. Woo no expone un evento público para eso y la página ya muestra el total real.
- Patterns del tema: WordPress cachea la lista en un transient. Si agregás un pattern y no aparece: `wp eval 'wp_get_theme()->delete_pattern_cache();'`.
- Cambios de configuración de WP/Woo: por WP-CLI, y decí qué comandos corriste.

## Entorno y comandos
- Repo en WSL: `~/proyectos/kiwi`. Docker Desktop en Windows. Claude corre en Windows sobre `\\wsl.localhost\...`.
- Ejecutá `git`, `docker` y `wp` dentro de WSL: `wsl -e bash -lc "cd ~/proyectos/kiwi && <comando>"`. Git desde Windows falla por *dubious ownership*.
- WP-CLI: `docker compose exec -T cli wp <args>` (`-T` porque no hay TTY). Con comillas complejas, escribí un script en el scratchpad y corrélo con `wsl -e bash -c "tr -d '\r' < /mnt/c/<ruta> | bash"`.
- Sitio local: http://localhost:8080. Se montan `themes/kiwi`, `plugins/` y `docker/php/uploads.ini` (límite de subida de 12M). El core, los plugins de terceros y los uploads viven en el volumen `wp_data`, fuera de git. El contenedor `cli` corre como `33:33`.
- Desde WSL, `docker compose exec -T` lee stdin: no le pases un script por pipe. Corré el script como archivo, con `< /dev/null`.
- Versiones fijas: WordPress 7.1.2, WooCommerce 11.1.2, PHP 8.3. No actualices sin pedir.
- Producción: VPS Ubuntu con Dokploy, sin desplegar. No despliegues ni asumas nada de producción.

## Pendientes: no los resuelvas por tu cuenta
Están en manos de diseño o de la dueña. Si una tarea depende de uno, frená y preguntá.

**BLOQUEADOR — móvil sin navegación, búsqueda ni footer**
El tráfico viene de Instagram y es mayoritariamente móvil. Hoy, debajo de 782 px, el header muestra solo logo y carrito, y el footer no se muestra: no hay diseño a 375 de navegación, búsqueda ni footer, y no existe el icono de menú (la lupa sí, desde la revisión 6). Pedido a diseño. No inventes UI para cubrirlo.

**BLOQUEADOR — ficha de producto sin diseño de escritorio**
Solo existe la ficha a 375 (§1). Desde 782 px se muestra la misma columna centrada a 520 px (preset `ficha-ancho`, la medida de lectura de la bajada del hero, §2.3). Es provisorio y deliberado: no inventes un layout de dos columnas. Pedido a diseño.

**BLOQUEADOR — listado sin diseño móvil (a confirmar con la dueña)**
Solo existe el listado a 1440 (§2.5). Debajo de 782 px se ocultan los filtros y la franja de garantías y las cards pasan a 2 columnas (sugerencia 4→3→2 del handoff). La hoja inferior de filtros queda para diseño. Esta salida la propuso Claude y todavía no la confirmó la dueña.

**Ficha y listado**
- Logo de WhatsApp en la ficha: el botón secundario va **a color** y el sello lima va **en monocromo**. Lo decide la regla de superficies de la revisión 6: el color solo va sobre crema, crema-alta, aviso o divisor, y el sello es lima. Así se cumple «un logo a color por vista», que la tabla del §2 rompía al pedir color en los dos.
- «Cambio en 15 días» no se muestra (política sin resolver). Lugar reservado: segundo ítem de la fila `kiwi-confianza` de la ficha y cuarta celda de la franja de garantías (la grilla ya es de 4).
- Badge «Nuevo»: omitido, nadie definió qué lo dispara. Filtros del listado: solo categoría y precio (no hay atributo color; la talla nunca se agota).
- Labels de grupo de filtros en `texto-muted`, no en el `texto-debil` del lienzo: a 11 px sobre crema, `texto-debil` no pasa AA.
- Orden del catálogo: por defecto «Más nuevos» (`date`), sin «valoración» (no hay reseñas) ni orden manual. Tallas ordenadas XS → 3XL por `term meta order` del atributo `pa_talla` (orden `menu_order`).
- Conflicto abierto: los puntos de la galería miden 7 px (diseño) y no llegan a 44 px táctiles. Se puede deslizar, pero los puntos son clicables. Llevar a diseño.
- La categoría de la ficha (eyebrow) es un enlace (`post-terms`) de 11 px, sin área táctil de 44. Llevar a diseño: ¿enlace o texto?
- El sitio está en modo «Próximamente» de Woo (solo páginas de tienda): sin sesión, la ficha y el listado muestran esa página.

**Header y footer**
- Navegación: los lienzos se contradicen (identidad: Novedades / Joyería / Accesorios / Ropa / Rebajas; flujo y ayuda: Ropa / Regalos / Rebajas) y las dos listas son del catálogo viejo (hoy: vestidos por encargo). El header usa el menú `menu-principal` (vacío) y el footer `menu-pie-comprar` (vacío) y `menu-pie-ayuda`; las categorías se cargan desde el editor de sitio.
- Descripción del footer («Accesorios, joyería y ropa para todos los días») también es del catálogo viejo: no se publicó. Falta el copy.
- Badge del carrito: el handoff pide `border-radius: 8px`, fuera de la regla de 2 px; se agregó como preset `badge` siguiendo el handoff.

**Contradicciones del handoff**
- Ficha §1: el botón secundario dice «Comprar por WhatsApp», pero §4 establece «Preguntar, no Comprar». Resuelto por la dueña a favor de «Preguntar»; falta que diseño corrija el lienzo.
- Revisión 6, §2: pide el logo de WhatsApp a color en el botón secundario y en el sello de la ficha, contra «un logo a color por vista». Resuelto en el código por la regla de superficies (ver «Ficha y listado»); llevar a diseño.
- Cancelación a las 48 h: las «Notas Woo» hablan de cancelar a las 48 h y §10 dice «desactivar cron». Ya está resuelto por regla del proyecto (manual, ver «Modelo de negocio»), pero el handoff sigue diciendo las dos cosas.
- Texto sin la marca ⚠ que una revisión posterior deroga: «State Management» (`llegaManana`, conteo de entrega, tarifas y peso), «Notas Woo» (dos zonas, IVA de Correos), §1 sello de envío y §2.1 barra (copy anterior a la revisión 5).
- Botón primario: el hover y el active piden «oscurecer un paso», pero ese valor no existe.
- Títulos: H2 es Archivo 600 / −0.02em y H3 es Karla 700, pero `theme.json` aplica Archivo 700 / −0.03em a todos.

**Valores que faltan o están sin aprobar**
- Tamaño del valor en las tarjetas de dato de la página de gracias (§6): «32–34 px» es un rango; no se agregó al `theme.json`.
- Espaciados usados en las pantallas pero fuera de la escala declarada (6, 9, 11, 24, 28, 36, 38, 44): no se agregaron. Header y footer usan el valor de la escala más cercano, pendiente de validar con diseño: 9→8 (logo móvil; padding vertical de la barra superior), 11→12 (logo escritorio, enlaces del footer), 38→40 (padding del footer), 5→4 (desplazamiento del badge del carrito), y 14 vs 18 entre lienzos (utilidades del header)→16. Ficha y listado: 7→8 (encabezado de la ficha), 9→8 (grupo de talla, casillas), 6→8 (icono de «Guía de tallas»), 5→4 (puntos de la galería), 11→12 (grupos de filtros, sello lima), 24→26 (padding y gap del sidebar, padding lateral de garantías). Los que caían entre dos valores se redondean hacia arriba (6→8, 24→26, 36→40): decisión de la dueña, a validar con diseño.
- Las medidas de componente (punto, iconos, badge, buscador, logo) no son espaciado: van como presets `dimensionSizes` en `theme.json`.
- Nombres de token `aviso` (#F1EEE2) y `borde-oscuro` (#4A524B): el handoff usa el valor pero no le da nombre.
- `fluid: true` en la tipografía: WordPress genera tamaños intermedios que el handoff no define.
- Iconos inexistentes: regalo, alerta, menú. Los SVG de WhatsApp son marcadores: faltan los oficiales de Meta y la revisión de sus lineamientos.
- Migración pendiente en los lienzos 08–16: el glifo de chat (aviso «por encargo» del carrito, fila de duda de envío) todavía aparece dibujado. Vale la regla de la revisión 6, no el lienzo.
- Comprobante JPG/PNG/PDF hasta 10 MB: es una propuesta sin aprobar.
- Check a trazo 2.5 dentro de discos ≤26 px; «esquinas 2»; wordmark exacto de Archivo 700.
- Layouts entre 375 y 1440 px (el breakpoint es 782, pero no hay diseño intermedio); estados de error del checkout y de validación del newsletter.

**Políticas y datos de negocio**
- Tarjeta de regalo: vigencia, saldo remanente y con qué se implementa.
- «Cambio en 15 días» en piezas hechas por encargo.
- Favoritos y newsletter: sin proveedor ni comportamiento definido. El newsletter queda fuera del footer hasta que tenga destino: no se maqueta un formulario sin destino.
- Datos reales: número y titular del SINPE, ubicación para el footer. Mientras tanto, el footer va sin ubicación. (WhatsApp de Ana: resuelto, ver «Modelo de negocio».)
