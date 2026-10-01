# Handoff: Kiwi — sistema de identidad y tienda en línea

## Overview
Kiwi es una tienda costarricense de accesorios, ropa y joyería que vende por web, Instagram y WhatsApp. Este paquete documenta la **evolución de su identidad de marca** (tres rutas de logo, paleta, tipografía, iconos) y **tres aplicaciones de interfaz** que ya están definidas a nivel visual: ficha de producto móvil (375 px), piezas de comunicación (cartel A2, anuncios de Instagram) y **home + listado de la tienda en escritorio (1440 px)**.

El objetivo de negocio: en este rubro casi todas las tiendas son difíciles de comprar (catálogos confusos, tallas poco claras, checkout largo). Kiwi compite por lo contrario — comprar tiene que ser obvio y rápido. Cada decisión de UI documentada acá responde a eso.

Dos públicos:
- **Principal**: mujeres de 22 a 45 años que compran para sí mismas, desde el celular.
- **Secundario**: hombres que compran regalos y no saben tallas ni estilos. La tienda debe guiarlos sin hacerlos sentir perdidos (de ahí la doble entrada "Compro para mí" / "Es un regalo").

## About the Design Files
Los archivos de este bundle son **referencias de diseño hechas en HTML** — prototipos que muestran la apariencia y el comportamiento buscados, **no código de producción para copiar tal cual**.

La tarea es **recrear estos diseños dentro del entorno existente del codebase destino** (React, Vue, Next, Astro, Shopify/Liquid, SwiftUI, etc.), usando sus patrones, componentes y librerías ya establecidos. Si todavía no hay entorno, elegir el framework más apropiado para el proyecto e implementarlos ahí.

Advertencias específicas de este bundle:
- `Kiwi-identidad.dc.html` es un **lienzo de presentación** de 1640 px de ancho: apila las secciones 01–07 una debajo de otra para revisión. **No es la estructura del sitio.** Lo que se implementa son las piezas que contiene (ficha móvil, home/listado escritorio), no el lienzo.
- El lienzo usa estilos **inline** exclusivamente y necesita `support.js` (incluido) para renderizar. Eso es una restricción de la herramienta de diseño, **no** una recomendación de arquitectura. En producción: usar el sistema de estilos del codebase (tokens/CSS variables/utilidades).
- El emblema está construido con `repeating-conic-gradient` + `mask` en CSS porque el lienzo debía ser paramétrico. **En producción el logo debe ser un SVG** (ver "Assets").

## Fidelity
**Alta fidelidad (hifi).** Colores, tipografía, escalas, espaciados y estados están definidos y son finales. El desarrollador debe recrear la UI con precisión usando las librerías y patrones del codebase. Las fotografías son placeholders rayados con leyendas en monoespaciada (`FOTO 1:1`, `FOTO DE PORTADA`) — ahí van las fotos reales de producto.

Las fotos de producto las entrega el proveedor ya hechas y reemplazan los placeholders rayados de los lienzos. No hay guía de fotografía propia.

---

## Sistema de marca (contexto para implementar el logo)

Se conserva el equity: **el corte de kiwi —círculo con ritmo radial— y el verde**. Se eliminan: el marrón cáscara (leía "orgánico/alimentos" en vez de moda), la tipografía redondeada tipo sticker, el detalle excesivo de las semillas (se empastaba al reducir), la fotografía dentro del logo y los datos de contacto dentro de la marca.

Tres rutas de evolución, en una sola línea de descendencia (todas comparten grilla, ritmo de 8 y el mismo verde):

| Ruta | Racional | Construcción |
|---|---|---|
| **A · Conservadora** | El mismo emblema sin marrón ni sticker. Quien ya compra lo reconoce sin explicación. | Disco lima `#C3DE4E`, keyline verde `#2F5D3F` de 0.1em, 8 semillas grafito radiales, centro crema con "KIWI" en Archivo 700 |
| **B · Intermedia** ← **recomendada e implementada** | El corte se vuelve sistema: aro, ocho radios y centro. La fruta se intuye pero ya no se dibuja. | Aro `#2F5D3F` de 0.17em, corona de 8 radios (6° de grosor, cada 45°) entre 33 % y 100 % del radio, punto central lima |
| **C · Ruptura** | El kiwi sobrevive solo como color y ritmo radial. Aguanta joyería fina. | Destello de 8 radios finos (1.6°) + wordmark "KIWI" en Archivo 500 con `letter-spacing: 0.34em` |

**Ruta B es la que se aplica en todas las piezas de este handoff.** A es el paso mínimo si hay miedo a perder clientela; C es el destino a 2–3 años.

Reglas de uso del logo:
- **Reducción**: a 24 px el aro sube a 0.2em y los radios engrosan a 8° para no empastarse. Bajo 24 px, el wordmark interno se cae.
- **Monocromo**: funciona en positivo (grafito sobre claro) y negativo (crema sobre grafito), una sola tinta.
- **Sobre foto**: siempre aro crema `#F6F3EA` con radios engrosados y centro lima; nunca caja de fondo.
- **Sin datos de contacto dentro de la marca**, nunca.
- El aro radial y el wordmark **no se mezclan en la misma dosis**: o manda el símbolo, o manda la palabra.
- En pieza de venta la marca firma en esquina a un tamaño fijo del **8 % del ancho**.

---

## Screens / Views

### 1. Ficha de producto — móvil, 375 px

**Purpose**: decidir y comprar en dos toques. Es la pantalla más importante del negocio (el público principal compra desde el celular).

**Layout**: columna única de 375 px, fondo `#F6F3EA`, borde `1px solid #CFCBBD`.
1. Header 
2. Galería de foto
3. Bloque de información
4. Selector de talla
5. Botones de compra
6. Sellos de confianza

**Componentes, de arriba abajo**

*Header* — `padding: 14px 16px`, `border-bottom: 1px solid #E3DFD2`, flex space-between.
- Izquierda: emblema ruta B (aro 0.19em, radios 8°, ~28 px de alto) + wordmark "KIWI" Archivo 700 / 19 px / `letter-spacing: 0.02em` / `#2F5D3F`, gap 9 px.
- Derecha: icono favoritos + icono carrito (22 × 22, trazo 1.75, `#1C231E`), gap 16 px. El carrito lleva badge: círculo `min-width:16px; height:16px; border-radius:8px`, fondo `#C0523A`, número Archivo 700 / 10 px / `#F6F3EA`, posicionado `top:-4px; right:-5px`.

*Galería* — `height: 400px`, foto 1:1 sobre fondo crema con la pieza puesta.
- Badge "Nuevo": `top:14px; left:14px`, fondo `#C3DE4E`, texto Karla 700 / 11 px / `letter-spacing:0.12em` / uppercase / `#1C231E`, `padding: 6px 10px`, `border-radius: 2px`.
- Paginación: 4 puntos de 7 px, gap 5 px, `bottom:14px; right:14px`. Activo `#2F5D3F`, inactivos `#CFCBBD`.

*Bloque de información* — `padding: 18px 16px 20px`, `gap: 16px` entre grupos.
- Eyebrow de categoría: Karla 700 / 11 px / `letter-spacing:0.12em` / uppercase / `#5C665D` → "Aretes"
- Nombre: Archivo 600 / 24 px / `line-height:1.15` / `letter-spacing:-0.02em` → "Aro Marina · acero dorado mate"
- Precio: Archivo 700 / 26 px / `letter-spacing:-0.02em` / `font-variant-numeric: tabular-nums` → "₡12.500". Precio anterior al lado: Archivo 500 / 16 px / `#8A9189` / `line-through` / tabular → "₡15.900". Gap 10 px, alineados por baseline.

*Selector de talla*
- Fila de encabezado: label "Talla del aro" (Karla 700 / 13 px) a la izquierda; a la derecha link "Guía de tallas" (Karla 700 / 13 px / `#3F4E7A`) con el icono de guía de tallas (17 px, `#3F4E7A`), gap 6 px.
> **⚠ DEROGADO en la revisión 5 — el estado «Agotada» del selector y su nota de reposición: nada se agota, todas las tallas están siempre disponibles. Quedan dos estados: normal y seleccionada.** Ver «Revisión 5».

- Tres opciones en flex `gap: 8px`, cada una `flex:1; height:48px; border-radius:2px`, tipografía Archivo 600 / 15 px, centrada:
  - **Disponible**: `border:1px solid #CFCBBD`, fondo `#FFFDF7`, texto `#1C231E`
  - **Seleccionada**: `border:1.5px solid #2F5D3F`, fondo `#2F5D3F`, texto `#F6F3EA`
  - **Agotada**: `border:1px solid #CFCBBD`, fondo `#F1EEE2`, texto `#A8A69B`
- Debajo, nota de reposición: Karla 400 / 12 px / `#5C665D` → "4 cm vuelve el 20 de setiembre · te avisamos por WhatsApp"
- **Decisión de producto**: la talla agotada **se muestra, no se esconde**, con fecha de regreso. El público que compra regalo necesita saber qué hacer cuando falla su primera opción.

*Botones* — `gap: 10px`
- Primario: `height:56px; border-radius:2px`, fondo `#2F5D3F`, texto `#F6F3EA` Archivo 700 / 17 px, con icono de carrito 20 px a la izquierda (`gap: 10px`), copy "Agregar · ₡12.500" (el precio va **en** el botón).
- Secundario: `height:48px`, `border:1.5px solid #2F5D3F`, texto `#2F5D3F` Archivo 600 / 15 px, "Comprar por WhatsApp".
- Ambos ocupan el ancho completo. Altura mínima de hit target respetada (≥44 px).

*Sellos de confianza* — `border-top:1px solid #E3DFD2`, `padding-top:14px`
- Sello de envío: fondo `#C3DE4E`, `padding: 11px 12px`, `border-radius:2px`, icono envío 20 px `#1C231E` + texto Karla 700 / 13 px / `#1C231E` → "Envíos a todo el país". **Va justo debajo del botón**, que es el único lugar donde importa.
- Fila de dos ítems, `gap: 18px`: icono 18 px `#5C665D` + texto Karla 400 / 12 px / `#3E4740` → "Cambio en 15 días" y "Pago por SINPE Móvil".

**Regla clave de esta pantalla**: el botón de compra es lo único `#2F5D3F` sólido en toda la vista. No compite con nada, así que no hay que buscarlo.

---

### 2. Tienda en línea — escritorio, 1440 px (home + listado)

**Purpose**: entrar, entender la promesa y llegar a producto sin fricción. Resuelve los dos públicos desde el primer scroll.

**Layout**: columna de 1440 px, fondo `#F6F3EA`, secciones apiladas separadas por `1px solid #E3DFD2`. Padding horizontal estándar del contenido: **40 px**.

**2.1 Barra de promesa** — fondo `#2F5D3F`, `padding: 9px 0`, contenido centrado, `gap:10px`: punto lima de 6 px + texto Karla 700 / 12 px / `letter-spacing:0.1em` / uppercase / `#F6F3EA` → "Envíos a todo el país · pago por SINPE Móvil".

**2.2 Header** — `padding: 18px 40px`, `border-bottom: 1px solid #E3DFD2`, tres bloques con space-between:
- Logo: emblema ruta B (~36 px) + "KIWI" Archivo 700 / 26 px / `letter-spacing:0.02em` / `#2F5D3F`, gap 11 px.
- Nav: `gap: 26px`, links Karla 700 / 14 px / `#1C231E`, sin subrayado. "Rebajas" en `#C0523A`.
- Utilidades: buscador (296 × 42, `border:1px solid #CFCBBD`, fondo `#FFFDF7`, `border-radius:2px`, icono lupa 17 px `#8A9189` + placeholder Karla 14 px **`#5C665D`** — este valor es obligatorio por contraste AA), icono favoritos 22 px, icono carrito 22 px con badge `#C0523A`.

**2.3 Portada (hero)** — grid `minmax(0,1fr) 620px`, `border-bottom: 1px solid #E3DFD2`.
- Columna de texto: `padding: 52px 44px 52px 40px`, `gap: 26px`, centrada verticalmente.
  - Eyebrow: Karla 700 / 11 px / `letter-spacing:0.14em` / uppercase / `#2F5D3F` → "Nueva colección · setiembre"
  - H1: Archivo 700 / 60 px / `line-height:1` / `letter-spacing:-0.035em` / `#1C231E`, `max-width:620px` → "Aretes que aguantan la oficina y la salida"
  - Bajada: Karla 400 / 17 px / `line-height:1.55` / `#3E4740`, `max-width:520px`
  - Dos botones, `gap:12px`, `height:52px`, `padding: 0 26px`, `border-radius:2px`: primario fondo `#2F5D3F` / texto `#F6F3EA` Archivo 700 / 16 px; secundario `border:1.5px solid #2F5D3F` / texto `#2F5D3F` Archivo 600 / 16 px.
