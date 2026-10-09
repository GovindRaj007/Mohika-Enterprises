<?php
/**
 * Specification card: label/value rows. Skips a row with no value.
 * $specs, $title, optional $note.
 */

if (!defined('ROOT_DIR')) {
    http_response_code(404);
    exit;
}

$specRows = array_filter($specs ?? [], static fn($r): bool => !empty($r['value']));
if (!$specRows) {
    return;
}
?>
<aside class="spec-card" data-reveal>
    <div class="spec-card__cables" aria-hidden="true"></div>
    <h3 class="spec-card__title"><?= e($title ?? 'Specification') ?></h3>
    <dl class="spec-card__rows">
        <?php foreach ($specRows as $specRow): ?>
            <div class="spec-card__row">
                <dt><?= e($specRow['label']) ?></dt>
                <dd><?= e($specRow['value']) ?></dd>
            </div>
        <?php endforeach; ?>
    </dl>
    <?php if (!empty($note)): ?>
        <p class="spec-card__note"><?= e($note) ?></p>
    <?php endif; ?>
</aside>
