## Initialiser le projet en Symfony

    - symfony new <nom-du-projet> --version="6.2.*" --webapp
    - cd <nom-du-projet>

### Création / Modification BDD

    - php bin/console d:d:c
    - DATABASE_URL => .env.dev.local (le fichier n'est pas commit)
    - php bin/console make:migration
    - php bin/console doctrine:migrations:migrate

    Création User
    - php bin/console make:entity User

    Création Activity
    - php bin/console make:entity Activity

    Création Formulaires
    - php bin/console make:form

    Login :
    - php bin/console make:controller Login
### Lancer le projet Symfony

    - symfony server:start