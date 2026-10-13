<?php
/**
 * A list of locations split under a heading per state — "Andhra Pradesh"
 * then "Telangana" — wherever the site lists cities, so every list reads the
 * same way. A state with nothing to list is skipped.
 *
 * $locations  list of location arrays (any subset, any keys)
 * $variant    'chips' (default) · 'links' (area-link rows) · 'cards' (city-card grid)
 * $href       callable(location): string — link target (chips / links)
 * $label      callable(location): string — link text   (chips / links)
 * $meta       optional callable(location): string — second line (links)
 * $tag        heading tag for the state names, default 'h3'
 * $extra      optional [label, href] — an outline chip after each group's chips
 */

if (!defined('ROOT_DIR')) {
    http_response_code(404);
    exit;
}

$sgTag = in_array($tag ?? 'h3', ['h2', 'h3', 'h4'], true) ? ($tag ?? 'h3') : 'h3';
$sgVariant = $variant ?? 'chips';
$sgGroups = [];
foreach ($locations as $sgLoc) {
    $sgGroups[$sgLoc['state']][] = $sgLoc;
}
?>
<div class="state-groups state-groups--<?= e($sgVariant) ?>">
    <?php foreach (get_states() as $sgKey => $sgState): if (empty($sgGroups[$sgKey])) { continue; } ?>
        <div class="state-group">
            <<?= $sgTag ?> class="state-group__title"><?= icon('pin', 'icon icon--sm') ?> <?= e($sgState['name']) ?></<?= $sgTag ?>>
            <?php if ($sgVariant === 'cards'): ?>
                <div class="city-grid" data-reveal-group>
                    <?php foreach ($sgGroups[$sgKey] as $sgLoc) { render_partial('city-card', ['location' => $sgLoc]); } ?>
                </div>
            <?php elseif ($sgVariant === 'links'): ?>
                <ul class="area-links" data-reveal-group>
                    <?php foreach ($sgGroups[$sgKey] as $sgLoc): ?>
                        <li data-reveal>
                            <a class="area-link" href="<?= e($href($sgLoc)) ?>">
                                <span class="area-link__name"><?= e($label($sgLoc)) ?></span>
                                <?php if (!empty($meta)): ?><span class="area-link__meta"><?= e($meta($sgLoc)) ?></span><?php endif; ?>
                                <?= icon('arrow', 'icon icon--sm area-link__arrow') ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <ul class="chips">
                    <?php foreach ($sgGroups[$sgKey] as $sgLoc): ?>
                        <li><a class="chip" href="<?= e($href($sgLoc)) ?>"><?= e($label($sgLoc)) ?></a></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
    <?php if (!empty($extra)): ?>
        <p class="state-groups__extra"><a class="chip chip--outline" href="<?= e($extra[1]) ?>"><?= e($extra[0]) ?></a></p>
    <?php endif; ?>
</div>
