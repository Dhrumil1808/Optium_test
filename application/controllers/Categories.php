<?php

class categories extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('encrypt');
		$this->load->library('upload');
		$this->load->model('product');
	    $this->load->model('category');
		
		$this->form_validation->set_rules('category_name','Category Name','trim|required');
		$this->form_validation->set_rules('category_description','Category Description','trim|required');
		$this->form_validation->set_rules('category_level','Category Level','trim|required|callback_category_level_check');
	}
	public function index()
	{
		
		$num_rows=$this->category->num_rows();
		//echo $num_rows;
		if($num_rows==0)
		{
			echo "Please insert categories.";
			exit;
		}

		$data_category=$this->category->list_all_categories();


		$result['category']=$data_category->result_array();
		
		//print_r($result['category']);
		//echo sizeof($result['category']);
		if(sizeof($result['category'])!=0)
		{
		for($i=0;$i<sizeof($result['category']);$i++)
		{
			$parent[$i]=$result['category'][$i]['category_parent_id'];
			if($parent[$i]==0)
			{
				$name[$i][0]['category_name']='None';
			}
			else
			{
			$name[$i]=$this->category->category_parent_category($parent[$i]);
			}
			
		}
//print_r($name);
	$result['parent_category']=$name;
}
		if(isset($_POST['data']))
		{
			$id=$_POST['data'];
		$this->category->delete_category($id);
		$this->load->view('category',$result);
		}

		
		if ($this->form_validation->run() == FALSE)
		{
			
			$this->load->view('category',$result);
			
		}	
		else
		{
		$data = array( 
        'category_name' => $this->input->post('category_name'),
        'category_parent_id'=>$this->input->post('category_level'),
        'category_description'=> $this->input->post('category_description'),
        );
        
		
		$this->category->insert_category($data);
	
		$this->load->view('category',$result);

	}
		
	}

	public function  category_edit($data_edit)
	{
		$num_rows=$this->category->num_rows();
		$data_category=$this->category->list_all_categories();


		$result['category']=$data_category->result_array();
		
			$id=$data_edit;
			//echo $id;
			$this->load->model('product');
	    $this->load->model('category');
		//$this->load->model('subcategory');
			$select_category=$this->category->list_category($id);

			$result['category_edit']=$select_category->result_array();
			for($i=0;$i<sizeof($result['category']);$i++)
		{
			$parent[$i]=$result['category'][$i]['category_parent_id'];
			if($parent[$i]==0)
			{
				$name[$i][0]['category_name']='None';
			}
			else
			{
			$name[$i]=$this->category->category_parent_category($parent[$i]);
			}
			
		}
//print_r($name);
	$result['parent_category']=$name;
	if(isset($_POST['data']))
		{
			$id=$_POST['data'];
		$this->category->delete_category($id);
		$this->load->view('category',$result);
		}
			if ($this->form_validation->run() == FALSE)
		{
			$result['category']=$data_category->result_array();
		
			$this->load->view('category',$result);
			
		}	
		else
		{
		$data = array( 
      'category_name' => $this->input->post('category_name'),
      'category_parent_id'=>$this->input->post('category_level'),
        'category_description'=> $this->input->post('category_description'),
        );
        	
		$edit_category=$this->category->edit_category($id,$data);
		$this->load->view('category',$result);

		}


	}
		  function category_level_check()
    {
            if ($this->input->post('category_level') === 'Select')  {
            $this->form_validation->set_message('category_level_check', 'Please choose category level.');
            return FALSE;
        }
        else {
            return TRUE;
        }
    }

}
?>