<?php

class TourController extends Zend_Controller_Action
{
    
    
	 public function indexAction() {
   	 
    	$db = new Zend_Db_Table('active_tours');
    	$select = $db->select()->setIntegrityCheck(false);
   
    	$select->from(array('t0'=>'active_tours'),array("t0.*"))
            	->join(array('t1'=>'dates'),"t0.date_id=t1.date_id",array("t1.tour_dt"))
            	->join(array('t2'=>'tours'),"t0.tour_id=t2.tour_id",array("t2.coach_id","t2.tour_title"))
            	->join(array('t3'=>'coaches'),"t2.coach_id=t3.coach_id",array("t3.coach_reg","t3.type_id"))
            	->join(array('t4'=>'coach_types'),"t3.type_id=t4.type_id",array("t4.capacity"))
            	->joinLeft(array('t5'=>'bookings'),"t0.active_tour_id=t5.active_tour_id",array("count(booking_id) as bookings","t4.capacity - count(booking_id) as availability"))
            	->group(array('active_tour_id'));
   	 
  	//die($select->assemble());
	 
    	$this->view->rows = $select->query()->fetchAll();
 	 
   	 
	}
    

        public function bookingAction() {
   	 
    	$active_tour_id = (int) $this->getParam('id',0);
   	 
    	$this->view->active_tour_id  = $active_tour_id;
        
        $form = new Application_Form_Booking();
   	 
    		
   	 
        	if($this->getRequest ()->isPost () ){
                    
                    
                    $formData = $this->getRequest ()->getPost() ;
                    
                  //  die(print_r($formData));
                    
                    if ($form->isValid($formData)){
        
       	                //die ('form is valid'); 
        	$dbContact = new Zend_Db_Table('contacts');
       	 
        	$contact_id = $dbContact->insert(array('contact_id'=>null,
                    'name_f'=>$form->getvalue('name_f'),
                    'name_l'=>$form->getValue('name_l'),
                        ));
       	 
       	 
        	$dbBooking = new Zend_Db_Table('bookings');
       	 
        	$booking_id = $dbBooking->insert(array('booking_id'=>null,
                    'active_tour_id'=>$form->getValue('active_tour_id'),
                    'contact_id'=>$contact_id,'booking_dt'=>new Zend_Db_Expr('Now()')));
                    }else{
        	echo "<p>Contact is $contact_id";
         	echo "<p>Booking  is $booking_id";
                           	 
        	//$this->redirect("tour");             	 
                           	 
    	}

   	 
}

        }
}
    
        
    


   
        
        
     
        
    