<?php
function genBoxError($err, $class){
    $htmlErr = ''; $blockErr = '';
    if(is_array($err)){
        foreach($err as $item){
            $htmlErr .= '<p>'.$item.'</p>';
        }
    }else{
        if($err != '')
            $htmlErr .= $err;
    }

    if($htmlErr != ''){
        $blockErr = '<div class="alert alert-danger '.$class.'" role="alert">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                <span class="sr-only">Error:</span>'.$htmlErr.'
            </div>';
    }
    return $blockErr;

}

function genBoxSuccess($err, $class){
    $htmlErr = ''; $blockErr = '';
    if(is_array($err)){
        foreach($err as $item){
            $htmlErr .= '<p>'.$item.'</p>';
        }
    }else{
        if($err != '')
            $htmlErr .= $err;
    }

    if($htmlErr != ''){
        $blockErr = '<div class="alert alert-success '.$class.'" role="alert">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                <span class="sr-only">Error:</span>'.$htmlErr.'
            </div>';
    }
    return $blockErr;

}


function genOption($list, $selected, $field = 'value'){
    if(!is_array($list)) return '';
    $html = '';
    foreach($list as $key => $val){
        $select = $val["id"] == $selected ? 'selected="selected"' : '';
        $html .= '<option '.$select.' value="'.$val["id"].'">'.$val[$field].'</option>';
    }
    return $html;
}
function genRadio($inputName, $list, $selected, $class = 'mR15' ,$field = 'value'){
    if(!is_array($list)) return '';
    $html = '';
    foreach($list as $key => $val){
        $select = $val["id"] == $selected ? TRUE : FALSE;
        $df = set_radio($inputName, $val['id'], $select);
        $html .= '<input '.$df.'  type="radio" name="'.$inputName.'" value="'.$val["id"].'" class="ipt-radio" /> ';
        $html .= '<span class="lbl-radio '.$class.'">'.$val[$field].'</span> ';
    }
    return $html;
}


?>