<?php

class Transaction extends \Eloquent {
	
	protected $fillable = ['user_id','amount','description'];

	public function user(){

		 return $this->belongsTo('User','user_id','id');
	}

	public function brokers(){

		 return $this->hasMany('Broker','transaction_id','id');
	}

	public function scopeDataTable($query,$search,$limit,$page)
    {
        
        return $query->where(function($query) use ($search){
                         $query->where('amount','LIKE',"%$search%")
                             ->orWhere('description','LIKE',"%$search%"); 
                        })
                        ->take($limit)
                        ->skip($page)
                        ->get();

    }

    public function scopeCountDataTable($query,$search)
    {
        return $query->where(function($query) use ($search){
                         $query->where('amount','LIKE',"%$search%")
                             ->orWhere('description','LIKE',"%$search%"); 
                        })
                        ->count();
    }

    public function scopeTest($query){

        
          $search = "";             
          /*return $query->where(function($query) use ($search){
                          $query->where('amount','LIKE',"%$search%")
                                ->orWhere('description','LIKE',"%$search%"); 
                        })
                        ->with(array('brokers'=>function($query) use ($search){
                                                                  
                                $query->where('broker','LIKE',"%$search%");
                        }))
                        ->get();
          */
          return $query->where(function($query) use ($search){
                              
                               $query->where(function($query) use ($search){
                                     
                                      $query->where('amount','LIKE',"%$search%")
                                            ->orWhere('description','LIKE',"%$search%");
                               
                               });     
                               $query->orWhere(function($query) use ($search){

                                      $query->where('amount','LIKE',"%$search%")
                                            ->orWhere('description','LIKE',"%$search%");
                                     
                                            
                                      
                                       
                               });
                         })
                         ->with('brokers')      
                         ->get();

                        

    }
    

}