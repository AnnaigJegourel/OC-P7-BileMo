# OC-P7-BileMo

Training program "Back-end Developer: PHP/Symfony" (OpenClassrooms)  
Project 7: API built with Symfony, for a B2B mobile phone company (study project)  

[![Maintainability](https://api.codeclimate.com/v1/badges/d18cc7ef7d1c0507c4ba/maintainability)](https://codeclimate.com/github/AnnaigJegourel/OC-P7-BileMo/maintainability)
[![Codacy Badge](https://app.codacy.com/project/badge/Grade/b340d28e14e9499c9b9c65e065c10b6f)](https://app.codacy.com/gh/AnnaigJegourel/OC-P7-BileMo/dashboard?utm_source=gh&utm_medium=referral&utm_content=&utm_campaign=Badge_grade)

## Configuration / Technologies ⚙️

xamppserver  
10.4.21-MariaDB  
PHP 8.1  
Composer 2.3.0  
Symfony 6.2

## Installation 🧑🏻‍🔧

    1. Clone the repository
    2. Upload & install xamppserver: [https://www.wampserver.com/en/download-wampserver-64bits/](https://www.apachefriends.org)
    3. Launch xamppserver, configure your php version to 8.1.6 or above
    4. Go to localhost/phpmyadmin/
    5. Create a new database & name it "p7-bilemo"
    6. Launch a terminal at the root of the project & run the command "composer intall"
    7. Launch the Symfony server running "symfony server:start"

You can load the fixtures as initial data, running "php bin/console doctrine:fixtures:load"
Once your project is installed, you can find the api documentation following this link:
<https://127.0.0.1:8000/api/doc/>

## Contexte 🇫🇷

📱 BileMo est une entreprise offrant toute une sélection de téléphones mobiles haut de gamme.
Vous êtes en charge du développement de la vitrine de téléphones mobiles de l’entreprise.
Le business modèle de BileMo n’est pas de vendre directement ses produits sur le site web, mais de fournir à toutes les plateformes qui le souhaitent l’accès au catalogue via une API (Application Programming Interface).
Il s’agit donc de vente exclusivement en B2B (business to business). Il va falloir que vous exposiez un certain nombre d’API pour que les applications des autres plateformes web puissent effectuer des opérations.

### Description

Le premier client a enfin signé un contrat de partenariat avec BileMo !
C’est le branle-bas de combat pour répondre aux besoins de ce premier client qui va permettre de mettre en place l’ensemble des API et de les éprouver tout de suite.  
Après une réunion dense avec le client, il a été identifié un certain nombre d’informations. Il doit être possible de :  
🛠 consulter la liste des produits BileMo ;  
🛠 consulter les détails d’un produit BileMo ;  
🛠 consulter la liste des utilisateurs inscrits liés à un client sur le site web ;  
🛠 consulter le détail d’un utilisateur inscrit lié à un client ;  
🛠 ajouter un nouvel utilisateur lié à un client ;  
🛠 supprimer un utilisateur ajouté par un client.  
Seuls les clients référencés peuvent accéder aux API. Les clients de l’API doivent être authentifiés via OAuth ou JWT.
Vous avez le choix entre mettre en place un serveur OAuth et y faire appel (en utilisant le FOSOAuthServerBundle), et utiliser Facebook, Google ou LinkedIn.
Si vous décidez d’utiliser JWT, il vous faudra vérifier la validité du token ; l’usage d’une librairie est autorisé.

### Présentation des données

Le premier partenaire de BileMo est très exigeant :  
➡️ il requiert que vous exposiez vos données en suivant les règles des niveaux 1, 2 et 3 du modèle de Richardson.  
➡️ Il a demandé à ce que vous serviez les données en JSON.  
➡️ Si possible, le client souhaite que les réponses soient mises en cache afin d’optimiser les performances des requêtes en direction de l’API.  
