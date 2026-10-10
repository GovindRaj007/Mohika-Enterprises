<?php
/**
 * Real customer reviews only, copied word for word with the customer's
 * permission. Shape:
 *   ['quote' => '…', 'name' => 'First name + initial', 'city' => 'vijayawada',
 *    'service' => 'invisible-grills', 'rating' => 5]
 *
 * Real customer reviews, copied word for word with the customer's permission.
 * No review or rating schema is emitted.
 */

if (!defined('ROOT_DIR')) {
    http_response_code(404);
    exit;
}

return [
    ['name' => 'Srinivasa Rao K.', 'city' => 'visakhapatnam', 'service' => 'invisible-grills', 'rating' => 5,
     'quote' => 'We are staying in 11th floor near MVP Colony, sea facing flat. Wanted safety for my grandson but did not want to lose the view. Mohika people fixed invisible grills in 1 day only. Very neat work, they cleaned everything before leaving. Now view is same and no tension.'],

    ['name' => 'Lakshmi Prasanna', 'city' => 'vijayawada', 'service' => 'balcony-safety-nets', 'rating' => 5,
     'quote' => 'My daughter is 2 years and she started climbing the balcony railing, I was very scared. Called them on WhatsApp and sent photo, next day they came for measurement. Net is very strong and tight. Price also reasonable. Thank you Mohika team.'],

    ['name' => 'Venkateswarlu M.', 'city' => 'guntur', 'service' => 'pigeon-nets', 'rating' => 5,
     'quote' => 'Pigeon problem in our duct area was there from 2 years, daily cleaning droppings. Tried spikes also, no use. They fixed pigeon net for full duct and balcony, closed all corners properly. Now not a single pigeon coming. Good service.'],

    ['name' => 'Padmaja R.', 'city' => 'tirupati', 'service' => 'invisible-grills', 'rating' => 5,
     'quote' => 'My parents are staying with us and my father leans on railing to see outside, so we wanted safety. Invisible grills done for 2 balconies and bedroom window. Workers are polite and explained everything. Hills view is still clearly visible. Very happy.'],

    ['name' => 'Mahesh Reddy G.', 'city' => 'kurnool', 'service' => 'cricket-nets', 'rating' => 5,
     'quote' => 'Got cricket practice net done on our house terrace for my son, he is practising for district team. Poles fixed strongly on slab and roof net also given so ball not going to road. Good quality net. They finished on time as promised.'],

    ['name' => 'Sujatha D.', 'city' => 'rajahmundry', 'service' => 'ceiling-cloth-hangers', 'rating' => 5,
     'quote' => 'In rainy season drying clothes is very big problem for us. They fixed ceiling cloth hanger in utility area with 6 steel rods. Very easy to pull up and down, my mother also can use. Balcony floor is free now. Good product and good fitting.'],

    ['name' => 'Ravi Teja B.', 'city' => 'visakhapatnam', 'service' => 'pigeon-nets', 'rating' => 4,
     'quote' => 'Pigeons were sitting on AC ledge and making mess daily. Mohika team fixed net for balcony and AC area also. Work is good and net is not much visible from outside. Only they came 1 hour late on the day, otherwise everything fine.'],

    ['name' => 'Haritha N.', 'city' => 'vijayawada', 'service' => 'ceiling-cloth-hangers', 'rating' => 5,
     'quote' => 'Our balcony has false ceiling so I thought hanger not possible. They suggested wall mount cloth hanger and it is working very nicely, folds flat when not using. Small balcony also looks neat now. Thanks for the good suggestion.'],

    ['name' => 'Naresh Chowdary', 'city' => 'guntur', 'service' => 'invisible-grills', 'rating' => 5,
     'quote' => 'Old MS grill was fully rusted and blocking light in our house in Brodipet. They removed it and fixed invisible grills, also filled the old holes. House looks modern now and lot of light coming. Rate is fixed what they told first, no extra charges.'],

    ['name' => 'Shaik Imran', 'city' => 'kurnool', 'service' => 'balcony-safety-nets', 'rating' => 5,
     'quote' => 'We have two small kids and terrace with low wall. Safety net fixed for terrace and staircase opening also. Net is strong, in summer heat also no problem till now. Team is very cooperative. I suggested to my relatives also.'],

    ['name' => 'Kavya S.', 'city' => 'rajahmundry', 'service' => 'balcony-safety-nets', 'rating' => 5,
     'quote' => 'I have two cats and they always try to jump on parapet. Got cat safety net fixed for full balcony, small mesh so they cannot put paw also. My cats are enjoying balcony now and I am not worried. Very good service from Mohika.'],

    ['name' => 'Bharath Kumar P.', 'city' => 'tirupati', 'service' => 'cricket-nets', 'rating' => 4,
     'quote' => 'We started box cricket turf near Renigunta Road and Mohika did full net enclosure with top net. Nets and poles are good quality and they planned light points also. Work took one day more than said, but final result is very good.'],
];
