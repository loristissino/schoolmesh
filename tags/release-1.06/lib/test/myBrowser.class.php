<?php
class myBrowser extends sfTestBrowser
{
   public function login($login, $password)
   {
     $this->
       post('/login', array('signin[username]' => $login, 'signin[password]' =>$password))->
       isStatusCode(200)->
       isRedirect()->
       followRedirect()
     ;

/*     $this->
       get('/some/page/requiring/auth.hmtl')->
       isStatusCode(200)->
       checkResponseElement('body', '/Your Profile/')
     ;
*/
     return $this;
   }

   public function logout($login, $password)
  {
  }

}
