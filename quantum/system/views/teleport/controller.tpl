
<?

/*
 * class {$controller_name}
 */

class {$controller_name} extends Quantum {
    
    /**
     * Public: index
    */
    public function index() {
      
      
    }
    
    {if isset($public_functions)}
    {foreach from=$public_functions item=public_function}
    
    /**
     * Public: {$public_function}
    */
    public function {$public_function}() {
      
      
    }
    
    {/foreach}
    {/if}
    
    {if isset($private_functions)}
    {foreach from=$private_functions item=private_function}
    
    /**
     * Private: {$private_function}
    */
    private function {$private_function}() {
      
      
    }
    
    {/foreach}
    {/if}
    
    {if isset($protected_functions)}
    {foreach from=$protected_functions item=protected_function}
    
    /**
     * Protected: {$protected_function}
    */
    protected function {$protected_function}() {
      
      
    }
    
    {/foreach}
    {/if} 
    
}



?>

