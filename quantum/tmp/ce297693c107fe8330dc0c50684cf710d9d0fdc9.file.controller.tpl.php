<?php /* Smarty version Smarty-3.0.7, created on 2012-07-08 06:25:02
         compiled from "/Users/carlosbarbosa/Sites/quantum/quantum_2/quantum/script/../system/views/teleport/controller.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9354523264ff927be7c5ab6-88118631%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ce297693c107fe8330dc0c50684cf710d9d0fdc9' => 
    array (
      0 => '/Users/carlosbarbosa/Sites/quantum/quantum_2/quantum/script/../system/views/teleport/controller.tpl',
      1 => 1341728691,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9354523264ff927be7c5ab6-88118631',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<<?php ?>?

/*
 * class <?php echo $_smarty_tpl->getVariable('controller_name')->value;?>

 */

class <?php echo $_smarty_tpl->getVariable('controller_name')->value;?>
 extends Quantum {
    
    /**
     * Public: index
    */
    public function index() {
      
      
    }
    
    <?php if (isset($_smarty_tpl->getVariable('public_functions',null,true,false)->value)){?>
    <?php  $_smarty_tpl->tpl_vars['public_function'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('public_functions')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['public_function']->key => $_smarty_tpl->tpl_vars['public_function']->value){
?>
    
    /**
     * Public: <?php echo $_smarty_tpl->tpl_vars['public_function']->value;?>

    */
    public function <?php echo $_smarty_tpl->tpl_vars['public_function']->value;?>
() {
      
      
    }
    
    <?php }} ?>
    <?php }?>
    
    <?php if (isset($_smarty_tpl->getVariable('private_functions',null,true,false)->value)){?>
    <?php  $_smarty_tpl->tpl_vars['private_function'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('private_functions')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['private_function']->key => $_smarty_tpl->tpl_vars['private_function']->value){
?>
    
    /**
     * Private: <?php echo $_smarty_tpl->tpl_vars['private_function']->value;?>

    */
    private function <?php echo $_smarty_tpl->tpl_vars['private_function']->value;?>
() {
      
      
    }
    
    <?php }} ?>
    <?php }?>
    
    <?php if (isset($_smarty_tpl->getVariable('protected_functions',null,true,false)->value)){?>
    <?php  $_smarty_tpl->tpl_vars['protected_function'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('protected_functions')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['protected_function']->key => $_smarty_tpl->tpl_vars['protected_function']->value){
?>
    
    /**
     * Protected: <?php echo $_smarty_tpl->tpl_vars['protected_function']->value;?>

    */
    protected function <?php echo $_smarty_tpl->tpl_vars['protected_function']->value;?>
() {
      
      
    }
    
    <?php }} ?>
    <?php }?> 
    
}

?<?php ?>>

