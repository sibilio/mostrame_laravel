<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'papel_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function isClient()
    {
      return($this->papel_id === 6)?true:false;
    }
    
    public function isMaster()
    {
      return ($this->papel_id === 2)?true:false;
    }

    public function isMasterOne()
    {
      return ($this->id === 1)?true:false;
    }

    public function canDoIt($tag)
    {
      $papel_id = $this->papel_id;
      
      $permissao = DB::table('permissoes')
                         ->where('tag', $tag)
                         ->first();

      $thereIsPermission = DB::table('permissoes_papeis')
                               ->where('papel_id', $papel_id)
                               ->where('permissao_id', $permissao->id)
                               ->first();
      
      return (is_null($thereIsPermission))?false:true;
    }

    public function cantDoIt($tag)
    {
       return !$this->canDoIt($tag);
    }
            
    public function canSeeMenu($tag)
    {
       return $this->canDoIt($tag);
    }
    
    public function papel()
    {
       return $this->belongsTo('App\Papel');
    }
}
