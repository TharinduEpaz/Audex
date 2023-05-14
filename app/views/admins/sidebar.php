<div class="sidebar">
    <a id="dashboard"  href="<?php echo URLROOT;?>/admins/admindashboard"><i class="fas fa-qrcode"></i> <span>Dashboard</span></a>
    <a id="profile"  href="<?php echo URLROOT;?>/admins/profiletest/<?php echo $_SESSION['user_id']?>"><i class="fas fa-qrcode"></i> <span>My Profile</span></a>
    <a id="manage_users" href="<?php echo URLROOT;?>/admins/manageuser"> <i class="fa fa-cog" aria-hidden="true"></i><span>Manage Users</span></a>
    <a id="reports" href="<?php echo URLROOT;?>/admins/manageuser"> <i class="fa fa-file"></i><span>Reports</span></a>
    <a id="approvals" href="<?php echo URLROOT;?>/admins/approval"> <i class="fas fa-check-circle" aria-hidden="true"></i><span>Approvals</span></a>      
</div>