- Columna de foto: `min-height:420px`, **`overflow:hidden` obligatorio**. Contiene la textura radial lima: disco de 180 px, `left:-70px; bottom:24px`, `opacity:.55`, recortado por el marco. Es **textura**, no logo repetido — nunca debe cruzar el borde de su contenedor.

**2.4 Doble entrada** — grid de 2 columnas, `gap:20px`, `padding: 28px 40px`, `border-bottom`. Dos tarjetas `padding: 22px 24px`, `border-radius:2px`, space-between:
- "Compro para mí": `border:1px solid #CFCBBD`, fondo `#FFFDF7`. Título Archivo 600 / 21 px; sub Karla 14 px / `#3E4740`; CTA "Explorar →" Archivo 700 / 14 px / `#2F5D3F`.
- "Es un regalo y no sé la talla": `border:1px solid #2F5D3F`, **fondo `#C3DE4E`**, todo el texto `#1C231E`; CTA "Guiame →".
- **Este es el único lima sólido del cuerpo de la página.** Ahí vive el público secundario, que necesita permiso explícito para comprar sin saber tallas.

**2.5 Listado con filtros** — grid `236px minmax(0,1fr)`.

*Sidebar de filtros* — `border-right:1px solid #E3DFD2`, `padding: 26px 24px 40px`, `gap:24px`.
- Título "Filtros" Archivo 600 / 17 px.
- Cada grupo: label Karla 700 / 11 px / `letter-spacing:0.12em` / uppercase / `#8A9189` + controles.
- Checkbox: 15 × 15, `border-radius:2px`; activo fondo `#2F5D3F`, inactivo `border:1px solid #CFCBBD`. Label Karla 14 px (activo `#1C231E`, inactivo `#3E4740`), con conteo entre paréntesis.
- Slider de precio: riel 4 px `#CFCBBD`, tramo activo `#2F5D3F`, thumb círculo 14 px `#2F5D3F`. Extremos Karla 12 px: mínimo `#5C665D`, valor actual 700 / `#1C231E`.
- Swatches de color: círculos de 26 px, `box-shadow: 0 0 0 1px #CFCBBD`; seleccionado `0 0 0 2px #2F5D3F`.
- Grupo "Entrega" con un solo control: **"Llega mañana"**. Es una decisión de marca, no de UX: la promesa de la tienda convertida en control.

*Grid de producto* — `padding: 26px 40px 40px`, `gap:20px`.
- Barra de encabezado: título "Aretes" Archivo 600 / 24 px / `letter-spacing:-0.02em` + conteo Karla 14 px / `#5C665D` ("42 piezas · 38 llegan mañana"); a la derecha, selector de orden (`height:38px`, `border:1px solid #CFCBBD`, fondo `#FFFDF7`, texto Karla 700 / 13 px + chevron 13 px).
- Cards: grid de 4 columnas, `gap:18px`, cada card en columna con `gap:10px`:
  - Foto `aspect-ratio:1`, `border-radius:2px`.
  - Badges opcionales `top:10px; left:10px`, Karla 700 / 10 px / `letter-spacing:0.12em` / uppercase, `padding:5px 8px`: "Nuevo" → fondo `#C3DE4E` / texto `#1C231E`; "Últimas 3" → fondo `#C0523A` / texto `#F6F3EA`.
  - Botón de favorito: círculo 30 px `#F6F3EA`, `box-shadow: 0 1px 3px rgba(28,35,30,.16)`, `bottom:10px; right:10px`, icono destello 15 px `#2F5D3F`.
  - Nombre Karla 700 / 15 px / `line-height:1.3`.
  - Precio Archivo 700 / 17 px tabular; precio anterior Archivo 500 / 13 px / `#8A9189` / `line-through`.
> **⚠ DEROGADO en la revisión 5 — el estado de la card («Disponible» / «Agotado» / «Vuelve el 20 set»). La card ya no declara disponibilidad: nada se agota.** Ver «Revisión 5».

  - Estado de entrega Karla 700 / 11 px / `letter-spacing:0.06em` / uppercase: disponible `#3F4E7A` ("Llega mañana"), reposición `#5C665D` ("Vuelve el 20 set").
- **Decisión de producto**: cada card declara **entrega**, no estrellas ni reseñas. En este mercado la duda real es cuándo llega, no si gusta.

**2.6 Franja de garantías** — grid de 4 columnas, `border-top:1px solid #E3DFD2`, fondo `#FFFDF7`. Cada celda `padding: 22px 24px`, `border-right:1px solid #E3DFD2` (menos la última), icono 22 px `#2F5D3F` + texto Karla 700 / 13 px / `#1C231E`, gap 12 px: envíos a todo el país, cambio en 15 días, guía de tallas por pieza, medios de pago.

**2.7 Footer** — fondo `#1C231E`, `padding: 38px 40px`, grid `minmax(0,1.2fr) repeat(3,minmax(0,1fr))`, `gap:32px`.
- Bloque de marca: emblema en aro lima + "KIWI" Archivo 700 / 24 px / `#F6F3EA`; descripción Karla 14 px / `line-height:1.55` / `#CFCBBD`, `max-width:300px`. **Acá viven los datos de ubicación, fuera del logo.**
- Dos columnas de links: label Karla 700 / 10 px / `letter-spacing:0.14em` / uppercase / `#8A9189`; links Karla 14 px / `#F6F3EA`, sin subrayado, `gap:11px`.
- Newsletter: campo `height:44px`, `border:1px solid #4A524B`, texto de placeholder `#8A9189`; botón `height:44px`, `padding: 0 16px`, fondo `#C3DE4E`, texto `#1C231E` Archivo 700 / 14 px → "Unirme".

**Regla de esta página**: la marca aparece **tres veces** en total (barra superior, header, pie) y nunca compite con producto.

---

### 3. Piezas de comunicación (referencia, no UI)

Incluidas en el lienzo por completitud del sistema; se implementan como plantillas de diseño, no como código.
- **Tarjeta de agradecimiento** 105 × 148 mm, dos caras: cara A con emblema, titular Archivo 700 / 34 px y firma al pie (`@usuario`, ciudad); cara B con cinco renglones a 34 px de interlínea para nota manuscrita + bloque lima con código de recompra "DEVUELTA15" (Archivo 700 / 32 px / `letter-spacing:0.06em`) y número de pedido en monoespaciada.
- **Cartel A2** (420 × 594 mm), dos plantillas: fondo crema con titular grande cuando el mensaje es producto; bloque `#2F5D3F` con foto arriba cuando el mensaje es servicio.
- **Anuncio Instagram**, feed 1:1 y story 9:16. En feed, el titular blanco va sobre scrim `linear-gradient(0deg, rgba(28,35,30,.92) 0%, rgba(28,35,30,.86) 62%, rgba(28,35,30,.66) 88%, transparent 100%)` — **el piso alto del degradado es obligatorio** para sostener AA sobre foto clara. En story el CTA puede ser lima sobre grafito.

---

## Interactions & Behavior

Estados definidos (implementar con los patrones del codebase):
- **Hover en links de nav**: cambio a `#2F5D3F`. Links genéricos de contenido: default `#2F5D3F`, hover `#C0523A`.
- **Hover en card de producto**: elevar sutilmente y revelar el botón de favorito (en el mock está siempre visible). Sin animaciones de escala agresivas.
- **Botón primario hover**: oscurecer `#2F5D3F` un paso; `active` un paso más. Sin cambio de tamaño.
> **⚠ DEROGADO en la revisión 5 — la talla agotada no clickeable y su fecha de regreso.** Ver «Revisión 5».

- **Selector de talla**: click selecciona (invierte a fondo `#2F5D3F`). La talla agotada **no es clickeable** pero sí enfocable y anunciada como agotada, con su fecha de regreso visible.
- **Favorito**: toggle; el icono es el destello radial de la marca (nunca corazón). Relleno lima al activarse.
- **Filtros**: aplicación inmediata, con actualización del conteo en el encabezado del listado ("42 piezas · 38 llegan mañana"). El filtro "Llega mañana" debe ser una faceta real sobre stock + SLA de entrega, no decorativa.
- **Buscador**: `placeholder` real en el input, no un span (el mock usa span por limitación del lienzo).
- **Transiciones**: 150–200 ms, `ease-out`, solo en color/opacidad/sombra.
- **Focus visible**: obligatorio en todo control. Anillo `#2F5D3F` de 2 px con 2 px de offset; sobre fondos oscuros, anillo `#C3DE4E`.
- **Estados faltantes por definir con producto**: carga (skeletons con `#E3DFD2`), vacío de resultados de filtro, error de checkout, validación del correo del newsletter.

**Responsive**: el mock de escritorio es 1440 px y el de ficha 375 px; los breakpoints intermedios no están diseñados. Sugerido: grid de producto 4 → 3 → 2 columnas; sidebar de filtros colapsa a hoja inferior en móvil; la doble entrada pasa a una columna. Confirmar con diseño antes de inventar layouts.

## State Management
- `cart`: ítems, cantidad, subtotal → alimenta el badge del header.
- `favorites`: set de ids de producto → estado del toggle de favorito.
> **⚠ DEROGADO en la revisión 5 — `stockBySize` y `restockDate`; no hay inventario.** Ver «Revisión 5».

- `selectedSize` por producto, y `stockBySize` con `restockDate` para la nota de reposición.
- `filters`: `{ categorias[], precioMin, precioMax, colores[], llegaManana: boolean }`.
- `sort`: enum (`nuevos` por defecto).
- `listing`: resultados + conteo total + conteo con entrega mañana.
- Datos requeridos: catálogo con precio y precio anterior, stock por talla con fecha de reposición, tarifas de envío por destino (GAM y Resto del país) y peso de cada pieza. Ya no hay umbral de envío gratis.

## Design Tokens

**Colores**

| Token | Hex | Uso |
|---|---|---|
| `verde-kiwi` (primario) | `#2F5D3F` | Tinta de marca, header, **botón de compra**, iconos. Blanco encima 7.6:1 |
| `lima-kiwi` (secundario) | `#C3DE4E` | Equity visible: emblema, sellos, resaltados, patrón radial. **Siempre con texto grafito (10.8:1), nunca blanco** |
| `guayaba` (acento 1) | `#C0523A` | Rebajas, últimas unidades, badge de carrito. **Nunca en botón primario.** Blanco encima 4.6:1 |
| `indigo` (acento 2) | `#3F4E7A` | Solo información de confianza: envío, cambios, pago seguro. Blanco encima 7.9:1 |
| `crema` | `#F6F3EA` | Fondo de tienda y de ficha |
| `crema-alta` | `#FFFDF7` | Fondo de campos e inserciones sobre crema |
| `bruma` | `#CFCBBD` | Bordes y divisores. **Nunca texto sobre crema** |
| `divisor` | `#E3DFD2` | Divisores internos |
| `grafito` | `#1C231E` | Texto, precios, monocromo. Sobre crema 15.2:1 |
| `texto-medio` | `#3E4740` | Cuerpo secundario |
| `texto-muted` | `#5C665D` | Notas, conteos, **placeholders** (mínimo AA a 14 px) |
| `texto-débil` | `#8A9189` | Solo labels ≥16 px o metadatos no esenciales; **no usar a 14 px sobre crema** |

Decisión sobre el verde: **se conserva, en dos temperaturas.** El lima original `#A4C93F` era el equity pero mezclado con marrón leía fruta y es tan claro que ningún texto blanco alcanza AA encima — por eso el botón de compra no podía ser verde. Se limpió hacia `#C3DE4E` (menos amarillo, más frío) y se acompañó de `#2F5D3F`, la misma familia en versión tinta, que sí carga texto blanco a 7.6:1. El cliente sigue viendo verde Kiwi; ahora hay uno para gritar y otro para vender.

**Tipografía** — dos familias, ambas en Google Fonts.
- **Display: Archivo** (500 / 600 / 700) — wordmark, títulos, precios, botones. Tracking negativo en tamaños grandes.
- **Texto: Karla** (400 / 500 / 700) — cuerpo, labels, ayuda al comprador.

| Rol | Familia / peso | Tamaño / interlínea | Tracking |
|---|---|---|---|
| H1 | Archivo 700 | 44 / 46 (60 en hero de escritorio) | −0.03em |
| H2 | Archivo 600 | 28 / 32 | −0.02em |
| H3 | Karla 700 | 18 / 24 | — |
| Cuerpo | Karla 400 | 16 / 25 | — |
| Precio | Archivo 700 | 22 (26 en ficha) | −0.02em, `tabular-nums` |
| Etiqueta | Karla 700 | 11, uppercase | 0.12em |
| Legal | Karla 400 | 12 / 17 | — |

