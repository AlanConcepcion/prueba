<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Password;


class Job extends Model
{


    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function getCompanySlugAttribute()
    {
        return str_slug($this->company);
    }

    public function getLocationSlugAttribute()
    {
        return str_slug($this->location);
    }

    public function getPositionSlugAttribute()
    {
        return str_slug($this->position);
    }

    public function scopeGetActiveJobs($query, $category_id = null, $jobs_per_page = null)
    {
        $query->where('expires_at', '>', Carbon::now())->where('is_activated', 1)->orderBy('expires_at', 'desc');

        if($category_id)
        {
            $query->where('category_id', $category_id);
        }

        return $query->paginate($jobs_per_page);
    }

    public function getExpiresAt()
    {
        return $this->expires_at;
    }


    public function setExpiresAtValue()
    {
        if(!$this->getExpiresAt())
        {
            $this->expires_at = Carbon::now()->addDays(30);
        }
    }

    public static function getTypesAttribute()
    {
        return array('full-time' => 'Full time', 'part-time' => 'Part time', 'freelance' => 'Freelance');
    }

    public static function getTypeValues()
    {
        return array_keys(self::getTypes());
    }

    public function getToken()
    {
        return $this->token;
    }

    public function setTokenValue()
    {
        if(!$this->getToken())
        {
            $this->token = Password::getRepository()->createNewToken();
        }
    }

    public function setIsActivated($isActivated)
    {
        $this->is_activated = $isActivated;

        return $this;
    }

    public function publish()
    {
        $this->setIsActivated(true);
    }

    public function getDaysBeforeExpiresAttribute()
    {
        return Carbon::now()->diffInDays($this->getExpiresAt());
    }

    public function isExpiredAttribute()
    {
        return $this->getDaysBeforeExpiresAttribute() < 0;
    }

    public function getExpiresSoonAttribute()
    {
        return $this->getDaysBeforeExpiresAttribute() < 5;
    }

    public function extend()
    {
        if (!$this->getExpiresSoonAttribute())
        {
            return false;
        }
        $this->expires_at = Carbon::now()->addDays(30);
        return true;
    }


    public function getTableColumns() {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }
}
