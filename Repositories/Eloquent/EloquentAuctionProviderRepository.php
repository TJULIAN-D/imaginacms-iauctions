<?php

namespace Modules\Iauctions\Repositories\Eloquent;

use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;
use Modules\Iauctions\Events\AuctionProviderWasCreated;
use Modules\Iauctions\Events\AuctionProviderWasUpdated;
use Modules\Iauctions\Repositories\AuctionProviderRepository;

class EloquentAuctionProviderRepository extends EloquentBaseRepository implements AuctionProviderRepository
{

    public function ByAuctionUser($auctionID, $userID)
    {

        return $this->model->where([
            ['auction_id', '=', $auctionID],
            ['user_id', '=', $userID]
        ])->first();

    }

    /**
     * @inheritdoc
     */
    public function create($data)
    {
        $model = $this->model->create($data);
        $model->products()->sync(array_get($data, 'products', []));
        event(new AuctionProviderWasCreated($model, $data));
        return $model;
    }

    /**
     * @inheritdoc
     */
    public function update($model, $data)
    {
        $model->update($data);
        $model->products()->sync(array_get($data, 'products', []));
        event(new AuctionProviderWasUpdated($model, $data));
        return $model;
    }

    public function getItem($criteria, $params = false)
    {
        //Initialize query
        $query = $this->model->query();

        /*== RELATIONSHIPS ==*/
        if (in_array('*', $params->include)) {//If Request all relationships
            $query->with(['products', 'auction', 'provider']);
        } else {//Especific relationships
            $includeDefault = [];//Default relationships
            if (isset($params->include))//merge relations with default relationships
                $includeDefault = array_merge($includeDefault, $params->include);
            $query->with($includeDefault);//Add Relationships to query
        }

        /*== FILTER ==*/
        if (isset($params->filter)) {
            $filter = $params->filter;

            if (isset($filter->field))//Filter by specific field
                $field = $filter->field;
        }


        if (isset($filter->auctions)) {                                                              //Filter by provider
            $auctions = is_array($filter->auctions)?true:[$filter->auctions];
            $query->whereIn('auction_id', $auctions);
        }
        if (isset($filter->providers)) {                                                              //Filter by provider
            $providers = is_array($filter->providers)?true:[$filter->providers];
            $query->whereIn('provider_id', $providers);
        }
        /*== FIELDS ==*/
        if (isset($params->fields) && count($params->fields))
            $query->select($params->fields);

        /*== REQUEST ==*/
        return $query->where($field ?? 'id', $criteria)->first();
    }

    public function getItemsBy($params = false)
    {
        /*== initialize query ==*/
        $query = $this->model->query();

        /*== RELATIONSHIPS ==*/
        if (in_array('*', $params->include)) {//If Request all relationships
            $query->with([]);
        } else {//Especific relationships
            $includeDefault = [];//Default relationships
            if (isset($params->include))//merge relations with default relationships
                $includeDefault = array_merge($includeDefault, $params->include);
            $query->with($includeDefault);//Add Relationships to query
        }

        /*== FILTERS ==*/
        if (isset($params->filter)) {
            $filter = $params->filter;//Short filter

            //Filter by date
            if (isset($filter->date)) {
                $date = $filter->date;//Short filter date
                $date->field = $date->field ?? 'created_at';
                if (isset($date->from))//From a date
                    $query->whereDate($date->field, '>=', $date->from);
                if (isset($date->to))//to a date
                    $query->whereDate($date->field, '<=', $date->to);
            }

            //Order by
            if (isset($filter->order)) {
                $orderByField = $filter->order->field ?? 'created_at';//Default field
                $orderWay = $filter->order->way ?? 'desc';//Default way
                $query->orderBy($orderByField, $orderWay);//Add order to query
            }
        }

        /*== FIELDS ==*/
        if (isset($params->fields) && count($params->fields))
            $query->select($params->fields);

        /*== REQUEST ==*/
        if (isset($params->page) && $params->page) {
            return $query->paginate($params->take);
        } else {
            $params->take ? $query->take($params->take) : false;//Take
            return $query->get();
        }
    }

}