**Espaciado**: escala de 4 px. Valores recurrentes 4 / 8 / 10 / 12 / 14 / 16 / 18 / 20 / 22 / 26 / 32 / 40 / 52. Padding horizontal de página: 40 px (escritorio), 16 px (móvil).

**Radios**: `2px` en todo (botones, cards, badges, campos). El único radio orgánico es `50%`, reservado al lenguaje del emblema, swatches, puntos y botones circulares de favorito.

**Sombras**: mínimas. `0 1px 3px rgba(28,35,30,.16)` en botón flotante de favorito; `0 12px 24px rgba(28,35,30,.12–.24)` solo en mockups de pieza impresa. **Sin sombras en cards de producto ni en botones.**

## Sistema de iconos
Grilla 24 · trazo **1.75** · terminaciones **rectas** · esquinas 2 · **sin relleno** · un solo color. Cada icono cabe en el mismo círculo de 20 que el emblema.

Set base: carrito, envío, guía de tallas, devolución, favoritos, pago seguro. Set ampliado (setiembre 2026): copiar, adjuntar/subir, reloj y check, más el glifo de WhatsApp como excepción documentada. Los once archivos están en `assets/icons/` y se describen en «Assets de producción». Van siempre en `#2F5D3F` o `#1C231E` (`currentColor`).

**Excepción deliberada**: *favoritos* **no usa corazón** — usa el destello de ocho radios de la marca (cuatro trazos cruzados a 45°). Es el único icono con carga de marca y por eso el único que puede ir en lima sobre foto. No sustituir por un corazón de librería.

## Assets
- **Logo**: cinco SVG listos para producción en `assets/logo/` (emblema, lockup horizontal, monocromo positivo, monocromo negativo y reducción ≤ 24 px), con el código en `Kiwi-assets-produccion.dc.html`. Sin gradientes, máscaras ni fuentes externas. El wordmark «KIWI» del lockup está construido con rutas geométricas que imitan Archivo 700; si se quiere el contorno exacto de la fuente, reemplazar solo esa parte. Ver «Assets de producción».
- **Iconos**: once SVG en `assets/icons/` (seis del set base, cuatro nuevos y el glifo de WhatsApp provisional), todos en `viewBox 0 0 24 24`, trazo 1.75 y `currentColor`. Listos para convertir en componentes.
- **Fuentes**: Archivo y Karla desde Google Fonts (o self-hosted; preferible por rendimiento). Pesos usados: Archivo 500/600/700, Karla 400/500/700.
- **Fotografía**: la entrega el proveedor. Los placeholders rayados de los lienzos se reemplazan por esas fotos.
- **Archivos de referencia originales** de la marca anterior (etiqueta circular con foto, emblema vectorial marrón/lima): están en `uploads/` del proyecto, fuera de este bundle. No usar en producción — la evolución los reemplaza.

## Files
| Archivo | Qué es |
|---|---|
| `Kiwi-identidad.dc.html` | Lienzo de identidad y aplicaciones (secciones 01–07, incluye listado y sus tres estados). Abrir en navegador. **Referencia visual, no estructura de producción.** |
| `Kiwi-flujo-compra-sinpe.dc.html` | Lienzo del flujo de compra (secciones 08–12: carrito, checkout, pago SINPE, racionales y tarjeta de regalo). |
| `Kiwi-estados-excepcion.dc.html` | Lienzo de estados de excepción del pago (secciones 13–16: error al subir comprobante, pedido cancelado, reintento de pago, monto distinto). Móvil 375 y escritorio 1440. |
| `Kiwi-assets-produccion.dc.html` | Lienzo de assets: los cinco SVG de logo, los once de iconos con su código, la verificación del set y la decisión sobre el icono de WhatsApp (secciones 17–19). |
| `assets/logo/*.svg`, `assets/icons/*.svg` | Archivos listos para importar. |
| `support.js`, `image-slot.js` | Runtime necesario para que los lienzos rendericen. No forman parte del entregable de código. |

Secciones: **01** rutas de logo · **02** paleta · **03** tipografía · **04** iconos · **05** aplicación (ficha móvil + tarjeta de agradecimiento) · **06** piezas de comunicación · **07** tienda en línea escritorio + estados del listado · **08** carrito · **09** checkout · **10** gracias/pago SINPE · **11** racionales, pendientes y notas Woo · **12** tarjeta de regalo.

Ambos lienzos deben quedar en la **misma carpeta** que `support.js` para abrirse.

## Restricciones no negociables
1. **Contraste WCAG AA en todos los pares texto/fondo.** Pares verificados: grafito/crema 15.2:1 · blanco/verde 7.6:1 · grafito/lima 10.8:1 · blanco/índigo 7.9:1 · blanco/guayaba 4.6:1. Nunca texto blanco sobre lima; nunca `#8A9189` a 14 px sobre crema.
2. **Legible a 24 px y funcional en monocromo** — el logo debe sobrevivir a favicon y a una tinta.
3. **La marca debe leerse sobre foto de producto**, no solo sobre fondo plano: aro crema con radios engrosados, sin caja.
4. **Sin datos de contacto dentro de la marca.** Van al pie, a la tarjeta, al footer.
5. **Hit targets ≥44 px** en móvil.
6. **Evitar explícitamente**: rosa pastel + dorado, degradados decorativos, foil dorado, mármol con vetas, script o caligráfica como logo, iconos de percha/corona/diamante/labios/mariposas, verde + marrón en proporciones de producto orgánico, fotografía dentro del logo, ilustración literal de kiwi.


---

## Flujo de compra: carrito, checkout y pago SINPE (setiembre 2026)

Archivo de referencia: `Kiwi - Flujo de compra SINPE.dc.html` (raíz del proyecto). Lienzo de 1640 px con las tres pantallas en móvil 375 y escritorio 1440. Mismos tokens del sistema: **no se introdujo ningún color, tipo, radio ni valor de espaciado nuevo**.

Contexto técnico asumido: **WooCommerce con tema de bloques**, **SINPE Móvil manual como único medio de pago** (sin pasarela ni redirección; el pedido queda pendiente hasta que la dueña concilia el comprobante a mano), salida paralela por **WhatsApp**, y **precios finales sin impuesto**: el negocio todavía **no está inscrito ante Hacienda**, no emite factura electrónica y no cobra IVA. El precio de las piezas es final; el monto del SINPE es piezas + envío. Ver «Pendiente — facturación electrónica» al final de esta sección.

### 4. Carrito — móvil 375 / escritorio 1440

> **⚠ DEROGADO — la línea «Envío GAM · ₡3.350», el total con envío y la nota «estimado al GAM» (Conflicto 1); «reservadas mientras terminás» (Conflicto 2).** Ver «Revisión 4».

**Purpose**: editar sin salir, ver el envío como línea propia antes del total y elegir entre checkout o WhatsApp.

**Layout móvil**: columna de 375 px, fondo `#F6F3EA`. Header de marca → título + conteo → ítems → resumen (subtotal, envío, total sin envío) → botones → sellos.
**Layout escritorio**: grid `minmax(0,1fr) 396px`, padding horizontal 40 px; tabla de ítems a la izquierda (columnas Pieza / Cantidad / Total) y resumen pegajoso a la derecha.

**Componentes**
- *Ítem*: foto 84 px (móvil) / 96 px (escritorio), nombre Karla 700 / 15–16 px, **talla siempre visible** en Karla 12–13 px `#5C665D`, precio Archivo 700 tabular. En escritorio se suma el estado de disponibilidad (Karla 700 / 11 px uppercase, `#3F4E7A` → "Disponible"), igual que la card del listado.
- *Control de cantidad*: caja `border:1px solid #CFCBBD`, fondo `#FFFDF7`, `height:44px`; − y + son celdas de 42–44 px; número en Archivo 700 tabular. "Quitar" es texto Karla 700 / 13 px `#5C665D`, nunca un icono de basurero.
- *Línea de envío*: fila Karla 14 px `#3E4740`, label "Envío GAM" y valor **₡3.350** en Karla 700 `#1C231E` tabular. Debajo, nota Karla 12 px `#5C665D`: estimado con envío al GAM, hasta 1 kg; el checkout confirma el monto según destino y peso.
- *Resumen*: "Subtotal (2 piezas)" Karla 14 px → línea de envío → **"Total sin envío"** en Archivo 700 / 26 px (móvil) y 28 px (escritorio), tabular, sobre `border-top:1px solid #E3DFD2`. Misma estructura en móvil y escritorio. **Sin línea de impuesto.**
- *Acciones*: primario `height:56px` fondo `#2F5D3F` → "Continuar" / "Continuar al pago", **sin monto dentro** (el monto todavía no es el final); secundario `height:48px` `border:1.5px solid #2F5D3F` → "Preguntar por WhatsApp".
- *Estado vacío*: emblema en `#CFCBBD` (misma construcción, una tinta apagada), titular Archivo 600 / 21 px (móvil) o 700 / 44 px (escritorio), CTA verde "Ver lo nuevo" y tarjeta lima "Es un regalo y no sé la talla".

**Decisiones de producto**
- **La talla viaja con el ítem**: en joyería es el motivo #1 de cambio; verla en el carrito evita el "pedí la equivocada".
- **Sin barra de envío gratis y sin mecanismo sustituto** (ver «Envío sin umbral»).
- **Cantidad con controles de 44 px** en vez de `select` nativo: se edita con el pulgar sin abrir hoja.
- **WhatsApp es secundario y su copy es "Preguntar", no "Comprar"**: es la salida de la duda, no un segundo camino de pago que fragmente la conciliación.
- **El carrito vacío es el mejor lugar del sitio para el público de regalo**: repite la doble entrada y contiene el único lima sólido de la vista.
- **El envío es una línea propia con monto antes del total**, y el total ya lo incluye.

### 5. Checkout de una página — móvil 375 / escritorio 1440

> **⚠ DEROGADO — la tarjeta de envío con tarifa por destino, el resumen con monto de envío (Conflicto 1); el punto «Reserva de 48 h» y el aviso de reserva (Conflicto 2).** Ver «Revisión 4».

**Purpose**: cerrar el pedido dejando claro que el pago ocurre después, fuera del sitio.

**Orden de secciones (innegociable)**: Contacto → Entrega → **Pago (explicado)** → resumen y botón. El bloque de facturación electrónica **se retiró** (ver «Pendiente — facturación electrónica»).

**Componentes**
- *Progreso*: "Paso 2 de 3" (móvil) / migas "Carrito · Datos y pago · SINPE" en Karla 700 / 13 px uppercase (escritorio). Sin barra de progreso decorativa.
- *Campos*: `height:48px`, `border:1px solid #CFCBBD`, fondo `#FFFDF7`, radio 2 px; placeholders `#5C665D`. Escritorio agrupa en grid de 2–3 columnas; móvil en columna única.
- *Entrega*: primero la dirección (provincia, cantón, distrito en escritorio; provincia y cantón en móvil; dirección exacta), **después** la tarjeta de envío `border:1.5px solid #2F5D3F` que la refleja: "Envío GAM a [cantón], [provincia]" Karla 700, sublínea Karla 12–13 px `#5C665D` "Hasta 1 kg. Lo despachamos al confirmar el pago", valor **₡3.350** en Archivo 700 `#1C231E` (fuera del GAM: "Por cotizar"). Al pie de la tarjeta, separada por `border-top:1px solid #E3DFD2`, una fila de 44 px con glifo de chat → "¿Fuera del GAM? Te cotizamos por WhatsApp" (Karla 700 / 13–14 px `#2F5D3F`).
- *Bloque de pago*: tarjeta `border:1.5px solid #2F5D3F` con radio seleccionado, título "SINPE Móvil" Archivo 700 / 17–19 px, etiqueta "Único medio", y **tres pasos numerados** en discos lima de 20 px con número grafito. Dentro, aviso de reserva sobre `#F1EEE2` con icono de reloj.
- *Rebalanceo del escritorio*: con un bloque menos la columna izquierda ya no justifica los 1440 px completos. El contenido del checkout se centra en un ancho de **1060 px** y el grid pasa de `minmax(0,1fr) 420px` a `minmax(0,1fr) 380px`, mismo `gap:36px`. Los tres bloques restantes quedan en medida de lectura razonable en vez de estirarse; el resumen sigue a la derecha.
- *Pasos del pago*: 1 · confirmás y te damos número, monto y referencia → 2 · hacés el SINPE y mandás la captura → 3 · verificamos a mano y lo despachamos.
- *Cierre*: resumen con Subtotal, **"Envío GAM · ₡3.350"** y **"Total"** (Archivo 700 / 26–28 px), botón `height:56px` **"Confirmar pedido"**, microcopy "Todavía no se cobra nada. En la pantalla siguiente te damos los datos del SINPE", y salida secundaria por WhatsApp.

