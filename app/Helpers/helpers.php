<?php 
function format_no($number){
    return number_format($number, 0, ',', '.');
}

function format_rp($number)
{
    if($number == 0){
        return 0;
    }

    return 'Rp'.format_no($number);
}


?>