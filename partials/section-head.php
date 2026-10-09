<?php
/**
 * Section header: kicker, heading, optional note. $level defaults to h2.
 * $align: 'start' (default) or 'center'. $tone: '' or 'light' on dark bands.
 */

if (!defined('ROOT_DIR')) {
    http_response_code(404);
    exit;
}

$shLevel = $level ?? 'h2';
$shId    = $id ?? '';
?>
<header class="section-head section-head--<?= e($align ?? 'start') ?>" data-reveal-group>
    <?php if (!empty($kicker)): ?>
        <p class="kicker" data-reveal><?= e($kicker) ?></p>
    <?php endif; ?>
    <<?= $shLevel ?> class="section-head__title"<?= $shId !== '' ? ' id="' . e($shId) . '"' : '' ?> data-reveal><?= rich($title) ?></<?= $shLevel ?>>
    <?php if (!empty($note)): ?>
        <p class="section-head__note" data-reveal><?= rich($note) ?></p>
    <?php endif; ?>
</header>