**Decisiones de producto**
- **Sin bloque de facturación electrónica** (setiembre 2026): el negocio no está inscrito ante Hacienda, así que pedir cédula y correo del XML recolectaría datos que nadie puede usar y sumaría el bloque más intimidante del formulario a cambio de nada. El checkout queda en tres bloques.
- **El pago se explica en tres pasos antes del botón**: con SINPE manual la mayor causa de pedidos muertos es la sorpresa de que no hay tarjeta.
- **El botón no dice "Pagar"**: dice "Confirmar pedido", porque el cobro ocurre después, por SINPE.
- **Reserva de 48 h, sin temporizador** (actualizado setiembre 2026): aviso por WhatsApp a las 24 h y cancelación a las 48 h, con fecha y hora exactas. Reemplaza a «reserva sin reloj».
- **El teléfono se pide como canal, no como dato**: "Es el número por el que te confirmamos el pago".
- **Precio de pieza final, sin impuesto que separar**: no se cobra IVA. El monto del SINPE es piezas + envío, el mismo número que Ana carga en el pedido: conciliar sigue siendo comparar dos cifras iguales.
- **Tarifa por destino y peso**: ver «Envío sin umbral».

### 6. Página de gracias = instrucciones de pago (móvil 375 / escritorio 1440)

> **⚠ DEROGADO — monto = piezas + envío y el ejemplo ₡24.750 (Conflicto 1); «Pedido reservado» y «piezas apartadas» (Conflicto 2).** Ver «Revisión 4».

**Purpose**: es la pantalla donde ocurre el pago real, con el cliente saltando entre el sitio y su app bancaria.

**Estado A — falta el pago**
- *Cabecera* `#2F5D3F`: etiqueta "Pedido #1042 reservado" en `#C3DE4E`, titular Archivo 700 / 28 px (móvil) o 52 px (escritorio) → "Falta un paso: hacé el SINPE", bajada crema.
- *Tres tarjetas numeradas*, un dato por tarjeta, valor en Archivo 700 / 32–34 px tabular y botón de copiar propio de 44–48 px: **1 número SINPE** (`#FFFDF7`), **2 monto exacto** (`#FFFDF7`; piezas + envío, con el desglose en la sublínea), **3 referencia** (fondo `#C3DE4E`, borde `#2F5D3F`, botón grafito). En escritorio quedan en grid de 3 columnas.
- *Aviso de reserva* sobre `#F1EEE2` con icono de reloj `#3F4E7A`: reserva de 48 h con fecha y hora exactas, aviso a las 24 h y qué hacer si ya se pagó.
- *"Ya lo pagué"*: dos botones **de igual peso** lado a lado — "Subir captura" (`#2F5D3F`) y "Por WhatsApp" (contorno `1.5px`), 56 px de alto en móvil. Microcopy: el WhatsApp ya va con el número de pedido escrito.
- *Barra fija al pie* `#1C231E`: "Pedido 1042 · pendiente de pago" + `8814 2073 · ₡24.750 · ref 1042` (en el lienzo, `₡24.750` es piezas + envío al GAM hasta 1 kg) en Archivo 700 / 16 px crema, y botón lima "Copiar todo".
- *Escritorio*: añade un QR al mismo pedido (140 px) para seguir en el celular, y columna derecha con detalle del pedido —Subtotal, "Envío GAM", Total por SINPE— y entrega: "Se despacha al confirmar el pago" (el bloque de datos de factura se retiró).

**Estado B — comprobante recibido**
- Cabecera verde con disco lima y check: "Comprobante recibido / Lo estamos verificando", y la promesa de aviso por WhatsApp.
- *Timeline de 4 hitos* (recibido → verificando → **confirmado** → en camino, este último "Te avisamos por WhatsApp cuando sale"; el tercer hito dice solo "Pedido confirmado / Ana lo pasa a confirmado a mano", sin promesa de factura): completado = disco `#2F5D3F` con check crema; en curso = disco con anillo radial de la marca; pendiente = anillo `#CFCBBD` y texto `#5C665D`.
- *Comprobante adjunto*: miniatura 52 px, nombre de archivo, y acción "Cambiar" en `#2F5D3F`.
- *Aviso* sobre `#F1EEE2`: si el monto o la referencia no cuadran, se avisa por WhatsApp antes de tocar el pedido.
- *Salidas*: "Escribirle a Ana" (contorno verde) y "Seguir viendo la tienda" (lima con texto grafito).

**Decisiones de producto**
- **No dice "gracias por tu compra", dice "falta un paso"**: la compra no terminó, y celebrarla produce pedidos que nunca se pagan.
- **Un dato por tarjeta, con su propio botón de copiar**: el cliente hace tres viajes a la app bancaria y cada viaje necesita una sola cosa en el portapapeles.
- **La referencia es el único bloque lima de la pantalla**: es el dato que se olvida y sin el cual el pago queda huérfano.
- **Barra fija con los tres datos y "copiar todo"**: diseñada para el regreso desde el banco; al volver no hay que releer nada.
- **Subida y WhatsApp con el mismo peso** (decisión del cliente): quien vive en WhatsApp usa WhatsApp, quien está en la web sube el archivo; ambas desembocan en el mismo pedido.
- **El estado posterior nombra a una persona**: "Ana revisa los pagos a mano" explica la demora sin disculparse y hace creíble el "no tenés que hacer nada más".
- **El comprobante es reemplazable**: subir la captura equivocada es frecuente; sin "Cambiar" esa corrección se convierte en soporte.

### Pendiente — facturación electrónica

**Estado (setiembre 2026)**: el negocio **no está inscrito ante Hacienda**. Vende de forma ocasional por Instagram y cobra por SINPE Móvil. No emite factura electrónica y **no cobra IVA**: el precio publicado es el monto final.

**Qué se quitó del diseño ya entregado**
- Checkout (sección 09, móvil y escritorio): el bloque completo **«Datos de factura electrónica»** — label, línea explicativa que nombraba a Hacienda, los tres botones segmentados de tipo de identificación (Física / Jurídica / DIMEX), el campo de número de cédula y el checkbox «Mandar el XML al mismo correo de contacto».
- Checkout y carrito: la línea **«IVA incluido»** bajo el subtotal y bajo el total, y la mención de IVA en la tarjeta de monto exacto de la página de gracias.
- Página de gracias (sección 10): el bloque **«Factura electrónica»** de la columna de detalle del pedido en escritorio, y la promesa de factura en el tercer hito del timeline del estado B («confirmado y factura enviada» → **«Pedido confirmado»**).
- Racionales (sección 11) y notas Woo: las decisiones asociadas, reemplazadas por las de esta reversión.

**Dónde vuelve, exactamente**
Entre el bloque **Pago (explicado)** y el **resumen con el botón**, como cuarto y último bloque del formulario — la misma posición que tenía. El orden vuelve a ser: Contacto → Entrega → Pago (explicado) → **Datos de factura electrónica** → resumen y botón. El racional original se mantiene: es el bloque que más asusta, arriba provoca abandono antes de ver el total y plegado genera errores de validación al final. Al reponerlo, el checkout de escritorio vuelve al grid `minmax(0,1fr) 420px` a ancho completo (1440 px con padding 40 px), porque el contenido vuelve a justificarlo.

**Qué campos incluye**

| Campo | Control | Especificación |
|---|---|---|
| Label del grupo | Texto | Karla 700 / 11 px / `letter-spacing:0.12em` / uppercase / `#8A9189` → «Datos de factura electrónica» |
| Línea explicativa | Texto | Karla 400 / 12 px móvil, 13 px escritorio / `#5C665D`. Nombra a Hacienda en una sola línea |
| Tipo de identificación | Tres botones segmentados | `height:44px`, radio 2 px, Archivo 600 / 14 px. Física / Jurídica / DIMEX. Seleccionado: fondo `#2F5D3F`, borde `1.5px`, texto `#F6F3EA`; no seleccionados `border:1px solid #CFCBBD` sobre `#FFFDF7` |
| Número de cédula | Campo | `height:48px`, `border:1px solid #CFCBBD`, fondo `#FFFDF7`, `font-variant-numeric: tabular-nums`, `letter-spacing:0.02em` |
| Correo del XML | Checkbox 15 × 15, radio 2 px, **marcado por defecto** | Fondo `#2F5D3F` con check crema → «Mandar el XML al mismo correo de contacto». Al desmarcar aparece un campo de correo aparte (compra a nombre de empresa o de contador) |

En escritorio los tres botones y el campo de cédula van en un grid `340px minmax(0,1fr)` con `gap:12px`; en móvil, en columna con los botones en fila de `flex:1`.

**Qué más hay que reponer al inscribirse**
- Línea de impuesto bajo subtotal y total, **solo si el precio pasa a incluir IVA**. Si el precio publicado sigue siendo el monto final, la línea es informativa y no cambia ninguna cifra.
- Timeline del estado B: el tercer hito vuelve a «Pedido confirmado y factura enviada», sublínea «El XML llega a tu correo».
- Página de gracias en escritorio: vuelve el bloque «Factura electrónica» en la columna de detalle del pedido.
- Woo: plugin de factura electrónica, impuestos configurados, y los tres campos guardados en el pedido y visibles en el admin junto al comprobante.

**Ningún token cambia.** La reversión es de contenido y de orden, no de sistema: todos los valores de esta tabla ya existen en el diseño entregado y se pueden reponer sin rediseñar el flujo.

### Decisiones pendientes (ningún valor inventado)
- **Cuatro iconos nuevos (copiar, subir, reloj, check)**: **resueltos**; verificados, ajustados a la grilla e incorporados al set (`assets/icons/`). Queda por aprobar la regla del check a 2.5 dentro de discos de ≤ 26 px.
- **Icono de WhatsApp**: resuelto como excepción documentada (glifo oficial, una tinta, solo en acciones que abren un chat). Falta descargar el archivo oficial: `whatsapp-provisional.svg` es un trazo de reserva y no debe publicarse.
- **Peso de cada pieza** y **tarifas de envío con IVA incluido**: ver «Envío sin umbral».
- **Aviso por WhatsApp a las 24 h y cancelación a las 48 h**: resuelto; ver «Cierre de políticas».
- **Monto distinto o parcial, error de subida, cancelación y reintento**: resueltos en «Estados de excepción del flujo de compra» (secciones 13–16). Quedan pendientes solo los plazos allí listados.

### Notas de implementación en WooCommerce
- Carrito y checkout con los **bloques nativos** de Woo, restilizados con los tokens del sistema. No se reescribe el core ni se reordenan campos por PHP.
- **SINPE Móvil como pasarela offline** (patrón de transferencia bancaria): el pedido nace `on-hold`; número, nombre e instrucciones son opciones del método, no texto duro.
- **Sin plugin de facturación electrónica y sin impuestos configurados en Woo**: el precio del producto es el monto final (solo el envío incluye el IVA que cobra Correos); no se agregan campos de cédula ni de correo XML al checkout.
- **Envío**: dos zonas de destino, "GAM" y "Resto del país", con tarifa por peso (primer kg + kg adicional). El origen es siempre Resto del País. Cada producto necesita peso cargado.
- **La página de gracias es `order-received`**, con referencia = número de pedido de Woo. Los botones de copiar usan la API de portapapeles y muestran el estado "copiado" en el propio botón.
- **Subida de comprobante**: adjunto ligado al pedido, con validación de tipo y tamaño, visible y reemplazable en "mi cuenta" mientras el pedido esté pendiente.
- **El paso `on-hold` → `processing` es siempre manual.** Cancelar a las 48 h solo pedidos `on-hold` sin la marca «pago reportado» (los de monto distinto quedan fuera del vencimiento).

---

## Tarjeta de regalo y estados del listado (setiembre 2026)

### 7. "Es un regalo y no sé la talla" — móvil 375 / escritorio 1440
Sección **12** de `Kiwi - Flujo de compra SINPE.dc.html`.

**Purpose**: cumplir la promesa de la tarjeta lima de la home, que hasta ahora no llevaba a ninguna parte.

**Mecanismo elegido: tarjeta de regalo por monto.** La talla no se resuelve, se traslada: quien recibe escoge pieza, talla y color. Se descartó el quiz de estilo (se siente listo y sigue entregando la talla equivocada) y la garantía de cambio como camino principal (deja el problema en manos de la dueña, que ya concilia pagos a mano).

