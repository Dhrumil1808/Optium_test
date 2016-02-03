    <?php
   //print_r($parent_category);
    ob_start();


    //header("refresh: 3;");
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
    			url:"http://optium.pe.hu/index.php/categories",
    			success: function(msg)
    			{
    					$("").html(msg)
    			}
    		});


    	});

    });
  
    </script>


<h2> Category </h2>
<?php if(isset($category) || isset($category_edit))  { echo validation_errors();} ?>
<form name="Products" method="POST" action="" enctype="multipart/form-data" id="products">
<label for="product_name"> Category Name:
<br/>
<input type="text" class="values" name="category_name" id="category_name" value="<?php  if(isset($category_edit[0]['category_name'])) { echo $category_edit[0]['category_name'];} ?>" />

</label>
<br/>
<label for="category_level"> Category Level: </label>

<br/>
<select name="category_level" id="category_level"> 
<option value="Select"> Select </option>
<?php if(isset($category_edit) && $category_edit[0]['category_name']==0)
{

    ?>
    <option value="0" selected="selected"> None </option>

    <?php
} 
else
{
?>
<option value="0"> None </option>

<?php
} 
 foreach($category as $query_category)
{    
     if(isset($category_edit) && $query_category['category_id']==$category_edit[0]['category_parent_id'])
{
    ?>
    <option value="<?php echo $category_edit[0]['category_parent_id'] ?>" selected="selected"> <?php echo $query_category['category_name']; ?></option>
    <?php
}
else
{
?>
     <option value="<?php echo $query_category['category_id'] ?>"> <?php echo $query_category['category_name']; ?> </option>
         <?php
}
}
?>

</select>
<br/>
<label for="product_description"> Category Description:
<br/>
<input type="text" class="values" name="category_description" id="category_description" value="<?php if(isset($category_edit[0]['category_description'])) { echo $category_edit[0]['category_description'] ;} ?>">
</label>
<br/>
<input type="submit" name="submit" value="submit" id="submit" />
</form>



<table class="list">

<tr>
<td> Category ID </td>

<td>
Category Name
</td>
<td> </td>
<td>
Category Description
</td>
<td> </td>
<td> Category Level </td>
<td> </td>
<td> Actions </td>
</tr>
<?php
if(isset($category))
{
    $i=-1;
foreach ($category AS $query_category)
{
    $i++;
	?>


<tr>
<td><?php echo $query_category['category_id'] ;?> </td>
<td>
<?php echo $query_category['category_name']; ?>
</td>
<td> </td>
<td>
<?php echo $query_category['category_description']; ?>
</td>

<td> </td>
<td> <?php if(isset($parent_category[$i][0]['category_name']))
{
            echo $parent_category[$i][0]['category_name'];  } ?>
<td> </td>
<td> <a href="http://optium.pe.hu/index.php/categories/category_edit/<?php echo $query_category['category_id']?>" class="edit" id="<?php echo $query_category['category_id']; ?>"> <span class="glyphicon glyphicon-edit"></span> </a>  <a href="" class="delete" id="<?php echo $query_category['category_id'] ?>">
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

