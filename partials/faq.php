<?php
/**
 * FAQ list as native <details> (works with JS off; answers stay in the DOM
 * for crawlers) + FAQPage schema from the same array. Renders nothing for an
 * empty list. $faqs: [['question' => …, 'answer' => …], …]
 */

if (!defined('ROOT_DIR')) {
    http_response_code(404);
    exit;
}

$faqs = array_values(array_filter($faqs ?? [], static fn($f): bool => !empty($f['question']) && !empty($f['answer'])));
if (!$faqs) {
    return;
}
?>
<div class="faq" data-reveal-group>
    <?php foreach ($faqs as $faqIndex => $faq): ?>
        <details class="faq__item" data-reveal<?= $faqIndex === 0 && !empty($openFirst) ? ' open' : '' ?>>
            <summary class="faq__q"><span><?= e($faq['question']) ?></span><span class="faq__icon" aria-hidden="true"></span></summary>
            <div class="faq__a"><p><?= rich($faq['answer']) ?></p></div>
        </details>
    <?php endforeach; ?>
</div>
<?php
json_ld([
    '@context'   => 'https://schema.org',
    '@type'      => 'FAQPage',
    'mainEntity' => array_map(static fn(array $f): array => [
        '@type' => 'Question',
        'name'  => $f['question'],
        'acceptedAnswer' => ['@type' => 'Answer', 'text' => strip_tags($f['answer'])],
    ], $faqs),
]);
