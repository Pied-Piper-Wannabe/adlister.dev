<!--Page for an index of advertisements-->
<div class='container-fluid topMargin'>
    <div class="row">
        <?PHP foreach ($results as $result) : ?>
            <div class="card" style="width: 20rem;">
                <a href="http://adlister.dev/show?id=<?= $result['id']?>&cat=<?=$result['category']?>"><img class="card-img-top" src="<?= $result['photodir']?>" alt="Card image cap" style="width: 100%"></a>
                <div class="card-block">
                    <a href="http://adlister.dev/show?id=<?= $result['id']?>&cat=<?=$result['category']?>"><h4 class="card-title"><?=htmlspecialchars(strip_tags($result['name'])) ?></h4></a>
                    <p class="card-text"><?=htmlspecialchars(strip_tags($result['description'])) ?></p>
                </div>
            </div>
        <?PHP endforeach; ?>
        <!-- Only one row. -->
    </div>
    <!-- Create Buttons Below -->
    <div class="row">
        <div class="col centerText">
            <?PHP if ($page > 1) : ?>
                <a class="btn btn-outline-success" href="http://adlister.dev/items?page=<?= $page - 1 ?>" role="button">Previous</a>
            <?PHP else : ?>
                <a class="btn btn-outline-success disabled" href="http://adlister.dev/items?page=<?= $page - 1 ?>" role="button">Previous</a>
            <?PHP endif; ?>

            <?PHP if ($page < $pages) : ?>
                <a class="btn btn-outline-success" href="http://adlister.dev/items?page=<?= $page + 1 ?>" role="button">Next</a>
            <?PHP else : ?>
                <a class="btn btn-outline-success disabled" href="http://adlister.dev/items?page=<?= $page + 1 ?>" role="button">Next</a>
            <?PHP endif; ?>
            <!-- Return current page and total number of results -->
            <p>Page: <?= $page ?> of <?= $pages ?></p>
            <p>Total Results: <?= $totalResults ?></p>
        </div>
    </div>
</div>
