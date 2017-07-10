<?php
require('../app/classLoad.php');
session_start();
if ( isset($_SESSION['userCH24Test']) ) {
    //create Controller
    $entryActionController = new EntryActionController('entry');
    //get objects
    $entrys = $entryActionController->getAll(); 
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
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row-fluid">
                        <div class="span12">
                            <h3 class="page-title">
                                Entries <small>other</small>
                            </h3>
                            <ul class="breadcrumb">
                                <li><i class="icon-home"></i><a href="index.php">Home</a></li>
                                <?php
                                if ( isset($_SESSION['userCH24Test']) ) 
                                {
                                ?>
                                <li> - <a href="entry.php">Add Entry</a></li>
                                <li> - <a href="logout.php">Logout</a></li>
                                <?php    
                                } 
                                else {
                                ?>
                                <li> - <a href="#login" data-toggle="modal">Login</a></li>
                                <?php	   
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <!-- Action's Messages Results : Success or Error -->
                            <?php if(isset($_SESSION['actionMessage']) and isset($_SESSION['typeMessage'])){ $message = $_SESSION['actionMessage']; $typeMessage = $_SESSION['typeMessage']; ?>
                            <div class="alert alert-<?= $typeMessage ?>"><button class="close" data-dismiss="alert"></button><?= $message ?></div>
                            <?php } unset($_SESSION['actionMessage']); unset($_SESSION['typeMessage']); ?>
                            <!-- Action's Messages Results : Success or Error -->
                            
                            
                            <div class="portlet box light-grey">
                                <div class="portlet-title">
                                    <h4>Add New Entry</h4>
                                    <div class="tools">
                                        <a href="javascript:;" class="reload"></a>
                                    </div>
                                </div>
                                <div class="portlet-body form">
                                    <form id="entry" class="horizontal-form" action="../app/Dispatcher.php" method="POST">
                                        <div class="row-fluid">
                                            <div class="span12">
                                                <div class="control-group">
                                                    <label class="control-label" for="title">Title <sup class="red-asterisk">*</sup></label>
                                                    <div class="controls">
                                                        <input required="required" type="text" id="title" name="title" class="m-wrap span12 bold">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row-fluid">
                                            <div class="span12">
                                                <div class="control-group">
                                                  <label class="control-label" for="content">Text</label>
                                                  <div class="controls">
                                                     <textarea class="span12 ckeditor m-wrap" id="content" name="content" rows="6"></textarea>
                                                  </div>
                                               </div>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <input type="hidden" name="action" value="add">
                                            <input type="hidden" name="source" value="entry">
                                            <p class="red-asterisk">* : Must be filled</p>
                                            <a href="index.php" class="btn black"><i class="m-icon-swapleft m-icon-white"></i> Go back</a>
                                            <button type="submit" class="btn green">Create <i class="icon-ok m-icon-white"></i></button>
                                        </div>
                                    </form>                 
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
    header('Location:index.php');    
}
?>
