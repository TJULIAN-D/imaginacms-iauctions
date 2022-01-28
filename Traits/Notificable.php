<?php

namespace Modules\Iauctions\Traits;


//Events
use Modules\Iauctions\Events\AuctionWasCreated;

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
		});

		//Listen event after updated model
		static::updatedWithBindings(function ($model) {

			\Log::info('Iauctions: Traits|Notificable|ModelUpdated');

    		// OJO AQUI VALIDAR EL EVENTO DEPNDIENDO DEL EDO
    		event(new AuctionWasCreated($model));

		});


		
	}

	
}