<?php

namespace Modules\Iauctions\Console;

use Illuminate\Console\Command;
use Modules\Iauctions\Emails\WinnerAuction;
use Modules\Iauctions\Repositories\AuctionRepository;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Support\Facades\Mail;

class SendEmailWinnerAuctions extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'iauctions:winner';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Look for the bids that have finished and send the mail to the winner';


    private $mail;
    private $auction;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(AuctionRepository $auction, Mail $mail)
    {
        parent::__construct();
        $this->auction=$auction;
        $this->mail = $mail;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try{
            \Log::info('cron');
         $auctions=$this->auction->getItemsBy(json_decode(json_encode(['include'=>['winner'],'filter'=>['status'=>2],'take'=>null])));
         foreach ($auctions as $auction){
             if($auction->finished_at<= now()->toDateString()){
                 $bid=$auction->winner;
                 $user=$bid->provider;
                 \Log::info($user);
                 $subject = trans("iauctions::auctions.messages.winner");
                 $view = "Oficio de Licitación No:  JC-".$auction->id;
                 Mail::to($user->email)->send(new WinnerAuction($user, $auction, $subject, $view));
                 $data=['status'=>3];
                 $this->info('se a actualizado y enviado la Licitación; '.$auction->id);
                 $this->auction->update($auction,$data);
             }
         }
        }catch (\Exception $e){
            \Log::error($e);
            $this->info($e->getMessage());
        }
    }

    /**
     * Get the console command arguments.
     *
     * @return array

    protected function getArguments()
    {
        return [
            ['example', InputArgument::REQUIRED, 'An example argument.'],
        ];
    }
*/
    /**
     * Get the console command options.
     *
     * @return array

    protected function getOptions()
    {
        return [
            ['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
        ];
    }*/
}
