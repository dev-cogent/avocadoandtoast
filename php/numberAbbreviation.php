<?php   
function numberAbbreviation($number) {
        if($number == NULL || $number == 0){
          $number = "0";
          return $number;
        }
        $abbrevs = array(12 => "T", 9 => "b", 6 => "m", 3 => "k", 0 => "");
          foreach($abbrevs as $exponent => $abbrev) {
        if($number >= pow(10, $exponent)) {
            $display_num = $number / pow(10, $exponent);
            $decimals = ($exponent >= 3 && round($display_num) < 100) ? 1 : 0;
            return number_format($display_num,$decimals) . $abbrev;
        }}}
        ?>