<?php

error_reporting(E_ALL);

/**
 * pretelejourj - class.Prestataires.php
 *
 * $Id$
 *
 * This file is part of pretelejourj.
 *
 * Automatically generated on 14.07.2017, 17:45:13 with ArgoUML PHP module 
 * (last revised $Date: 2010-01-12 20:14:42 +0100 (Tue, 12 Jan 2010) $)
 *
 * @author firstname and lastname of author, <author@example.org>
 */

if (0 > version_compare(PHP_VERSION, '5')) {
    die('This file was generated for PHP 5');
}

class Prestataires extends Common
{
    public $table='prestataires';
	public static $tablestat='prestataires';
    public $id_prestataire = null;
	public $nom_prestataire = null;
	public $prenom_prestataire = null;
	public $adresse_prestataire = null;
	public $cp_prestataire = null;
	public $ville_prestataire = null;
	public $telephone_prestataire = null;
	public $id_type_prestataire = null;
	public $statut = null;
	public $date_creation = null;

    public $date_modification = null;

   
    public function getId_prestataire()
    {
	return $this->id_prestataire;
           }

   
    public function getNom_prestataire()
    {
    }

    
    public function getPrenom_prestataire()
    {
     }

    public function getAdresse_prestataire()
    {
       }

    
    public function getCp_prestataire()
    {
         }

     public function Prestataires($id=null)
    {
		if($id<>null){
			$info=$this->getPrestataire($id);
			parent::hydrate($info);
		}
    }
	public static function getPrestataireFromId($id)
	{
		$prestataire=new Prestataires($id);
		return $prestataire->getPrestataire($id);
	
	}
    public function getPrestataire($id){
		$sql="SELECT * 
			FROM `prestataires` p 
			WHERE p.id_prestataire=".$id;
		$data=query_full($sql);
		return $data;
	}
    public function getVille()
    {
    }

  
    public function getTelehpone()
    {
    }

    
    public function getIdTypePrestataire()
    {
    }


    public function delete()
    {
    }
	
    
    public function getStatut()
    {
    }
	  public function __set($property,$value) {
	 $this->$property = $value;
	  }public function getTheId(){
		return "id_prestataire";
	}
    
    
} /* end of class Prestataires */

?>