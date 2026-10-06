<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="login-section">
    <div class="login-card">
        <p class="eyebrow">Protected workspace</p>
        <h1>Staff login</h1>
        <p>Sign in with your SariPOS user account to manage customers and team users.</p>
        <?php if (session('error')): ?><div class="alert error" role="alert"><?= esc(session('error')) ?></div><?php endif ?>
        <?php if (session('success')): ?><div class="alert success" role="status"><?= esc(session('success')) ?></div><?php endif ?>
        <?php if (validation_list_errors()): ?><div class="alert error" role="alert"><?= validation_list_errors() ?></div><?php endif ?>
        <form method="post" action="<?= site_url('login') ?>">
            <?= csrf_field() ?>
            <div class="field">
                <label for="username">Username</label>
                <input id="username" name="username" type="text" maxlength="50" required autocomplete="username" autofocus value="<?= esc(old('username'), 'attr') ?>">
            </div>
            <div class="field">
                <label for="password">Password</label>
                <input id="password" name="password" type="password" maxlength="72" required autocomplete="current-password">
            </div>
            <button class="button primary login-button" type="submit">Log in</button>
        </form>
    </div>
</section>
<?= $this->endSection() ?>
