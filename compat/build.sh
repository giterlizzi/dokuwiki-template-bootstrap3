#!/bin/sh

rm -rf inc/Menu
rm -rf lib/images/menu

cp -va ~/www/dokuwiki/inc/Menu inc
cp -va ~/www/dokuwiki/lib/images/menu lib/images

find . -name "*.php" -exec perl -i -pe "s/DOKU_INC/DOKU_INC_COMPAT/" {} +
