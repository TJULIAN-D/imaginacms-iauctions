<?php

namespace Modules\Iauctions\Presenters;

use Laracasts\Presenter\Presenter;

class BidsPresenter extends Presenter
{

    public function __construct($entity)
    {
        parent::__construct($entity);
        $this->auctions = app('Modules\Iauctions\Repositories\AuctionRepository');
    }

    public function auction()
    {
        return $this->auctions->get($this->entity->auction_id);

    }

    public function financialCost()
    {
        return $this->entity->longer_term >= intval($this->auction()->longer_term) ? 0 : ((intval($this->auction()->longer_term) - intval($this->entity->longer_term)) * intval($this->auction()->financial_cost_monthly)) * intval($this->entity->price) + ((intval($this->auction()->longer_term_freight) - intval($this->entity->freight_term)) * intval($this->auction()->financial_cost_monthly)) * intval($this->entity->freight_price);
    }

    public function total()
    {
        $TotlaValue = intval($this->entity->price) + intval($this->entity->freight_price) + $this->financialCost();
        $grLt = intval($this->entity->concentration);
        $vrGrIa = intval($TotlaValue) / intval($grLt);
        $dosisHa = intval($this->auction()->product->dosis_ha);
        $costHa = intval($TotlaValue) * intval($dosisHa);
        $has = intval($this->auction()->area);
        $kilogramsBuy = intval($has) * intval($dosisHa);
        $concentration = intval($grLt) * intval($dosisHa);
        $cost = intval($TotlaValue) * intval($kilogramsBuy);
        $iva = intval($this->entity->tax);
        $ivaValue = intval($this->entity->price) * intval($iva) * intval($kilogramsBuy);
        $TotlaValue = intval($cost) + intval($ivaValue);
        
        
        return $TotlaValue;
    }
}
 