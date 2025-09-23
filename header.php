<style>
    body {
        background-color: #B6CEB4;
    }

    #navbarNav {
        position: absolute;
        right: 0;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="login.php">Home</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">logout</a>
                </li>
                <?php if (isset($_SESSION['email'])) { ?>
                    <a class="nav-link" href="#">
                        <?php echo $_SESSION['email']; ?>
                    </a>
                <?php } else { ?>
                    <a class="nav-link" href="login.php">Login</a>
                <?php } ?>
            </ul>
        </div>
    </nav>
</header>