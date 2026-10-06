<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<?php $editing = $user !== null; ?>
<section class="page-hero compact">
    <div class="container narrow">
        <p class="eyebrow">User accounts</p>
        <h1><?= $editing ? 'Edit user' : 'Add a new user' ?></h1>
        <p><?= $editing ? 'Update account details and optionally upload a profile picture.' : 'Create a staff account for the point-of-sale directory.' ?></p>
    </div>
</section>

<section class="container narrow section form-section">
    <div class="form-card">
        <?php if (validation_list_errors()): ?>
            <div class="alert error" role="alert"><strong>Please check the form.</strong><?= validation_list_errors() ?></div>
        <?php endif ?>
        <form method="post" enctype="multipart/form-data" action="<?= $editing ? site_url('users/' . $user['id']) : site_url('users') ?>">
            <?= csrf_field() ?>
            <div class="field-grid">
                <div class="field">
                    <label for="username">Username <span>*</span></label>
                    <input id="username" name="username" type="text" minlength="3" maxlength="50" required value="<?= esc(old('username', $user['username'] ?? ''), 'attr') ?>">
                    <small>Letters, numbers, periods, underscores, and dashes only.</small>
                </div>
                <div class="field">
                    <label for="full_name">Full name <span>*</span></label>
                    <input id="full_name" name="full_name" type="text" maxlength="100" required value="<?= esc(old('full_name', $user['full_name'] ?? ''), 'attr') ?>">
                </div>
                <div class="field">
                    <label for="password">Password <?= $editing ? '' : '<span>*</span>' ?></label>
                    <input id="password" name="password" type="password" minlength="8" maxlength="72" <?= $editing ? '' : 'required' ?> autocomplete="new-password">
                    <small><?= $editing ? 'Leave blank to keep the current password.' : 'Use at least 8 characters.' ?></small>
                </div>
            </div>
            <?php if ($editing): ?>
                <div class="upload-panel">
                    <img class="avatar-preview" src="<?= base_url('uploads/avatars/' . ($user['avatar'] ?: 'placeholder.svg')) ?>" alt="Current profile picture">
                    <div class="field">
                        <label for="avatar">Profile picture</label>
                        <input id="avatar" name="avatar" type="file" accept="image/jpeg,image/png">
                        <small>JPG or PNG, up to 2 MB. The image will be cropped to a square.</small>
                    </div>
                </div>
            <?php endif ?>
            <div class="form-actions"><a class="button secondary" href="<?= site_url('users') ?>">Cancel</a><button class="button primary" type="submit"><?= $editing ? 'Save changes' : 'Create user' ?></button></div>
        </form>
    </div>
</section>
<?= $this->endSection() ?>
