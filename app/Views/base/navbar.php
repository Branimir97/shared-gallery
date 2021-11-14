<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/home">
    Shared gallery
    <i class="fas fa-camera-retro"></i>
    </a>
    <button class="navbar-toggler" type="button" 
            data-toggle="collapse" data-target="#navbarNavAltMarkup" 
            aria-controls="navbarNavAltMarkup" aria-expanded="false" 
            aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ml-auto">
            <a class="nav-item nav-link" href="/home">
            Home
            <i class="fas fa-house-damage"></i>
            </a>
            <?php 
            if(isset($_SESSION['loggedIn'])): ?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" 
                id="navbarDropdownMenuLink" data-toggle="dropdown" 
                aria-haspopup="true" aria-expanded="false">
                Menu
                <i class="fas fa-chevron-circle-down"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="/management">
                        Management
                        <i class="fas fa-images"></i>
                    </a>
                    <a class="dropdown-item" href="/account">
                        My account
                        <i class="fas fa-user-circle"></i>
                    </a>
                </div>
            </li>
            <a class="nav-item nav-link" href="/logout">
                Logout
                <i class="fas fa-sign-in-alt"></i>
            </a>
            <?php else: ?>
            <a class="nav-item nav-link" href="/login">
                Login
                <i class="fas fa-sign-in-alt"></i>
            </a>
            <a class="nav-item nav-link" href="/register">
                Register
                <i class="fas fa-user-plus"></i>
            </a>
            <?php endif; ?>
        </div>
    </div>
</nav>