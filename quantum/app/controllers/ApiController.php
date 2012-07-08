<?

/*
 * class ApiController
 * Example for implementing a simple api class,
 * uses the Quantum\ApiOutput and Quantum\ApiException
 * classes for rendering data to the client.
 */

class ApiController extends Quantum {
    
    function member() {
        
        if (!isset($_REQUEST['code'])) {
            Quantum\ApiException::invalidParameters();
        }
       
       $member = Member::find_by_id($this->requestData['id']);
       
        if (empty($member)) {
            Quantum\ApiException::resourceNotFound();
        }
        
        $data['first_name'] = $member->first_name;
        $data['last_name'] = $member->last_name;
        $data['created_at'] = strtotime($member->created_at);
        $data['updated_at'] = strtotime($member->updated_at);
        
        Quantum\ApiOutput::adaptableOutput($data);
       
       
    }
    
    
    
    
   
    
}
