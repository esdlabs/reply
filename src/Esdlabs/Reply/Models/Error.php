<?php namespace Esdlabs\Reply\Models;

class Error extends \Eloquent {

    protected $table  = 'reply_errors';    
    public static $unguarded = true;
    public $timestamps = false;
}