**Tres pasos, una sola página**
1. **Monto** — tres botones (₡10.000 / ₡15.000 / ₡25.000) más "otro monto" punteado, para que se lea como escape y no como opción principal. ₡15.000 preseleccionado por frecuencia; ₡25.000 **sin anotación** (llevaba "Envío gratis", que ya no existe).
2. **Para quién** — nombre (requerido) y mensaje corto (opcional, 90 caracteres). Entrega: "a mi correo, la entrego yo" **por defecto** —con pago manual la tarjeta no puede salir antes de conciliar, y quien la entrega en persona no depende de eso— o "al correo de ella", que se envía al confirmar el SINPE.
3. **Pago** — mismo checkout SINPE de la sección 09, con la misma frase "todavía no se cobra nada". Sin envío: la tarjeta es digital.

Salida por WhatsApp presente pero secundaria, con el mismo peso visual que en carrito y checkout.

**Implementación en Woo**: producto de tarjeta de regalo con monto variable; el código se emite como cupón de un uso al pasar el pedido a `processing` (siempre manual). El PDF/correo se dispara desde ese cambio de estado, nunca desde `on-hold`.

**Pendientes de esta sección**
- **Vigencia de la tarjeta** — ¿vence? El diseño no lo afirma.
- **Saldo remanente** — si la compra cuesta menos que la tarjeta, ¿queda saldo a favor o se pierde? Es política comercial.
- **Icono de regalo** — no existe en el set cerrado. La sección usa el aro radial y tipografía en su lugar.

### 8. Estados del listado — escritorio 1440
Dentro de la sección **07** de `Kiwi - Evolución de identidad.dc.html`.

- **Cargando**: skeletons en **#E3DFD2** sobre crema. Mismo esqueleto que el resultado real —sidebar, encabezado y cuatro cards— para que nada cambie de lugar cuando llega el dato. Sin spinner.
- **Sin resultados tras filtrar**: la salida no es "intentá otra cosa" sino el nombre del filtro que sobra. Titular que declara el conflicto ("Ningún arete lima cuesta menos de ₡8.000"), el conteo de lo que aparecería sin ese filtro, botón primario **"Quitar el filtro de precio"** y secundario "Limpiar todos los filtros". El chip del filtro culpable y su control en el sidebar se marcan en Guayaba; los demás quedan neutros. Panel lateral con salida a WhatsApp para pedidos puntuales.
- **Error de carga**: borde Guayaba una sola vez, texto en grafito. "No pudimos cargar las piezas" + "tus filtros y tu carrito siguen guardados". Primario "Volver a cargar", secundario WhatsApp. El error no es culpa del cliente y no se le grita en rojo.

### Ajuste a la sección 07 ya diseñada
> **⚠ DEROGADO en la revisión 5 — el grupo «Disponibilidad · Solo disponible ahora», la línea «Disponible»/«Agotado» de la card y la decisión de mostrar lo agotado en vez de esconderlo.** Ver «Revisión 5».

- **Se eliminó el filtro "Llega mañana"**: no hay dato de SLA que lo sostenga. El grupo "Entrega" del sidebar se reemplazó por **"Disponibilidad · Solo disponible ahora"** (dato de inventario que Woo ya tiene) y la columna se cerró con un enlace "Limpiar filtros", que además es la salida del estado sin resultados.
- **Conteo del encabezado**: "42 piezas" (antes "42 piezas · 38 llegan mañana").
- **Línea de estado de la card**: pasa de entrega a disponibilidad. **"Disponible"** en Azul #3F4E7A y **"Agotado"** en Verde apagado #5C665D. Se descartó "Vuelve el 20 set" porque no hay fecha de reposición cargada en Woo. Agotado nunca en Guayaba: no es un error. La regla se mantiene: la card declara disponibilidad, nunca estrellas ni reseñas.
- **Copy del hero**: se quitó "y llega mañana" por la misma razón. La barra superior no promete plazo de entrega (ver «Envío sin umbral»).
- Si más adelante la dueña carga fecha de reposición por producto, la línea "Vuelve el DD mes" vuelve a ser posible en el mismo lugar y con el mismo Verde apagado.

---

## Envío sin umbral · tarifa por destino y peso (setiembre 2026, revisión 3)

> **⚠ DEROGADO — en lo que toca a tarifas, zonas, IVA del envío y montos de envío en cualquier pantalla (Conflicto 1). Sigue vigente: no hay envío gratis ni contador de umbral.** Ver «Revisión 4».

> **⚠ DEROGADO en la revisión 5 — la tarifa por zona y peso: el envío es plano, ₡3.000 por pedido.** Ver «Revisión 5».

**Estado**: Kiwi **no ofrece envío gratis**. Todo pedido paga envío, sin umbral mínimo. Se envía por Correos de Costa Rica (EMS Nacional) con origen Resto del País. Tarifa base sin IVA: **GAM** ₡2.964,60 el primer kg + ₡1.371,68 cada kg adicional; **Resto del País** ₡4.250,06 + ₡1.548,67. Se suma **IVA 13%** porque Correos lo cobra, y al cliente se le muestra con IVA incluido: **GAM ₡3.350 + ₡1.550**; **Resto del País ₡4.250 + ₡1.750**. No hay cotización por WhatsApp ni estado "Te cotizamos el envío". Un vestido pesa 200–300 g: hasta 3 caben en el primer kg. El plazo de entrega lo define Correos (no se promete plazo). El lienzo asume un pedido de hasta 1 kg (GAM ₡3.350, total ₡24.750).

Ningún token cambió. Todo reutiliza componentes ya entregados (fila de resumen, tarjeta de entrega seleccionada, aviso con reloj, glifo de chat).

### Qué cambió, por sección

| Sección | Antes | Ahora |
|---|---|---|
| Barra superior (home, listado, carrito) | "Envío gratis arriba de ₡25.000 · …" | "Envíos a todo el país · pago por SINPE Móvil" |
| 01 · Ficha, sello bajo el botón | "Envío gratis · llega en 24–48 h al GAM" | "Envíos a todo el país" |
| 01 · Ficha, fila de confianza | "Pago seguro SINPE / tarjeta" (falso: no hay tarjeta) | "Pago por SINPE Móvil" |
| 07 · Franja de garantías (2.6) | "Envío gratis +₡25.000" | "Envíos a todo el país" (misma grid de 4, mismo icono) |
| 06 · Cartel A2 | "Envío gratis en todo el GAM / …" | "Envíos a todo el país / Tarifa según destino y peso, visible antes de pagar." |
| 06 · Story | "Llega antes del viernes" (sin plazo que lo sostenga) | "A todo el país" |
| 08 · Carrito | Contador "Te faltan ₡3.600" + barra | Bloque eliminado; línea **Envío GAM · ₡3.350** antes del **Total ₡24.750** |
| 09 · Checkout | Tarjeta "Envío al GAM · ₡0" | Tarjeta "Envío GAM a [distrito], [cantón], [provincia] · ₡3.350", fila "¿Dudas con el envío? Preguntanos por WhatsApp"; resumen con línea de envío y total; botón "Confirmar pedido" |
| 10 · Gracias | Monto ₡21.400 | GAM: directo a los datos SINPE, monto = piezas + ₡3.350, "Se despacha al confirmar el pago". Un solo estado de pago: el envío se calcula en el checkout |
| 12 · Tarjeta de regalo | ₡25.000 anotado "Envío gratis" | ₡25.000 sin anotación |

### Decisiones de producto
- **Barra superior: alcance y pago.** Ambos son verdaderos en todo pedido y cada uno responde una duda distinta: cuándo llega, cómo se paga (no hay tarjeta), si llega a donde vivo. Nada promocional.
- **Garantías: la celda de envío pasa a alcance.** "Envíos a todo el país" es verificable. No se publica plazo de entrega porque no hay uno garantizado.
- **El contador se cierra, sin reemplazo.** Su función era subir el ticket con un premio por monto. Cualquier sustituto (descuento, regalo por monto) es una política comercial que nadie definió; inventarla repite el error que motivó este cambio. El envío se cobra por peso, no por pedido, así que "un solo envío" no es un argumento válido.
- **El envío es una línea con monto, antes del total, desde el carrito.** El total ya lo incluye: el cliente del GAM ve el costo real antes del checkout. La nota bajo la línea aclara que es un estimado al GAM hasta 1 kg.
- **La tarjeta de envío del checkout refleja la dirección.** GAM ₡3.350 y Resto del País ₡4.250 (hasta 1 kg); cada kg adicional se suma.
- **El botón vuelve a "Confirmar pedido"**: no hay cotización intermedia en ningún destino.

### Pendientes (ningún valor inventado)
- **Peso de cada producto**: cargarlo en Woo para calcular el kg adicional (vestidos: 200–300 g).
- **GAM (cantones incluidos, para la zona en Woo)**: San José: San José, Escazú, Desamparados, Aserrí, Mora, Goicoechea, Santa Ana, Alajuelita, Vázquez de Coronado, Tibás, Moravia, Montes de Oca, Curridabat. Alajuela: Alajuela, Atenas, Poás. Cartago: Cartago, Paraíso, La Unión, Alvarado, Oreamuno, El Guarco. Heredia: Heredia, Barva, Santo Domingo, Santa Bárbara, San Rafael, San Isidro, Belén, Flores, San Pablo.
- **Páginas de ayuda** (`Kiwi-paginas-de-ayuda.dc.html`): guía de tallas (panel), cambios y devoluciones, envíos. Pendiente: reglas del cambio (quién paga el envío, devolución de dinero).
- **Woo**: zonas "GAM" y "Resto del país" con tarifa por peso (primer kg + kg adicional), sin método "Envío por cotizar".


---

## Estados de excepción del flujo de compra (setiembre 2026)

Archivo de referencia: `Kiwi-estados-excepcion.dc.html` (secciones **13–16**). Lienzo de 1640 px, cada estado en móvil 375 y escritorio 1440. **Ningún token nuevo**: colores, Archivo/Karla, escala de 4 px, radio de 2 px e iconos (copiar, subir, reloj, check, chat, candado, ya aprobados en el flujo) son los entregados. Todos los componentes se reutilizan: encabezado de bloque, tarjetas de dato, tarjeta lima, timeline, aviso con reloj, fila de comprobante, botones de 56/48 px.

**Contexto**: SINPE manual, sin reversa automática. Todo lo resuelve una persona (Ana) por WhatsApp. Por eso ninguna pantalla promete automatismos ni plazos que no estén decididos.

**Políticas aplicadas**
- Monto menor al total: **se pide la diferencia** y el pedido sigue reservado.
- Monto mayor: **se devuelve el excedente por SINPE manual**.
- Devolución de dinero: **siempre**, una vez que se confirme lo sucedido. No se muestra ningún número de días (ver pendientes).

**Reglas de sistema para estos estados**
- Guayaba `#C0523A` se usa **una sola vez por pantalla** y solo como anillo o borde, nunca como titular ni banner. Ningún estado es un «error en rojo».
- Encabezado neutro `#F1EEE2` cuando algo se cancela o falta plata; verde `#2F5D3F` cuando el pedido está a salvo. Nunca celebración.
- El tiempo se expresa en fechas y en relativo («hace 2 días»), nunca como cuenta regresiva: en pago manual no hay reloj.

### 9. Error al subir el comprobante — móvil 375 / escritorio 1440

**Purpose**: el cliente ya transfirió; el archivo no llegó. Distinguir «el pago está hecho» de «el archivo no subió» y dejar siempre una salida.

**Casos**: archivo muy pesado, formato no admitido, conexión cortada a mitad de subida (móvil los muestra los tres; escritorio muestra el de conexión, los otros cambian solo el texto).

**Layout**: encabezado verde → tarjeta «Dónde estamos» con dos filas → fila del archivo → aviso de ayuda → botones.
- *Encabezado*: etiqueta lima «Pedido #1042 · SINPE hecho»; titular Archivo 700 / 28 px «Tu pago está hecho. El archivo no subió.»; bajada con la causa.
- *Tarjeta «Dónde estamos»*: fila 1 disco verde con check «SINPE enviado desde tu app · ₡24.750 · referencia 1042»; fila 2 anillo `#C0523A` de 2 px «Comprobante · No subió».
- *Fila del archivo*: miniatura 52 px, nombre, causa en Karla 12 px; en la conexión cortada, barra de 4 px (riel `#CFCBBD`, tramo `#2F5D3F`) detenida en 60 %.
- *Aviso*: bloque `#F1EEE2` con icono de reloj y una sola acción concreta por causa.
- *Botones*: primario 56 px («Elegir otro archivo» / «Reintentar subida») y secundario 48 px «Mandar por WhatsApp».

