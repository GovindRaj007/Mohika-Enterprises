<?php
/**
 * The quote form. Four fields and a consent box — no email field, because
 * this trade replies by phone and WhatsApp, and every extra field costs
 * completions. Posts to /actions/contact-handler.php, which is the source
 * of truth for validation; assets/js/site.js repeats the same rules on blur
 * and submit (never on keypress).
 *
 * Pre-selection: ?service=slug (or comma-separated slugs) and ?city=slug.
 * After a submission: ?sent=1 replaces the form with a thank-you; ?error=
 * shows the phone number as the fallback.
 */

if (!defined('ROOT_DIR')) {
    http_response_code(404);
    exit;
}

session_begin();
$formErrors = $_SESSION['contact_errors'] ?? [];
$formOld    = $_SESSION['contact_old'] ?? [];
unset($_SESSION['contact_errors'], $_SESSION['contact_old']);

$formBiz      = business();
$formServices = get_all_services();
$formCities   = get_all_locations();

$preServices = array_filter(explode(',', (string) ($_GET['service'] ?? '')), static fn($s): bool => isset($formServices[$s]));
$preCity     = isset($formCities[$_GET['city'] ?? '']) ? (string) $_GET['city'] : '';

$selServices = $formOld['services'] ?? array_values($preServices);
$selCity     = $formOld['city'] ?? $preCity;
$consent     = $formOld ? !empty($formOld['consent']) : true;

$sent  = isset($_GET['sent']);
$error = (string) ($_GET['error'] ?? '');

$fieldErr = static function (string $field) use ($formErrors): string {
    return isset($formErrors[$field]) ? ' aria-invalid="true" aria-describedby="err-' . $field . '"' : '';
};
?>
<div class="quote-card" id="quote">
    <?php if ($sent): ?>
        <div class="quote-card__done" role="status">
            <span class="quote-card__done-icon"><?= icon('check') ?></span>
            <h2 class="quote-card__title">Thank you — we have your request</h2>
            <p>We will call or WhatsApp you on the number you gave to fix a time for the site visit. If it is urgent, call us now.</p>
            <div class="quote-card__done-actions">
                <a class="btn btn--cta" href="<?= e(tel_href()) ?>"><?= icon('phone', 'icon icon--sm') ?> <?= e($formBiz['phone_display']) ?></a>
                <a class="btn btn--whatsapp" href="<?= e(whatsapp_url()) ?>" target="_blank" rel="noopener"><?= icon('whatsapp', 'icon icon--sm') ?> Send photos on WhatsApp</a>
            </div>
        </div>
    <?php else: ?>
        <h2 class="quote-card__title"><?= e($formTitle ?? 'Get a free quote') ?></h2>
        <p class="quote-card__note"><?= e($formBiz['offer']) ?>. We reply by phone or WhatsApp.</p>

        <?php if ($error !== '' || isset($formErrors['form'])): ?>
            <div class="form-alert" role="alert">
                <?= icon('phone', 'icon icon--sm') ?>
                <p><?= e($formErrors['form'] ?? 'Sorry — your request could not be sent.') ?> Please call or WhatsApp us on <a href="<?= e(tel_href()) ?>"><?= e($formBiz['phone_display']) ?></a>.</p>
            </div>
        <?php endif; ?>

        <form class="form" action="/actions/contact-handler.php" method="post" novalidate data-quote-form>
            <?= csrf_field() ?>
            <input type="hidden" name="source" value="<?= e(current_path() ?? '/contact-us.php') ?>">
            <div class="form__hp" aria-hidden="true">
                <label for="website">Leave this empty</label>
                <input type="text" id="website" name="website" tabindex="-1" autocomplete="off">
            </div>

            <div class="form__row">
                <label class="form__label" for="f-name">Your name</label>
                <input class="form__input" type="text" id="f-name" name="name" maxlength="100" autocomplete="name" required value="<?= e($formOld['name'] ?? '') ?>"<?= $fieldErr('name') ?>>
                <p class="form__error" id="err-name"<?= isset($formErrors['name']) ? '' : ' hidden' ?>><?= e($formErrors['name'] ?? 'Enter your name.') ?></p>
            </div>

            <div class="form__row">
                <label class="form__label" for="f-phone">Mobile number</label>
                <input class="form__input" type="tel" id="f-phone" name="phone" inputmode="numeric" autocomplete="tel" required placeholder="10-digit mobile" value="<?= e($formOld['phone'] ?? '') ?>"<?= $fieldErr('phone') ?>>
                <p class="form__error" id="err-phone"<?= isset($formErrors['phone']) ? '' : ' hidden' ?>><?= e($formErrors['phone'] ?? 'Enter a 10-digit mobile number.') ?></p>
            </div>

            <div class="form__row">
                <label class="form__label" for="f-city">City</label>
                <select class="form__input" id="f-city" name="city" required<?= $fieldErr('city') ?>>
                    <option value="">Choose your city</option>
                    <?php foreach (locations_by_state() as $formStateKey => $formStateCities): ?>
                        <optgroup label="<?= e(get_states()[$formStateKey]['name']) ?>">
                            <?php foreach ($formStateCities as $formCity): ?>
                                <option value="<?= e($formCity['slug']) ?>"<?= $selCity === $formCity['slug'] ? ' selected' : '' ?>><?= e(city_display_name($formCity)) ?></option>
                            <?php endforeach; ?>
                        </optgroup>
                    <?php endforeach; ?>
                    <option value="elsewhere"<?= $selCity === 'elsewhere' ? ' selected' : '' ?>>Somewhere else in AP or Telangana</option>
                </select>
                <p class="form__error" id="err-city"<?= isset($formErrors['city']) ? '' : ' hidden' ?>><?= e($formErrors['city'] ?? 'Choose your city.') ?></p>
            </div>

            <fieldset class="form__row form__group"<?= isset($formErrors['services']) ? ' aria-describedby="err-services"' : '' ?>>
                <legend class="form__label">What do you need?</legend>
                <div class="checks">
                    <?php foreach ($formServices as $formSvc): ?>
                        <label class="check">
                            <input type="checkbox" name="services[]" value="<?= e($formSvc['slug']) ?>"<?= in_array($formSvc['slug'], $selServices, true) ? ' checked' : '' ?>>
                            <span class="check__box"><?= icon('check', 'icon icon--sm') ?></span>
                            <span><?= e($formSvc['nav_label']) ?></span>
                        </label>
                    <?php endforeach; ?>
                </div>
                <p class="form__error" id="err-services"<?= isset($formErrors['services']) ? '' : ' hidden' ?>><?= e($formErrors['services'] ?? 'Pick at least one.') ?></p>
            </fieldset>

            <label class="check check--consent">
                <input type="checkbox" name="consent" value="1"<?= $consent ? ' checked' : '' ?>>
                <span class="check__box"><?= icon('check', 'icon icon--sm') ?></span>
                <span>You may call or WhatsApp me about this request.</span>
            </label>

            <button class="btn btn--cta btn--lg btn--block" type="submit" data-track="quote-submit">Request my free quote <?= icon('arrow', 'icon icon--sm') ?></button>
        </form>
    <?php endif; ?>
</div>
