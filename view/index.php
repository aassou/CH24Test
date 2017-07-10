<?php
require('../app/classLoad.php');
session_start();
//create Controller
$entryActionController = new EntryActionController('entry');
//get objects
$entries = $entryActionController->getAll();
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
                                Home <small>other</small>
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
                            <div class="portlet">
                                <div class="portlet-title line">
                                </div>
                                <div class="portlet-body" id="chats">
                                    <div class="scroller" data-height="343px" data-always-visible="1" data-rail-visible1="1">
                                        <ul class="chats">
                                            <?php foreach($entries as $entry){ ?>
                                            <li class="in">
                                                <div class="message">
                                                    <span class="arrow"></span>
                                                    <span class="datetime"><h3><?= date('d.m.Y', strtotime($entry->created())) ?> : <?= $entry->title() ?></h3></span>
                                                    <span class="body">
                                                    <?= $entryActionController->wrapString(html_entity_decode($entry->content()), "...", 1000) ?>
                                                    </span>
                                                    <a class="name"><?= $entry->authore() ?></a>
                                                </div>
                                            </li>
                                            <?php } ?>    
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- Action's Messages Results : Success or Error -->
                            <?php if(isset($_SESSION['actionMessage']) and isset($_SESSION['typeMessage'])){ $message = $_SESSION['actionMessage']; $typeMessage = $_SESSION['typeMessage']; ?>
                            <div class="alert alert-<?= $typeMessage ?>"><button class="close" data-dismiss="alert"></button><?= $message ?></div>
                            <?php } unset($_SESSION['actionMessage']); unset($_SESSION['typeMessage']); ?>
                            <!-- Action's Messages Results : Success or Error -->
                            
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