**Decisiones de producto**
- **Dos filas de estado, no una**: pago y archivo son cosas distintas y se ven distintas.
- **El titular afirma el pago**: nunca «falló», «error» ni «no se procesó». Quien ya transfirió lo lee como plata perdida.
- **Una causa, una línea, una salida**: pesado → usar captura en vez de foto; formato → imagen o PDF; conexión → el archivo sigue elegido. Sin códigos de error.
- **Reintentar es primario; WhatsApp siempre presente**, con el número de pedido ya escrito. Reintentar no duplica nada.
- **La barra cortada evita adivinar**: se dice que no sabemos si llegó y se pide repetir.

**Woo**: validación de tipo y tamaño en cliente y servidor. Un fallo de subida no cambia el estado (sigue `on-hold`); se deja nota interna del intento.

### 10. Pedido cancelado por la dueña — móvil 375 / escritorio 1440

> **⚠ DEROGADO en la revisión 5 — el caso (b) completo y «liberar stock»; queda solo (a), nunca se pagó.** Ver «Revisión 5».

> **⚠ DEROGADO — el caso (b) «Tu pieza se agotó: te devolvemos todo» con pieza + envío, «liberar stock» y la nota «el stock ya no está apartado».** Ver «Revisión 4».

**Purpose**: dos causas que no se pueden mostrar igual.

**(a) Nunca se pagó** — encabezado `#F1EEE2`, titular «Cancelamos tu pedido: no recibimos el pago», bajada «No se te cobró nada». Timeline con fechas reales (pedido hecho → aviso por WhatsApp → cancelado). Aviso «¿Pagaste y no lo vimos?» hacia WhatsApp. Botón primario «Volver a pedir estas piezas» (restaura el carrito) y secundario «Escribirle a Ana»; nota de que el stock ya no está apartado.

**(b) Se pagó, sin producto** — encabezado `#F1EEE2`, titular «Tu pieza se agotó: te devolvemos todo». Tres tarjetas: **Te devolvemos** ₡15.850 (lima; pieza + envío), **Cómo** «SINPE manual» al número que pagó, **Cuándo** «Te avisamos el día». Timeline de dinero: pago recibido → pieza sin disponibilidad → **Ana confirma lo sucedido y te devuelve** (en curso, manual) → devolución hecha. Aviso sobre cambio de número de SINPE. Primario «Escribirle a Ana», secundario lima «Seguir viendo la tienda».

**Decisiones de producto**
- **Neutro, no verde ni guayaba**: verde celebra, guayaba grita.
- **(a) Salida para quien sí pagó**: evita tratar un pago real como impago.
- **(b) Lo primero es el dinero**: monto exacto, canal y momento.
- **(b) El «cuándo» no promete número**: depende de que se confirme lo sucedido y el paso en curso es manual y nombra a una persona.
- **(b) La culpa se asume**: «error de nuestro lado, no tuyo». Sin excusas ni compensaciones inventadas.

**Woo**: (a) `cancelled` sin reembolso, liberar stock. (b) `cancelled` + reembolso manual registrado en Woo con nota interna. Ambas las dispara la dueña; desactivar cron de cancelación automática. Un correo distinto por causa.

### 11. Reintento de pago — móvil 375 (desde el correo) / escritorio 1440 (desde «Mi cuenta»)

> **⚠ DEROGADO — «Sigue apartado» y «piezas apartadas» (Conflicto 2); el monto con envío (Conflicto 1).** Ver «Revisión 4».

**Purpose**: recuperar número, monto y referencia sin pasar por el checkout.

**Qué cambió respecto a la página de gracias original**
- Sin encabezado verde ni «Falta un paso»: encabezado crema con borde inferior, titular «Hecho hace 2 días. Sigue apartado.»
- Los tres datos se mantienen pero **compactos**: una fila por dato con botón de copiar de 44 px solo con icono; la referencia sigue siendo la única en lima.
- **Tiempo transcurrido**: relativo en el titular, exacto en la bajada («vie 27 set, 6:15 p.m.»). Nunca cuenta regresiva.
- Aviso «Ana te escribió el sábado 28 set» como evento real, con qué pasa si se atrasa (sin plazo).
- Confirma que nada cambió: piezas apartadas, monto igual.
- Escritorio: migas «Mi cuenta · Pedidos · #1042» y resumen del pedido a la derecha.

**Acciones**: «Ya pagué: subir captura» (primario) y «Por WhatsApp» (contorno). **No hay «Cancelar pedido»**: falta política.

**Woo**: vista de pedido `on-hold` (`view-order` / `order-received` con order key) con los datos del método offline. El enlace del correo no exige login.

### 12. Monto distinto al esperado — móvil 375 / escritorio 1440

> **⚠ DEROGADO — las cifras ₡24.750 / ₡4.750 / ₡26.000 / ₡1.250 (ahora sobre ₡21.400) y «sigue reservado».** Ver «Revisión 4».

**Purpose**: qué ve el cliente cuando la conciliación no cuadra.

**Transfirió de menos (₡20.000 de ₡24.750)** — encabezado `#F1EEE2`, titular «Nos llegaron ₡20.000 de ₡24.750». Tarjetas: **Ya recibimos** ₡20.000, **Falta transferir** ₡4.750 (lima, «Copiar monto»), **Referencia** 1042 (la misma). Timeline: recibido → falta la diferencia (en curso) → pedido confirmado. Botones «Subir comprobante de la diferencia» y «Por WhatsApp».

**Transfirió de más (₡26.000 de ₡24.750)** — encabezado verde, titular «Nos llegó de más: ₡1.250». Tarjetas: **Pedido confirmado** ₡24.750, **Te devolvemos** ₡1.250 (lima), **Cuándo** «Te avisamos el día». Timeline: pago recibido → pedido confirmado («la devolución no lo demora») → devolución del excedente (en curso) → hecha.

**Decisiones de producto**
- **Tres cifras siempre, en el mismo orden**: total, recibido, diferencia; tabulares.
- **Menor**: solo se pide lo que falta y con la misma referencia; no se paga el total otra vez. Tono «nos llegaron», no «te equivocaste».
- **Mayor**: el pedido se confirma y se despacha; el excedente se devuelve por SINPE manual y no lo demora.
- **Verde vs neutro** distingue de un vistazo si el pedido está a salvo (mayor) o incompleto (menor).

**Woo**: la conciliación manual guarda el monto recibido en una nota. Menor: sigue `on-hold`. Mayor: pasa a `processing` y se registra un reembolso parcial manual por el excedente.

### Decisiones pendientes de estos estados (ningún valor inventado)
- **Plazo del aviso por WhatsApp** a un pedido sin pagar (24 h / 48 h) y qué ocurre al vencer.
- **Días para devolver el dinero** (cancelación con pago y excedente). Las pantallas dicen «Te avisamos el día» hasta que se defina.
- **Tamaño máximo y formatos exactos del comprobante**: los diseños no muestran números.
- **Plazo para completar una diferencia** antes de liberar las piezas.
- **Pedido de varias piezas donde solo una se agota**: ¿se despacha el resto o se devuelve todo? El diseño solo cubre devolución total.
- **Cancelación por parte del cliente**: sin política, no hay botón.
- **Icono de alerta**: no existe en el set cerrado; no se usó.


---

## Assets de producción (setiembre 2026)

Cierre del sistema de identidad: logo en SVG, set de iconos y WhatsApp. Ningún token nuevo: mismos colores, mismos trazos y grilla.

### 17. Logo en SVG — `assets/logo/`

| Archivo | viewBox | Uso |
|---|---|---|
| `kiwi-emblema.svg` | `0 0 100 100` | Emblema a color (aro `#2F5D3F`, punto `#C3DE4E`). Mínimo 32 px. |
| `kiwi-lockup-horizontal.svg` | `0 0 406 140` | Header web. Mostrar entre 36 y 48 px de alto. |
| `kiwi-monocromo-positivo.svg` | `0 0 406 140` | Una tinta `#1C231E` sobre fondo claro. |
| `kiwi-monocromo-negativo.svg` | `0 0 406 140` | Una tinta `#F6F3EA` sobre grafito. |
| `kiwi-emblema-reduccion.svg` | `0 0 100 100` | Para ≤ 24 px: aro 0.2em, radios de 8°, punto de 13. |

**Construcción** (cuadrícula de 100): aro exterior r 50 e interior r 33 (0.17em); ocho radios de 6° centrados cada 45°, de r 16.5 hasta el aro; punto lima r 15. Aro y radios son una sola ruta (la parte interior del aro se dibuja en sentido contrario para vaciarse); el punto es un círculo. La reducción sube el aro a 20, los radios a 8° y baja el punto a 13.
**Lockup**: emblema a escala 1.4 (140 de alto), separación de 42, wordmark con 70 de altura de mayúscula. En los monocromos, todo es una sola ruta con el punto incluido.
**Sin dependencias**: sin fuentes, sin gradientes, sin máscaras, sin capas. Cada archivo lleva un `<title>`.

**Decisiones de producto**
- **Un solo umbral de reducción**: bajo 32 px se usa el archivo de reducción, no el estándar escalado.
- **El monocromo conserva el punto** en la misma tinta; queda separado del radio por un hueco de 1.5 unidades.
- **Sobre foto**: se deriva del emblema cambiando el color del aro a `#F6F3EA` y usando la variante de reducción.

**Pendiente**: el wordmark es una construcción geométrica de trazo uniforme, no el contorno de Archivo 700. Si se exige fidelidad exacta, exportar «KIWI» desde Archivo 700 con tracking 0.02em, convertir a contornos y reemplazar esa parte de la ruta.

### 18. Set de iconos — `assets/icons/`

Especificación: `viewBox 0 0 24 24`, trazo **1.75**, terminaciones **rectas**, uniones en inglete, **sin relleno**, un solo color mediante `currentColor`. Área activa entre 2 y 22.

| Archivo | Origen | Notas |
|---|---|---|
| `carrito`, `envio`, `guia-de-tallas`, `devolucion`, `favoritos`, `pago-seguro` | Set base | Sin cambios. `favoritos` sigue siendo el destello de ocho radios. |
| `copiar` | Nuevo | Dos láminas de 13 px, ocupa 2.5–21.5 |
| `subir` | Nuevo | Flecha y bandeja abierta, ocupa 2.5–21.5 |
| `reloj` | Nuevo | Círculo r 9.5 y manecillas |
| `check` | Nuevo | Una ruta de 3.5 a 20.5 |
| `whatsapp-provisional` | Excepción | Ver más abajo. Reemplazar antes de publicar. |

**Verificación de los cuatro nuevos**: en el lienzo original los cuatro cumplían trazo, terminaciones y ausencia de relleno, pero estaban **subdimensionados** (ocupaban 14–16 px de 24 frente a los ~20 del set base; el reloj era el más chico). Se redibujaron a la misma escala sin cambiar su forma.
**A confirmar**: «esquinas 2». Los seis del set base tienen esquinas vivas (sin redondeo) y los nuevos hacen igual. Si el «2» significaba un radio de 2, hay que redibujar el set completo.
**Decisión pendiente**: dentro de los discos de 20–26 px del timeline, el check se dibuja a trazo 2.5 porque a 1.75 se pierde. Es una regla de tamaño (como la reducción del logo), no un token nuevo, pero necesita aprobación.

### 19. Icono de WhatsApp — excepción documentada

**Problema**: el sistema prohíbe logos de terceros y el lienzo usaba un glifo de chat genérico. WhatsApp es el segundo canal de venta y un glifo genérico no se lee como tal.

| Vía | A favor | En contra | Decisión |
|---|---|---|---|
| A · Mantener el genérico | Sin riesgo de marca y coherente | No se lee como WhatsApp | Descartada |
| **B · Marca oficial como excepción** | Se reconoce a un vistazo | Rompe «sin relleno» y «logos de terceros» | **Recomendada** |
| C · Dibujar uno propio en trazo | Coherente con el set | La forma reconocible es la marca; redibujarla es alterarla | Descartada |

**Regla de la excepción**
1. Solo identifica el canal: va en acciones que abren una conversación de WhatsApp («Por WhatsApp», «Preguntar por WhatsApp», «Escribirle a Ana»). Nunca decorativo, nunca en la franja de garantías.
2. Una tinta (grafito, verde Kiwi o crema según el fondo). No se usa el verde de WhatsApp: competiría con el botón de compra.
3. Sin modificar: se usa el archivo oficial del centro de recursos de marca de Meta, no un redibujo.
4. Es la **única** excepción a «sin relleno» y a «sin logos de terceros». Ningún otro icono de terceros entra al set.
5. Siempre acompañado de texto en el botón.

