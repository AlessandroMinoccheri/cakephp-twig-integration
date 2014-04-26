<?php

class ExamplesController extends AppController {
	public function beforeFilter () {
		parent::beforeFilter(); // chiamo anche il callback beforeFilter dal parent per ottenere un'autorizzazione per l'utente loggato da tutte le viste $this->Auth->allow('index','view'); per tutti i Model 
	}
	
	public function index () {
		
	}
}

?>
