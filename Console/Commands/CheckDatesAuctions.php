<?php

namespace Modules\Iauctions\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Log;

use Modules\Iauctions\Entities\Auction;

use Carbon\Carbon;

class CheckDatesAuctions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'checkDatesAuctions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check dates of auctions and UPDATE the status';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        
        $this->auctionsPending();

    }

    /**
     *  Check Auctions Pending and change to Published
     */
    public function auctionsPending(){
         
        $auctions = Auction::where("status",1)->get();
        Log::info('Revisando Licitaciones Pendientes - Cantidad: '.count($auctions));
        
        if(count($auctions)>0){
             foreach ($auctions as $auction) {
 
                 $startTime =  Carbon::parse($auction->started_at);
                 $now = Carbon::now();
                 Log::info("ID: {$auction->id} - Start: {$auction->started_at}");
                 Log::info("Today: {$now}");
            
                 if($now->greaterThanOrEqualTo($startTime)){
                    $update = Auction::where("id",$auction->id)->update(['status' => 2]);
                    Log::info("ID:{$auction->id} - Changed state to Publish");
                 }
 
             }
        }

    }

    /**
     *  Check Auctions Published and change to Finished
     */
    public function auctionsPublished(){
        /*
        $auctions = Auction::where("status",1)->get();
         //Log::info('Revisando Licitaciones - Cantidad: '.count($auctions));
        $this->comment('Revisando Licitaciones Pendientes- Cantidad: '.count($auctions));
        if(count($auctions)>0){
             foreach ($auctions as $auction) {
 
                 $startTime =  Carbon::parse($auction->started_at);
                 $now = Carbon::now();
 
                 $this->comment("ID: {$auction->id} - Start: {$auction->started_at}");
                 $this->comment("Today: {$now}");
 
                 // Update status to Published
                 if($now->greaterThanOrEqualTo($startTime)){
                     $this->comment("ID:{$auction->id} - Change state to Publish");
                     $update = Auction::where("id",$auction->id)
                     ->update(['status' => 2]);
                 }
 
             }
        }
        */

    }

    

}
