<?php namespace Esdlabs\Reply;

use Esdlabs\Reply\Models\Error;

class Reply {

    /**
     * Return error to response 
     * 
     * @author Victor Cruz <victorcruz@esd.com.do>
     * @param string $error_code            Error code
     * @param integer $http_response_code   HTTP response
     * @param string $output_format         Response http format (JSON, XML, CSV)
     *
     * @return mixed
     */
    public function error($error_code, $notes = false, $http_response_code = false, $output_format = false)
    {
        $error = Error::where('error_code', '=', $error_code)->first();
        if ($error)
            $response = $this->buildResponseBody($error->error_code, $error->description);
        else
        { 
            $response = $this->buildResponseBody('UNK-ERROR', "Error $error_code not found on the database");
            $http_response_code = 500;
        }
                        
        if (!$http_response_code)
            $http_response_code = $error->response_code;

        if ($notes)
            $response['notes'] = $notes;

        return \Response::make($response, $http_response_code);
    }

    /**
     * Build body response to the request
     * 
     * @author Victor Cruz <victorcruz@esd.com.do>
     * @param string $error_code            Error code
     * @param string $description           Error description
     *
     * @return array
     */
    protected function buildResponseBody($error_code, $description)
    {
        return array(
            'error_code' => $error_code,
            'description' => $description
        );
    }

    /**
     * Return custom error response
     * 
     * @author Victor Cruz <victorcruz@esd.com.do>
     * @param string  $description           Error description
     * @param integer $http_response_code    HTTP response code
     *
     * @return Mixed
     */
    public function customError($description, $http_response_code = 500)
    {
        $response = $this->buildResponseBody('UNK-ERROR', $description);
        return \Response::make($response, $http_response_code);
    }

}