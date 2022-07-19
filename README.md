# W świecie IT

Repozytorium powstało na potrzeby wpisów na bloga [W świecie IT](https://wswiecieit.dev/).

## Instalacja

```bash
docker build -t blog .
docker run -it --rm --name blog -v "$PWD":/usr/src/blog blog
./bin/composer install
```