<?php
class Product extends MY_Model
{
  function __construct()
  {
    parent::__construct();
  }
  
 function insert_item($data)
  {
  	//$query="INSERT INTO products(Category_ID', 'Subcategory_ID', 'Product_Name', 'Product_Description', 'Product_Image') VALUES ($category_ID,$subcategory_ID,$product_name,$Product_Description,$product_image)";
  	$this->db->insert('products',$data);

  }

 	function edit_item($product_ID,$data)
  {
  	/*$query="UPDATE products SET Category_ID= $category_ID,Subcategory_ID=$subcategory_ID, Product_Name=$product_name, Product_Description=$Product_Description, Product_Image=$product_image WHERE Product_ID=$product_ID";
  	$result=$this->db->query($query);*/
    $this->db->where('Product_ID',$product_ID);
    $result=$this->db->update('products',$data);

  	return $result;
  }

  function delete_item($product_ID)
  {
  	$this->db->where('Product_ID',$product_ID);
  	$this->db->delete('products');
  }
  function list_item($product_ID)
  {
  $query="SELECT * FROM products WHERE Product_ID=$product_ID";
  $result=$this->db->query($query);
  return $result;
}
	function list_all_items()
	{
		$query="SELECT * FROM products";
		$result=$this->db->query($query);
		return $result;
	}

}
?>