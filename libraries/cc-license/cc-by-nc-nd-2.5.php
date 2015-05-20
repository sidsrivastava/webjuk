<?php

##################################################
##################################################

// Creative Commons Atrribution/No Derivatives License
// The licensor permits others to copy, distribute,
// display, and perform the work. In return,
// licensees must give the original author credit.
//
// The licensor permits others to copy, distribute,
// display and perform only unaltered copies of the
// work -- not derivative works based on it.

##################################################
##################################################

require_once ('cc-license.php');

$license = new cc_license ('Creative Commons - Attribution, Non-Commercial & No Derivative Works', 'Creative Commons - by/nc/nd', 'http://creativecommons.org/licenses/by-nc-nd/2.5',
                              'http://creativecommons.org/licenses/by-nc-nd/2.5/legalcode', true, true, false,
                              true, true, true, false, 'http://creativecommons.org/images/public/somerights.gif');

return ($license);

?>