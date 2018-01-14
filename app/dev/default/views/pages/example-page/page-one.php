<?php

/**
 * @Author: Cleberson Bieleski
 * @Date:   2017-12-23 04:54:45
 * @Last Modified by:   Cleberson Bieleski
 * @Last Modified time: 2018-01-10 17:19:16
 */
?>
 <div class="col-sm-8 blog-main">

      <? foreach ($this->content as $k => $result) { ?>
          <? if($k!=0){ ?><hr><? } ?>
          <div class="blog-post pt-5 " id="<?=$result['url']?>">
              <h3 class="pt-4"><?=$result['title']?></h3>
              <? foreach ($result['text']['description'] as $keyPha => $value) { ?>
                  <? if(!empty($result['text']['description'][$keyPha])){?>
                    <p><?=$result['text']['description'][$keyPha]?></p>
                  <? } ?>
                  <? if(!empty($result['text']['code'][$keyPha])){?>
                    <pre><?=$result['text']['code'][$keyPha]?></pre>
                  <? } ?>
              <? } ?>
          </div>
      <? } ?>
</div>
<div class="col-sm-3 offset-sm-1 blog-sidebar">
  <div class="sidebar-module sidebar-module-inset">
    <h4>Sobre</h4>
    <p>Framework desenvolvido para aumentar a velocidade de desenvolvimento com estrutura <em>bootstrap 4</em> e ambientes <em>development</em>, <em>testes</em> e <em>produção</em> na mesma estrutura de arquivos.</p>
  </div>
</div><!-- /.blog-sidebar -->