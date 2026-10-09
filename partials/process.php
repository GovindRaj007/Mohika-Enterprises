<?php
/**
 * Four-step process timeline. Optional $installText replaces step 3's text
 * with the service's own description. $compact = true shows only the step
 * headings, except the service's own step 3 — used on service × city pages,
 * where the full shared text would repeat across thirty pages.
 */

if (!defined('ROOT_DIR')) {
    http_response_code(404);
    exit;
}

$procSteps = config_get('process-steps');
if (!empty($installText)) {
    $procSteps[2]['text'] = $installText;
}
?>
<ol class="process" data-reveal-group data-process>
    <?php foreach ($procSteps as $procIndex => $procStep): ?>
        <li class="process__step" data-reveal>
            <span class="process__num" aria-hidden="true"><?= str_pad((string) ($procIndex + 1), 2, '0', STR_PAD_LEFT) ?></span>
            <h3 class="process__title"><?= e($procStep['heading']) ?></h3>
            <?php if (empty($compact) || ($procIndex === 2 && !empty($installText))): ?><p><?= e($procStep['text']) ?></p><?php endif; ?>
        </li>
    <?php endforeach; ?>
</ol>
