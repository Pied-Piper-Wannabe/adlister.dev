<!--partial view for navbar-->

<nav class="navbar navbar-toggleable-md navbar-light bg-faded">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand logoGreen" href="/">pie piper</a>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <form class="form-inline my-2 my-lg-0 mr-auto">
            <input class="form-control mr-sm-2 searchbar" name="search" type="text" placeholder="Search">
            <button class="btn btn-success my-2 my-sm-0" id="searchButton" type="submit">Search</button>
        </form>
    <!-- Shop Button -->
    <div class="btn-group">
        <button id="shopButton" type="button" class="btn btn-outline-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Shop
        </button>
        <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="/items">All</a>
            <a class="dropdown-item" href="/items?cat=Software">Software</a>
            <a class="dropdown-item" href="/items?cat=Hardware">Hardware</a>
            <a class="dropdown-item" href="/items?cat=Rockets">Rockets</a>
            <a class="dropdown-item" href="/items?cat=Investment">Investment</a>
        </div>
    </div>
    <!-- Profile Button -->
    <!-- If statement needed here to determine if user is logged in, if not show only login -->
    <?PHP if(isset($_SESSION['LOGGED_IN_USER'])) : ?>
    <div class="btn-group">
        <button id="profileButton" type="button" class="btn btn-outline-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Profile
        </button>
        <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="/account">View Profile</a>
            <a class="dropdown-item" href="edit-user">Edit Profile</a>
            <a class="dropdown-item" href="/create">Create Ad</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="/logout">Logout</a>
        </div>
    </div>
    <?PHP else : ?>
        <a href="/login" id="profileButton" class="btn btn-outline-success" role="button" aria-disabled="true">Login/Signup</a>
    <?PHP endif; ?>
    </div>
</nav>
