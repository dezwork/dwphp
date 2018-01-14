<?php

/**
 * @Author: Cleberson Bieleski
 * @Date:   2017-12-23 04:54:45
 * @Last Modified by:   Cleberson Bieleski
 * @Last Modified time: 2018-01-13 21:36:24
 */

  namespace App;
  use DwPhp\Framework;
  use DwPhp\Library\html;

  class template extends Framework{
    public $modal = array();

    public function initialize(){
          $this->html = new html();
          $head = $this->html->head;
          $head->setBase($GLOBALS['f']->getPathBaseHref());
          //titulo do site
          $head->setMetaTitle('DwPhp');

          // inlcui arquivos no cabeçalho do site
          $this->html->includeFile('/assets/css/bootstrap.min.css','start');
          $this->html->includeFile('/assets/css/bootstrap-grid.min.css','start');
          $this->html->includeFile('/assets/css/bootstrap.min.css.map','end');
          $this->html->includeFile('/assets/css/style.css','start');
          $this->html->includeFile('/assets/css/style.css','start');


          $this->html->includeFile('/assets/js/jquery-3.2.1.slim.min.js','end');
          $this->html->includeFile('/assets/js/popper.min.js','end');
          $this->html->includeFile('/assets/js/bootstrap.min.js','end');
          $this->html->includeFile('/assets/vendor/jquery-unobtrusive-ajax/jquery.unobtrusive-ajax.min.js','end');


          $this->html->includeFile('/assets/images/icons/apple-icon-57x57.png','start','rel="apple-touch-icon" sizes="57x57"');
          $this->html->includeFile('/assets/images/icons/apple-icon-60x60.png','start','rel="apple-touch-icon" sizes="60x60"');
          $this->html->includeFile('/assets/images/icons/apple-icon-72x72.png','start','rel="apple-touch-icon" sizes="72x72"');
          $this->html->includeFile('/assets/images/icons/apple-icon-76x76.png','start','rel="apple-touch-icon" sizes="76x76"');
          $this->html->includeFile('/assets/images/icons/apple-icon-114x114.png','start','rel="apple-touch-icon" sizes="114x114"');
          $this->html->includeFile('/assets/images/icons/apple-icon-120x120.png','start','rel="apple-touch-icon" sizes="120x120"');
          $this->html->includeFile('/assets/images/icons/apple-icon-144x144.png','start','rel="apple-touch-icon" sizes="144x144"');
          $this->html->includeFile('/assets/images/icons/apple-icon-152x152.png','start','rel="apple-touch-icon" sizes="152x152"');
          $this->html->includeFile('/assets/images/icons/apple-icon-180x180.png','start','rel="apple-touch-icon" sizes="180x180"');
          $this->html->includeFile('/assets/images/icons/android-icon-192x192.png','start','rel="icon" type="image/png" sizes="192x192"');
          $this->html->includeFile('/assets/images/icons/favicon-32x32.png','start','rel="icon" type="image/png" sizes="32x32"');
          $this->html->includeFile('/assets/images/icons/favicon-96x96.png','start','rel="icon" type="image/png" sizes="96x96"');
          $this->html->includeFile('/assets/images/icons/favicon-16x16.png','start','rel="icon" type="image/png" sizes="16x16"');
          $this->html->includeFile('/assets/images/icons/manifest.json','start','rel="manifest"');


          $icons =  '<meta name="msapplication-TileColor" content="#ffffff">'."\n";
          $icons .= '<meta name="msapplication-TileImage" content="default/assets/images/icons/ms-icon-144x144.png">'."\n";
          $icons .= '<meta name="theme-color" content="#F8F8F8">'."\n";
          $head->setTagsPersonalize($icons);

          $this->html->includeFile('/assets/js/main.js','end');
     }

    public function templateInclude($filename){
      $baseFiles=$GLOBALS['f']->getPathApplication('views/layout/',$this->getTemplate().'/'.$filename);
      if(file_exists($baseFiles) && $filename!=''){
        include $baseFiles;
      }
    }

    public function setModals($filename){
      $this->modal[] = $filename;
    }

    public function includeModals(){
      foreach ($this->modal as $value) {
        if(class_exists($value, true)){
          $n = new $value();
          $n->initialize();
        }
      }

    }

    public function showHTML($paginaView){
          $html = $GLOBALS['f']->template->html;
          $template = $GLOBALS['f']->template;

          //echo $this->fileVersion('/assets/css/style.css');
          /**
           * inlcui a pagina view
           */
          require_once $paginaView;
          /**
           * compactarHTML
           * @param string html
           * @param indent code HTML - true|false
           * @return compact code HTML - true|false
           */
          echo $html->compactarHTML((ob_get_clean()),($GLOBALS['f']->getEnvironmentStatus()!='production'?true:false),($GLOBALS['f']->getEnvironmentStatus()!='production'?false:true));
          //echo $html->compactarHTML((ob_get_clean()), true,true);
          //echo $this->HTMLaddFooter();
    }

  }
?>