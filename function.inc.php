<?php
function check_form($form) {
    if(!get_magic_quotes_gpc()) {
        for($i=0;$i<11;$i++) {
            $form[$i] = addslashes($form[$i]);
        }
    }
    return $form;
}

function json_encode_u8($str)
{
    $code = json_encode($str);
    return preg_replace("#\\\\u([0-9a-f]{4})#ie", "iconv('UCS-2','UTF-8', pack('H4', '\\1'))", $code);
}
?>
