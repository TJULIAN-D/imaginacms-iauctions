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
        return $this->auctions->find($this->entity->auction_id);

    }

    public function cant()
    {
     return $this->auction()->quantity;
    }

    public function valueUnit()
    {
        return (int)$this->total()/(int)$this->cant();
    }
    public function dosisHa()
    {
        return intval($this->cant()) / intval($this->auction()->area);
    }
    public function costHa()
    {
        return (int)$this->total() * (int)$this->dosisHa();
    }
    public function has()
    {
        return (int)$this->auction()->area;
    }
    public function tax()
    {
        return intval($this->entity->tax);
    }
    public function costo()
    {
        $value = intval($this->entity->price) + $this->financialCost();

        return  $value * (int)$this->cant();
    }
    public function taxValue()
    {
        return (int)$this->total() * (int)$this->tax();
    }
    public function financialCost()
    {
        $cost_financial_longer = 0;
        $cost_financial_freight = 0;
        $financial_cost_daily = (intval($this->auction()->financial_cost_monthly) / 30) / 100;

        if ($this->entity->longer_term < intval($this->auction()->longer_term)) {
            $day_longer = intval($this->auction()->longer_term) - intval($this->entity->longer_term);//50
            $cost_financial_longer = ($day_longer * $financial_cost_daily) * intval($this->entity->price);
        }
        if ($this->entity->freight_term > intval($this->auction()->longer_term_freight)) {
            $day_freight = $this->entity->freight_term - intval($this->auction()->longer_term_freight);
            $cost_financial_freight = ($day_freight * $financial_cost_daily) * intval($this->entity->freight_price);
        }
        $total_financia_cost = $cost_financial_longer + $cost_financial_freight;
        return $total_financia_cost;
    }

    public function total()
    {
        $TotlaValue = intval($this->entity->price) + $this->financialCost();
        // $grLt = intval($this->entity->product->concentration);
        // $vrGrIa = intval($TotlaValue) / intval($grLt);
        // $dosisHa = intval($this->auction()->quantity) / intval($this->auction()->area);
        // $costHa = intval($TotlaValue) * intval($dosisHa);
        ////$has = intval($this->auction()->area);
        //$kilogramsBuy = intval($has) * intval($dosisHa);
        //$concentration = intval($this->auction()->concentration);
        //$cost = intval($TotlaValue) * intval($kilogramsBuy);
        $iva = intval($this->entity->tax) / 100;
        $ivaValue = intval($this->entity->price) * $iva;
        $TotlaValue = ($TotlaValue + $ivaValue) * $this->auction()->quantity;


        return round($TotlaValue);
    }
}
