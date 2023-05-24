## Initialiser le projet en Symfony

    - symfony new <nom-du-projet> --version="6.2.*" --webapp
    - cd <nom-du-projet>

### Création / Modification BDD

    - php bin/console d:d:c
    - DATABASE_URL => .env.dev.local

    Création User
    - php bin/console make:entity User
    - php bin/console make:migration (créer la migration)
    - php bin/console doctrine:migrations:migrate (update bdd)

    Création Activity
    - php bin/console make:entity Activity

    Création Formulaires
## Lancer le projet Symfony

    - symfony server:start