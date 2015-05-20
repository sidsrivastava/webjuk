<?php

##################################################
##################################################

// Creative Commons Atrribution/Share-Alike License
// The licensor permits others to copy, distribute,
// display, and perform the work. In return,
// licensees must give the original author credit.
//
// The licensor permits others to distribute derivative
// works only under a license identical to the one that
// governs the licensor's work

##################################################
##################################################

require_once ('cc-license.php');

$license = new cc_license ('Creative Commons - Attribution & Share-Alike', 'Creative Commons - by/sa', 'http://creativecommons.org/licenses/by-sa/2.5',
                              'http://creativecommons.org/licenses/by-sa/2.5/legalcode', true, true, true,
                              false, true, true, true, 'http://creativecommons.org/images/public/somerights.gif');

return ($license);

?>