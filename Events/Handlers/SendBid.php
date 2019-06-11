<?php

namespace Modules\Iauctions\Events\Handlers;


use Illuminate\Contracts\Mail\Mailer;
use Modules\Iauctions\Events\BidWasCreated;
use Modules\Iauctions\Repositories\AuctionRepository;

class SendBid
{

   private $aution;


    public function __construct(AuctionRepository $auction)
    {
        $this->aution=$auction;
    }

    public function handle(BidWasCreated $event)
    {
        $bit=$event->bit;
        $auction=$bit->auction;
        $data=$event->data;
        $dataAution=array();
        try{
            if(empty($auction->winner_value) || $auction->winner_value > $bit->present()->total){
                $dataAution=['winner_id'=>$bit->id,'winner_value'=>$bit->present()->total];
            }
            if($auction->longer_term<$data['longer_term']) {
                $dataAution['longer_term'] = $data['longer_term'];
            }
            if(!empty($dataAution)) $this->aution->update($auction,$dataAution);
        }catch (\Exception $e){
            \Log::error($e);
            return $e->getMessage();
        }

    }
}