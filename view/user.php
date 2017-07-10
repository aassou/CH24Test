<?php
require('../app/classLoad.php');
session_start();
if ( isset($_SESSION['userCH24Test']) ) {
    //create Controller
    $userActionController = new AppController('user');
    //get objects
    $users = $userActionController->getAll(); 
    /*$usersNumber = $userActionController->getAllNumber(); 
    $p = 1;
    if ( $usersNumber != 0 ) {
        $userPerPage = 20;
        $pageNumber = ceil($usersNumber/$userPerPage);
        if(isset($_GET['p']) and ($_GET['p']>0 and $_GET['p']<=$pageNumber)){
            $p = $_GET['p'];
        }
        else{
            $p = 1;
        }
        $begin = ($p - 1) * $userPerPage;
        $pagination = paginate('user.php', '?p=', $pageNumber, $p);
        $users = $userActionController->getAllByLimits($begin, $userPerPage);
    }*/ 
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
    <head>
        <?php include('../include/head.php') ?>
    </head>
    <body class="fixed-top">
        <div class="header navbar navbar-inverse navbar-fixed-top">
          <?php include("../include/top-menu.php"); ?>
        </div>
        <div class="page-container row-fluid sidebar-closed">
            <?php include("../include/sidebar.php"); ?>
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row-fluid">
                        <div class="span12">
                            <ul class="breadcrumb">
                                <li><i class="icon-home"></i><a href="dashboard.php">Accueil</a><i class="icon-angle-right"></i></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <?php if(isset($_SESSION['actionMessage']) and isset($_SESSION['typeMessage'])){ $message = $_SESSION['actionMessage']; $typeMessage = $_SESSION['typeMessage']; ?>
                            <div class="alert alert-<?= $typeMessage ?>"><button class="close" data-dismiss="alert"></button><?= $message ?></div>
                            <?php } unset($_SESSION['actionMessage']); unset($_SESSION['typeMessage']); ?>
                            <!-- addUser box begin -->
                            <div id="addUser" class="modal hide fade in" tabindex="-1" role="dialog" aria-hidden="false" >
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h3>Ajouter User</h3>
                                </div>
                                <form class="form-horizontal" action="../app/Dispatcher.php" method="post">
                                    <div class="modal-body">
                                    <div class="control-group">
                                            <label class="control-label">Login</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="login" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Password</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="password" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Email</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="email" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Fullname</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="fullname" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Street</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="street" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Postcode</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="postcode" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Place</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="place" />
                                            </div>
                                        </div>
                                             
                                    </div>
                                    <div class="modal-footer">
                                        <div class="control-group">
                                            <div class="controls">
                                                <input type="hidden" name="action" value="add" />
                                                <input type="hidden" name="source" value="user" />    
                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>    
                            <!-- addUser box end -->
                            <div class="portlet box light-grey">
                                <div class="portlet-title">
                                    <h4>Liste des Users</h4>
                                    <div class="tools">
                                        <a href="javascript:;" class="reload"></a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="clearfix">
                                        <div class="btn-group">
                                            <a class="btn blue pull-right" href="#addUser" data-toggle="modal">
                                                <i class="icon-plus-sign"></i>&nbsp;User
                                            </a>
                                        </div>
                                    </div>
                                    <table class="table table-striped table-bordered table-hover" id="sample_2">
                                        <thead>
                                            <tr>
                                                <th class="t10 hidden-phone">Actions</th>
                                                <th class="t10">Login</th>
                                                <th class="t10">Password</th>
                                                <th class="t10">Email</th>
                                                <th class="t10">Fullname</th>
                                                <th class="t10">Street</th>
                                                <th class="t10">Postcode</th>
                                                <th class="t10">Place</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            //if ( $usersNumber != 0 ) { 
                                            foreach ( $users as $user ) {
                                            ?>
                                            <tr>
                                                <td class="hidden-phone">
                                                    <a href="#deleteUser<?= $user->id() ?>" data-toggle="modal" data-id="<?= $user->id() ?>" class="btn mini red"><i class="icon-remove"></i></a>
                                                    <a href="#updateUser<?= $user->id() ?>" data-toggle="modal" data-id="<?= $user->id() ?>" class="btn mini green"><i class="icon-refresh"></i></a>
                                                </td>
                                                <td><?= $user->login() ?></td>
                                                <td><?= $user->password() ?></td>
                                                <td><?= $user->email() ?></td>
                                                <td><?= $user->fullname() ?></td>
                                                <td><?= $user->street() ?></td>
                                                <td><?= $user->postcode() ?></td>
                                                <td><?= $user->place() ?></td>
                                            </tr> 
                                            <!-- updateUser box begin -->
                                            <div id="updateUser<?= $user->id() ?>" class="modal hide fade in" tabindex="-1" role="dialog" aria-hidden="false">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h3>Modifier Info User</h3>
                                                </div>
                                                <form class="form-inline" action="../app/Dispatcher.php" method="post">
                                                    <div class="modal-body">
                                                        <div class="control-group">
                                                            <label class="control-label">Login</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="login"  value="<?= $user->login() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Password</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="password"  value="<?= $user->password() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Email</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="email"  value="<?= $user->email() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Fullname</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="fullname"  value="<?= $user->fullname() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Street</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="street"  value="<?= $user->street() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Postcode</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="postcode"  value="<?= $user->postcode() ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label">Place</label>
                                                            <div class="controls">
                                                                <input required="required" type="text" name="place"  value="<?= $user->place() ?>" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="control-group">
                                                            <div class="controls">
                                                                <input type="hidden" name="id" value="<?= $user->id() ?>" />
                                                                <input type="hidden" name="action" value="update" />
                                                                <input type="hidden" name="source" value="user" />    
                                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- updateUser box end --> 
                                            <!-- deleteUser box begin -->
                                            <div id="deleteUser<?= $user->id() ?>" class="modal modal-big hide fade in" tabindex="-1" role="dialog" aria-hidden="false">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h3>Supprimer User</h3>
                                                </div>
                                                <form class="form-horizontal" action="../app/Dispatcher.php" method="post">
                                                    <div class="modal-body">
                                                        <h4 class="dangerous-action">Êtes-vous sûr de vouloir supprimer User : <?= $user->login() ?> ? Cette action est irréversible!</h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="control-group">
                                                            <div class="controls">
                                                                <input type="hidden" name="id" value="<?= $user->id() ?>" />
                                                                <input type="hidden" name="action" value="delete" />
                                                                <input type="hidden" name="source" value="user" />    
                                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>
                                                                <button type="submit" class="btn red" aria-hidden="true">Oui</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- deleteUser box end --> 
                                            <?php 
                                            }//end foreach 
                                            //}//end if
                                            ?>
                                        </tbody>
                                    </table>
                                    <?php /*if($usersNumber != 0){ echo $pagination; }*/ ?><br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include('../include/footer.php'); ?>
        <?php include('../include/scripts.php'); ?>     
        <script>jQuery(document).ready( function(){ App.setPage("table_managed"); App.init(); } );</script>
    </body>
</html>
<?php
}
else{
    header('Location:../index.php');    
}
?>
