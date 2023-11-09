<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ingredient_model extends CI_Model {
  
    /**
     * CONSTRUCTOR | LOAD DB
    */
    public function __construct() {
       parent::__construct();
       $this->load->database();
    }

    public function getByProductId($id)
    {
        $data = $this->db->get_where("product_ingredients", ['product_id' => $id]);
        return $data->result();
    }

    /**
     * CREATE method.
     *
     * @return Response
    */
    public function create($data)
    {   
        $product_id = $data["ingredients"][0]["product_id"];
        // hapus data dulu
        $this->db->delete("product_ingredients", ['product_id' => $product_id]);
        // baru input data baru
        $this->db->insert_batch('product_ingredients', $data["ingredients"]);
        return $this->db->affected_rows();
    }
    
    /**
     * DELETE method.
     *
     * @return Response
    */
    public function delete($id)
    {
        $this->db->delete('product_ingredients', array('product_id'=>$id));
        return $this->db->affected_rows();
    }
}
