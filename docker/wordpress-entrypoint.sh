#!/bin/sh
# Enlaza cada ./plugins/kiwi-* del repo dentro de wp-content/plugins.
# Los plugins de terceros (WooCommerce) siguen viviendo en el volumen wp_data;
# montar la carpeta plugins completa los taparía.
set -e

SRC=/var/www/kiwi-plugins
DST=/var/www/html/wp-content/plugins

mkdir -p "$DST"

# Quitar enlaces kiwi-* cuyo plugin ya no existe en el repo.
for link in "$DST"/kiwi-*; do
  [ -L "$link" ] && [ ! -e "$link" ] && rm "$link"
done

for dir in "$SRC"/kiwi-*/; do
  [ -d "$dir" ] || continue
  ln -sfn "${dir%/}" "$DST/$(basename "$dir")"
done

exec docker-entrypoint.sh "$@"
