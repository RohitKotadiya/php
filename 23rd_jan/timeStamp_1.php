<?php

//cureent time
echo 'date/time is' . date(' D M Y , H:i:s', time());
echo '<br> date/time is' . date(' d m y , h:i:s:', time());
echo '<br> date/time is'. date(' d-m-y \T H:i:s.uP', time());

//time modified
echo '<br><br>time modified : ' . date('d-m-y @ H:i:s', strtotime('+1 week'));
echo '<br><br>time modified : ' . date('d-m-y @ H:i:s', strtotime('+1 week 5 hours'));
echo '<br><br>time modified : ' . date('d-m-y @ H:i:s', strtotime('+1 year 2 months'));
?>