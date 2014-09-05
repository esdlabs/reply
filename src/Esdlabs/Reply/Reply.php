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
            $response = $this->buildResponseBody($error->error_code, $error->description, $notes);
        else
        { 
            $response = $this->buildResponseBody('UNK-ERROR', "Error $error_code not found on the database", $notes);
            $http_response_code = 500;
        }
                        
        if (!$http_response_code)
            $http_response_code = $error->response_code;        

        return \Response::make($response, $http_response_code);
    }

    /**
     * Build body response to the request
     * 
     * @author Victor Cruz <victorcruz@esd.com.do>
     * @param string $error_code            Error code
     * @param string $description           Error description
     * @param mixed $notes                  Note or array of notes
     *
     * @return array
     */
    protected function buildResponseBody($error_code, $description, $notes = false)
    {
        $response = array(
            'error_code' => $error_code,
            'description' => $description
        );

        if ($notes)
            $response['notes'] = $notes;

        return $response;
    }

    /**
     * Return custom error response
     * 
     * @author Victor Cruz <victorcruz@esd.com.do>
     * @param string  $description           Error description
     * @param integer $http_response_code    HTTP response code
     * @param mixed $notes                   Note or array of notes
     *
     * @return Mixed
     */
    public function customError($description, $http_response_code = 500, $notes = false)
    {
        $response = $this->buildResponseBody('UNK-ERROR', $description, $notes);
        return \Response::make($response, $http_response_code);
    }

}