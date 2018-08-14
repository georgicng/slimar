<?php
ob_start();
$admin = true;
require "../inc/config.php";

//This will be required for the active page in navigation
$pagename = "manage_menus";
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
<link rel="stylesheet" href="css/bootstrap-iconpicker.min.css">
<script src="js/jquery-1.11.1.min.js"></script>
</head>

<body>
	<?php include "inc/header.php"; ?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="index.php"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
				<li><a href="manage_menus.php"> Manage Menus</a></li>
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
					<div class="panel-heading">Add new Menu</div>
					<div class="panel-body">
                        <?php
                        //Post comment
                        if (isset($_POST["addmenu"])) {
                            if ($in["username"]) {
                                $name = $_POST['menu_name'];
                                $position = $_POST['menu_position'];
                                
                                
                                activitylog(''.$in['username'].'', 'created a menu', ''.time().'');
                                $stmt = $dbh->prepare("INSERT INTO menus (name, position, status) VALUES (:name, :position, '1')");
                                $stmt->bindParam(':name', $name);
                                $stmt->bindParam(':position', $position);
                                
                                $stmt->execute();
                            }
                        } ?>
						<form method="post">
							<div class="form-group">
								<input type="text" name="menu_name" placeholder="Menu Name" class="form-control"></input>
                            </div>
                            <div class="form-group">
                                <select name="menu_position" class="form-control">
                                    <option value="*">Select Menu Location</option>
                                    <option value="header">Header</option>
                                    <option value="main">Main</option>
                                    <option value="footer">Footer</option>
                                </select>
                             </div>
                            <input type="submit" style="float:left;"class="btn btn-primary" value="Add Menu" name="addmenu">
						</form>
					</div>
				</div>
			</div>
		</div><!--/.row-->
        <div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Manage Menus</div>
					<div class="panel-body">
						<table class="table">
							<thead>
						    <tr>
						        <th>ID</th>
						        <th>Name</th>
                                <th>Position</th>
						        <th>Status</th>
								<th>Edit</th>
						    </tr>
						    </thead>
							<?php
                            $sql = "SELECT * FROM menus ORDER BY id asc";
        $stm = $dbh->prepare($sql);
        $stm->execute();
        $u = $stm->fetchAll();
                                                
        $count = 0;
        foreach ($u as $ug) {
            ?>
							<tr>
								<td><?php echo $ug['id']; ?></td>
						        <td><?php echo $ug['name']; ?></td>
								<td><?php echo $ug['position']; ?></td>
						        <td>
								<?php if ($ug['status'] == "1") {
                ?><span class='label label-success'>Active</span><?php
            } else {
                ?><span class='label label-default'>Inactive</span><?php
            } ?>
								</td>
						        
								<td>
									<a href='manage_menus.php?p=edit&id=<?php echo $ug['id']; ?>' class='btn btn-primary btn-xs'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Edit</a> 
									<a href='manage_menus.php?p=delete&id=<?php echo $ug['id']; ?>' class='btn btn-danger btn-xs'><i class='fa fa-times' aria-hidden='true'></i> Delete</a> </td>
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
        $stmt1 = $dbh->prepare("SELECT * FROM menus WHERE `id` = :id");
        $stmt1->bindValue(':id', $_GET['id']);
        $stmt1->execute();
        $menu = $stmt1->fetch();
        error_log(json_encode($_POST));
            
        if (isset($_POST['updatemenu'])) {
            $currenturl = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}";
            activitylog(''.$in['username'].'', 'updated menu '.$menu['name'].'', ''.time().'', 'Admin');
            $sql = "UPDATE menus SET name='".$_POST['name']."', status='".$_POST['status']."', position='".$_POST['position']."', content='".htmlentities($_POST['content'])."' WHERE id=".$menu['id']."";
            error_log('sql: ', $sql);
            $query = $dbh->prepare($sql);
            $query->execute();
            $success = "Menu updated";
            header("location: manage_menus.php");
        } ?>
		

        <div class="row">
            <div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Edit Menu: <?php echo $menu['name']; ?></div>
					<div class="panel-body">
                    <div class="row">
                            <div class="col-md-4">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">Add Menu Item</div>
                                    <div class="panel-body">
                                        <form id="frmEdit" class="form-horizontal">
                                            <input type="hidden" name="mnu_icon" id="mnu_icon">
                                            <div class="form-group">
                                                <label for="mnu_text" class="col-sm-2 control-label">Text</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control item-menu" id="mnu_text" name="mnu_text" placeholder="Text">
                                                        <div class="input-group-btn">
                                                            <button id="mnu_iconpicker" class="btn btn-default" data-iconset="fontawesome" data-icon="" type="button"></button>
                                                        </div>
                                                        <input type="hidden" name="icon" class="item-menu">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="mnu_href" class="col-sm-2 control-label">URL</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control item-menu" id="mnu_href" name="mnu_href" placeholder="URL">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="mnu_target" class="col-sm-2 control-label">Target</label>
                                                <div class="col-sm-10">
                                                    <select id="mnu_target" name="mnu_target" class="form-control item-menu">
                                                    <option value="_self">Self</option>
                                                    <option value="_blank">Blank</option>
                                                    <option value="_top">Top</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="mnu_title" class="col-sm-2 control-label"><a href="https://www.jqueryscript.net/tooltip/">Tooltip</a></label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control item-menu" id="mnu_title" name="mnu_title" placeholder="Text">
                                                </div>
                                            </div>                                            
                                        </form>
                                    </div>
                                    <div class="panel-footer">
                                        <button type="button" id="btnUpdate" class="btn btn-primary" disabled><i class="fa fa-refresh"></i> Update</button>
                                        <button type="button" id="btnAdd" class="btn btn-success"><i class="fa fa-plus"></i> Add</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="panel panel-default">
                                    <div class="panel-heading clearfix">
                                        <h5 class="pull-left">Create/Edit Menu</h5>
                                        <div class="pull-right">
                                            <button id="btnOut" type="button" class="btn btn-success"> <i class="glyphicon glyphicon-ok"></i> Save</button>
                                        </div>
                                    </div>
                                    <div class="panel-body" id="cont">
                                        <ul id="menuList" class="sortableLists list-group">                                               
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>					
                        <form id="frmMenu" method="post">
                            <div class="form-group">
                                <label>Menu Title</label>
                                <input type="text" name="name" value="<?php echo $menu['name']; ?>" class="form-control"></input>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label>Menu Position</label>
                                <select name="position" class="form-control">
                                <option value="*">Select Menu Location</option>
                                <option <?php if ($menu['position'] == "header") {
            echo 'selected';
        } ?> value="header">Header</option>
                                <option <?php if ($menu['position'] == "main") {
            echo 'selected';
        } ?> value="main">Main</option>
                                <option <?php if ($menu['position'] == "footer") {
            echo 'selected';
        } ?> value="footer">Footer</option>
                                </select>
                            </div>                            
                            <hr>
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option <?php if ($menu['status'] == "1") {
            echo 'selected';
        } ?> value="1">Active</option>
                                    <option <?php if ($menu['status'] == "0") {
            echo 'selected';
        } ?> value="0">Inactive</option>
                                </select>
                            </div>
                            <input type="hidden" name="content" id="content" value="<?php echo $menu['content']? $menu['content']: '[]' ?>"/>
                            <input type="hidden" name="updatemenu" value="1">
                            <input type="submit" value="Update Menu" class="btn btn-primary" style="float:left;" />
                        </form>                        
					</div>
				</div>
			</div>
        </div>
        <script>
             $(document).ready(function() {
                // icon picker options
                var iconPickerOpt = {};

                // menu builder options
                var options = {
                    hintCss: {'border': '1px dashed #13981D'},
                    placeholderCss: {'background-color': 'gray'},
                    ignoreClass: 'btn',
                    opener: {
                        active: true,
                        as: 'html',
                        close: '<i class="fa fa-minus"></i>',
                        open: '<i class="fa fa-plus"></i>',
                        openerCss: {'margin-right': '10px'},
                        openerClass: 'btn btn-success btn-xs'
                    }
                };

                // initialize the menu builder
                editor = new MenuEditor('menuList', {
                    listOptions: options, 
                    iconPicker: iconPickerOpt, 
                    labelEdit: 'Edit', 
                    labelRemove: 'X'
                });
                //[{"href":"http://home.com","icon":"fa fa-home","text":"Home"},{"icon":"fa fa-bar-chart-o","text":"Opcion2"},{"icon":"fa fa-cloud-upload","text":"Opcion3"},{"icon":"fa fa-crop","text":"Opcion4"},{"icon":"fa fa-flask","text":"Opcion5"},{"icon":"fa fa-search","text":"Opcion7","children":[{"icon":"fa fa-plug","text":"Opcion7-1","children":[{"icon":"fa fa-filter","text":"Opcion7-2","children":[{"icon":"fa fa-map-marker","text":"Opcion6"}]}]}]}];
                var arrayJson = $('#content').val();

                editor.setData(arrayJson);

                editor.setForm($('#frmEdit'));
                editor.setUpdateButton($('#btnUpdate'));                
                
                $("#btnUpdate").click(function(){
                    editor.update();
                });
                $('#btnAdd').click(function(){
                    editor.add();
                });


                //var str = editor.getString();
                //$("#myTextarea").text(str);
                $('#frmMenu').submit(function() {
                    console.log('menu: ', editor.getString());
                    menu = editor.getString();
                    $("#content").val(menu);
                });

                $('#btnOut').on('click', function () {
                    $("#frmMenu").submit();
                });
            });
        </script>

        <?php
    } ?>
		<?php if ($menu == "delete") {
        //Gathers users
        $stmt1 = $dbh->prepare("SELECT * FROM menus WHERE `id` = :id");
        $stmt1->bindValue(':id', $_GET['id']);
        $stmt1->execute();
        $menu = $stmt1->fetch();
            
        if ($_POST['deletemenu']) {
            activitylog(''.$in['username'].'', 'deleted menu: '.$menu['title'].'', ''.time().'', 'Admin');
                
            $sql = "DELETE FROM `menus` WHERE id = '".$menu["id"]."'";
            $dbh->exec($sql);
            header("location: manage_menus.php");
        } ?>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Delete <?php echo $menu['title']; ?></div>
					<div class="panel-body">
					<form method="post">
					<div class="form-group">
				<label for="viewmenu">Are you sure you would like to delete this menu? This can not be undone!!<br />
					
				</label>
			  </div>
			  <input type="submit" style="float:left;margin-right:10px;"class="btn btn-primary" value="Delete Menu" name="deletemenu"> 
				 <a class="btn btn-primary" href="manage_menus.php">Cancel</a>
					</form>	
					</div>
				</div>
			</div>
		</div><!--/.row-->
		<?php
    } ?>
		          
    </div>	<!--/.main-->

    
    <script src="js/bootstrap.min.js"></script>
    <script src='js/iconset/iconset-fontawesome-4.7.0.min.js'></script>
    <script src='js/bootstrap-iconpicker.js'></script>
    <script src='js/jquery-menu-editor.min.js'></script>

    <script>
        !function ($) {
            $(document).on("click","ul.nav li.parent > a > span.icon", function(){		  
                $(this).find('em:first').toggleClass("glyphicon-minus");	  
            }); 
            $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
        }(window.jQuery);

        $(window).on('resize', function () {
            if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
        });

        $(window).on('resize', function () {
            if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
        });

    </script>	
</body>

</html>
