<?php
error_reporting(E_ALL); 
ini_set("display_errors", 1);

include_once 'simple_html_dom.php';

$compteur = 1;

while ( $compteur <= 1) {
$html=file_get_html('http://edituspro.luxweb.com/web/search.do?siteCode=AP&language=fr&input=centre+d\'affaire&siteCodeRub=AP&numPage='.$compteur);



foreach($html->find('div.zoneNomAdresse') as $people) {
	$item['nom']  = trim($people->find('a.raisSoc', 0)->plaintext);
    $item['rue']  = trim($people->find('div.adresse', 0)->plaintext);
    $item['pays'] = trim($people->find('span.highlight-pays', 0)->plaintext);
    $item['codpos'] = trim($people->find('span.highlight-codpos', 0)->plaintext);
    $item['localite'] = trim($people->find('span.highlight-localite', 0)->plaintext);
    $item['tel'] = trim($people->find('div.telephone', 0)->plaintext);
    $peoples[] = $item;
}
$compteur++;
}
$csv = fopen('centreaffaire.csv' ,'w');
foreach ($peoples as $item) {
    fputcsv($csv, $item);
}
fclose($csv);
print_r($peoples);