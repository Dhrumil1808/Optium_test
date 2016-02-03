    <?php
    //header("refresh: 3;");
    ob_start();    //]print_r($product_edit);
    ?>
    <div id="body">

    <a href="http://optium.pe.hu/index.php/products"> <input type="submit" value="Products" name="Products"> Displays the Products Page </a>
    <br/>
    <br/>
    <a href="http://optium.pe.hu/index.php/categories"> <input type="submit" value="categories" name="categories">  Displays the Categories Page </a>
    <br/>
    <br/>
   
    </div>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <script>
    $(document).ready(function()
    {
    	//alert("Yup jquery is working");
    	$(".delete").click(function()
    	{
    		var id_delete=this.id;
    		//alert(id_delete);
    		$("").html('.....');
    		$.ajax({
    			type:"POST",
    			data:"data="+ id_delete,
    			url:"http://optium.pe.hu/index.php/products",
    			success: function(msg)
    			{
    					$("").html(msg)
    			}
    		});


    	});
    });
  
    </script>

	<style>
	a#update
	{
		height:26px;
		width: 58px;
	}
	</style> 

<h2> Products </h2>
<?php if(isset($product) || isset($product_edit))  { echo validation_errors();} ?>
<form name="Products" method="POST" action="" enctype="multipart/form-data" id="products">
<label for="product_name"> Product Name:
<br/>
<input type="text" class="values" name="product_name" id="product_name" value="<?php  if(isset($product_edit[0]['Product_Name'])) { echo $product_edit[0]['Product_Name'];} ?>" />
<br/>
</label>
<label for="product_description"> Product Description:
<br/>
<input type="text" class="values" name="product_description" id="product_description" value="<?php if(isset($product_edit[0]['Product_Description'])) { echo $product_edit[0]['Product_Description'] ;} ?>">
</label>
<br/>
<span id="category"> Category:</span>
<br/>
<select name="category" class="values" id="category"> 
<option value="Select">Select </option>
<?php
//echo $category['Category_ID']; 

if(isset($category))
{
foreach ($category as $query)
{
	if(isset($product_edit) && isset($category_edit) && $query['category_id']== $category_edit[0]['category_id'])
{

	?>
	<option value="<?php echo $category_edit[0]['category_id'] ?> " selected="selected"> <?php echo $category_edit[0]['category_name']; ?></option>
	<?php
}
else
{
?>
	<option value="<?php echo $query['category_id']; ?>  "> <?php echo $query['category_name']; } ?> </option>
	<?php
}
}

?>
</select>
<br/>
<label for="file">Image:
<br/>
<input type="file" name="file" id="file" value="<?php if(isset($result)) { echo set_value('file'); } ?>"> </label>
<br/>
<?php
/*if((isset($product)) && (isset($product_edit)))
{
	?>
	<a href="/CodeIgniter-3.0.4/index.php/products/add_item?data_update=<?php echo $product_edit[0]['Product_ID'] ?>"<input type="submit" name="update" value="update" id="update" /> </a>
	<?php
}*/
 /*else
{
	*/?>
<input type="submit" name="submit" value="submit" id="submit" />
<?php
/*}
 */
?>
</form>



<table class="list">

<tr>
<td> Product ID </td>
<td> </td>
<td>
Product Name
</td>
<td> </td>
<td>
Product Description
</td>
<td> </td>
<td>
Product Image
</td>
<td> </td>
<td> Actions </td>
</tr>
<?php
if(isset($product))
{
foreach ($product AS $query_product)
{
	?>

<tr>
<td><?php echo $query_product['Product_ID'] ;?> </td>
<td> </td>
<td>
<?php echo $query_product['Product_Name']; ?>
</td>
<td> </td>
<td>
<?php echo $query_product['Product_Description']; ?>
</td>
<td> </td>
<td>
<img src="http://optium.pe.hu/<?php echo $query_product['Product_Image']?>" width="50px" height="50px" />
</td>
<td> </td>
<td> <a href="http://optium.pe.hu/index.php/products/product_edit/<?php echo $query_product['Product_ID']?>" class="edit" id="<?php echo $query_product['Product_ID']; ?>"> <span class="glyphicon glyphicon-edit"></span> </a>  <a href="" class="delete" id="<?php echo $query_product['Product_ID'] ?>">
          <span class="glyphicon glyphicon-remove-sign"></span>
        </a> </td>
</tr>
<?php
}
}

?>
</table>
<?php
ob_flush();
?>


