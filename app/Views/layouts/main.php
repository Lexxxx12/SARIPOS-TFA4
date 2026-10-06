<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="A basic point-of-sale account management system built with CodeIgniter 4.">
    <title><?= esc($title) ?> | SariPOS</title>
    <link rel="stylesheet" href="<?= base_url('css/app.css') ?>">
</head>
<body>
    <div class="app-shell">
    <aside class="site-sidebar">
        <nav class="nav" aria-label="Main navigation">
            <a class="brand" href="<?= site_url('/') ?>" aria-label="SariPOS home">
                <span class="brand-mark" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M4 9h16l-1-5H5L4 9Zm1 0v11h14V9M9 20v-6h6v6"/></svg></span>
                <span>Sari<strong>POS</strong></span>
            </a>
            <div class="nav-links">
                <a class="<?= $activePage === 'home' ? 'active' : '' ?>" href="<?= site_url('/') ?>"><span>⌂</span>Overview</a>
                <a class="<?= $activePage === 'customers' ? 'active' : '' ?>" href="<?= site_url('customers') ?>"><span>◎</span>Customers</a>
                <a class="<?= $activePage === 'users' ? 'active' : '' ?>" href="<?= site_url('users') ?>"><span>◇</span>Team users</a>
                <a class="<?= $activePage === 'about' ? 'active' : '' ?>" href="<?= site_url('about') ?>"><span>i</span>About</a>
            </div>
            <div class="sidebar-note"><span class="live-dot"></span><div><strong>Store system</strong><small>Online and ready</small></div></div>
        </nav>
    </aside>

    <div class="workspace">
        <header class="topbar">
            <div><span class="topbar-kicker">SariPOS workspace</span><strong><?= esc($title) ?></strong></div>
            <?php if (session('isLoggedIn')): ?>
                <div class="operator">
                    <span><?= esc(strtoupper(substr((string) session('fullName'), 0, 1))) ?></span>
                    <div><strong><?= esc(session('fullName')) ?></strong><small><?= esc(session('username')) ?></small></div>
                    <form method="post" action="<?= site_url('logout') ?>"><?= csrf_field() ?><button class="logout-link" type="submit">Log out</button></form>
                </div>
            <?php else: ?>
                <a class="button secondary" href="<?= site_url('login') ?>">Log in</a>
            <?php endif ?>
        </header>
        <main><?= $this->renderSection('content') ?></main>

        <footer class="site-footer">
            <div class="container footer-inner">
            <span>&copy; <?= date('Y') ?> SariPOS</span>
            <span>Built with CodeIgniter <?= CodeIgniter\CodeIgniter::CI_VERSION ?></span>
            </div>
        </footer>
    </div>
    </div>
</body>
</html>