**Pendiente**: no se pudo descargar el glifo oficial desde este entorno. `whatsapp-provisional.svg` es un trazo de reserva para que los mockups rendericen; reemplazarlo por el archivo oficial y confirmar los términos vigentes de Meta antes de lanzar.

### Fotografía de producto

Las fotos de los vestidos las entrega el proveedor ya hechas. **No hay guía de fotografía propia**: se retiró del handoff. Las fotos del proveedor reemplazan los placeholders rayados de los lienzos.


---

## Cierre de políticas (setiembre 2026)

> **⚠ DEROGADO — la política A1 como «reserva» de 48 h y los dos conflictos que la acompañan; A3 «el envío se recalcula».** Ver «Revisión 4».

Actualiza los estados de excepción y el flujo de compra. Lienzo: `Kiwi-estados-excepcion.dc.html`. Ningún token nuevo. **Reemplaza** lo dicho antes sobre «reserva sin reloj», «te avisamos el día» y los plazos pendientes.

| Política | Definición | Dónde se ve |
|---|---|---|
| A1 Pedido sin pago | Aviso por WhatsApp a las 24 h («se cancela si no hay pago en 24 h»); cancelación a las 48 h | Checkout, gracias, reintento, cancelado (a) |
| A2 Devolución | De 24 a 48 h, por SINPE manual | Cancelado (b) y (c), excedente |
| A3 Parcialmente agotado | Se despacha lo disponible y se devuelve solo lo agotado | Cancelado (c), nuevo |
| A4 Cancelación del cliente | Sin botón; se consulta por WhatsApp y la dueña decide | Bloque de ayuda en reintento |
| A5 Monto distinto | Se ajusta por WhatsApp; sin plazo límite ni liberación automática | Monto distinto |
| A6 Comprobante | JPG, PNG o PDF, hasta 10 MB | Error de subida, gracias |

### Dos conflictos que estas políticas crean
1. **«Reserva sin reloj» frente a 48 h.** El checkout, la página de gracias y el reintento decían que no había reloj. Resolución: se dice la verdad. Reservado 48 h, vencimiento con **fecha y hora exactas** («Reservado hasta el dom 29 set, 6:15 p.m.»), sin temporizador vivo. El reintento ya no puede decir «hace 2 días»: ahora muestra «hace 1 día».
2. **El reloj frente a un pago ya hecho.** Un pedido pagado puede parecer «sin pago»: comprobante en verificación, archivo que falló tras transferir, o monto distinto. Resolución: el reloj corre solo en «pendiente sin pago reportado». Se detiene cuando el cliente reporta el pago (subir el comprobante, aunque falle el intento, o escribir por WhatsApp) y nunca corre en monto distinto. Desde ahí cancela solo una persona. **Confirmado**: reportar el pago detiene el reloj.

### A3. Parcialmente agotado (nuevo caso c)
Encabezado verde «Despachamos tu collar; el aro se agotó». Tres tarjetas, tres preguntas: **Recibís** (Collar Bruma, ₡8.900 + envío ₡3.350), **No recibís** (Aro Marina, agotado, ₡12.500) y **Te devolvemos** ₡12.500 (lima, «solo lo agotado, de 24 a 48 h por SINPE manual»). Los ₡24.750 se reparten a la vista. **El envío se recalcula según lo que se envía**: aquí el collar entra en el primer kg y sigue en ₡3.350; si bajara de tarifa, esa diferencia se suma a lo que vuelve. Se dice en la pantalla. Woo: pedido a `processing`, línea agotada quitada, envío recalculado y reembolso parcial manual por la línea y la diferencia de envío.

### A4. Cancelación sin invitar a cancelar
No hay botón «Cancelar». Se comunica como **ayuda general al pie de la vista de pedido pendiente**: «¿Algo del pedido no está bien? Dirección, talla o cualquier duda: escribile a Ana con el número #1042. Ella te dice si todavía se puede cambiar.» Enlace de 44 px «Escribirle a Ana por WhatsApp». Decisiones: nunca la palabra cancelar, nunca cerca del botón de pago ni en el resumen, y la misma frase en el correo de confirmación y en Cambios y devoluciones.

### A5. Monto distinto
Menor: «Tu pedido sigue reservado y no vence. Ana te escribe por WhatsApp para ajustar la diferencia.» Tarjeta «Sin plazo límite»; el dato a transferir sigue visible con la misma referencia. Mayor: pedido confirmado y excedente devuelto en 24–48 h. Es una excepción consciente a las 48 h. Woo: marca «monto distinto», excluida del vencimiento.

### A6. Comprobante: JPG, PNG o PDF, hasta 10 MB
- **Formatos**: capturas de iPhone y Android salen en PNG o JPG; las apps bancarias comparten PDF. Con esos tres se cubre casi todo.
- **10 MB**: una captura pesa de 0,3 a 3 MB, una foto de 12 MP de 3 a 6 MB y una de 48 MP hasta unos 10 MB. Cubre esos casos y no deja pasar videos.
- **HEIC, WebP y GIF quedan fuera**: Ana no puede abrirlos de forma fiable. Con el selector restringido a JPG/PNG/PDF, el iPhone convierte HEIC a JPG solo.
- **Un archivo, reemplazable.** El error dice el límite y la salida («14 MB · el máximo es 10 MB» y usar una captura). Mejor que rechazar: reducir la imagen a 2000 px en el navegador antes de subir.
- **Woo**: subir `upload_max_filesize` y `post_max_size` a 12 MB o más (muchos hostings traen 2 MB); `accept="image/jpeg,image/png,application/pdf"`; validar el tipo real (MIME) en el servidor.
- **Por aprobar**: estos valores son una propuesta.

### Pendientes que quedan
Solo queda por aprobar 10 MB y JPG/PNG/PDF para el comprobante (A6). Cerrados: las 24–48 h de devolución cuentan desde que se confirma lo sucedido; el envío de un despacho parcial se recalcula según lo que se envía; reportar el pago detiene el reloj.

---

> **⚠ Revisión 4 derogada casi por completo por la revisión 5**: los dos cobros SINPE, el Conflicto 2 (stock sin reserva) y todo lo que dependía de ellos. Se mantiene solo la vigencia de 48 h como limpieza de pedidos sin pago.

## Revisión 4 — Conflictos 1 y 2 (setiembre 2026)

Archivos: `Kiwi - Flujo de compra SINPE.dc.html` (secciones **13** y **14**, más carrito, checkout y gracias ya actualizados), `Kiwi - Estados de excepcion.dc.html`, `Kiwi - Paginas de ayuda.dc.html` y `Kiwi - Evolución de identidad.dc.html` (barra superior, sello de envío, garantías, ficha, afiche). **Ningún token nuevo.**

### Qué queda derogado de la revisión 3

| Sección de la revisión 3 | Estado | Reemplazo |
|---|---|---|
| Envío sin umbral · tarifas GAM / Resto del país, IVA 13%, «hasta 1 kg» | **Derogada** | Sin tarifa en el sitio. Correos factura por peso y se sabe al entregar el paquete. |
| 4 · Carrito: línea «Envío GAM · ₡3.350», total con envío, nota de estimado | **Derogada** | «Envío · Se cobra aparte» + porqué; total rotulado «Pagás hoy». |
| 5 · Checkout: tarjeta de envío con tarifa por destino | **Derogada** | «Envío por Correos a [dirección]» con valor «Aparte». |
| 5 / 6 · Resumen y total «piezas + envío» (₡24.750), botón «Copiar monto» con envío | **Derogada** | SINPE 1 = solo piezas (₡21.400). Envío = SINPE 2 con recibo. |
| 6 · «Un solo estado de pago» | **Derogada** | Tarjeta «qué se pagó / qué falta / qué espera». |
| 4 · «Reservadas mientras terminás»; 5 · «Reserva de 48 h»; 6 · «Pedido reservado», «piezas apartadas», aviso de reserva | **Derogadas** | Pedido abierto 48 h, sin stock apartado. |
| 11 · «Sigue apartado», «Hecho hace 1 día. Sigue apartado.» | **Derogadas** | «Sigue abierto». |
| 10 (a) «el stock ya no está apartado», Woo «liberar stock» | **Derogadas** | No hay stock que liberar. |
| 10 (b) «Tu pieza se agotó» (devolución pieza + envío) | **Derogada** | «Tu pieza se vendió a otro pedido»; devuelve solo la pieza. |
| A3 «el envío se recalcula según lo que se envía» | **Derogada** | El envío se cobra después, por el paquete real. |
| Cierre de políticas A1 como reserva; «Conflicto 1 · reserva sin reloj frente a 48 h» y «Conflicto 2 · reloj frente a pago hecho» | **Derogadas en su parte de stock** | El plazo de 48 h sigue, pero solo limpia pedidos muertos. El reloj se detiene al reportar el pago, igual que antes. |
| Páginas de ayuda B3: tabla de tarifas, peso por pieza, lista de cantones del GAM | **Derogadas** | «Por qué se cobra aparte» y «Cómo pagás el envío». |
| Afiche A2 «Tarifa según destino y peso, visible antes de pagar»; barra «Envíos a todo el país · pago por SINPE Móvil»; garantía «Envíos a todo el país» | **Derogados** | Barra «Envíos por Correos · el envío se paga aparte»; garantía «Envío al costo de Correos»; afiche «Por Correos de Costa Rica. El envío se paga aparte, con el recibo.» |
| Datos requeridos: tarifas por destino y peso de cada pieza; zonas Woo «GAM» / «Resto del país» | **Derogados** | Un método «Correos de Costa Rica — se cobra aparte» a ₡0. El peso queda opcional. |

**Siguen vigentes**: sin envío gratis ni contador de umbral; SINPE como único medio; precio final sin IVA; conciliación manual; aviso a 24 h y cancelación a 48 h (ahora solo como limpieza); devolución de 24 a 48 h; despacho parcial; monto distinto sin plazo; comprobante JPG/PNG/PDF hasta 10 MB.

### Conflicto 1 — el envío no tiene precio antes de pagar

**Decisión: dos cobros.** Las piezas se pagan al confirmar; el envío, en un segundo SINPE cuando Correos emite el recibo.

- *Por qué no un cobro diferido*: el pedido viviría sin dinero durante el pesaje y el envío, el cliente no sabría su total, y dos pedidos competirían por la misma pieza sin pago de por medio (ver Conflicto 2).
- *Cada pago es una cifra exacta*: SINPE 1 = piezas, referencia `1042`. SINPE 2 = monto del recibo, referencia `1042-E`. Ana concilia dos cifras iguales, nunca suma algo que no existe.
- *Sin costo sorpresa*: el carrito dice «Se cobra aparte» y por qué (Correos cobra por peso y lo informa al recibir el paquete). Se repite en la tarjeta del checkout y en el paso 3 del pago. **Nunca un monto hipotético**: ni «desde», ni «hasta 1 kg», ni estimado.
- *Qué se pagó, qué falta, qué espera*: tarjeta de tres renglones con estados **Pagado** (check verde), **Por pagar** (anillo lima), **En espera** (anillo punteado, monto «Por definir») y **Vencido** (anillo Guayaba, una vez por pantalla). Viaja por gracias y por los estados nuevos.
- *Estados nuevos (sección 13)*: N1 piezas pagadas, envío en espera · N2 envío listo para pagar (recibo de Correos, tres datos, referencia `1042-E`) · N3 todo pagado · N4 recordatorio del envío sin pagar · mensaje de WhatsApp con el recibo.
- *Barra superior y garantías*: «Envíos por Correos · el envío se paga aparte»; celda de garantías «Envío al costo de Correos».
- *Woo*: método de envío único «Correos de Costa Rica — se cobra aparte» a ₡0. Al entregar el paquete, Ana agrega al pedido una tarifa con el monto del recibo y se genera la solicitud del SINPE 2.

**Riesgo aceptado**: Kiwi adelanta el envío en la oficina de Correos antes de cobrarlo.

### Conflicto 2 — el stock ya no se reserva

**Escenario**: dos personas pagan la misma pieza única. Ana lo descubre al conciliar, con el dinero de ambas recibido.

