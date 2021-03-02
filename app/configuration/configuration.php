<?php
// configuration - nustatymai
// siuos duomenis patogu laikyti config'e, kad butu galima juos pasiekti is betkurios projekto vietos

// 1 _ DB Parametrai:

// define - php f-ja, kuri sukuria konstanta, pavadinimu DB_HOST ir turincia reiksme localhost, kuri nurodo kur yra DB
define('DB_HOST', 'localhost');
// define - php f-ja, kuri sukuria konstanta, pavadinimu DB_USER ir turincia reiksme root, kuri nurodo DB prisijungimo username'a
define('DB_USER', 'root');
// define - php f-ja, kuri sukuria konstanta, pavadinimu DB_PASS ir turincia tuscia reiksme, kuri nurodo DB prisijungimo password'a
define('DB_PASS', '');
// define - php f-ja, kuri sukuria konstanta, pavadinimu DB_NAME ir turincia reiksme 2021_03_01_PRAKTINIO_DARBO_EGZAMINO_ATSISKAITYMAS_SPORTO_KLUBAS, kuri nurodo DB name'a
define('DB_NAME', '2021_03_01_PRAKTINIO_DARBO_EGZAMINO_ATSISKAITYMAS_SPORTO_KLUBAS');

// 2 _ APPROOT konstanta - nuoroda i projekta failu sistemoje (path'a) pvz.(C:\wamp64\www\2021_03_01_PRAKTINIO_DARBO_EGZAMINO_ATSISKAITYMAS_SPORTO_KLUBAS\app)
// __FILE__ konstanta / ji egzistuoja betkuriame php faile ir reiksme yra konkretus failo pavadinimas ir path'as
define('APPROOT', dirname(dirname(__FILE__)));

// 3 _ define - php f-ja, kuri sukuria konstanta, pavadinimu URLROOT ir turincia reiksme http://localhost/2021_03_01_PRAKTINIO_DARBO_EGZAMINO_ATSISKAITYMAS_SPORTO_KLUBAS yra adresas i projekta
define('URLROOT', 'http://localhost/2021_03_01_PRAKTINIO_DARBO_EGZAMINO_ATSISKAITYMAS_SPORTO_KLUBAS');

// 4 _ define - php f-ja, kuri sukuria konstanta, pavadinimu SITENAME ir turincia reiksme 2021_03_01_PRAKTINIO_DARBO_EGZAMINO_ATSISKAITYMAS_SPORTO_KLUBAS, kuri nurodo psl. / aplikacijos pavadinima 
define('SITENAME', '2021_03_01_PRAKTINIO_DARBO_EGZAMINO_ATSISKAITYMAS_SPORTO_KLUBAS');