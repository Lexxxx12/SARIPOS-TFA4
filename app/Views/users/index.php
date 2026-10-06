<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="page-hero compact">
    <div class="container">
        <p class="eyebrow">Staff directory</p>
        <div class="title-row">
            <div><h1>User Accounts</h1><p>Team members with access to the point-of-sale system.</p></div>
            <div class="title-actions"><span class="count-badge"><?= count($users) ?> records</span><a class="button primary" href="<?= site_url('users/new') ?>">New user</a></div>
        </div>
    </div>
</section>

<section class="container section table-section">
    <?php if (session('success')): ?><div class="alert success" role="status"><?= esc(session('success')) ?></div><?php endif ?>
    <div class="table-card">
        <div class="table-wrap">
            <table>
                <thead><tr><th>User</th><th>Full name</th><th>Date created</th><th class="align-right">Actions</th></tr></thead>
                <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><img class="avatar-photo" src="<?= base_url('uploads/avatars/' . ($user['avatar'] ?: 'placeholder.svg')) ?>" alt=""><code><?= esc($user['username']) ?></code></td>
                        <td><strong><?= esc($user['full_name']) ?></strong></td>
                        <td><?= esc(date('M j, Y', strtotime($user['created_at']))) ?></td>
                        <td class="align-right"><a class="text-link" href="<?= site_url('users/' . $user['id'] . '/edit') ?>">Edit</a></td>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