- *Quién se queda la pieza*: **decide Ana**. El sitio no publica el criterio (ni hora del pedido ni hora del SINPE) y nunca dice «primero en pagar».
- *Qué ve la segunda persona, y cuándo*:
  - **Antes del dinero, solo si es verdad**: si Woo tiene un pedido `on-hold` sobre la pieza, el carrito y el checkout muestran «Otra persona ya pidió esta pieza y su pago está pendiente. Podés pedirla igual: si su pedido se confirma primero, te devolvemos todo lo que pagaste.» Borde Guayaba, una sola vez.
  - **Después del dinero, WhatsApp primero**: Ana escribe el mismo día que concilia. La página pasa a «Tu pieza se vendió a otro pedido» (encabezado neutro `#F1EEE2`), con la tarjeta de estado (pago recibido → pieza asignada a otro pedido → Ana te escribe), y **sin opciones en pantalla**: devolución, pieza parecida o esperar se hablan caso por caso. Devolución de 24 a 48 h por SINPE manual.
  - El texto no asigna culpa ni ganadores: «quedó asignada a otro pedido», «es de nuestro lado, no tuyo». Quien gana no ve nada distinto.
- *Advertencias*:
  - **Ficha y carrito**: línea fija «Disponibilidad sujeta a confirmación del pago. Si se vendió, te devolvemos todo.» Karla 12 px, icono de reloj `#3F4E7A`, sin banner ni color de alerta.
  - **Listado**: sin advertencia; conserva «Disponible» / «Agotado».
  - **Sin «últimas piezas»**: no hay dato de cantidad que lo sostenga y empujaría a pagar rápido justo cuando el riesgo es pagar dos veces.
  - *Por qué no genera desconfianza*: aparece solo en los dos puntos de decisión, va atada a su remedio y reemplaza una promesa («reservadas») que sería falsa.
- *Vigencia del pedido*: «Pedido abierto hasta [fecha y hora]» (antes «Reservado hasta»). El aviso de las 24 h y la cancelación de las 48 h siguen, pero ya no liberan stock: solo limpian pedidos sin pago.
- *Woo*: no descontar stock al crear el pedido; descontarlo al pasar a `processing`. Marcar en el admin el pedido con «pieza con otro pedido pendiente» para que Ana vea el conflicto al conciliar.

### Pendientes (ningún valor inventado)
- **Plazo del SINPE 2** (propuesta: 3 días, recordatorio a las 48 h) y qué hace Ana si no se paga: el paquete ya salió.
- **Quién adelanta el envío** y si clientes nuevos pagan el envío antes de que salga el paquete.
- **Criterio interno de Ana** para asignar una pieza en conflicto: no se publica, pero conviene que sea consistente.
- **Plazo para que Ana escriba a la segunda persona**: el diseño dice «hoy»; debe ser cierto.
- **Pedido de varias piezas donde solo una se vende a otro**: aplica el despacho parcial A3.
- Las tarifas, cantones y peso de la revisión 3 quedan solo como referencia interna de Ana.

---

## Revisión 5 — sin inventario, envío plano y sin plazo (setiembre 2026)

Archivos: `Kiwi - Flujo de compra SINPE.dc.html` (carrito, checkout, gracias y decisiones corregidos; **secciones 13 y 14 eliminadas**), `Kiwi - Estados de excepcion.dc.html` (sección 14 reducida a «nunca se pagó»), `Kiwi - Paginas de ayuda.dc.html` (B3 Envíos reescrita, aviso en Regalo), `Kiwi - Evolución de identidad.dc.html` (barra, ficha, listado, garantías, story). **Ningún token nuevo.** Se reutilizan el aviso con icono (#F1EEE2), el sello lima, la fila de WhatsApp y el glifo de chat.

### Cambio 1 — No hay inventario
Cada pieza se confecciona cuando alguien la compra, en la cantidad y las tallas pedidas. Nunca se agota; dos personas pueden comprar lo mismo a la vez.

- *Selector de talla*: se simplifica a **dos estados**, normal (`border:1px solid #CFCBBD`, fondo `#FFFDF7`) y seleccionada (`#2F5D3F`). Sin opción deshabilitada, sin `aria-disabled`, sin nota de reposición. Todas las tallas son clicables siempre.
- *Listado*: la card pierde su línea de estado y la insignia «Últimas 3» (era un dato de cantidad). Sale el filtro «Solo disponible ahora» y la chip «Disponible ahora».
- *Vacío tras filtrar*: «¿Buscás algo puntual?» ya no dice «si lo tenemos o cuándo entra» sino «si se puede hacer».
- *Bruma `#CFCBBD`*: pierde el uso «tallas agotadas»; queda en bordes y divisores.
- *Woo*: productos sin gestión de inventario, siempre comprables. No hay que descontar stock ni marcar «pieza con otro pedido pendiente».

### Cambio 2 — Envío plano de ₡3.000, pagado por adelantado
₡3.000 por pedido, sin importar piezas ni destino, dentro del **mismo SINPE**. Vuelve el checkout de un solo pago (estructura de la revisión 3, sin zonas, sin peso, sin tabla).

- *Carrito y checkout*: fila «Envío · ₡3.000» (tabular) con nota «Tarifa plana por pedido: no cambia con las piezas ni con el destino». Total «Pagás hoy» = subtotal + ₡3.000 (ejemplo del lienzo: ₡21.400 + ₡3.000 = **₡24.400**).
- *Tarjeta de envío del checkout*: «Envío a [distrito], [cantón]» con `₡3.000`; sin «por Correos» ni «Aparte».
- *Gracias*: monto exacto, barra fija y resumen usan ₡24.400; referencia única `1042`.
- *Estados de excepción*: las cifras de los estados de monto distinto se recalculan (total ₡24.400; transfirió de menos: ₡23.000, falta ₡1.400; de más: ₡26.000, se devuelven ₡1.600).
- *Woo*: un método «Envío plano» a ₡3.000, sin zonas ni clases. Sale la tarifa agregada a mano y la solicitud del SINPE 2.

### Cambio 3 — No existe plazo de entrega
**Hallazgo**: revisadas todas las pantallas, la promesa «24–48 h» **ya no estaba** en la barra, garantías ni sello (se quitó en la revisión 3). Lo que sí había era la ausencia de explicación y copy de la revisión 4 que hablaba de envíos por peso. Las únicas «24 a 48 h» que quedan son de **devolución de dinero** (Estados de excepción), no de entrega: ver Pendientes.

**Principio**: la falta de fecha se presenta como un hecho del proceso («se confecciona por encargo»), nunca como disculpa, y siempre va con una salida (preguntar antes de pagar). Prohibido en cualquier copy: número de días, rango, «aproximadamente», ejemplos de plazo.

| Lugar | Antes (rev. 4) | Ahora | Función |
|---|---|---|---|
| Barra superior | «Envíos por Correos · el envío se paga aparte» | «Hecho por encargo · Envío ₡3.000 a todo el país» | Identidad: el proceso es la marca. Dos hechos verificables, sin plazo. |
| Sello lima bajo el botón | «Envíos por Correos, se paga aparte» | «¿Necesitás fecha? Escribinos por WhatsApp» (glifo de chat) | Acción: la duda surge aquí y aquí se resuelve. Pregunta, no excusa. |
| Ficha, fila bajo el sello | «Disponibilidad sujeta a confirmación del pago…» | **«Se confecciona por encargo.** No hay fecha fija: el tiempo depende del proveedor.» | Explicación, aviso con icono de reloj. |
| Franja de garantías | «Envío al costo de Correos» | «Envío plano ₡3.000»; «SINPE · tarjeta · WhatsApp» pasa a «Pago por SINPE Móvil» (no hay tarjeta) | Solo hechos. |
| Carrito | «Disponibilidad sujeta a confirmación…» | **«Se confecciona por encargo.** No hay fecha de entrega fija… ¿Tenés un día en mente? Preguntanos antes de pagar.» | Segundo contacto, antes del checkout. |
| Checkout | Aviso de «piezas no apartadas» | Mismo aviso **dentro de la tarjeta de pago**, sobre los tres pasos, y fila «¿Necesitás una fecha? Escribinos por WhatsApp» en la tarjeta de envío | Última lectura antes de confirmar. |
| Gracias | Tarjeta «qué se pagó / qué falta» | Tarjeta **«Qué pasa después»**: 1 Ana confirma tu pago (WhatsApp, 8712 4455) · 2 tu pedido se manda a confeccionar, sin fecha fija · 3 Ana te escribe en cada novedad. En estado B, la línea de tiempo sustituye «Entrega a Correos» por «Confección por encargo» | Nombra quién escribe, por dónde y sobre qué. |
| Story | «Envíos a todo el país» | «Hecho por encargo» / «Envío a todo el país: ₡3.000 por pedido.» | — |

**Cuándo se explica**: en la ficha (antes de agregar), en el carrito y en el checkout (antes de confirmar); la gracias solo lo repite. Quien compra para un evento lo lee tres veces antes de pagar.
**WhatsApp**: siempre como consulta («¿Necesitás fecha?»), nunca como «llamá porque no decimos». El sello y la fila del checkout tienen el mismo peso visual que el resto de salidas secundarias.
**Regalo**: el flujo «Es un regalo y no sé la talla» **no redirige**; advierte temprano. La tarjeta lima dice «Se hace por encargo y no tiene fecha fija: si es para un evento, escribinos antes», y la pestaña Regalo de la guía de tallas abre con el aviso «Antes de elegir». La tarjeta de regalo digital (sección 12) no cambia: no se confecciona.
**Ayuda · Envíos (B3)**: reescrita. Secciones «Cuánto cuesta» (₡3.000 plano, en el mismo SINPE), «Por qué no hay fecha fija» (por encargo, depende del proveedor), «Qué pasa después de pagar» (Ana escribe por WhatsApp) y tarjeta «¿Necesitás una fecha?» con mensaje «Hola, quiero pedir ____ y lo necesito para ____. ¿Se puede coordinar?».

### Qué queda derogado de la revisión 4

| De la revisión 4 | Estado |
|---|---|
| Conflicto 2 completo: advertencia «Otra persona ya pidió esta pieza», estado «Tu pieza se vendió a otro pedido», caso (c) de despacho parcial, marca de admin «pieza con otro pedido pendiente», decisión de Ana caso por caso | **Derogado** (no hay inventario) |
| Línea «Disponibilidad sujeta a confirmación del pago» en ficha y carrito | **Derogada**; la ocupa «Se confecciona por encargo» |
| Conflicto 1 completo: dos SINPE (`1042` y `1042-E`), tarjeta «qué se pagó / qué falta / qué espera», estados N1–N4 (sección 13), mensaje de WhatsApp con recibo de Correos | **Derogado** |
| «Envío · Se cobra aparte» (carrito), «Envío por Correos · Aparte» (checkout) | **Derogados** → «Envío · ₡3.000» |
| Barra «Envíos por Correos · el envío se paga aparte», garantía «Envío al costo de Correos» | **Derogadas** |
| Copy de ayuda «Por qué se cobra aparte» / «Cómo pagás el envío», plazo de 3 días del SINPE 2 | **Derogado** |
| Sección 14 de Flujo de compra («Conflicto 2 · Stock sin reserva») y sección 13 («Conflicto 1 · Envío aparte») | **Eliminadas** |
| Estados de excepción (b) «pagado, sin stock» y (c) «parcialmente agotado» | **Eliminados** |
| Woo: decrementar stock al pasar a `processing`; método «se cobra aparte» a ₡0 | **Derogado** |

### Qué queda derogado de la revisión 3 y anteriores

| Antes | Estado |
|---|---|
| Selector: estado «Agotada», nota de reposición, «stockBySize/restockDate» | **Derogado** |
| Listado: línea «Agotado», filtro «Solo disponible ahora», «Últimas 3» | **Derogados** |
| Decisión «mostrar lo agotado en vez de esconderlo» | **Derogada** |
| Tarifa por zona y peso (GAM / Resto del país), «hasta 1 kg», IVA del envío | **Derogada** (sigue derogada) |
| Liberar stock al cancelar (sección 10 a) | **Derogado** |

**Siguen vigentes**: sin envío gratis ni contador; SINPE único medio; precio sin IVA; conciliación manual; aviso a 24 h y cancelación a 48 h como limpieza de pedidos sin pago; monto distinto sin plazo; sin botón «cancelar»; cambio en 15 días.

### Pendientes (ningún valor inventado)
- **Cadencia de avisos**: la gracias promete «Ana te escribe en cada novedad». Ana debe confirmar que puede sostenerlo y en qué eventos (pago confirmado, salida a confección, envío).
- **Devolución «de 24 a 48 h»** (excedente y Estados de excepción): es un plazo de Kiwi sobre su propio dinero, no de entrega, y se mantuvo. Confirmar que Ana lo cumple.
- **Cambio en 15 días** en una pieza hecha por encargo: política comercial por definir; el diseño no la toca.
- **Diferencia con Correos**: Kiwi absorbe la diferencia entre ₡3.000 y lo que cobre Correos.
- **Barra superior en móvil 375**: verificar con la fuente real que «Hecho por encargo · Envío ₡3.000 a todo el país» entra en una línea o dejar que envuelva.
