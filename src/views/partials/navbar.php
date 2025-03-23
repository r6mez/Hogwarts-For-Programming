<div class="navbar">
    <img src="/assets/Hogwarts.png" class="logo">
    <div class="buttons">
        <div>
            <a href="/" class="<?= ($_SERVER['REQUEST_URI'] == '/') ? 'active' : '' ?>">Home</a>
            <?php if (!isset($_SESSION['user']) || $_SESSION['user']['type'] !== 'Professor'): ?>
                <a href="/courses" class="<?= strpos($_SERVER['REQUEST_URI'], '/course') === 0 ? 'active' : '' ?>">Course</a>
                <a href="/MyCourses" class="<?= strpos($_SERVER['REQUEST_URI'], '/MyCourses') === 0 ? 'active' : '' ?>">My Courses</a>
                <a href="/DiagonAlley" class="<?= strpos($_SERVER['REQUEST_URI'], '/DiagonAlley') === 0 ? 'active' : '' ?>">Diagon Alley</a>
                <?php endif; ?>
                <a href="/OwlPost" class="<?= strpos($_SERVER['REQUEST_URI'], '/OwlPost') === 0 ? 'active' : '' ?>">Owl Post</a>
                <a href="/leaderBoard/students" class="<?= strpos($_SERVER['REQUEST_URI'], '/leaderBoard/students') === 0 || strpos($_SERVER['REQUEST_URI'], '/students') === 0 || strpos($_SERVER['REQUEST_URI'], '/houses') === 0 ? 'active' : '' ?>">Leaderboard</a>
        </div>
        <div>
            <?php if (isset($_SESSION['user'])): ?>
                <a href="/profile" class="<?= strpos($_SERVER['REQUEST_URI'], '/profile') === 0 ? 'active' : '' ?>">Profile</a>
                <a href="/logout">Logout</a>
            <?php else: ?>
                <a href="/login">Login</a>
                <a href="/register">Register</a>
            <?php endif; ?>
        </div>
    </div>
</div>
<style>
/* Navbar styles */
.navbar {
    background-color: var(--secondary-background-color);
    padding: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    z-index: 1000;
    box-sizing: border-box;
}

.navbar a {
    text-decoration: none;
    color: var(--text-color);
    font-size: 16px;
    margin: 10px;
    transition: color 0.3s;
}

.navbar a:hover {
    color: var(--button-hover-color);
}

.navbar .buttons {
    display: flex;
    width: 100%;
}

.navbar .buttons > div:first-child {
    margin-left: 10px;
    margin-right: auto;
}

.navbar .buttons > div:last-child {
    margin-left: auto;
}

.navbar .logo {
    width: 40px;
    height: 40px;
    align-items: center;
}
.navbar a.active {
    color: var(--button-hover-color);
    font-weight: bold;
    text-shadow: 0 0 10px var(--button-hover-color); /* Glowing effect */
}
</style>
