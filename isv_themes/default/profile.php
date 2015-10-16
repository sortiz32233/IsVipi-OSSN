﻿<?php $pageManager->loadCustomHead('g_head','m_head'); ?>
<?php $pageManager->loadCustomHeader('g_header','m_header'); ?>
<?php $pageManager->loadsideBar('sidebar'); ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
        	<!-- user profile -->
        	<section class="col-lg-10">
				<div class="box box-solid members">
                	<div class="row">
                    
                    <!-- cover photo goes here -->
                    <div class="col-md-12 cover-photo">
                    	<img class="" src="<?php echo user_cover_pic($m_info['m_cover_photo']) ?>" alt="cover photo" style="width: 100%;max-height: 100%">
                    <div class="change-cover-photo">
                    	<a href="#" data-toggle="modal" data-target="#cover">Change Cover Photo</a>
                    </div>
                    </div>
                    
                    <!-- end::cover photo -->
                    <!-- col-md-4 -->
                    <div class="col-md-4">
                    	<!-- Profile Image -->
                          <div class="box profile-pic-box">
                            <div class="box-body box-profile">
                              <img class="profile-user-img img-responsive square-circle" src="<?php echo user_pic($m_info['m_profile_pic']) ?>" alt="User profile picture">
                              <h3 class="profile-username text-center"><?php echo $m_info['m_fullname']; ?></h3>
                              
                              <?php if($_SESSION['isv_user_id'] === $m_info['m_user_id']){?>
                              <a href="#" class="btn btn-warning btn-block" data-toggle="modal" data-target="#profilePic"><b>Change Profile Pic</b></a>
                              <a href="<?php echo ISVIPI_URL. 'profile/' .$m_info['m_username'] . '/edit'?>" class="btn btn-primary btn-block"><b>Edit Profile</b></a>
                              <?php } ?>
            
                              <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                  <b>Friends</b> <a class="pull-right"><?php echo $m->friendsTotal(number_format($m_info['m_user_id'])) ?></a>
                                </li>
                                <li class="list-group-item">
                                  <b>Member Level</b> <a class="pull-right"><?php echo $m_info['m_level']; ?></a>
                                </li>
                              </ul>
            				  <?php if($_SESSION['isv_user_id'] !== $m_info['m_user_id']){?>
                              <a href="#" class="btn btn-primary"><b>Add Friend</b></a>
                              <a href="#" class="btn btn-success"><b>Message</b></a>
                              <a href="#" class="btn btn-danger"><b>Block</b></a>
                              <?php } ?>
                              
                            </div><!-- /.box-body -->
                          </div><!-- /.box -->
                          <!-- end::Profile Image -->
                          
                          <!-- About Me Box -->
                          <div class="box box-primary">
                            <div class="box-header with-border">
                              <h3 class="box-title">About Me</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                            	<?php if(empty($m_info['m_rel_status'])){
									$relStatus = '';
								} else {
									$relStatus = ' - ' .$m_info['m_rel_status'];
								}?>
                                <strong><i class="fa fa-file-text-o margin-r-5"></i> Personal Info</strong><br />
                            	<?php echo ucfirst($m_info['m_gender']) ?> (<?php echo age($m_info['m_dob']).$relStatus ?>)
                             
                             <?php if($_SESSION['isv_user_id'] == $m_info['m_user_id'] || $m_info['m_phone_settings'] === 2){?>
                                 <hr style="margin:5px 0">
                                 <strong>Phone</strong> <?php echo $m_info['m_phone'] ?>
                             <?php } ?>
                             
                            <hr style="margin:5px 0">
                              <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>
                              <?php 
							  	if(empty($m_info['m_city'])){
									$city = '';
								} else {
									$city = $m_info['m_city']. ', ';
								}
							  ?>
                              <span class="text-muted"><?php echo $city.$m_info['m_country'] ?></span>
            
                              <hr style="margin:5px 0">
            
                              <strong><i class="fa fa-file-text-o margin-r-5"></i> Hobbies</strong>
                              <span class="text-muted"><?php echo $m_info['m_hobbies'] ?></span>
                            </div><!-- /.box-body -->
                          </div><!-- /.box -->
                          <!-- end::About Me Box -->
                    </div>
                    <!-- end::col-md-4-->
                    
                    <!-- col-md-8 -->
                    <div class="col-md-8 prof-nav" id="profile-menu">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                          <li <?php if (isset($PAGE[2]) && $PAGE[2] == 'feeds'){?>class="active"<?php } ?>>
                          	<a href="<?php echo ISVIPI_URL. 'profile/' .$m_info['m_username'] . '/feeds'?>">Timeline</a>
                          </li>
                          <li <?php if (isset($PAGE[2]) && $PAGE[2] == 'friends'){?>class="active"<?php } ?>>
                          	<a href="<?php echo ISVIPI_URL. 'profile/' .$m_info['m_username'] . '/friends'?>">Friends</a>
                          </li>
                          <?php if($_SESSION['isv_user_id'] == $m_info['m_user_id']){?>
                          <li <?php if (isset($PAGE[2]) && $PAGE[2] == 'settings'){?>class="active"<?php } ?>>
                          	<a href="<?php echo ISVIPI_URL. 'profile/' .$m_info['m_username'] . '/settings'?>">Settings</a>
                          </li>
                          <?php } ?>
                        </ul>
                    </div>
                    <div class="right-content" id="tWall">
                    <!-- load the user timeline -->
                    <?php if (!isset($PAGE[2]) || (isset($PAGE[2]) && ($PAGE[2] === 'feeds'))){
                    	require_once(ISVIPI_ACT_THEME .'ovr/profile_scripts.php') 
					?>
                    <script>
						loadWall(<?php echo $m_info['m_user_id'] ?>);
					</script>
                    
					<?php } else if (isset($PAGE[2]) && $PAGE[2] === 'edit' && ($m_info['m_user_id'] === $_SESSION['isv_user_id'])) {
						require_once(ISVIPI_ACT_THEME .'pages/edit.php');
					} else if (isset($PAGE[2]) && $PAGE[2] === 'friends'){
						require_once(ISVIPI_ACT_THEME .'pages/friends.php');
					} else if (isset($PAGE[2]) && $PAGE[2] === 'settings' && ($m_info['m_user_id'] === $_SESSION['isv_user_id'])){
						require_once(ISVIPI_ACT_THEME .'pages/settings.php');
					} else { 
						require_once(ISVIPI_ACT_THEME .'ovr/profile_scripts.php');
					?>
                    <script>
						loadWall(<?php echo $m_info['m_user_id'] ?>);
					</script>
                    <?php } ?>
                    
                    
                    </div>
                    </div>
                    <!-- end::col-md-8 -->
                    </div>
                </div>
            <div class="clear"></div> 
			</section>
            <!--end::user profile -->
            
            <!-- online friends -->
            <section class="col-lg-2 friends-sidebar">
            	<div class="box box-solid">
                    <div class="box-header">
                    
                    </div>
                    
                    
                </div>
            </section>
			
            
            <div class="clear"></div>
            </section>
        
        </section>
        <!-- /.content -->
        
      </div>
      <!-- /.content-wrapper -->
      <!-- load our profile page related modals -->
      <?php require_once(ISVIPI_ACT_THEME .'pages/modals.php') ?>
      <!-- scripts section -->
<?php $pageManager->loadCustomFooter('g_footer','m_footer'); ?>
