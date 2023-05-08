

Viduc/Orkin
=======  


AUTEUR
------  
[![Viduc](https://www.shareicon.net/data/48x48/2016/01/02/229394_cylon_256x256.png)](https://github.com/viduc) [![Mail](https://www.shareicon.net/data/48x48/2016/03/20/444954_mail_200x200.png)](mailto:viduc@mail.fr?subject=[GitHub]%20Source%20Han%20Sans)  
STATUT
------  
[![License](http://poser.pugx.org/viduc/orkin/license)](https://packagist.org/packages/viduc/orkin) ![example workflow](https://github.com/viduc/orkin/actions/workflows/php.yml/badge.svg) [![Latest Stable Version](http://poser.pugx.org/viduc/orkin/v)](https://packagist.org/packages/viduc/orkin) [![Latest Unstable Version](http://poser.pugx.org/viduc/orkin/v/unstable)](https://packagist.org/packages/viduc/orkin) [![Total Downloads](http://poser.pugx.org/viduc/orkin/downloads)](https://packagist.org/packages/viduc/orkin) [![Maintainability](https://api.codeclimate.com/v1/badges/0e4654bced125386dbc4/maintainability)](https://codeclimate.com/github/viduc/orkin/maintainability) [![Test Coverage](https://api.codeclimate.com/v1/badges/0e4654bced125386dbc4/test_coverage)](https://codeclimate.com/github/viduc/orkin/test_coverage)
-------  

Copyright [2023] [Tristan FLeury]

Copyright (C) 2007 Free Software Foundation, Inc. <http://fsf.org/>  
Everyone is permitted to copy and distribute verbatim copies  
of this license document, but changing it is not allowed.

https://www.gnu.org/licenses/gpl-3.0.fr.html

The GNU General Public License is a free, copyleft license for  
software and other kinds of works.

The licenses for most software and other practical works are designed  
to take away your freedom to share and change the works. By contrast,  
the GNU General Public License is intended to guarantee your freedom to  
share and change all versions of a program--to make sure it remains free  
software for all its users. We, the Free Software Foundation, use the  
GNU General Public License for most of our software; it applies also to  
any other work released this way by its authors. You can apply it to  
your programs, too.

DESCRIPTION
-------  
ORKIN est un gestionnaire d’outils d’analyse de code pour Php. Il va permettre d’installer et de configurer les principaux outils utilisés dans l’analyse et l’amélioration du code et ce de façon indépendante de votre code de production. Les versions des librairies utilisées ne seront donc pas en concurrence d’autres librairies que vous pourriez utiliser dans votre code. Seule la version de Php (8.0, 8.1 ou 8.2) sera nécessaire.  
Les outils disponibles sont :

- **phpunit** : [PHPUnit](https://phpunit.de/) est un _framework_ de tests unitaires pour PHP. Il s’inspire de JUnit, la version Java du _framework_. PHPUnit fournit son propre exécutable `phpunit` pour exécuter les tests. Il fournit également une bibliothèque de classes nécessaire pour la rédaction des tests.

- **kahlan** : [Kahlan](https://github.com/kahlan/kahlan) est un framework de test Unit & BDD complet à la RSpec/JSpec qui utilise une syntaxe de description. Kahlan vous permet de stubber ou de patcher votre code directement comme dans Ruby ou JavaScript sans aucune extension PECL requise.
- **phpcsfixer** : L'outil PHP Coding Standards Fixer ([PHP CS Fixer](https://github.com/PHP-CS-Fixer/PHP-CS-Fixer)) corrige votre code pour qu'il respecte les normes ; si vous souhaitez suivre les standards de codage PHP tels que définis dans le PSR-1, PSR-2, etc., ou d'autres standards communautaires comme celui de Symfony. Vous pouvez également définir votre style (d'équipe) via la configuration.
- **phpcs** : [PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer) est un ensemble de deux scripts PHP ; le script phpcs principal qui tokenise les fichiers PHP, JavaScript et CSS pour détecter les violations d'une norme de codage définie, et un second script phpcbf pour corriger automatiquement les violations de la norme de codage. PHP_CodeSniffer est un outil de développement essentiel qui garantit que votre code reste propre et cohérent.
- **phpmd** : [Phpmd](https://phpmd.org/) est un projet dérivé de PHP Depend et vise à être un équivalent PHP de l'outil Java bien connu PMD. PHPMD peut être considéré comme une application frontale conviviale pour le flux de métriques brutes mesuré par PHP Depend.
- **phpstan** : [PHPStan](https://phpstan.org/user-guide/getting-started) se concentre sur la recherche d'erreurs dans votre code sans réellement l'exécuter. Il détecte des classes entières de bogues avant même que vous écriviez des tests pour le code. Cela rapproche PHP des langages compilés dans le sens où l'exactitude de chaque ligne du code peut être vérifiée avant d'exécuter la ligne réelle.
- **phploc** : [Phploc](https://github.com/sebastianbergmann/phploc) est un outil permettant de mesurer rapidement la taille et d'analyser la structure d'un projet PHP.

ORKIN utilise l’outil [phing](https://www.phing.info/) pour paramétrer et exécuter tout les outils. Il est possible d’utiliser tout les outils ou seulement certains au choix. Chaque outil peut être configuré indépendamment.

INSTALLATION
-------  
Vous devez préalablement créer un dossier à la racine de votre projet. Ce dossier contiendra tout les outils et le paramétrage nécessaire. Il est conseillé de nommer ce dossier **quality**.


    cd <monprojet>  
    mkdir quality  
    cd quality  

Installer orkin avec composer:

    composer require viduc/orkin

Lors de l'installation, composer détectera le fichier composer.json de votre projet. Il vous demandera si vous souhaitez l'utilise, répondez non (n)

CONFIGURATION
-------  
Tout en restant dans le dossier d'installation d'orkin, lancer la commande suivante pour créer le projet:

./vendor/bin/orkin orkin create  
Par défaut la langue utilisée est l'anglais, vous pouvez rajouter l'option locale=fr si vous souhaitez utiliser le français pour l'installation:

./vendor/bin.orkin orkin create locale=fr  
Il vous sera demandé si vous souhaitez utiliser la configuration par défaut. SI vous utilisez ce mode, tout les outils seront activés avec leur configuration par défaut de renseignée. Sinon vous pouvez choisir de configurer chaque outil de façon unitaire. A chaque fois il vous sera demandé si vous souhaitez activer ou non l'outil puis ces différentes option de paramétrage.

PARAMÉTRAGE DES OUTILS
-------  

- orkin:
- quality.folder: nom du dossier utilisé pour orkin (créer avant l'installation). **défaut: quality**
- src: nom du dossier source de votre application. **défaut: src**
- reports.folder: dossier ou seront enregistrés les rapports d'outils. **défaut: reports**
- phpunit:
- checkreturn: vérifie le retour d’exécution et de l'outil et s'arrête si une erreur est retournée. **défaut: true**
- folderTest: nom du dossier contenant les tests de votre application: **défaut: tests**
- kahlan:
- checkreturn: vérifie le retour d’exécution et de l'outil et s'arrête si une erreur est retournée. **défaut: true**
- spec: nom du dossier contenant les spécifications de votre application: **défaut: spec**
- reporter.console: Le nom du reporter de texte à utiliser dans la sortie console, les reporters de texte intégrés sont `'dot'`, `'bar'`, `'json'`, `'tap'` & `'verbose'`. **défaut: dot**
- reporter.coverage: Le nom du reporter de texte à utiliser dans la sortie texte, les reporters de texte intégrés sont `'dot'`, `'bar'`, `'json'`, `'tap'` & `'verbose'`. **défaut: tap**
- reporter.coverage: Générer un rapport de couverture de code. La valeur spécifie le niveau de détail pour le rapport de couverture de code (0-4). **défaut: 4**
- phpcsfixer:
- checkreturn: vérifie le retour d’exécution et de l'outil et s'arrête si une erreur est retournée. **défaut: true**
- dryrun: corrige ou non les fichiers cible. Il est conseillé d'activer ce mode en local (poste développeur) et de le désactiver en mode CI (intégration continue). **défaut: true**
- phpcs:
- phpcb: activer ou désactiver l'outil de correction phpcb. Il est conseillé d'activer ce mode en local (poste développeur) et de le désactiver en mode CI (intégration continue). **défaut: true**
- phpmd:
- mode: règles à appliquer. Les différentes règles disponibles sont: cleancode, codesize, controversial,design, naming et unusedcode. **défaut: cleancode**
- reportType: type du fichier de report utilisé. Les différents types sont: xml, text, html, json, ansi, github, gitlab, sarif, checkstyle. **défaut: text**
- reportFile: le nom du fichier de report utilisé. **défaut: phpmd.txt**
- phpstan:
- level: Si vous souhaitez utiliser PHPStan mais que votre base de code n'est pas à jour avec un typage fort et les contrôles stricts de PHPStan, vous pouvez actuellement choisir parmi 10 niveaux (0 est le plus lâche et 9 est le plus strict). **défaut: 7**
- xdebug: PHPStan désactive XDebug s'il est activé pour obtenir de meilleures performances. Si vous avez besoin de déboguer PHPStan lui-même ou vos extensions personnalisées et que vous souhaitez exécuter PHPStan avec XDebug activé, passez cette option. **défaut: false**
