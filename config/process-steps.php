<?php
/**
 * The four-step process shown on the home, service and city pages. Service
 * pages replace step 3's text with the service's own 'install_step_text'.
 */

if (!defined('ROOT_DIR')) {
    http_response_code(404);
    exit;
}

return [
    ['heading' => 'Call or WhatsApp', 'text' => 'Tell us what needs covering. A photo of the balcony or window helps us come prepared.'],
    ['heading' => 'Site visit & measurement', 'text' => 'We measure every opening, show you the material and give a written quote before anything is fitted.'],
    ['heading' => 'Installation', 'text' => 'Your local team fits everything into sound concrete, usually in a single visit for a home.'],
    ['heading' => 'Check & clean-up', 'text' => 'We test the tension and fixings with you, fill and clean around the work, and leave the space ready to use.'],
];
