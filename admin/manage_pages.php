<?php
ob_start();
$admin = true;
require "../inc/config.php";

//This will be required for the active page in navigation
$pagename = "manage_pages";
//Sets last active time for forums [This is to check if the user is online or not]

if (!$in_perm['has_admin']) {
    header("location: ../index.php");
    exit;
}

$p = $_GET['p'];
if (empty($_GET['p'])) {
    $page = "home";
} else {
    $page = $p;
}
?>

<!DOCTYPE html>
<html>
<head>
<?php include "inc/head.php"; ?>
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
</head>

<body>
	<?php include "inc/header.php"; ?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="index.php"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
				<li><a href="manage_pages.php"> Manage Pages</a></li>
			</ol>
		</div><!--/.row-->
		<br>
		<?php if ($_GET['success'] == "user") {
    ?>
		<div class="alert bg-success" role="alert">
					<svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg> category successfully updated</a>
		</div>
		<?php
} ?>
		
		<?php if ($page == "home") {
        ?>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Add new Page</div>
					<div class="panel-body">
					<?php
                    //Post comment
                    if (isset($_POST["addpage"])) {
                        if ($in["username"]) {
                            $title = $_POST['page_title'];
                            $content = $_POST['page_content'];
                            $slug = $_POST['page_slug'];
                            
                            
                            activitylog(''.$in['username'].'', 'created a page', ''.time().'');
                            $stmt = $dbh->prepare("INSERT INTO pages (title, slug, content, status) VALUES (:title, :slug, :content, '1')");
                            $stmt->bindParam(':title', $title);
                            $stmt->bindParam(':slug', $slug);
                            $stmt->bindParam(':content', $content);
                            
                            $stmt->execute();
                        }
                    } ?>
						<form method="post">
							<div class="form-group">
								<input type="text" name="page_title" placeholder="Page title" class="form-control"></input>
                            </div>
                            <div class="form-group">
								 <input type="text" name="page_slug" placeholder="Page permalink" class="form-control"></input>
                             </div>
                            <div class="form-group">
                                <textarea id="summernote" name="page_content"></textarea>
							</div>
                            <input type="submit" style="float:left;"class="btn btn-primary" value="Add Page" name="addpage">
						</form>
					</div>
				</div>
			</div>
		</div><!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Manage Pages</div>
					<div class="panel-body">
						<table class="table">
							<thead>
						    <tr>
						        <th>ID</th>
						        <th>Title</th>
                                <th>Slug</th>
						        <th>Status</th>
								<th>Edit</th>
						    </tr>
						    </thead>
							<?php
                            $sql = "SELECT * FROM pages ORDER BY id asc";
        $stm = $dbh->prepare($sql);
        $stm->execute();
        $u = $stm->fetchAll();
                            
        $count = 0;
        foreach ($u as $ug) {
            ?>
							<tr>
								<td><?php echo $ug['id']; ?></td>
						        <td><?php echo $ug['title']; ?></td>
								<td><?php echo $ug['slug']; ?></td>
						        <td>
								<?php if ($ug['status'] == "1") {
                ?><span class='label label-success'>Active</span><?php
            } else {
                ?><span class='label label-default'>Inactive</span><?php
            } ?>
								</td>
						        
								<td>
									<a href='manage_pages.php?p=edit&id=<?php echo $ug['id']; ?>' class='btn btn-primary btn-xs'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Edit</a> 
									<a href='manage_pages.php?p=delete&id=<?php echo $ug['id']; ?>' class='btn btn-danger btn-xs'><i class='fa fa-times' aria-hidden='true'></i> Delete</a> </td>
							</tr>
							<?php
        } ?>
						</table>
					</div>
				</div>
			</div>
		</div><!--/.row-->
		<?php
    } ?>

		<?php if ($page == "edit") {
        //Gathers users permissions
        $stmt1 = $dbh->prepare("SELECT * FROM pages WHERE `id` = :id");
        $stmt1->bindValue(':id', $_GET['id']);
        $stmt1->execute();
        $page = $stmt1->fetch();
            
            
        if (isset($_POST['updatepage'])) {
            $currenturl = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}";
            activitylog(''.$in['username'].'', 'updated page '.$page['title'].'', ''.time().'', 'Admin');
                    
            $sql = $dbh->prepare("UPDATE pages SET title='".$_POST['title']."', status='".$_POST['status']."', slug='".$_POST['slug']."', content='".$_POST['content']."' WHERE id=".$page['id']."");
            $sql->execute();
            $success = "Page updated";
            header("location: manage_pages.php");
        } ?>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Edit Page: <?php echo $page['title']; ?></div>
					<div class="panel-body">
					
						<form method="post">
							<div class="form-group">
								<label>Page Title</label>
								<input type="text" name="title" value="<?php echo $page['title']; ?>" class="form-control"></input>
							</div>
							<hr>
                            <div class="form-group">
								<label>Page Slug</label>
								<input type="text" name="slug" value="<?php echo $page['slug']; ?>" class="form-control"></input>
							</div>
							<hr>
                            <div class="form-group">
								<label>Content</label>
                                <textarea id="summernote" name="content"><?php echo $page['content']; ?></textarea>
							</div>
							<hr>
							<div class="form-group">
								<label>Status</label>
								<select name="status" class="form-control">
									<option <?php if ($page['status'] == "1") {
            echo 'selected';
        } ?> value="1">Active</option>
									<option <?php if ($page['status'] == "0") {
            echo 'selected';
        } ?> value="0">Inactive</option>
								</select>
							</div>
							
							
							
							 <input type="submit" style="float:left;"class="btn btn-primary" value="Update Page" name="updatepage">
						</form>
					</div>
				</div>
			</div>
		</div><!--/.row-->

		<?php
    } ?>
		<?php if ($page == "delete") {
        //Gathers users
        $stmt1 = $dbh->prepare("SELECT * FROM pages WHERE `id` = :id");
        $stmt1->bindValue(':id', $_GET['id']);
        $stmt1->execute();
        $page = $stmt1->fetch();
            
        if ($_POST['deletepage']) {
            activitylog(''.$in['username'].'', 'deleted page: '.$page['title'].'', ''.time().'', 'Admin');
                
            $sql = "DELETE FROM `pages` WHERE id = '".$page["id"]."'";
            $dbh->exec($sql);
            header("location: manage_pages.php");
        } ?>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Delete <?php echo $page['title']; ?></div>
					<div class="panel-body">
					<form method="post">
					<div class="form-group">
				<label for="viewpage">Are you sure you would like to delete this page? This can not be undone!!<br />
					
				</label>
			  </div>
			  <input type="submit" style="float:left;margin-right:10px;"class="btn btn-primary" value="Delete Page" name="deletepage"> 
				 <a class="btn btn-primary" href="manage_pages.php">Cancel</a>
					</form>	
					</div>
				</div>
			</div>
		</div><!--/.row-->
		<?php
    } ?>
		
	</div>	<!--/.main-->

	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
	
	<script>
		!function ($) {
			$(document).on("click","ul.nav li.parent > a > span.icon", function(){		  
				$(this).find('em:first').toggleClass("glyphicon-minus");	  
			}); 
			$(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
		}(window.jQuery);

		$(window).on('resize', function () {
		  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		})
		$(window).on('resize', function () {
		  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		})

        $(document).ready(function() {
            $('#summernote').summernote();
        });
	</script>	
</body>

</html>
