<!--Page for single advertisement -->
<div class="container">
    <div class="row">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/items">All</a></li>
            <li class="breadcrumb-item"><a href="http://adlister.dev/items?cat=<?=$results->category?>"><?=$results->category?></a></li>
            <li class="breadcrumb-item active"><?=$results->name?></li>
        </ol>
    </div>
    <div class="row">
        <div class="col-md-8 col-sm">
            <div class="adPhoto whiteBox">
                <img src="<?= $results->photodir ?>">
            </div>
        </div>
        <div class="col-md-4 col-sm">
            <div class="adDetails whiteBox">
                <h1 class="adName"><?=$results->name?></h1>
                <h2 class="adBrand"><?=$results->brand?></h2>
                <p class="adDesc"><?=$results->description?></p>
                <h2 class="adPrice">$<?=$results->price?></h2>
                <a href='mailto:<?=$userEmail?>' class="btn btn-success btn-lg btn-block" role="button">Contact Seller</a>
                <p class="sidenote">Right click -> "Copy Email Address" if you do not have email client.</p>
            </div>
            <div class="adAbout">ABOUT THE SELLER</div>
            <div class="adUser whiteBox">
                <h1><?=$username?></h1>
                <?PHP if(isset($_SESSION['LOGGED_IN_USER'])) : ?>
                <?PHP if($_SESSION['LOGGED_IN_USER'] === $username) : ?>
                    <a href='/edit' class="btn btn-success btn-lg btn-block" role="button">Edit Ad</a>
                <?PHP endif; ?>
                <?PHP endif; ?>
            </div>
        </div>
    </div>
</div>
