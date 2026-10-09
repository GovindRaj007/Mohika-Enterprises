<?php
/**
 * Every business fact the site shows. Only values the client supplied are
 * filled in; everything else is null and renders nothing — no placeholder,
 * no plausible guess. Each partial and schema block checks for emptiness, so
 * filling a value here is all it takes to make it appear everywhere.
 */

if (!defined('ROOT_DIR')) {
    http_response_code(404);
    exit;
}

return [
    'name'       => 'Mohika Invisible Grills & Safety Nets',
    'short_name' => 'Mohika',

    // Primary number: every call button, tel: link and WhatsApp link uses it.
    'phone_display' => '91003 25366',
    'phone_e164'    => '+919100325366',

    // Second number — shown only as an alternate line in contact details
    // (footer, contact page, schema), never on a call or WhatsApp button.
    'alt_phone_display' => '91828 32070',
    'alt_phone_e164'    => '+919182832070',

    // WhatsApp runs on the primary number.
    'whatsapp_e164'           => '+919100325366',
    'whatsapp_message_prefix' => 'Hi Mohika, I would like a quote for ',

    'email' => 'mohikainvisiblegrills@gmail.com',

    'state'   => 'Andhra Pradesh',
    'country' => 'India',

    // TODO(client): the business address will be supplied later. While null,
    // no address is printed and the LocalBusiness schema is published as a
    // service-area business (areaServed only, no PostalAddress or geo).
    // Shape when supplied:
    //   ['street' => '…', 'locality' => '…', 'region' => 'Andhra Pradesh',
    //    'postal_code' => '…']
    'address' => null,
    'geo'     => null,     // ['latitude' => '…', 'longitude' => '…']
    'google_maps_url' => null,

    // Supplied by the client: "7+ years".
    'years_experience' => 7,

    // Not supplied — nothing renders for any of these.
    'opening_hours'   => null,
    'warranty'        => null,
    'installs_count'  => null,
    'price_from'      => null,   // per-sq-ft rate; titles gain "From ₹X" when set
    'gbp_url'         => null,   // Google Business Profile
    'gbp_review_url'  => null,   // "write a review" link
    'social'          => [],     // ['facebook' => 'https://…', 'instagram' => '…']

    // The offer every CTA repeats — confirmed free by the client.
    'offer'       => 'Free site visit & measurement',
    'offer_short' => 'Free site visit',

    // Quote form delivery. mail_from must be a real mailbox on the site's own
    // domain (create it in the hosting panel) so SPF aligns — see DEPLOY.md.
    'contact_recipient_email' => 'mohikainvisiblegrills@gmail.com',
    'mail_from'               => 'no-reply@mohikainvisiblegrills.in',

    // One line under the logo in the footer.
    'footer_blurb' => 'Invisible grills, balcony safety nets, pigeon nets, cricket nets and ceiling cloth hangers — measured, fitted and finished by local team members in six cities of Andhra Pradesh.',
];
