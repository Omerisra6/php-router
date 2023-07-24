<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="/public/styles/index.css">
    <link rel="stylesheet" href="/public/styles/profile.css">
</head>
<body>
    
    <div class="profile-wrapper">

        <div class="profile-container">

            <div class="profile-top-container">

                <div class="theme-image-container"></div>
                
                <div class="image-and-name-container">

                    <div class="profile-image-container">
                        <img class="profile-image" src="<?= $user->profile ?>" alt="profile">
                    </div>

                    <h1 class="username"><?= $user->fullname ?></h1>
                    
                </div>

            </div>

            <div class="profile-bottom-container">

                <div class="user-details-column">

                    <div class="team-name-container detail-container">

                        <h5 class="team-name-title title">Team</h5>

                        <h3 class="team-name detail"><?= $user->team ?></h3>

                    </div>
                    
                    <div class="role-container detail-container">

                        <h5 class="role-title title">Role in the team</h5>

                        <h3 class="role detail"><?= $user->role ?></h3>

                    </div>

                    <div class="company-container detail-container">

                        <h5 class="company-title title">Department or company</h5>

                        <h3 class="company detail"><?= $user->department ?></h3>

                    </div>
                    
                    <div class="location-container detail-container">

                        <h5 class="location-title title">Location</h5>

                        <h3 class="location detail"><?= $user->location ?></h3>

                    </div>

                </div>
        
                <div class="user-details-column">

                    <div class="member-since-container detail-container">

                        <h5 class="member-since-title title"><?= $user->team ?> member since</h5>

                        <h3 class="member-since detail"><?= date('m/d/y', $user->member_since) ?></h3>

                    </div>
                    
                    <div class="working-since-container detail-container">

                        <h5 class="working-since-title title">Working in [company] since</h5>

                        <h3 class="working-since detail">January 2017</h3>

                    </div>

                    <div class="favorite-container detail-container">

                        <h5 class="favorite-title title">Favorite</h5>

                        <h3 class="favorite detail">Glassmorphism</h3>

                    </div>

                </div>

                <div class="user-details-column">
                    
                    <div class="superpower-container detail-container">

                        <h5 class="superpower-title title">My superpower</h5>

                        <h3 class="superpower detail"><?= $user->good_at ?></h3>

                    </div>
                    
                    <div class="bad-at-container detail-container">

                        <h5 class="bad-at-title title">I want to be good at</h5>

                        <h3 class="bad-at detail">Proptyping</h3>

                    </div>

                    <div class="favorite-at-work-container detail-container">

                        <h5 class="favorite-at-work-title title">Favorite-at-work [thing]</h5>

                        <h3 class="favorite-at-work detail">Glassmorphism</h3>

                    </div>

                </div>

                <div class="user-details-column background-column">
                    
                    <div class="background-container detail-container">

                        <h5 class="background-title title">Background / experience</h5>

                        
                        <div class="background-list-container">
                            <?php foreach ($user->background as $background) {
                                echo '<h3 class="background detail">' . $background . '</h3>';
                            } ?>
                        </div>
                    
                </div>

            </div>

        </div>

    </div>

</body>
</html>
