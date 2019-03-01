<?php

namespace Modules\Iauctions\Repositories\Eloquent;

use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;
use Modules\Iauctions\Repositories\AuctionRepository;

class EloquentAuctionRepository extends EloquentBaseRepository implements AuctionRepository
{


    public function getItemsBy($params = false)
    {
        /*== initialize query ==*/

        $query = $this->model->query();

        /*== RELATIONSHIPS ==*/

        if (in_array('*', $params->include)) {                                                   //If Request all relationships
            $query->with(['user', 'product', 'ingredient', 'auctionProviders', 'bids']);
        } else {                                                                                        //Especific relationships
            $includeDefault = ['auctionProviders'];                                                                       //Default relationships
            if (isset($params->include))                                                                //merge relations with default relationships
                $includeDefault = array_merge($includeDefault, $params->include);

            $query->with($includeDefault);                                                              //Add Relationships to query

        }

        /*== FILTERS ==*/

        if (isset($params->filter)) {
            $filter = (object)$params->filter;                                                           //Short filter
            if (isset($filter->status)) {
                is_array($filter->status) ? true : $filter->status = [$filter->status];
                $query->whereIn('status', $filter->status);
            }


            if (isset($filter->provider)) {                                                              //Filter by provider
                $provider = (object)$filter->provider;
                $query->whereHas('auctionProviders', function ($query) use ($provider) {
                    $query->where('provider_id', $provider->id);
                    if (isset($provider->status)) {
                        $query->where('status', $provider->status);
                    }
                });
            }

            if (isset($filter->date)) {                                                                 //Filter by date
                $date = $filter->date;                                                                  //Short filter date
                $date->field = $date->field ?? 'created_at';
                if (isset($date->from))                                                                 //From a date
                    $query->whereDate($date->field, '>=', $date->from);
                if (isset($date->to))                                                                   //to a date
                    $query->whereDate($date->field, '<=', $date->to);
            }


            if (isset($filter->order)) {                                                                //Order by
                if ($filter->order == 'random') {
                    $query->inRandomOrder();
                } else {
                    $order = (object)$filter->order;
                    $orderByField = $order->field ?? 'created_at';                                  //Default field
                    $orderWay = $order->way ?? 'desc';                                              //Default way
                    $query->orderBy($orderByField, $orderWay);
                }
                //Add order to query
            }
        }

        /*== FIELDS ==*/
        if (isset($params->fields) && count($params->fields))
            $query->select($params->fields);

        /*== REQUEST ==*/
        if (isset($params->page) && $params->page) {
            return $query->paginate($params->take);
        } else {
            $params->take ? $query->take($params->take) : false;                                        //Take
            return $query->get();
        }
    }

    public function getItem($criteria, $params = false)
    {
        //Initialize query
        $query = $this->model->query();

        /*== RELATIONSHIPS ==*/
        if (in_array('*', $params->include)) {//If Request all relationships
            $query->with(['user', 'product', 'ingredient', 'auctionProviders', 'bid']);
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
            if (isset($filter->status)) {
                is_array($filter->status) ? true : $filter->status = [$filter->status];
                $query->whereIn('status', $filter->status);
            }


            if (isset($filter->provider)) {                                                              //Filter by provider
                $provider = (object)$filter->provider;
                $query->whereHas('auctionProviders', function ($query) use ($provider) {
                    $query->where('provider_id', $provider->id);
                    if (isset($provider->status)) {
                        $query->where('status', $provider->status);
                    }
                });
            }


        }

        /*== FIELDS ==*/
        if (isset($params->fields) && count($params->fields))
            $query->select($params->fields);

        /*== REQUEST ==*/
        return $query->where($field ?? 'id', $criteria)->first();
    }


}
