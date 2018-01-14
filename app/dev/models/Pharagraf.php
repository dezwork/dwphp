<?php

/**
 * @Author: Cleberson Bieleski
 * @Date:   2017-12-28 17:24:24
 * @Last Modified by:   Cleberson Bieleski
 * @Last Modified time: 2018-01-10 16:08:48

 - This Class extends same file in "entity" folder, the "entity" folder extends Php/library/models/AbstractObject.php.
 - Files in the "entity" folder should not be changed
 - New methods must be constructed in this file, just below __construct


 */

namespace App\Models;

use App\Entity\Pharagraf AS Pharagraf_DB;
use DwPhp\Library\sql;

class Pharagraf extends Pharagraf_DB{

	public function __construct($params = array()){
		$this->setDbTable($this->getNameTable());

		$this->setID(		(isset($params['id']) 			? $params['id']		     : null) );
                $this->setIdTitle(      (isset($params['id_title'])             ? $params['id_title']        : null) );
                $this->setDescription(  (isset($params['description'])          ? $params['description']     : null) );
                $this->setCode(         (isset($params['code'])                ? $params['code']             : null) );
		$this->setActive(	(isset($params['active']) 	        ? $params['active']	     : null) );
	}

	//
        // Boscat ...
        public function getParagraphByIdTitle($id_title=0){
                $db = new sql();

                $db->setTable($this->getNameTable());
                $db->setFields('*');
                $db->setWhere("id_title = ".(int)$id_title);
                $db->Select();

                $return = array();
                while($row = $db->getRow()){
                        $return[] = new Pharagraf($row);
                }

                return $return;
        }
}