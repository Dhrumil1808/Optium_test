<?php
class category extends MY_Model
{
  function __construct() {

    parent::__construct();

}
  function insert_category($data)
  {
  	 $this->db->insert('category',$data);
  }

 	function edit_category($category_ID,$data)
  {
  	$this->db->where('category_id',$category_ID);
    $result=$this->db->update('category',$data);

    return $result;
  }

 function delete_category($category_ID)
  {
    $this->db->where('category_id',$category_ID);
    $this->db->delete('category');
  }
  function list_category($category_ID)
  {
  $query="SELECT * FROM category WHERE category_id=$category_ID";
  $result=$this->db->query($query);
  return $result;
}

  function list_category_from_name($category_name)
  {
  $query="SELECT * FROM category WHERE category_name=$category_name";
  $result=$this->db->query($query);
  return $result;
}

function subcategory_from_category($category_id)
{
  $query="SELECT * FROM category WHERE category_parent_id=$category_id";
  $result=$this->db->query($query);
  return $result;
}

function category_parent_category($category_parent_id)
{
  $query="SELECT category_name FROM category where category_id=$category_parent_id";
  $result=$this->db->query($query);
  return $result->result_array();
}
	function list_all_categories()
	{
		$query="SELECT * FROM category";
		$result=$this->db->query($query);
		return $result;
	}
  function num_rows()
  {
    $query="SELECT COUNT(*) FROM category";
    $result=$this->db->query($query);
    $results=$result->num_rows();
    return $results;

  }
}
?>