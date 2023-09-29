<style>
    .sidebar {
        margin: 0;
        margin-left: 10px;
        padding: 0;
        width: 200px;
        position: absolute;
    }

    .sidebar a {
        display: block;
        padding: 14px;
        font-size: 16px;
        text-decoration: none;
    }

    .profile-content {
        margin-left: 240px;
        padding: 10px;
    }

    @media screen and (max-width: 600px) {
        .sidebar {
            width: 100%;
            position: relative;
        }

        .sidebar a {
            float: left;
            font-size: 12px;
            padding: 16px;
        }

        .profile-content {
            margin-left: 0;
        }

    }
</style>

<div class="sidebar"> 
    <a href="my-profile.php">Profile</a>
    <a href="change-password.php">Change Password</a>
    <a href="edit-profile.php">Edit Profile</a>
    <a href="action/logout.php">Logout</a>
</div>

<br clear="both">