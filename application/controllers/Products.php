<?php
ob_start();
class products extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('encrypt');
		$this->load->library('upload');
		$this->load->model('product');
	    $this->load->model('category');		
	    $this->form_validation->set_rules('product_name','Product Name','trim|required');
		$this->form_validation->set_rules('product_description','Product Description','trim|required');
		$this->form_validation->set_rules('category','Category','trim|required|callback_category_check');
		//$this->form_validation->set_rules('subcategory','SubCategory','trim|required|callback_subcategory_check');
		$this->form_validation->set_rules('file','Image','trim|callback_image_check');
	}
	public function index()
	{

		$data=$this->category->list_all_categories();
		
		$data_product=$this->product->list_all_items();
		$result['product']=$data_product->result_array();
		$result['category']=$data->result_array();
		
		if(isset($_POST['data']))
		{
			$id=$_POST['data'];
			
		$this->product->delete_item($id);
		$data=$this->category->list_all_categories();
		//$data_sub=$this->subcategory->list_all_subcategories();
		$data_product=$this->product->list_all_items();
		$result['product']=$data_product->result_array();
		$result['category']=$data->result_array();
		}
		
		if ($this->form_validation->run() == FALSE)
		{
			$result['product']=$data_product->result_array();
		$result['category']=$data->result_array();

			$this->load->view('product',$result);
			
		}	
		else
		{
		$data = array( 
        'Product_Name' => $this->input->post('product_name'),
        'Product_Description'=> $this->input->post('product_description'),
        'Category_ID' => $this->input->post('category'),
        'Product_Image'  =>'upload/'.$_FILES['file']['name']
        );
        	 $uploaddir = 'upload/';
            $uploadfile = $uploaddir.basename($_FILES['file']['name']);
            move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile);
           
		$this->product->insert_item($data);
	
		$this->load->view('product',$result);

	}
		
		
	}

	public function product_edit($data_edit)
	{
		
		$data=$this->category->list_all_categories();
		
		$data_product=$this->product->list_all_items();
		$result['product']=$data_product->result_array();
		$result['category']=$data->result_array();
			$id=$data_edit;
			$this->load->model('product');
	    $this->load->model('category');
			$select_product=$this->product->list_item($id);

			$result['product_edit']=$select_product->result_array();
			if(sizeof($result['product_edit']) !=0)
			{
			$category_id=$result['product_edit'][0]['Category_ID'];
			$select_category=$this->category->list_category($category_id);
			$result['category_edit']=$select_category->result_array();

		}

			if(isset($_POST['data']))
		{
			$id=$_POST['data'];
		$this->product->delete_item($id);
		$data=$this->category->list_all_categories();
		$data_product=$this->product->list_all_items();
		$result['product']=$data_product->result_array();
		$result['category']=$data->result_array();
		}
			if ($this->form_validation->run() == FALSE)
		{
		$result['product']=$data_product->result_array();
		$result['category']=$data->result_array();
			$this->load->view('product',$result);
			
		}	
		else
		{
		$data = array( 
        'Product_Name' => $this->input->post('product_name'),
        'Product_Description'=> $this->input->post('product_description'),
        'Category_ID' => $this->input->post('category'),
        'Product_Image'  =>'upload/'.$_FILES['file']['name']
        );
        	 $uploaddir = 'upload/';
            $uploadfile = $uploaddir.basename($_FILES['file']['name']);
            move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile);
            
		$edit_product=$this->product->edit_item($id,$data);
		$this->load->view('product',$result);

		}
	
	}

		  public function category_check()
    {
            if ($this->input->post('category') === 'Select')  {
            $this->form_validation->set_message('category_check', 'Please choose your category.');
            return FALSE;
        }
        else {
            return TRUE;
        }
    }
      public function subcategory_check()
    {
            if ($this->input->post('subcategory') === 'Select')  {
            $this->form_validation->set_message('subcategory_check', 'Please choose your subcategory.');
            return FALSE;
        }
        else {
            return TRUE;
        }
    }
      public function image_check()
    {
    	//echo $_FILES['file']['name'];
    	$str=explode(".",$_FILES['file']['name']);

    			if(!isset($str[1]))
    			{
    				$this->form_validation->set_message('image_check', 'Please choose image.');
    				return FALSE;
    			}
    			else
    			{
           if ($str[1]==='jpg'||'png'||'jpeg'||'gif')
                {
                	return TRUE;
 
                	 }
                else
                {
                    $this->form_validation->set_message('image_check', 'Please choose valid image.');
                	return FALSE;
               
                        
                }
    }
}

}
ob_flush();
?>