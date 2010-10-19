<?php

class AppModel extends Model {
	
	var $actsAs = array('Containable');
	
	var $recursive = -1;
	
	
	/**
     * Adds to a HABTM association some instances
     *
     * @param integer $id The id of the record in this model
     * @param mixed $assoc_name The name of the HABTM association
     * @param mixed $assoc_id The associated id or an array of id’s to be added
     * @return boolean Success
     */
    function addAssoc($id,$assoc_name,$assoc_id)
    {
        $data=$this->_auxAssoc($id,$assoc_name);
        if (!is_array($assoc_id)) $assoc_id=array($assoc_id);
        $data[$assoc_name][$assoc_name]=am($data[$assoc_name][$assoc_name],$assoc_id);
		// debug($data);
        return $this->save($data);
    }

    /**
     * Deletes from a HABTM association some instances
     *
     * @param integer $id The id of the record in this model
     * @param mixed $assoc_name The name of the HABTM association
     * @param mixed $assoc_id The associated id or an array of id’s to be removed
     * @return boolean Success
     */
    function deleteAssoc($id,$assoc_name,$assoc_id)
    {
        $data=$this->_auxAssoc($id,$assoc_name);
        if (!is_array($assoc_id)) $assoc_id=array($assoc_id);
        $result=array();
        foreach ($data[$assoc_name][$assoc_name] as $id)
        {
            if (!in_array($id, $assoc_id)) $result[]=$id;
        }
        $data[$assoc_name][$assoc_name]=$result;
        return $this->save($data);
    }

    /**
     * Returns the data associated with a HABTM in an array
     * suitable for save without deleting the current relationships
     *
     * @param integer $id The id of the record in this model
     * @param mixed $assoc_name The name of the HABTM association
     * @return array Data array with current HABTM association intact
     */
    function _auxAssoc($id,$assoc_name)
    {
        //disable query cache
        $back_cache=$this->cacheQueries;
        $this->cacheQueries=false;

        $this->recursive=1;
        $this->unbindAll(array('hasAndBelongsToMany'=>array($assoc_name)));
        $data=$this->findById($id);
        $assoc_data=array();
        foreach ($data[$assoc_name] as $assoc)
        {
            $assoc_data[]=$assoc['id'];
        }
        unset($data[$assoc_name]);
        $data[$assoc_name][$assoc_name]=$assoc_data;

        //restore previous setting of query cache
        $this->cacheQueries=$back_cache;

        return $data;
    }
}

?>