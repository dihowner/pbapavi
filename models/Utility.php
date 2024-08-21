<?php

class Utility extends Database {

    protected $responseBody, $db;

    function __construct($db) {
        $this->db = $db;
        $this->responseBody	= array();
    }

    /**
     * convert objects to array
     *
     * @param array $array
     * @return object
     */
    public function arrayToObject($array)
    {
        return (object) $array;

    }

    /**
     * convert arrays to object
     *
     * @param object $object
     * @return array
     */
    public function objectToArray($object)
    {
	    return (array) $object;

    }

    public function randID($character, $length = 5) { 
        $alphabets = 'aeioubcdfghjklmnpqrstvwxyz'; 
        $numbers = '0123456789'; 

        $idNumber = '';
        switch ($character) {
            case 'numeric':
            case 'num':
                for ($i = 0; $i < $length; $i++) { 
                    $idNumber.= substr($numbers, (rand()%(strlen($numbers))), 1);
                }
            break;

            case 'alphabetic':
            case 'alpha':
                for ($i = 0; $i < $length; $i++) { 
                    $idNumber.= substr($alphabets, (rand()%(strlen($alphabets))), 1);
                } 
            break;
        }         
        return $idNumber; 
    } 

    public function generateStudentRegNumber() {
        return date("Ym").$this->randID("numeric");
    }

    public function niceDateFormat($date, $format="date_time") {

        if ($format == "date_time") {
            $format = "D j, M Y h:ia"; 
        } else {
            $format = "D j, M Y";
        }

        $timestamp = strtotime($date);
        $niceFormat = date($format, $timestamp);

        return $niceFormat;
    }
    
    public function displayFormError()
    {
        $formError = "";
        if (isset($_SESSION['formErrorMessage'])) {
            $formError .= '<div id="alert-2" class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50" role="alert">
                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                    <polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon>
                    <line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line>
                </svg>
                <span class="sr-only">Info</span>
                <div class="ms-3 text-sm font-medium">';
                    if (is_array($_SESSION['formErrorMessage'])) {
                        $formError .= '<h5 class="mt-1 mb-2">Errors!</h5>';
                        foreach ($_SESSION['formErrorMessage'] as $key => $error) {
                            $formError .= '<li>' .$error. '</li>';
                        }
                    } else {
                        $formError .= '<strong>Error:</strong> ' .$_SESSION['formErrorMessage'];
                    }
                $formError .= '</div>
                <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert-2" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>
            </div>';

            unset($_SESSION['formErrorMessage']);
            return $formError;
        }
    }

    public function displayFormSuccess()
    {
        $formSuccess = "";
        if (isset($_SESSION['formSuccessMessage'])) {
            $formSuccess .= '<div id="alert-3" class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50" role="alert">
                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                    <polyline points="9 11 12 14 22 4"></polyline>
                    <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                </svg>
                <span class="sr-only">Info</span>
                <div class="ms-3 text-sm font-medium">';
                    if (is_array($_SESSION['formSuccessMessage'])) {
                        $formSuccess .= "<h3>Success!</h3><ul>";
                        foreach ($_SESSION['formSuccessMessage'] as $key => $msg) {
                            $formSuccess .= '<li>' .$msg. '</li>';
                        }
                        $formSuccess .= "</ul>";
                    } else {
                        $formSuccess .= $_SESSION['formSuccessMessage'];
                    }
                $formSuccess .= '</div>
                <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert-3" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>
            </div>';
            unset($_SESSION['formInput']);
            unset($_SESSION['formSuccessMessage']);
            return $formSuccess;
        }
    }

    public function returnFormInput($name)
    {
        $formInput = '';
        if (isset($_SESSION['formInput'][$name])) {
            $formInput = $_SESSION['formInput'][$name];
            unset($_SESSION['formInput'][$name]);
        }

        echo $formInput;
    }

    public function getFileSize($url)
    {
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, TRUE);
        curl_setopt($ch, CURLOPT_NOBODY, TRUE);

        $data = curl_exec($ch);
        $size = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);

        curl_close($ch);
        echo $size;
    }

    public function validateDate($dateString) {
        // Remove the WAT timezone abbreviation and replace it with the equivalent UTC offset
        $dateString = str_replace('WAT', ' ', $dateString);
        // Create a DateTime object from the modified datetime string
        $date = DateTime::createFromFormat('Y-m-d H:i', $dateString);

        if ($date !== false) {
            $now = new DateTime('now', new DateTimeZone('Africa/Lagos')); // Use UTC as the reference timezone
            if ($date < $now) {
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }
}
?>