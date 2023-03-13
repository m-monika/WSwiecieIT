# W świecie IT

Repozytorium powstało na potrzeby wpisów na bloga [W świecie IT](https://wswiecieit.dev/).
// TEST

## Instalacja

```bash
docker build -t blog .
docker run -it --rm --name blog -v "$PWD":/usr/src/blog blog
./bin/composer install
```

## Przykłady

- [Nie mogę napisać testu do metody – part 1](./src/CanNotWriteTestToMethodPartOne/README.md)
- [Nie mogę napisać testu do metody – part 2](./src/CanNotWriteTestToMethodPartTwo/README.md)
- [Nie mogę napisać testu do metody wywołującej metodę statyczną](./src/CanNotWriteTestToMethodUsingStaticMethod/Exercises/One/README.md)
- Code Smells:
  - [Primitive Obsession](./src/CodeSmells/PrimitiveObsession/README.md)
