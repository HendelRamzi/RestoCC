<?php
    ob_start();
	session_start();

	$pageTitle = 'Users';

	if(isset($_SESSION['username_restaurant_qRewacvAqzA']) && isset($_SESSION['password_restaurant_qRewacvAqzA']))
	{
		include 'connect.php';
  		include 'Includes/functions/functions.php'; 
		include 'Includes/templates/header.php';
		include 'Includes/templates/navbar.php';

        ?>

            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

            <script type="text/javascript">

                var vertical_menu = document.getElementById("vertical-menu");


                var current = vertical_menu.getElementsByClassName("active_link");

                if(current.length > 0)
                {
                    current[0].classList.remove("active_link");   
                }
                
                vertical_menu.getElementsByClassName('users_link')[0].className += " active_link";

            </script>

            <style type="text/css">

                .menus-table
                {
                    -webkit-box-shadow: 0 .15rem 1.75rem 0 rgba(58,59,69,.15)!important;
                    box-shadow: 0 .15rem 1.75rem 0 rgba(58,59,69,.15)!important;
                }

                .thumbnail>img 
                {
                    width: 100%;
                    object-fit: cover;
                    height: 300px;
                }

                .thumbnail .caption 
                {
                    padding: 9px;
                    color: #333;
                }

                .menu_form
                {
                    max-width: 750px;
                    margin:auto;
                }

                .panel-X
                {
                    border: 0;
                    -webkit-box-shadow: 0 1px 3px 0 rgba(0,0,0,.25);
                    box-shadow: 0 1px 3px 0 rgba(0,0,0,.25);
                    border-radius: .25rem;
                    position: relative;
                    display: -webkit-box;
                    display: -ms-flexbox;
                    display: flex;
                    -webkit-box-orient: vertical;
                    -webkit-box-direction: normal;
                    -ms-flex-direction: column;
                    flex-direction: column;
                    min-width: 0;
                    word-wrap: break-word;
                    background-color: #fff;
                    background-clip: border-box;
                    margin: auto;
                    width: 600px;
                }

                .panel-header-X 
                {
                    display: -webkit-box;
                    display: -ms-flexbox;
                    display: flex;
                    -webkit-box-pack: justify;
                    -ms-flex-pack: justify;
                    justify-content: space-between;
                    -webkit-box-align: center;
                    -ms-flex-align: center;
                    align-items: center;
                    padding-left: 1.25rem;
                    padding-right: 1.25rem;
                    border-bottom: 1px solid rgb(226, 226, 226);
                }

                .save-header-X 
                {
                    display: -webkit-box;
                    display: -ms-flexbox;
                    display: flex;
                    -webkit-box-align: center;
                    -ms-flex-align: center;
                    align-items: center;
                    -webkit-box-pack: justify;
                    -ms-flex-pack: justify;
                    justify-content: space-between;
                    min-height: 65px;
                    padding: 0 1.25rem;
                    background-color: #f1fafd;
                }

                .panel-header-X>.main-title 
                {
                    font-size: 18px;
                    font-weight: 600;
                    color: #313e54;
                    padding: 15px 0;
                }

                .panel-body-X
                {
                    padding: 1rem 1.25rem;
                }

                .save-header-X .icon
                {
                    width: 20px;
                    text-align: center;
                    font-size: 20px;
                    color: #5b6e84;
                    margin-right: 1.25rem;
                }
            </style>

        <?php

            $do = '';

            if(isset($_GET['do']) && in_array(htmlspecialchars($_GET['do']), array('Add','Edit')))
                $do = $_GET['do'];
            else
                $do = 'Manage';

            if($do == "Manage")
            {
                $stmt = $con->prepare("SELECT * FROM users");
                $stmt->execute();
                $users = $stmt->fetchAll();

            ?>
                <div class="card">
                    <div class="card-header">
                        <?php echo $pageTitle; ?>
                    </div>
                    <div class="card-body">

                        <!-- ADD NEW MENU BUTTON -->

                        <div class="above-table" style="margin-bottom: 1rem!important;">
                            <a href="user2.php?do=Add" class="btn btn-success">
                                <i class="fa fa-plus"></i> 
                                <span>Add new User</span>
                            </a>
                        </div>

                        <!-- MENUS TABLE -->



                        <table class="table table-bordered users-table">
                            <thead>
                                <tr>
                                    <th scope="col">Username</th>
                                    <th scope="col">E-mail</th>
                                    <th scope="col">Full Name</th>
                                    <th scope="col">Manage</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach($users as $user)
                                    {
                                        echo "<tr>";
                                            echo "<td>";
                                                echo $user['username'];
                                            echo "</td>";
                                            echo "<td>";
                                                echo $user['email'];
                                            echo "</td>";
                                            echo "<td>";
                                                echo $user['full_name'];
                                            echo "</td>";
                                            echo "<td>" ; 
                                                $delete_data = "delete_".$user["user_id"];
                                                $view_data = "view_".$user["user_id"];
                                                ?>
                                                    <ul class="list-inline m-0">
        
                                                        <!-- EDIT BUTTON -->
        
                                                        <li class="list-inline-item" data-toggle="tooltip" title="Edit">
                                                            <button class="btn btn-success btn-sm rounded-0">
                                                                <a href="user2.php?do=Edit&user_id=<?php echo $user['user_id']; ?>" style="color: white;">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                            </button>
                                                        </li>   
        
                                                        <!-- DELETE BUTTON -->
        
                                                        <li class="list-inline-item" data-toggle="tooltip" title="Delete">
                                                            <button class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="modal" data-target="#<?php echo $delete_data; ?>" data-placement="top"><i class="fa fa-trash"></i>
                                                            </button>
        
                                                            <!-- Delete Modal -->
        
                                                            <div class="modal fade" id="<?php echo $delete_data; ?>" tabindex="-1" role="dialog" aria-labelledby="<?php echo $delete_data; ?>" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">Delete User</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            Are you sure you want to delete this User "<?php echo strtoupper($user['username']); ?>"?
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                            <button type="button" data-id = "<?php echo $user['user_id']; ?>" class="btn btn-danger delete_menu_bttn">Delete</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                <?php
                                            
                                            echo "</td>";
                                        echo "</tr>";
                                    }
                                ?>
                            </tbody>
                        </table>  
                    </div>
                </div>
            <?php
            }

            /*** ADD NEW MENU SCRIPT ***/

            elseif($do == 'Add')
            {
                ?>

                    <div class="card">
                        <div class="card-header">
                            Add New User
                        </div>
                        <div class="card-body">
                            <form method="POST" class="menu_form" action="user2.php?do=Add" enctype="multipart/form-data">
                                <div class="panel-X">
                                    <div class="panel-header-X">
                                        <div class="main-title">
                                            Add New User
                                        </div>
                                    </div>
                                    <div class="save-header-X">
                                        <div style="display:flex">
                                            <div class="icon">
                                                <i class="fa fa-sliders-h"></i>
                                            </div>
                                            <div class="title-container">User details</div>     
                                        </div>
                                        <div class="button-controls">
                                            <button type="submit" name="add_new_user" class="btn btn-primary">Save User</button>
                                        </div>
                                    </div>
                                    <div class="panel-body-X">

                                        <!-- user NAME INPUT -->

                                        <div class="form-group">
                                            <label for="user_name">User Name</label>
                                            <input type="text" class="form-control" onkeyup="this.value=this.value.replace(/[^\sa-zA-Z]/g,'');" value="<?php echo (isset($_POST['user_name']))?htmlspecialchars($_POST['user_name']):'' ?>" placeholder="User Name" name="user_name">
                                            <?php
                                                $flag_add_menu_form = 0;

                                                if(isset($_POST['add_new_user']))
                                                {
                                                    if(empty(test_input($_POST['user_name'])))
                                                    {
                                                        ?>
                                                            <div class="invalid-feedback" style="display: block;">
                                                                Menu name is required.
                                                            </div>
                                                        <?php

                                                        $flag_add_menu_form = 1;
                                                    }
                                                    
                                                }
                                            ?>
                                        </div>
                                        
                                        <!-- User Email INPUT -->
                                        
                                        <div class="form-group">
                                            <label for="user_email">User Email</label>
                                            <input type="text" class="form-control"  value="<?php echo (isset($_POST['user_email']))?htmlspecialchars($_POST['user_email']):'' ?>" placeholder="User email" name="user_email">
                                            <?php
                                                $flag_add_menu_form = 0;

                                                if(isset($_POST['add_new_user']))
                                                {
                                                    if(empty(test_input($_POST['user_email'])))
                                                    {
                                                        ?>
                                                            <div class="invalid-feedback" style="display: block;">
                                                                User email is required.
                                                            </div>
                                                        <?php

                                                        $flag_add_menu_form = 1;
                                                    }
                                                    
                                                }
                                            ?>
                                        </div>

                                        <!-- User Fullname INPUT -->

                                        <div class="form-group">
                                            <label for="user_fullname">User fullname</label>
                                            <textarea class="form-control" name="user_fullname" style="resize: none;"><?php echo (isset($_POST['user_fullname']))?htmlspecialchars($_POST['user_fullname']):''; ?></textarea>
                                            <?php

                                                if(isset($_POST['add_new_user']))
                                                {
                                                    if(empty(test_input($_POST['user_fullname'])))
                                                    {
                                                        ?>
                                                            <div class="invalid-feedback" style="display: block;">
                                                                User fullname is required.
                                                            </div>
                                                        <?php

                                                        $flag_add_menu_form = 1;
                                                    }
                                                    elseif(strlen(test_input($_POST['user_fullname'])) > 50)
                                                    {
                                                        ?>
                                                            <div class="invalid-feedback" style="display: block;">
                                                                The length of the description should be less than 200 letters.
                                                            </div>
                                                        <?php

                                                        $flag_add_menu_form = 1;
                                                    }
                                                }
                                            ?>
                                        </div>

                                        <!-- MENU PRICE INPUT -->

                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control"  placeholder="password" name="password">
                                            <?php

                                                if(isset($_POST['add_new_user']))
                                                {
                                                    if(empty(test_input($_POST['password'])))
                                                    {
                                                        ?>
                                                            <div class="invalid-feedback" style="display: block;">
                                                                menu price is required.
                                                            </div>
                                                        <?php

                                                        $flag_add_menu_form = 1;
                                                    }
                                                }
                                            ?>
                                        </div>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                <?php

                /*** ADD NEW menu ***/

                if(isset($_POST['add_new_user']) && $_SERVER['REQUEST_METHOD'] == 'POST' && $flag_add_menu_form == 0)
                {
                    $username = test_input($_POST['user_name']);
                    $email = test_input($_POST['user_email']) ;
                    $password = test_input($_POST['password']);
                    $full_name = test_input($_POST['user_fullname']);
                    $hashedPass = sha1($password);
                    // move_uploaded_file($_FILES['menu_image']['tmp_name'],"Uploads/images//".$image);

                    try
                    {
                        $stmt = $con->prepare("insert into users(username,email,full_name,password) values(?,?,?,?) ");
                        $stmt->execute(array($username,$email,$full_name,$hashedPass));
                        
                        ?> 
                            <!-- SUCCESS MESSAGE -->

                            <script type="text/javascript">
                                swal("New User","The new User has been inserted successfully", "success").then((value) => 
                                {
                                    window.location.replace("user2.php");
                                });
                            </script>

                        <?php

                    }
                    catch(Exception $e)
                    {
                        echo 'Error occurred: ' .$e->getMessage();
                    }
                    
                }
            }

            elseif($do == 'Edit')
            {
                $user_id = (isset($_GET['user_id']) && is_numeric($_GET['user_id']))?intval($_GET['user_id']):0;

                if($user_id)
                {
                    $stmt = $con->prepare("Select * from users where user_id = ?");
                    $stmt->execute(array($user_id));
                    $user = $stmt->fetch();
                    $count = $stmt->rowCount();

                    if($count > 0)
                    {
                        ?>

                        <div class="card">
                            <div class="card-header">
                                Edit User
                            </div>
                            <div class="card-body">
                                <form method="POST" class="menu_form" action="user2.php?do=Edit&user_id=<?php echo $user['user_id'] ?>" enctype="multipart/form-data">
                                    <div class="panel-X">
                                        <div class="panel-header-X">
                                            <div class="main-title">
                                                <?php echo $user['username']; ?>
                                            </div>
                                        </div>
                                        <div class="save-header-X">
                                            <div style="display:flex">
                                                <div class="icon">
                                                    <i class="fa fa-sliders-h"></i>
                                                </div>
                                                <div class="title-container">User details</div>
                                            </div>
                                            <div class="button-controls">
                                                <button type="submit" name="edit_menu_sbmt" class="btn btn-primary">Save Edit</button>
                                            </div>
                                        </div>
                                        <div class="panel-body-X">
                                                
                                            <!-- User ID -->

                                            <input type="hidden" name="menu_id" value="<?php echo $user['user_id'];?>" >

                                            <!-- User NAME INPUT -->

                                            <div class="form-group">
                                                <label for="user_name">Username</label>
                                                <input type="text" class="form-control" onkeyup="this.value=this.value.replace(/[^\sa-zA-Z]/g,'');" value="<?php echo $user['username'] ?>" placeholder="user Name" name="user_name">
                                                <?php
                                                    $flag_edit_menu_form = 0;

                                                    if(isset($_POST['edit_menu_sbmt']))
                                                    {
                                                        if(empty(test_input($_POST['user_name'])))
                                                        {
                                                            ?>
                                                                <div class="invalid-feedback" style="display: block;">
                                                                    Username is required.
                                                                </div>
                                                            <?php

                                                            $flag_edit_menu_form = 1;
                                                        }
                                                    }
                                                ?>
                                            </div>
                                        
                                            <!-- Email CATEGORY INPUT -->
                                            <div class="form-group">
                                                <label for="email">User email</label>
                                                <input type="email" class="form-control"  value="<?php echo $user['email'] ?>" placeholder="Email" name="email">
                                                <?php
                                                    $flag_edit_menu_form = 0;

                                                    if(isset($_POST['edit_menu_sbmt']))
                                                    {
                                                        if(empty(test_input($_POST['email'])))
                                                        {
                                                            ?>
                                                                <div class="invalid-feedback" style="display: block;">
                                                                    Email is required.
                                                                </div>
                                                            <?php

                                                            $flag_edit_menu_form = 1;
                                                        }
                                                    }
                                                ?>
                                            </div>    
                                            <!-- Fullname INPUT -->

                                            <div class="form-group">
                                                <label for="full_name">User Fullname</label>
                                                <textarea class="form-control" name="full_name" style="resize: none;"><?php echo $user['full_name']; ?></textarea>
                                                <?php

                                                    if(isset($_POST['edit_menu_sbmt']))
                                                    {
                                                        if(empty(test_input($_POST['full_name'])))
                                                        {
                                                            ?>
                                                                <div class="invalid-feedback" style="display: block;">
                                                                    User fullname is required.
                                                                </div>
                                                            <?php

                                                            $flag_edit_menu_form = 1;
                                                        }
                                                        elseif(strlen(test_input($_POST['menu_description'])) > 50)
                                                        {
                                                            ?>
                                                                <div class="invalid-feedback" style="display: block;">
                                                                    The length of the Fullname should be less than 200 letters.
                                                                </div>
                                                            <?php

                                                            $flag_edit_menu_form = 1;
                                                        }
                                                    }
                                                ?>
                                            </div>

                                            <!-- Password INPUT -->

                                            <div class="form-group">
                                                <label for="password">Reset Password</label>
                                                <input type="password" class="form-control"  placeholder="Password" name="password">
                                            </div>

                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <?php

                        /*** EDIT MENU ***/

                        if(isset($_POST['edit_menu_sbmt']) && $_SERVER['REQUEST_METHOD'] == 'POST' && $flag_edit_menu_form == 0)
                        {
                            $user_id = test_input($_POST['user_id']);
                            $username = test_input($_POST['user_name']);
                            $email = test_input($_POST['email']) ; 
                            $fullname = test_input($_POST['full_name']);
                            $password = test_input($_POST['password']);

                            if(empty($password)){
                                $password = $user['password'] ; 
                            } else {
                                $hashedPass = sha1($password);
                            }
                            

                                try
                                {
                                    $stmt = $con->prepare("update users  set username = ?, email = ?, full_name = ?, password = ? where user_id = ? ");
                                    $stmt->execute(array($username,$email,$fullname,$password,$user_id));
                                    
                                    ?> 
                                        <!-- SUCCESS MESSAGE -->

                                        <script type="text/javascript">
                                            swal("Edit User","User has been updated successfully", "success").then((value) => 
                                            {
                                                window.location.replace("user2.php");
                                            });
                                        </script>

                                    <?php

                                }
                                catch(Exception $e)
                                {
                                    echo 'Error occurred: ' .$e->getMessage();
                                }
                            
                            
                            
                        }

                    }
                    else
                    {
                        header('Location: User2.php');
                    }
                }
                else
                {
                    header('Location: User2.php');
                }
            }


        /*** FOOTER BOTTON ***/

        include 'Includes/templates/footer.php';

    }
    else
    {
        header('Location: index.php');
        exit();
    }

?>

<!-- JS SCRIPT -->

<script type="text/javascript">

    // When delete menu button is clicked

    $('.delete_menu_bttn').click(function()
    {
        var user_id = $(this).data('id');
        var do_ = "Delete";

        $.ajax(
        {
            url:"ajax_files/users_ajax.php",
            method:"POST",
            data:
            {
                user_id:user_id,
                do_:do_
            
            },
            success: function (data) 
            {
                swal("Delete Menu","The menu has been deleted successfully!", "success").then((value) => {
                    window.location.replace("user2.php");
                });     
            },
            error: function(xhr, status, error) 
            {
                alert('AN ERROR HAS BEEN ENCOUNTERED WHILE TRYING TO EXECUTE YOUR REQUEST');
            }
          });
    });



</script>
