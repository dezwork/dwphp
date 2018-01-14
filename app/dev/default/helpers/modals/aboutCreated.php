<?php
/**
 * @Author: Cleberson Bieleski
 * @Date:   2018-01-02 11:16:13
 * @Last Modified by:   Cleberson Bieleski
 * @Last Modified time: 2018-01-10 17:17:36
 */
    namespace App\ModalDefault;
    use DwPhp\Library\systemFunctions;

    class aboutCreated{
        public function initialize(){
            //<!-- branvo-manager -->
            $html = $GLOBALS['f']->template->html;
            $this->html();
        }

        public function html(){
?>
        <!-- Modal -->
        <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="mySmallModalLabel">Links</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  <div class="row m-0 p-0">
                    <div class="col-4 mt-4">Github</div><div class="col-8 mt-4"><a href="https://github.com/cleberbieleski">@bieleski</a></div>
                    <div class="col-4 mt-4">Twitter</div><div class="col-8 mt-4"><a href="https://twitter.com/cleberbieleski">@bieleski</a></div>
                  </div>
                  <br/>
              </div>
            </div>
          </div>
        </div>
<?
    }
}
?>