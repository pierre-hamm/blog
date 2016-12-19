Command utile
=======================

Installation Projet symfony :

    composer create-project symfony/framework-standard-edition M2I "2.8.*"
    
Creation d'un bundle (configuration -> yml):

    php app/console generate:bundle

Creation d'une entity (configuration -> annotations):

    php app/console doctrine:generate:entity
  
Mise a jour des setter / getter d'une entity:

    php app/console doctrine:generate:entities MI2BlogBundle:Article

Update la BDD en fontion de nos entity:

    php app/console doctrine:schema:update --dump-sql
    php app/console doctrine:schema:update --force

Generation d'un formulaire:

    php app/console doctrine:generate:form M2IBlogBundle:Article

Clone le repository :

    * git clone https://github.com/pierre-hamm/blog.git;
    * composer install;
