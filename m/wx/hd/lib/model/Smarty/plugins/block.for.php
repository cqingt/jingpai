<?php
function smarty_block_for($params, $content, &$smarty){
    if(is_null($content)) {
        return;
    }
    $from = 0;
    $to = 0;
    $step = 1;
   
    foreach ($params as $_key => $_val) {
        switch ($_key) {
            case 'from':
            case 'to':
            case 'step':
                $$_key = (int)$_val;
                break;

            default:
                $smarty->trigger_error("textformat: unknown attribute '$_key'");
        }
    }

    $_output = '';

    for($_x = $from; $_x <= $to; $_x += $step) {
        $_output .= $content."\n\r";
    }

    return $_output;

}
?>
