<?php
require('../app/classLoad.php');
session_start();
//create Controller
$entryActionController = new EntryActionController('entry');
$commentActionController = new CommentActionController('comment');
//get objects
$idEntry = $_GET['id'];
$entry = $entryActionController->getOneById($idEntry);
$comments = $commentActionController->getAllByIdEntry($idEntry);
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
                                Entry details <small></small>
                            </h3>
                            <ul class="breadcrumb">
                                <li><i class="icon-home"></i><a href="index.php">Home</a> - </li>
                                <li><a href="#login" data-toggle="modal">Login</a></li>
                                <?php
                                if ( isset($_SESSION['userCH24Test']) ) 
                                {
                                ?>
                                <li> - <a href="entry.php">Add Entry</a></li>
                                <li> - <a href="logout.php">Logout</a></li>
                                <?php    
                                } 
                                ?>
                            </ul>
                            
                            <!-- Action's Messages Results : Success or Error -->
                            <?php if(isset($_SESSION['actionMessage']) and isset($_SESSION['typeMessage'])){ $message = $_SESSION['actionMessage']; $typeMessage = $_SESSION['typeMessage']; ?>
                            <div class="alert alert-<?= $typeMessage ?>"><button class="close" data-dismiss="alert"></button><?= $message ?></div>
                            <?php } unset($_SESSION['actionMessage']); unset($_SESSION['typeMessage']); ?>
                            <!-- Action's Messages Results : Success or Error -->
                            
                            <div class="portlet">
                                <div class="portlet-title line">
                                </div>
                                <div class="portlet-body">
                                    <h1><?= $entry->title() ?></h1><?php if (isset($_SESSION['userCH24Test']) and $entry->idUser() === $_SESSION['userCH24Test']->id()){ ?><a href="#">Edit</a>|<a href="#delete" data-toggle="modal">Delete</a><?php } ?>
                                    <?= html_entity_decode($entry->content()) ?>
                                </div>
                                <hr>
                                <h4>Comments</h4>
                                <?php foreach( $comments as $comment ){ ?>
                                    <h5 style="text-decoration: underline"><strong><?= $comment->name() ?></strong> (<a target="_blank" href="<?= $comment->url() ?>"><?= $comment->url() ?></a>) said  (<?= date('d.m.Y H:i', strtotime($comment->created())) ?>) :</h5>
                                    <p>&nbsp;<?= $comment->remark() ?></p>
                                <?php } ?>
                                <hr>
                                <h4>Leave a comment</h4>
                                <form id="entry" class="horizontal-form" action="../app/Dispatcher.php" method="POST">
                                    <div class="row-fluid">
                                        <div class="span4">
                                            <div class="control-group">
                                                <label class="control-label" for="name">Name <sup class="red-asterisk">*</sup></label>
                                                <div class="controls">
                                                    <input required="required" type="text" id="name" name="name" class="m-wrap span12 bold">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row-fluid">
                                        <div class="span4">
                                            <div class="control-group">
                                                <label class="control-label" for="email">Email</label>
                                                <div class="controls">
                                                    <input type="text" id="email" name="email" class="m-wrap span12 bold">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row-fluid">
                                        <div class="span4">
                                            <div class="control-group">
                                                <label class="control-label" for="url">URL</label>
                                                <div class="controls">
                                                    <input type="text" id="url" name="url" class="m-wrap span12 bold">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row-fluid">
                                        <div class="span4">
                                            <div class="control-group">
                                              <label class="control-label" for="remark">Remark <sup class="red-asterisk">*</sup></label>
                                              <div class="controls">
                                                 <textarea class="span12 m-wrap" id="remark" name="remark" rows="6"></textarea>
                                              </div>
                                           </div>
                                        </div>
                                    </div>
                                    <div class="row-fluid">
                                        <input type="hidden" name="action" value="add">
                                        <input type="hidden" name="source" value="comment">
                                        <input type="hidden" name="idEntry" value="<?= $entry->id() ?>">
                                        <p class="red-asterisk">* : Must be filled</p>
                                        <button type="submit" class="btn green">Send <i class="icon-envelope m-icon-white"></i></button>
                                    </div>
                                </form>                 
                            </div>
                                                        <!-- login moal begin -->
                            <div id="login" class="modal hide fade in" tabindex="-1" role="dialog" aria-hidden="false" >
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h3>Login</h3>
                                </div>
                                <form class="form-horizontal" action="../app/Dispatcher.php" method="post">
                                    <div class="modal-body">
                                        <div class="control-group">
                                            <label class="control-label">login</label>
                                            <div class="controls">
                                                <input required="required" type="text" name="login" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">password</label>
                                            <div class="controls">
                                                <input required="required" type="password" name="password" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="control-group">
                                            <div class="controls">
                                                <input type="hidden" name="action" value="login" />
                                                <input type="hidden" name="source" value="user" />    
                                                <button type="submit" class="btn green" aria-hidden="true">Ok</button>
                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>    
                            <!-- login modal end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include('../include/footer.php'); ?>
        <?php include('../include/scripts.php'); ?>     
    </body>
</html>