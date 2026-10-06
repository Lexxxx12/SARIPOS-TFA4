<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<?php $editing = $customer !== null; ?>
<section class="page-hero compact">
    <div class="container narrow">
        <p class="eyebrow">Customer accounts</p>
        <h1><?= $editing ? 'Edit customer' : 'Add a new customer' ?></h1>
        <p><?= $editing ? 'Update this customer’s contact details.' : 'Create a customer record for your store directory.' ?></p>
    </div>
</section>

<section class="container narrow section form-section">
    <div class="form-card">
        <?php if (validation_list_errors()): ?>
            <div class="alert error" role="alert"><strong>Please check the form.</strong><?= validation_list_errors() ?></div>
        <?php endif ?>
        <form method="post" action="<?= $editing ? site_url('customers/' . $customer['id']) : site_url('customers') ?>">
            <?= csrf_field() ?>
            <div class="field">
                <label for="full_name">Full name <span>*</span></label>
                <input id="full_name" name="full_name" type="text" maxlength="100" required value="<?= esc(old('full_name', $customer['full_name'] ?? ''), 'attr') ?>">
            </div>
            <div class="field-grid">
                <div class="field">
                    <label for="email">Email address <span>*</span></label>
                    <input id="email" name="email" type="email" maxlength="100" required value="<?= esc(old('email', $customer['email'] ?? ''), 'attr') ?>">
                </div>
                <div class="field">
                    <label for="phone">Phone number</label>
                    <input id="phone" name="phone" type="tel" maxlength="20" value="<?= esc(old('phone', $customer['phone'] ?? ''), 'attr') ?>">
                </div>
            </div>
            <div class="form-actions"><a class="button secondary" href="<?= site_url('customers') ?>">Cancel</a><button class="button primary" type="submit"><?= $editing ? 'Save changes' : 'Create customer' ?></button></div>
        </form>
    </div>
</section>
<?= $this->endSection() ?>
