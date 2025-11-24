#!/bin/bash

echo "Donner les bons droits sur les dossiers"
chmod 755 $PWD
chmod 755 $PWD/generateurderecette

echo "Donner les bons droits sur les fichiers"
chmod 644 $PWD/*.php
chmod 644 $PWD/*.css
chmod 644 $PWD/*.js
chmod 644 $PWD/generateurderecette/*.json
