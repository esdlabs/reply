<?php namespace Esdlabs\Reply;

use DB;
use Seeder;
use Esdlabs\Reply\Models\Error;

class BaseErrorSeeder extends Seeder {

    /**
     * Error start code
     * @var string
     */
    protected $error_start_code;

    /**
     * Clean the database for new insert
     * 
     * @author Victor Cruz <victorcruz@esd.com.do>
     * @param string $code            Errors code start to be deleted
     *
     * @return void
     */
    public function deleteRows($code = false)
    {
        if (!$code)
            $code = $this->error_start_code;

        DB::table('reply_errors')
            ->where('error_code', 'like', "%$code%")
            ->delete();
    }

    /**
     * Seed the database with the errors provided
     * 
     * @author Victor Cruz <victorcruz@esd.com.do>
     * @param array $errors     Errors array
     *
     * @return void
     */
    public function seed(array $errors)
    {
        //Delete previous errors rows
        $this->deleteRows();

        foreach ($errors as $error)
        {
            $error['error_code'] = $this->error_start_code . $error['error_code'];
            $error['created_at'] = date('Y-m-d H:i:s');
            Error::create($error);
        }
    }    

}