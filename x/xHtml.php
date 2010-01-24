<?php
function xHtmlForm(array $attr, array $elements) {
    $form = '';
    foreach($elements as $name => $element) {
        $form .= xHtmlFormElement($attr['name'], $name, $element);
    }
    
    return xHtmlTag(xHtmlElement('form', $form, $attr));
}

function xHtmlFormElement($form, $name, array $element) {
    $element['attr']['name'] = $form . '['.$name.']';
    $content  = xHtmlTag(xHtmlElement('label', $element['label'], array('for' => $element['attr']['name'])));
    if($element['tag'] == 'select') {
        $eInner = '';
        foreach($element['inner'] as $optValue => $optInner){
            $eInner .= xHtmlTag(xHtmlElement('option', $optInner, array('value' => $optValue)));
        }
        $element['inner'] = $eInner;
    }
    $content .= xHtmlTag($element);
    
    return xHtmlTag(xHtmlElement('div', $content, array('id' => $name)));
}

function xHtmlElement($tag, $inner, array $attr = array()) {
     return array('tag' => $tag, 'inner' => $inner, 'attr' => $attr);   
}

function xHtmlField($tag, $label, $default = null, array $attr = array()) {
    $element = array('tag' => $tag, 'label' => $label, 'attr' => $attr);
    
    if($tag == 'input') {
        if(!isset($attr['type'])) {
            $element['attr']['type'] = 'text';
        }
        
        $element['attr']['value'] = $default;
    } else {
        $element['inner'] = $default;
    }
    
    return $element;
}

function xHtmlTag(array $tag) {
    $attrStr = '';
    foreach($tag['attr'] as $k => $v) {
        $attrStr .= sprintf(' %s="%s"', $k, $v);
    }
    
    if(isset($tag['inner'])) {
        return sprintf("\n<%s%s>%s</%s>", $tag['tag'], $attrStr, $tag['inner'], $tag['tag']);
    } else {
        return sprintf("\n<%s %s />", $tag['tag'], $attrStr);
    }
}

$form = array();
$form['username'] = xHtmlField('input', 'Username');
$form['info'] = xHtmlField('textarea', 'Info', 'asdf');
$form['password'] = xHtmlField('input', 'Password', null, array('type' => 'password'));
$form['email'] = xHtmlField('input', 'Email', '%auto%');
$form['type'] = xHtmlField('select', 'Type', array('id1' => 'Two'));

echo xHtmlForm(array('name' => 'User', 'action' => '', 'method' => 'post'), $form);
?>
