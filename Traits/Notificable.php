<?php

namespace Modules\Iauctions\Traits;


//Events
use Modules\Iauctions\Events\AuctionWasCreated;
use Modules\Iauctions\Events\AuctionWasActived;
use Modules\Iauctions\Events\AuctionWasFinished;

/**
* Trait 
*/
trait Notificable
{


	/**
   	* Boot trait method
   	*/
	public static function bootNotificable()
	{

		
		//Listen event after create model
		static::createdWithBindings(function ($model) {
    		event(new AuctionWasCreated($model));
    		// Created and Active the one
    		$model->checkStatus($model);
		});

		//Listen event after updated model
		static::updatedWithBindings(function ($model) {
			$model->checkStatus($model);
		});


		
	}

	/*
	* Check status model
	*/
	public function checkStatus($model){

		//ACTIVE
		if($model->status==1)
			event(new AuctionWasActived($model));

		//FINISHED
		if($model->status==2)
			event(new AuctionWasFinished($model));
    			

	}

	
}