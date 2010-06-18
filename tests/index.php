<?php

header('Content-type: text/html; charset=UTF-8');

// Inclu les sources de la librairies
require '../hyla_tpl.class.php';


// Créé l'objet Hyla_Tpl
$t = new Hyla_Tpl('tpl');

$t->logError(true);

// Import du gabarits
$t->importFile('main.tpl');

$t->render('multiple_block');
#exit;

// Fonction de traduction
function traduction($var) {
    global $lang;
    if ($lang == 'en') {
        return $var;
    }
    $l10n = array(
        'Hello'         =>  'Salut',
        'Current path'  =>  'Chemin courant',
        'Size'          =>  'Taille',
        'Name'          =>  'Nom',
        'Switch lang'   =>  'Changer de langue',
    );
    return (array_key_exists($var, $l10n) ? $l10n[$var] : $var);
}


// Déclare la fonction de traduction
$t->setL10nCallback('traduction');

// Test error
$t->displayError(true);
$t->render('unknow.block');
$t->displayError(false);

$t->render('unknow.block.1');
$t->render('unknow.block.2');



// Cette fonction renvoie une taille facilement lisible (ex: 1024o renverra 1ko)
function get_human_readable_size($bytes) {
    global $lang;
    $types = array(null, 'k', 'm', 'g', 't');
    for ($i = 0; $bytes >= 1024 && $i < (count($types) -1); $bytes /= 1024, $i++);
    return round($bytes, 2) . $types[$i] . ($lang == 'fr' ? 'o' : 'b');
}

// Enregistre la fonction get_human_readable_size en tant que humansize dans le template
$t->registerVarFunction('humansize', 'get_human_readable_size');

function printo() {
    return 'Fonction printo';
}

$t->registerFunction('printo', create_function(null, "return 'function printo';"));
$t->registerFunction('printr', create_function('$args', 'return print_r($args, true);'));
$t->registerFunction('print', create_function('$args', '$out = null; foreach(func_get_args() as $arg) $out .= $arg; return $out;'), true);

function hello($name = null) {
    return "Hello $name !";
}
$t->registerFunction('hello', 'hello');

$t->render('b4');
$t->render('b4');
$t->render('b4');
$t->render('b4');
$t->render('b3');
$t->render('b3');
$t->render('b3');
$t->render('b2');
$t->render('b2');
$t->render('b1');
$t->render('b2');
$t->render('b1');

for ($i = 0; $i < 5; $i++) {
    $t->render('cycle');
}

// Récupère les variables get
$dir = isset($_GET['dir']) ? $_GET['dir'] : dirname(__FILE__);
$dir = realpath($dir);

$lang = isset($_GET['lang']) ? $_GET['lang'] : 'fr';

// Assigne quelques variables
$t->setVars(array(
    'VERSION'       =>  $t->getVersion(),
    'a'             =>  'Lorem ipsum dolor sit amet',
    'test'          =>  'ok',
    'TEST'          =>  'OK',
    'test1'         =>  'ok1',
    'test2'         =>  'ok2',
    'escape'        =>  '<span class="ko">toto</span>',
    'trim'          =>  '    Trim    ',
    'words'         =>  'hello wOrld !',
    'get'           =>  $t->get('get'),
    'dir'           =>  $dir,
    'lang'          =>  $lang,
    'lang_switch'   =>  ($lang == 'en' ? 'fr' : 'en'),
));

// Ouvre le dossier
if (!$files = @scandir($dir)) {
    exit("Unable to open « $dir »");
}

// Parcours des dossiers / fichiers
foreach ($files as $file) {

    $path = realpath("$dir/$file");

    $file = array(
        'path'  =>  $path,
        'name'  =>  $file,
        'size'  =>  filesize($path),
    );
    $t->setVar('file', $file);


    // L'élément courant est un dossier ?
    if (is_dir($path)) {
        $t->render('table.line.dir');
    }


    // Affiche la ligne
    $t->render('table.line');
}

$t->render('block.always.called');

// Affiche le résultat
echo $t->render();

?>
