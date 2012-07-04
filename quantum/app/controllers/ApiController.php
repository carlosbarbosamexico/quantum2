<?

/*
 * class ApiController
 * Example for implementing a simple api class,
 * uses the Quantum\ApiOutput and Quantum\ApiException
 * classes for rendering data to the client.
 */

class ApiController extends Quantum {
    
    /*
     * __construct()
     * @param $arg
     */
    
    function index() {
        $this->set('title_for_layout', 'Data and Insights');
          
    }
    
    /**
     * Example of user api endpoint:
     * You should access it as /api/member?code=FBPWEFW
    */
    function member() {
        
        if (!isset($_REQUEST['code'])) {
            Quantum\ApiException::invalidParameters();
        }
       
       $member = Member::find_by_promo_code($_REQUEST['code']);
       
        if (empty($member)) {
            Quantum\ApiException::resourceNotFound();
        }
        
        $data['first_name'] = $member->first_name;
        $data['last_name'] = $member->last_name;
        $data['promo_code'] = $member->promo_code;
        $data['promo_code_hash'] = to_password($member->promo_code, $this->environment->system_salt); 
        $data['language'] = $member->language;
        $data['email'] = $member->email;
        $data['facebook'] = $member->facebook;
        $data['created_at'] = strtotime($member->created_at);
        $data['updated_at'] = strtotime($member->updated_at);
        
        Quantum\ApiOutput::adaptableOutput($data);
       
       
    }
    
    
    
    
   
    
}
