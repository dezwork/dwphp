<?php

/**
 * @Author: Cleberson Bieleski
 * @Date:   2017-12-23 04:54:45
 * @Last Modified by:   Cleberson Bieleski
 * @Last Modified time: 2018-01-15 13:48:13
 */
use DwPhp\Init;
session_start();
//inicia a contagem do tempo de carregamento do framework
define('MICROTIME', microtime());
// constante com o caminho raiz dos arquivos do framework
define('PATH_ROOT', dirname(__FILE__));
//importa arquivos do composer
if(file_exists(PATH_ROOT.'/vendor/autoload.php')){
	require_once PATH_ROOT.'/vendor/autoload.php';
}else{
	define('KEYHASH', '5fa073f7860d74d00d451c8cd05f7c77');
	require_once("public/deploy.php");
	exit;
}


if(!empty($_SERVER['HTTP_HOST'])){
	try {
		//inicializa sistema
	    	new Init();
	} catch (Exception $e) {
	    	echo $e->getMessage();
	}
}
