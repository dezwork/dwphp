<?php

/**
 * @Author: Cleberson Bieleski
 * @Date:   2017-12-28 17:24:24
 * @Last Modified by:   Cleberson Bieleski
 * @Last Modified time: 2018-01-10 14:52:40

 - This Class extends same file in "entity" folder, the "entity" folder extends Php/library/models/AbstractObject.php.
 - Files in the "entity" folder should not be changed
 - New methods must be constructed in this file, just below __construct


 */

namespace App\Models;

use App\Entity\Title AS Title_DB;
use DwPhp\Library\sql;

class Title extends Title_DB{

	public function __construct($params = array()){
		$this->setDbTable($this->getNameTable());

		$this->setID(			(isset($params['id']) 			? $params['id']			: null) );
        $this->setTitle(  		(isset($params['title'])        ? $params['title']      : null) );
		$this->setActive(		(isset($params['active']) 	    ? $params['active']	    : null) );
	}

	//
        // Novos metodos são implementados aqui...
        // public function ....
        //

}