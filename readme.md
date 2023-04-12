# Blog

Blog est un site internet qui vous présentent des articles sur des sujets divers et variés.

## Environnement de développement

### Pré-requis

* PHP 8.2
* Composer
* Symfony CLI

Vous pouvez vérifier les pré-requis (sauf Docker et Docker-compose) avec la commande suivante (de la CLI Symfony) : 

```bash
symfony check:requirements
```

### Lancer l'environnement de développement

```bash
symfony serve -d
```

## Lancer des tests

```bash
php bin/phpunit --testdox
```