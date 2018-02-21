<?php

namespace App;

use App\Traits\SolrSearch;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Product extends Model
{
    use SolrSearch;
   
    public function __construct($attributes = array())
    {
        parent::__construct($attributes);
    }
    
    protected $table = 'products';

    protected $fillable = [
        'name',
        'img',
        'category',
        'price',
        'notes'
    ];

    protected static function getColumns()
    {

        return Schema::getColumnListing('products');
    }

}
