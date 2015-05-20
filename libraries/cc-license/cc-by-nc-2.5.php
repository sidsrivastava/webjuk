<?php

##################################################
##################################################

// Creative Commons Atrribution/Non-commercial License
// The licensor permits others to copy, distribute,
// display, and perform the work. In return,
// licensees must give the original author credit.
//
// The licensor permits others to copy, distribute,
// display, and perform the work. In return, licensees
// may not use the work for commercial purposes --
// unless they get the licensor's permission.

##################################################
##################################################

require_once ('cc-license.php');

$license = new cc_license ('Creative Commons - Attribution & Non-Commercial', 'Creative Commons - by/nc','http://creativecommons.org/licenses/by-nc/2.5',
                              'http://creativecommons.org/licenses/by-nc/2.5/legalcode', true, true, true,
                              true, true, true, false, 'http://creativecommons.org/images/public/somerights.gif');

return ($license);

?>