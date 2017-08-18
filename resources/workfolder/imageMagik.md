# Ligne de commande pour ImageMagik

Pour redimensionner et croper par lot les différentes images d'oblyks (lors du transfer de base de donnée)

**Redimensionner en hauteur**

exemple : redimensionne les .jpg à 200px de haut

```bash
mogrify -resize x200 *.jpg
```

**redimensionne une image pour que la plus petite dimension soit à X px**

exemple : thumbnail de plus petite dimension 200px sur les .jpg

```bash
mogrify -thumbnail 200x200^ *.jpg
```

**Crop une image en gardant le centre**

exemple : crop à 200*200px centré sur les .jpg

```bash
mogrify -gravity Center -crop 200x200+0+0 *.jpg
```