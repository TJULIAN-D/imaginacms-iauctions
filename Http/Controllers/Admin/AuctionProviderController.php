<?php

namespace Modules\Iauctions\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Iauctions\Entities\AuctionProvider;
use Modules\Iauctions\Http\Requests\CreateAuctionProviderRequest;
use Modules\Iauctions\Http\Requests\UpdateAuctionProviderRequest;
use Modules\Iauctions\Repositories\AuctionProviderRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

use Modules\Iauctions\Repositories\AuctionRepository;

use Modules\Iauctions\Entities\Status;

use Modules\Setting\Contracts\Setting;

class AuctionProviderController extends AdminBaseController
{
    /**
     * @var AuctionProviderRepository
     */
    private $auctionprovider;
    private $auction;
    private $status;
    private $setting;

    public function __construct(
        AuctionProviderRepository $auctionprovider,
        AuctionRepository $auction,
        Status $status,
        Setting $setting
    ){
        parent::__construct();
        $this->auctionprovider = $auctionprovider;
        $this->auction = $auction;
        $this->status = $status;
        $this->setting = $setting;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$auctionproviders = $this->auctionprovider->all();

        return view('iauctions::admin.auctionproviders.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('iauctions::admin.auctionproviders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateAuctionProviderRequest $request
     * @return Response
     */
    public function store(CreateAuctionProviderRequest $request)
    {
        $this->auctionprovider->create($request->all());

        return redirect()->route('admin.iauctions.auctionprovider.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('iauctions::auctionproviders.title.auctionproviders')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  AuctionProvider $auctionprovider
     * @return Response
     */
    public function edit($id)
    {
        $auction = $this->auction->find($id);
        $status = $this->status;

        return view('iauctions::admin.auctionproviders.edit', compact('auction','status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  AuctionProvider $auctionprovider
     * @param  UpdateAuctionProviderRequest $request
     * @return Response
     */
    public function update(AuctionProvider $auctionprovider, UpdateAuctionProviderRequest $request)
    {
        //$this->auctionprovider->update($auctionprovider, $request->all());

        return redirect()->route('admin.iauctions.auctionprovider.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('iauctions::auctionproviders.title.auctionproviders')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  AuctionProvider $auctionprovider
     * @return Response
     */
    public function destroy(AuctionProvider $auctionprovider)
    {
        $this->auctionprovider->destroy($auctionprovider);

        return redirect()->route('admin.iauctions.auctionprovider.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('iauctions::auctionproviders.title.auctionproviders')]));
    }

     /**
     * Update Status
     *
     * @param  
     * @return Response
     */
    public function updateStatus(Request $request){

        try {

            // Update Status
            $auctionprovider = $this->auctionprovider->find($request->auctionprovider_id);
            $auctionprovider->status = $request->status;
            $auctionprovider->update();
            
            // Send Email to Provider
            $email_from = $this->setting->get('iauctions::from-email');
            $email_to = explode(',',$this->setting->get('iauctions::to-email'));
            $sender  = $this->setting->get('core::site-name');

            $auction = $auctionprovider->auction;
            
            $msjTheme = "iauctions::email.auctionprovider_status";
            $msjSubject = trans('iauctions::common.email.subject.change state')." #".$auction->id;
            $msjIntro = trans('iauctions::common.email.intro.change state');
            
            $userEmail = $auctionprovider->user->email;
            $userFirstname = $auctionprovider->user->first_name;
            
            $statusName = $this->status->get($auctionprovider->status);

            $content=[
                'auction'=> $auction,
                'user' => $userFirstname,
                'statusName' => $statusName
            ];
            
            $mailUser = iauctions_emailSend(['email_from'=>[$email_from],'theme' => $msjTheme,'email_to' => $userEmail,'subject' => $msjSubject, 'sender'=>$sender,'data' => array('title' => $msjSubject,'intro'=> $msjIntro,'content'=>$content)]);
            
           
          return response()->json(['success'=>1,'msg'=> trans('core::core.messages.resource updated', ['name' => trans('iauctions::auctionproviders.title.auctionproviders')])]);
        
        } catch (\Exception $e) {

          return response()->json(['success'=>0,'msg'=>$e->getMessage()]);

        }

    }

}
