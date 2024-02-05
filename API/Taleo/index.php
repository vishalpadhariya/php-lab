<?php

header('Content-Type: application/json');

define('TALEO_COMPANY_CODE', ''); // replace with your credential
define('TALEO_USERNAME', ''); // replace with your credential
define('TALEO_PASSWORD', ''); // replace with your credential

if (TALEO_COMPANY_CODE === '' || TALEO_USERNAME === '' || TALEO_PASSWORD === '') {
    echo json_encode(
        array(
            "status" => false,
            "statusCode" => 401,
            "error" => array(
                "message" => "Unauthorized Access. Check your authentication credentials."
            )
        )
    );
    exit;
}

define('TALEO_LOGIN_API', 'https://phe.tbe.taleo.net/phe01/ats/api/v1/login');

define('GET_TALEO_DATA_API', 'https://phe.tbe.taleo.net/phe01/ats/api/v1/object/requisition/search?openedDate_from=1970-01-01&status=2');

define('LOGOUT_TALEO_API', 'https://phe.tbe.taleo.net/phe01/ats/api/v1/logout');

/* Get authentication token */
function getAuthToken()
{
    $url = TALEO_LOGIN_API . "?orgCode=" . TALEO_COMPANY_CODE . "&userName=" . TALEO_USERNAME . "&password=" . TALEO_PASSWORD;

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $headers = array(
        "Content-Type: application/json",
        "Content-Length: 0",
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    //for debug only!
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $resp = json_decode(curl_exec($curl));
    curl_close($curl);

    if ($resp->status->success == false) {
        /** Taleo Authentication Failed */
        echo json_encode(
            array(
                "status" => false,
                "error" => array(
                    "message" => "Unauthorized Access. Check your authentication credentials."
                )
            )
        );
        die;
    } else {
        /** Taleo Successfully Configured */
        return $resp->response->authToken;
    }
}

/* Logout from auth */
function logout($authToken)
{
    $curl = curl_init(LOGOUT_TALEO_API);
    curl_setopt($curl, CURLOPT_URL, LOGOUT_TALEO_API);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $headers = array(
        "Content-Type: application/json",
        "Content-Length: 0",
        'Cookie: "authToken=' . $authToken . '"'
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    //for debug only!
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $resp = curl_exec($curl);
    curl_close($curl);
}

/** Get Total jobs counter */
function getCounterOfJob()
{
    $authToken = getAuthToken();
    $url = GET_TALEO_DATA_API . "&limit=1500";
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $headers = array(
        'Cookie: "authToken=' . $authToken . '"'
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    //for debug only!
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $resp = json_decode(curl_exec($curl));
    curl_close($curl);
    logout($authToken);

    return $resp->response->pagination->total;
}

/** Get All jobs */
function getTaleoData()
{
    $authToken = getAuthToken();

    $limit = getCounterOfJob();

    $url = GET_TALEO_DATA_API . "&limit=" . $limit;

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $headers = array(
        'Cookie: "authToken=' . $authToken . '"'
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    //for debug only!
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $resp = curl_exec($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);
    logout($authToken);

    if ($httpCode === 200) {
        echo $resp;
    } else {
        echo json_encode(
            array(
                "status" => false,
                "statusCode" => $httpCode,
                "error" => array(
                    "message" => "Something went wrong!"
                )
            )
        );
        exit;
    }
}

getTaleoData();
die;