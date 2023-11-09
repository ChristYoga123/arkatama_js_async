<?php

/* Table structure for table `products` */
// CREATE TABLE `products` (
//   `id` int(10) UNSIGNED NOT NULL,
//   `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
//   `price` double NOT NULL,
//   `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
//   `updated_at` datetime DEFAULT NULL
// ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
// ALTER TABLE `products` ADD PRIMARY KEY (`id`);
// ALTER TABLE `products` MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1; COMMIT;

/**
 * Product class.
 * 
 * @extends REST_Controller
 */
   require APPPATH . '/libraries/REST_Controller.php';
   use Restserver\Libraries\REST_Controller;
     
class Ingredients extends REST_Controller {
    
	  /**
     * CONSTRUCTOR | LOAD MODEL
     *
     * @return Response
    */
    public function __construct() {
       parent::__construct();
       $this->load->library('Authorization_Token');	
       $this->load->model('Ingredient_model');
    }
       
    /**
     * SHOW | GET method.
     *
     * @return Response
    */
	public function index_get($id)
	{
        // ------- Main Logic part -------
        $data = $this->Ingredient_model->getByProductId($id);
        if($data)
        {
            $final["message"] = "Berhasil mendapatkan data bahan baku";
            $final["data"] = $data;
            $this->response($final, REST_Controller::HTTP_OK);
        } else
        {
            $final["message"] = "Produk belum memiliki bahan baku";
            $final["data"] = null;
            $this->response($final, REST_Controller::HTTP_NOT_FOUND);
        }
        // ------------- End -------------
	}
      
    /**
     * INSERT | POST method.
     *
     * @return Response
    */
    public function index_post()
    {
        $data = $this->post();
        // ------- Main Logic part -------
        $result = $this->Ingredient_model->create($data);
        if($result > 0)
        {
            $final["message"] = "Post bahan sukses";
            $final["data"] = $result;
    
            $this->response($final, REST_Controller::HTTP_CREATED);
        } else {
            $final["message"] = "Post bahan gagal";
            $final["data"] = null;
    
            $this->response($final, REST_Controller::HTTP_BAD_REQUEST);
        }
        // ------------- End -------------
    } 
     
    /**
     * DELETE method.
     *
     * @return Response
    */
    public function index_delete($id)
    {
        // ------- Main Logic part -------
        $res = $this->Ingredient_model->getByProductId($id);
        if($res)
        {
            $this->Ingredient_model->delete($id);
            $final["message"] = "Delete bahan sukses";
            $this->response($final, REST_Controller::HTTP_OK);
        } else 
        {
            $final["message"] = "ID tidak ditemukan";
            $final["data"] = null;
    
            $this->response($final, REST_Controller::HTTP_NOT_FOUND);
        }
        // ------------- End -------------
    }
    	
}