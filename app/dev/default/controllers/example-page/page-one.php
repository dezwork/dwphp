<?php

/**
 * @Author: Cleberson Bieleski
 * @Date:   2017-12-23 04:54:45
 * @Last Modified by:   Cleberson Bieleski
 * @Last Modified time: 2018-01-14 10:32:47
 */

namespace App\Framework;
use App\template;
use DwPhp\Library\systemFunctions;
use DwPhp\Library\sql;
use DwPhp\Library\html;

class controller extends template{
		public function initialize(){
			//verifica se esta logado
			$this->setModals('App\ModalDefault\aboutCreated');
		}

		public function show(){
			/* seta valores da classe DwPhp*/
			$this->setNamePage('ajustes');

			//definições do HEAD
			$html = $GLOBALS['f']->template->html;
			$html->head->setMetaTitle($html->head->getMetaTitle().' - Ajustes');
			$this->read();
		}

		/**
		 * CRUD
		*/
		public function read(){



			$titleDB = new \App\Models\Title();
			$pharagrafDB = new \App\Models\Pharagraf();

			$returnTit = $titleDB->getAll($order = 'id ASC', $limit = '0');

			foreach ($returnTit as $keyTit => $objTitle) {
				$this->content[$keyTit]['title'] = $objTitle->getTitle();
				$this->content[$keyTit]['url'] = systemFunctions::UrlAmigavel($objTitle->getTitle());

				$returnPha = $pharagrafDB->getParagraphByIdTitle($objTitle->getId());

				foreach ($returnPha as $keyPha => $objPharagraf) {
					$this->content[$keyTit]['text']['description'][] = $objPharagraf->getDescription();
					$this->content[$keyTit]['text']['code'][] = $objPharagraf->getCode();
				}
			}

		}

		public function create(){

		}
		public function update(){

		}

		public function delete(){
		}

}