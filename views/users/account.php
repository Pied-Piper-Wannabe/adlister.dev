<!--Page for user account home-->

<div class="container">
    <div class="row">
        <div class="col-6 offset-3">
            <h1>Your Profile</h1>
        </div>
    </div>
    <div class="row topMargin">
        <div class="col-sm offset-sm-0 col-md-6 offset-md-3">
            <h3>Profile Info:</h3>
            <ul class="list-group">
                <li class="list-group-item">Name: <?=$name?></li>
                <li class="list-group-item">Username: <?=$username?></li>
                <li class="list-group-item">Email: <?=$email?></li>
                <li class="list-group-item">Password: ********</li>
            </ul>
            <input type="button" class="btn btn-success float-right topMargin" value="Edit Profile" onclick="location.href = '/edit-user';">
        </div>
    </div>
    <div class="row">
        <div class="col-sm offset-sm-0 col-md-6 offset-md-3">
            <h3>Your Ads:</h3>
            <div class="list-group">
                <?PHP foreach($results as $result) : ?>
                  <a href="/show?id=<?=$result["id"]?>&cat=<?=$result["category"]?>" class="list-group-item list-group-item-action"><?=$result["name"]?></a>
                 <?PHP endforeach; ?>
            </div>
            <input type="button" class="btn btn-success float-right topMargin" value="Create Ad" onclick="location.href = '/create';">
        </div>
    </div>
    <div class="row">
        <div class="col centerText">
            <?PHP if ($page > 1) : ?>
                <a class="btn btn-outline-success" href="http://adlister.dev/account?page=<?= $page - 1 ?>" role="button">Previous</a>
            <?PHP else : ?>
                <a class="btn btn-outline-success disabled" href="http://adlister.dev/account?page=<?= $page - 1 ?>" role="button">Previous</a>
            <?PHP endif; ?>

            <?PHP if ($page < $pages) : ?>
                <a class="btn btn-outline-success" href="http://adlister.dev/account?page=<?= $page + 1 ?>" role="button">Next</a>
            <?PHP else : ?>
                <a class="btn btn-outline-success disabled" href="http://adlister.dev/account?page=<?= $page + 1 ?>" role="button">Next</a>
            <?PHP endif; ?>
            <!-- Return current page and total number of results -->
            <p>Page: <?= $page ?> of <?= $pages ?></p>
            <p>Total Results: <?= $total ?></p>
        </div>
    </div>
</div>
