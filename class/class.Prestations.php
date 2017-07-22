<?php

error_reporting(E_ALL);

/**
 * pretelejourj - class.Prestation.php
 *
 * $Id$
 *
 * This file is part of pretelejourj.
 *
 * Automatically generated on 14.07.2017, 17:45:12 with ArgoUML PHP module 
 * (last revised $Date: 2010-01-12 20:14:42 +0100 (Tue, 12 Jan 2010) $)
 *
 * @author firstname and lastname of author, <author@example.org>
 */

if (0 > version_compare(PHP_VERSION, '5')) {
    die('This file was generated for PHP 5');
}

/* user defined includes */
// section -64--88-1-48-74727e79:15d40a02818:-8000:0000000000000883-includes begin
// section -64--88-1-48-74727e79:15d40a02818:-8000:0000000000000883-includes end

/* user defined constants */
// section -64--88-1-48-74727e79:15d40a02818:-8000:0000000000000883-constants begin
// section -64--88-1-48-74727e79:15d40a02818:-8000:0000000000000883-constants end

/**
 * Short description of class Prestation
 *
 * @access public
 * @author firstname and lastname of author, <author@example.org>
 */
class Prestations extends Common
{
	public $table="prestations";
	public static $tablestat="prestations";
    public $selection = null;
	public $modele = null;
    public $valeur = null;
    public $date_creation = null;
    public $date_modification = null;

	public function delete(){
	}
	public function getTheId(){
		return "id_prestation";
	}
   
    public function Prestation(){ 
	}

    public function getListeSelection()
    { }
public function getPrestationsFromSelection($id){
		$sql="SELECT p.* , libelle_modele_type_prestataire
			FROM `prestations` p 
			INNER JOIN modele_type_prestataire m ON m.id_modele_type_prestataire = p.id_modele_type_prestataire
			WHERE p.id_selection='".$id."'";
		$data=query_full($sql);
		return $data;
	}
   
    public function getListeModele()    {
    }
	

} /* end of class Prestation */

?>