<?php
class common{
	public $table;
	public static $tablestat;
	public function hydrate(array $donnees)	{
		  foreach ($donnees[0] as $key => $value)
		  {
		  $method = 'get'.ucfirst($key);
		  if (method_exists($this, $method)){
			$this->__set($key,$value);
			}
			/*// On récupère le nom du setter correspondant à l'attribut.
			$method = 'set'.ucfirst($key);
			echo $key."<br/>";
			// Si le setter correspondant existe.
			$this->$method($value);
			if (method_exists($this, $method)){
				// On appelle le setter.
				echo "ok";
				  $this->$method($value);
			}*/
		  }
	}
	 public function save($champs)
    {
	
		$text="INSERT INTO ".$this->table ." SET ";
		$field=array();

		try {
			$query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '".$this->table ."'";
			$field=query_full($query);
	

			/*while ($row = $result->fetch()) {
				$field[]= $row['COLUMN_NAME'];
			}*/

			$db_connection = null;
		} catch (PDOException $e) {
			$e->getMessage();
		}
		$i=0;
		foreach ($champs as $key=>$champ)    {
			if(array_search($key,array_column($field,0))!==false){
				if($i>0) {
					$text.=",";
				}
				$text.=$key."='".trim(vers_base($champ))."'";
				$i++;
			}
			
		}
		echo $text;
    $last_id = query_exec($text);
	
	return $last_id;
    }
	public function update($champs){
	   $text="    UPDATE ".$this->table ." SET ";
        $field=array();

        try {
            $query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '".$this->table."'";
            $field=query_full($query);
        } catch (PDOException $e) {
            $e->getMessage();
        }
        $i=0;
		
		foreach ($champs as $key=>$champ)    {
			echo $key. " ".$this->getTheId(). "<br/>";
            if(array_search($key,array_column($field,0))!==false && $key<>$this->getTheId()){
                if($i>0) $text.=",";
                $text.=$key."='".vers_base($champ)."'";
			}
            $i++;
        }
        $text.=" WHERE ".$this->getTheId()."='".$champs[$this->getTheId()]."'";
	//echo $text;die();
        $count =query_exec($text);
       return $count;
	}
	
	
	  public function __set($property,$value) {
	 $this->$property = $value;
	  }
	  
	  	public static function getLink($action="",$id="")
	{
		return "index.php?cont=".static::$tablestat.((isset($action) && $action<>"")?"&action=".$action:"").((isset($id) && $id<>"")?"&id=".$id:"");
	}
}
?>