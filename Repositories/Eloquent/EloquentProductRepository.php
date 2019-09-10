<?php

namespace Modules\Iauctions\Repositories\Eloquent;

use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;
use Modules\Iauctions\Repositories\ProductRepository;

class EloquentProductRepository extends EloquentBaseRepository implements ProductRepository
{

    public function getItemsBy($params = false)
    {
        /*== initialize query ==*/
        $query = $this->model->query();

        /*== RELATIONSHIPS ==*/
        if (in_array('*', $params->include)) {//If Request all relationships
            $query->with(['ingredient', 'users', 'auctions', 'auctionProvider', 'bids']);
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

            if (isset($filter->ingredient)) {
                is_array($filter->ingredient) ? true : $filter->ingredient = [$filter->ingredient];
                $query->whereIn('ingredient_id',$filter->ingredient);
            }
            if (isset($filter->provider)){
                $provider = $filter->provider;
                $query->whereHas('providers', function ($query) use ($provider) {
                    $query->where('user_id', $provider);
                });
            }
            if (isset($filter->noprovider)){
                $noprovider = is_array($filter->noprovider)? $filter->noprovider:[$filter->noprovider];
                $query->whereDoesntHave('providers', function ($query) use ($noprovider) {
                    $query->whereIn('user_id', $noprovider);
                });
            }

            if (isset($filter->search)) { //si hay que filtrar por rango de precio
                $criterion = $filter->search;
                $param = explode(' ', $criterion);
                $query->where(function ($query) use ($param) {
                    foreach ($param as $index => $word) {
                        if ($index == 0) {
                            $query->where('name', 'like',  $word . "%");
                        } else {
                            $query->orWhere('name', 'like', $word . "%");
                        }
                    }

                });
            }
            if (isset($filter->concentration)) {
                $concentration=(object)$filter->concentration;
                $query->whereBetween('concentration',[$concentration->min,$concentration->max]);
            }

            if (isset($filter->status)) {
                is_array($filter->status) ? true : $filter->status = [$filter->status];
                $query->whereIn('status', $filter->status);
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

    public function getItem($criteria, $params = false)
    {
        //Initialize query
        $query = $this->model->query();

        /*== RELATIONSHIPS ==*/
        if (in_array('*', $params->include)) {//If Request all relationships
            $query->with([]);
        } else {//Especific relationships
            $includeDefault = ['ingredient'];//Default relationships
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

        /*== FIELDS ==*/
        if (isset($params->fields) && count($params->fields))
            $query->select($params->fields);

        /*== REQUEST ==*/
        return $query->where($field ?? 'id', $criteria)->first();
    }

    /**
     * Return Products with relations (Index Backend)
     *
     * @return products collection
     */
    public function allWithRelations()
    {

        return $this->model->with(['ingredient'])
            ->orderBy('created_at', 'DESC')->paginate(12);
    }


}
