<?php
/**
 * Two-column comparison table from a service's 'comparison' block.
 * The table is real <table> markup with a caption, readable on a phone.
 */

if (!defined('ROOT_DIR')) {
    http_response_code(404);
    exit;
}

if (empty($comparison['rows'])) {
    return;
}
?>
<div class="compare" data-reveal>
    <table class="compare__table">
        <caption class="sr-only"><?= e($comparison['title']) ?></caption>
        <thead>
            <tr>
                <th scope="col"><span class="sr-only">Feature</span></th>
                <th scope="col" class="compare__ours"><?= e($comparison['a']) ?></th>
                <th scope="col"><?= e($comparison['b']) ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($comparison['rows'] as $cmpRow): ?>
                <tr>
                    <th scope="row"><?= e($cmpRow['label']) ?></th>
                    <td class="compare__ours"><?= icon('check', 'icon icon--sm') ?> <?= e($cmpRow['a']) ?></td>
                    <td><?= e($cmpRow['b']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
