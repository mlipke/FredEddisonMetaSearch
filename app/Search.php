<?php

namespace App;

use App\Models\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\ParameterBag;

class Search extends Model
{
    use UsesUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tripTypes',
        'reoccurDays',
        'smoking',
        'animals',
        'transportTypes',
        'baggage',
        'gender',
        'organizations',
        'availabilityStarts',
        'availabilityEnds',
        'startPoint',
        'endPoint',
        'arrival',
        'departure',
        'trips'
    ];


    public function startPoint()
    {
        return $this->hasOne(\App\SearchRadius::class);
    }

    public function endPoint()
    {
        return $this->hasOne(\App\SearchRadius::class);
    }

    public function departure()
    {
        return $this->hasOne(\App\TimeRange::class);
    }

    public function arrival()
    {
        return $this->hasOne(\App\TimeRange::class);
    }

    public function trips()
    {
        return $this->hasMany(Trip::class);
    }

    public function getDepartureRange(): Array
    {
        $tolerance = $this->departure->toleranceInDays;
        return [$this->departure->time->copy()->add($tolerance * -1, 'day')->startOfDay(),
                $this->departure->time->copy()->add($tolerance, 'day')->endOfDay()];
    }
//
//    public function toJson($options = 0)
//    {
//        /** @var ParameterBag $json */
//        $json = parent::toJson($options);
//
//        $json->set('startPoint', $this->startPoint->)
//    }


}
