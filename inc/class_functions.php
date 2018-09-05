<?php
//SLIMARUSER 2017
function GetIP()
{
    if (getenv("HTTP_CLIENT_IP")) {
        $ip = getenv("HTTP_CLIENT_IP");
    } elseif (getenv("HTTP_X_FORWARDED_FOR")) {
        $ip = getenv("HTTP_X_FORWARDED_FOR");
        if (strstr($ip, ',')) {
            $tmp = explode(',', $ip);
            $ip = trim($tmp[0]);
        }
    } else {
        $ip = getenv("REMOTE_ADDR");
    }
    if ($ip == "127.0.0.1") { //For local testing
        return $ip = '101.177.171.178';
    } else {
        return $ip;
    }
}

function displayTimeZoneSelect($selectedTimeZone = 'America/New_York')
{
    $countryCodes = getCountryCodes();
    $return = null;
    foreach ($countryCodes as $country => $countryCode) {
        $timezone_identifiers = DateTimeZone::listIdentifiers(DateTimeZone::PER_COUNTRY, $countryCode);
        foreach ($timezone_identifiers as $value) {
            /* getTimeZoneOffset returns minutes and we need to display hours */
            $offset = getTimeZoneOffset($value)/60;
            /* for the GMT+1 GMT-1 display */
            $offset = (substr($offset, 0, 1) == "-" ? " (GMT" : " (GMT+") . $offset . ")";
            /* America/New_York -> America/New York */
            $displayValue = (str_replace('_', ' ', $value));
            /* Find the city */
            $ex = explode("/", $displayValue);
            $city = (($ex[2]) ? $ex[2] : $ex[1]);
            /* For the special names */
            $displayValue = htmlentities($country." - ".$city.$offset);
            /* handle the $selectedTimeZone in the select form */
            $selected = (($value == $selectedTimeZone) ? ' selected="selected"' : null);
            $return .= '<option value="' . $value . '"' . $selected . '>'
                . $displayValue
                . '</option>' . PHP_EOL;
        }
    }

    return $return;
}

function json_response($code = 200, $data = null)
{
    // clear the old headers
    header_remove();
    // set the actual code
    http_response_code($code);
    // set the header to make sure cache is forced
    header("Cache-Control: no-transform,public,max-age=300,s-maxage=900");
    // treat this as json
    header('Content-Type: application/json');
    $status = array(
        200 => '200 OK',
        400 => '400 Bad Request',
        422 => 'Unprocessable Entity',
        500 => '500 Internal Server Error'
        );
    // ok, validation error, or failure
    header('Status: '.$status[$code]);
    // return the encoded json
    return json_encode(
        array(
        'status' => $code < 300, // success or not?
        'data' => $data
        )
    );
}

function getCountryCodes()
{
    $return = array(
        "AFGHANISTAN"=>"AF",
        "ALAND ISLANDS"=>"AX",
        "ALBANIA"=>"AL",
        "ALGERIA"=>"DZ",
        "AMERICAN SAMOA"=>"AS",
        "ANDORRA"=>"AD",
        "ANGOLA"=>"AO",
        "ANGUILLA"=>"AI",
        "ANTARCTICA"=>"AQ",
        "ANTIGUA AND BARBUDA"=>"AG",
        "ARGENTINA"=>"AR",
        "ARMENIA"=>"AM",
        "ARUBA"=>"AW",
        "AUSTRALIA"=>"AU",
        "AUSTRIA"=>"AT",
        "AZERBAIJAN"=>"AZ",
        "BAHAMAS"=>"BS",
        "BAHRAIN"=>"BH",
        "BANGLADESH"=>"BD",
        "BARBADOS"=>"BB",
        "BELARUS"=>"BY",
        "BELGIUM"=>"BE",
        "BELIZE"=>"BZ",
        "BENIN"=>"BJ",
        "BERMUDA"=>"BM",
        "BHUTAN"=>"BT",
        "BOLIVIA, PLURINATIONAL STATE OF"=>"BO",
        "BONAIRE, SINT EUSTATIUS AND SABA"=>"BQ",
        "BOSNIA AND HERZEGOVINA"=>"BA",
        "BOTSWANA"=>"BW",
        "BOUVET ISLAND"=>"BV",
        "BRAZIL"=>"BR",
        "BRITISH INDIAN OCEAN TERRITORY"=>"IO",
        "BRUNEI DARUSSALAM"=>"BN",
        "BULGARIA"=>"BG",
        "BURKINA FASO"=>"BF",
        "BURUNDI"=>"BI",
        "CAMBODIA"=>"KH",
        "CAMEROON"=>"CM",
        "CANADA"=>"CA",
        "CAPE VERDE"=>"CV",
        "CAYMAN ISLANDS"=>"KY",
        "CENTRAL AFRICAN REPUBLIC"=>"CF",
        "CHAD"=>"TD",
        "CHILE"=>"CL",
        "CHINA"=>"CN",
        "CHRISTMAS ISLAND"=>"CX",
        "COCOS (KEELING) ISLANDS"=>"CC",
        "COLOMBIA"=>"CO",
        "COMOROS"=>"KM",
        "CONGO"=>"CG",
        "CONGO, THE DEMOCRATIC REPUBLIC OF THE"=>"CD",
        "COOK ISLANDS"=>"CK",
        "COSTA RICA"=>"CR",
        "CÔTE D'IVOIRE"=>"CI",
        "CROATIA"=>"HR",
        "CUBA"=>"CU",
        "CURAÇAO"=>"CW",
        "CYPRUS"=>"CY",
        "CZECH REPUBLIC"=>"CZ",
        "DENMARK"=>"DK",
        "DJIBOUTI"=>"DJ",
        "DOMINICA"=>"DM",
        "DOMINICAN REPUBLIC"=>"DO",
        "ECUADOR"=>"EC",
        "EGYPT"=>"EG",
        "EL SALVADOR"=>"SV",
        "EQUATORIAL GUINEA"=>"GQ",
        "ERITREA"=>"ER",
        "ESTONIA"=>"EE",
        "ETHIOPIA"=>"ET",
        "FALKLAND ISLANDS (MALVINAS)"=>"FK",
        "FAROE ISLANDS"=>"FO",
        "FIJI"=>"FJ",
        "FINLAND"=>"FI",
        "FRANCE"=>"FR",
        "FRENCH GUIANA"=>"GF",
        "FRENCH POLYNESIA"=>"PF",
        "FRENCH SOUTHERN TERRITORIES"=>"TF",
        "GABON"=>"GA",
        "GAMBIA"=>"GM",
        "GEORGIA"=>"GE",
        "GERMANY"=>"DE",
        "GHANA"=>"GH",
        "GIBRALTAR"=>"GI",
        "GREECE"=>"GR",
        "GREENLAND"=>"GL",
        "GRENADA"=>"GD",
        "GUADELOUPE"=>"GP",
        "GUAM"=>"GU",
        "GUATEMALA"=>"GT",
        "GUERNSEY"=>"GG",
        "GUINEA"=>"GN",
        "GUINEA-BISSAU"=>"GW",
        "GUYANA"=>"GY",
        "HAITI"=>"HT",
        "HEARD ISLAND AND MCDONALD ISLANDS"=>"HM",
        "HOLY SEE (VATICAN CITY STATE)"=>"VA",
        "HONDURAS"=>"HN",
        "HONG KONG"=>"HK",
        "HUNGARY"=>"HU",
        "ICELAND"=>"IS",
        "INDIA"=>"IN",
        "INDONESIA"=>"ID",
        "IRAN, ISLAMIC REPUBLIC OF"=>"IR",
        "IRAQ"=>"IQ",
        "IRELAND"=>"IE",
        "ISLE OF MAN"=>"IM",
        "ISRAEL"=>"IL",
        "ITALY"=>"IT",
        "JAMAICA"=>"JM",
        "JAPAN"=>"JP",
        "JERSEY"=>"JE",
        "JORDAN"=>"JO",
        "KAZAKHSTAN"=>"KZ",
        "KENYA"=>"KE",
        "KIRIBATI"=>"KI",
        "KOREA, DEMOCRATIC PEOPLE'S REPUBLIC OF"=>"KP",
        "KOREA, REPUBLIC OF"=>"KR",
        "KUWAIT"=>"KW",
        "KYRGYZSTAN"=>"KG",
        "LAO PEOPLE'S DEMOCRATIC REPUBLIC"=>"LA",
        "LATVIA"=>"LV",
        "LEBANON"=>"LB",
        "LESOTHO"=>"LS",
        "LIBERIA"=>"LR",
        "LIBYAN ARAB JAMAHIRIYA"=>"LY",
        "LIECHTENSTEIN"=>"LI",
        "LITHUANIA"=>"LT",
        "LUXEMBOURG"=>"LU",
        "MACAO"=>"MO",
        "MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF"=>"MK",
        "MADAGASCAR"=>"MG",
        "MALAWI"=>"MW",
        "MALAYSIA"=>"MY",
        "MALDIVES"=>"MV",
        "MALI"=>"ML",
        "MALTA"=>"MT",
        "MARSHALL ISLANDS"=>"MH",
        "MARTINIQUE"=>"MQ",
        "MAURITANIA"=>"MR",
        "MAURITIUS"=>"MU",
        "MAYOTTE"=>"YT",
        "MEXICO"=>"MX",
        "MICRONESIA, FEDERATED STATES OF"=>"FM",
        "MOLDOVA, REPUBLIC OF"=>"MD",
        "MONACO"=>"MC",
        "MONGOLIA"=>"MN",
        "MONTENEGRO"=>"ME",
        "MONTSERRAT"=>"MS",
        "MOROCCO"=>"MA",
        "MOZAMBIQUE"=>"MZ",
        "MYANMAR"=>"MM",
        "NAMIBIA"=>"NA",
        "NAURU"=>"NR",
        "NEPAL"=>"NP",
        "NETHERLANDS"=>"NL",
        "NEW CALEDONIA"=>"NC",
        "NEW ZEALAND"=>"NZ",
        "NICARAGUA"=>"NI",
        "NIGER"=>"NE",
        "NIGERIA"=>"NG",
        "NIUE"=>"NU",
        "NORFOLK ISLAND"=>"NF",
        "NORTHERN MARIANA ISLANDS"=>"MP",
        "NORWAY"=>"NO",
        "OMAN"=>"OM",
        "PAKISTAN"=>"PK",
        "PALAU"=>"PW",
        "PALESTINIAN TERRITORY, OCCUPIED"=>"PS",
        "PANAMA"=>"PA",
        "PAPUA NEW GUINEA"=>"PG",
        "PARAGUAY"=>"PY",
        "PERU"=>"PE",
        "PHILIPPINES"=>"PH",
        "PITCAIRN"=>"PN",
        "POLAND"=>"PL",
        "PORTUGAL"=>"PT",
        "PUERTO RICO"=>"PR",
        "QATAR"=>"QA",
        "RÉUNION"=>"RE",
        "ROMANIA"=>"RO",
        "RUSSIAN FEDERATION"=>"RU",
        "RWANDA"=>"RW",
        "SAINT BARTHÉLEMY"=>"BL",
        "SAINT HELENA, ASCENSION AND TRISTAN DA CUNHA"=>"SH",
        "SAINT KITTS AND NEVIS"=>"KN",
        "SAINT LUCIA"=>"LC",
        "SAINT MARTIN (FRENCH PART)"=>"MF",
        "SAINT PIERRE AND MIQUELON"=>"PM",
        "SAINT VINCENT AND THE GRENADINES"=>"VC",
        "SAMOA"=>"WS",
        "SAN MARINO"=>"SM",
        "SAO TOME AND PRINCIPE"=>"ST",
        "SAUDI ARABIA"=>"SA",
        "SENEGAL"=>"SN",
        "SERBIA"=>"RS",
        "SEYCHELLES"=>"SC",
        "SIERRA LEONE"=>"SL",
        "SINGAPORE"=>"SG",
        "SINT MAARTEN (DUTCH PART)"=>"SX",
        "SLOVAKIA"=>"SK",
        "SLOVENIA"=>"SI",
        "SOLOMON ISLANDS"=>"SB",
        "SOMALIA"=>"SO",
        "SOUTH AFRICA"=>"ZA",
        "SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS"=>"GS",
        "SPAIN"=>"ES",
        "SRI LANKA"=>"LK",
        "SUDAN"=>"SD",
        "SURINAME"=>"SR",
        "SVALBARD AND JAN MAYEN"=>"SJ",
        "SWAZILAND"=>"SZ",
        "SWEDEN"=>"SE",
        "SWITZERLAND"=>"CH",
        "SYRIAN ARAB REPUBLIC"=>"SY",
        "TAIWAN, PROVINCE OF CHINA"=>"TW",
        "TAJIKISTAN"=>"TJ",
        "TANZANIA, UNITED REPUBLIC OF"=>"TZ",
        "THAILAND"=>"TH",
        "TIMOR-LESTE"=>"TL",
        "TOGO"=>"TG",
        "TOKELAU"=>"TK",
        "TONGA"=>"TO",
        "TRINIDAD AND TOBAGO"=>"TT",
        "TUNISIA"=>"TN",
        "TURKEY"=>"TR",
        "TURKMENISTAN"=>"TM",
        "TURKS AND CAICOS ISLANDS"=>"TC",
        "TUVALU"=>"TV",
        "UGANDA"=>"UG",
        "UKRAINE"=>"UA",
        "UNITED ARAB EMIRATES"=>"AE",
        "UNITED KINGDOM"=>"GB",
        "UNITED STATES"=>"US",
        "UNITED STATES MINOR OUTLYING ISLANDS"=>"UM",
        "URUGUAY"=>"UY",
        "UZBEKISTAN"=>"UZ",
        "VANUATU"=>"VU",
        "VENEZUELA, BOLIVARIAN REPUBLIC OF"=>"VE",
        "VIET NAM"=>"VN",
        "VIRGIN ISLANDS, BRITISH"=>"VG",
        "VIRGIN ISLANDS, U.S."=>"VI",
        "WALLIS AND FUTUNA"=>"WF",
        "WESTERN SAHARA"=>"EH",
        "YEMEN"=>"YE",
        "ZAMBIA"=>"ZM",
        "ZIMBABWE"=>"ZW"
    );
    return $return;
}

//List of Nigerian Banks
function getBankList()
{
    global $i;
    global $in;
    $supported_banks = [];
    error_log(json_encode($i).' '. json_encode($in));
    $key = $i['paga_mode']? $i['paga_live_private_key'] : $i['paga_test_private_key'];
    $paystack = new Yabacon\Paystack($key);
    try {
        $banks = $paystack->bank->getList();
        foreach ($banks->data as $bank) {
            $bank = (array) $bank;
            $supported_banks[] = [ 'id' => $bank['code'], 'name' => $bank['name'] ];
        }
    } catch (\Yabacon\Paystack\Exception\ApiException $e) {
        $supported_banks = [
            ["id" => "044", "name" => "Access Bank"],
            ["id" => "035A", "name" => "ALAT by WEMA"],
            ["id" => "023", "name" => "Citibank Nigeria"],
            ["id" => "063", "name" => "Diamond Bank"],
            ["id" => "050", "name" => "Ecobank Nigeria"],
            ["id" => "084", "name" => "Enterprise Bank"],
            ["id" => "070", "name" => "Fidelity Bank"],
            ["id" => "011", "name" => "First Bank of Nigeria"],
            ["id" => "214", "name" => "First City Monument Bank"],
            ["id" => "058", "name" => "Guaranty Trust Bank"],
            ["id" => "030", "name" => "Heritage Bank"],
            ["id" => "301", "name" => "Jaiz Bank"],
            ["id" => "082", "name" => "Keystone Bank"],
            ["id" => "014", "name" => "MainStreet Bank"],
            ["id" => "526", "name" => "Parallex Bank"],
            ["id" => "101", "name" => "Providus Bank"],
            ["id" => "076", "name" => "Skye Bank"],
            ["id" => "221", "name" => "Stanbic IBTC Bank"],
            ["id" => "068", "name" => "Standard Chartered Bank"],
            ["id" => "232", "name" => "Sterling Bank"],
            ["id" => "100", "name" => "Suntrust Bank"],
            ["id" => "032", "name" => "Union Bank of Nigeria"],
            ["id" => "033", "name" => "United Bank For Africa"],
            ["id" => "215", "name" => "Unity Bank"],
            ["id" => "035", "name" => "Wema Bank"],
            ["id" => "057", "name" => "Zenith Bank"]
        ];
    }
    return $supported_banks;
}

function getRecipient($key, $accname, $bank, $accnumber)
{
    $paystack = new Yabacon\Paystack($key);
    return $paystack->transferrecipient->initialize(
        [
            'type' => 'nuban',
            'name' => $accname,
            'bank_code' => $bank,
            'account_number' => $accnumber,
        ]
    );
}

function makeTransfer($key, $amount, $recipient, $reason = "Winnings")
{
    $paystack = new Yabacon\Paystack($key);
    return $paystack->transfer->initialize(
        [
            'source' => 'balance',
            'amount' => $amount,
            'reason' => $reason,
            'recipient' => $recipient,
        ]
    );
}

function sendOTP($key, $code, $token)
{
    $paystack = new Yabacon\Paystack($key);
    return $paystack->transfer->finalizeTransfer(
        [
            'transfer_code' => $code,
            'otp' => $token,
        ]
    );
}

function resendOTP($key, $code)
{
    $paystack = new Yabacon\Paystack($key);
    return $paystack->transfer->resendOtp(
        [
            'transfer_code' => $code,
        ]
    );
}

/**
 *  Like array_merge, but will recursively merge array values.
 *
 *  @param array $a1
 *      The array to be merged into.
 *  @param array $a2
 *      The array to merge in. Overwrites $a1, when string keys conflict.
 *      Numeric keys will just be appended.
 *  @return array
 *      The array, post-merge.
 */
function merge_query_var_arrays($a1, $a2)
{
    foreach ($a2 as $k2 => $v2) {
        if (is_string($k2)) {
            $a1[$k2] = isset($a1[$k2]) && is_array($v2) ? merge_query_var_arrays($a1[$k2], $v2) : $v2;
        } else {
            $a1[] = $v2;
        }
    }
    return $a1;
}

/**
 *  @param string $query_string
 *      The URL or query string to add to.
 *  @param string|array $vars_to_add
 *      Either a string in var=val&[...] format, or an array.
 *  @return string
 *      The new query string. Duplicate vars are overwritten.
 */
function add_query_vars($query_string, $vars_to_add)
{
    if (is_string($vars_to_add)) {
        parse_str($vars_to_add, $vars_to_add);
    }
    if (preg_match('/.*\?/', $query_string, $match)) {
        $query_string = preg_replace('/.*\?/', '', $query_string);
    }
    parse_str($query_string, $query_vars);

    $query_vars = merge_query_var_arrays($query_vars, $vars_to_add);
    return @$match[0] . http_build_query($query_vars);
}

//Get bank from id
function getBank($id)
{
    $banks = getBankList();
    foreach ($banks as $key => $bank) {
        if ($id == $key) {
            return $bank;
        }
    }
    return false;
}

//Get value from post or get
function getSetValue($name)
{
    if (! empty($_POST[$name])) {
        return $_POST[$name];
    } elseif (! empty($_GET[$name])) {
        return $_GET[$name];
    }
    return '';
}

/**
 * Calculates the offset from UTC for a given timezone
 *
 * @return integer
 */
function getTimeZoneOffset($timeZone)
{
    $dateTimeZoneUTC = new DateTimeZone("UTC");
    $dateTimeZoneCurrent = new DateTimeZone($timeZone);

    $dateTimeUTC = new DateTime("now", $dateTimeZoneUTC);
    $dateTimeCurrent = new DateTime("now", $dateTimeZoneCurrent);

    $offset = (($dateTimeZoneCurrent->getOffset($dateTimeUTC))/60);
    return $offset;
}

function getusercomments()
{
}

function converttime()
{
    $datetime = new DateTime('2008-08-03 12:35:23');
    echo $datetime->format('Y-m-d H:i:s') . "\n";
    $la_time = new DateTimeZone('America/Los_Angeles');
    $datetime->setTimezone($la_time);
    echo $datetime->format('Y-m-d H:i:s');
}

function username()
{
    //Gathers users
    $dbh = $GLOBALS['dbh'];
    $stmt = $dbh->prepare("SELECT * FROM users WHERE `id` = :id");
    $stmt->bindValue(':id', $_COOKIE['id']);
    $stmt->execute();
    $in = $stmt->fetch();
            
    echo $in['username'];
}

function activitylog($user, $message, $time, $about = "-")
{
    $dbh = $GLOBALS['dbh'];
    $ip = GetIP();
    $sql = "INSERT INTO activity_log(user, ip, message, time, about) VALUES ('".$user."', '".$ip."', '".$message."', '".$time."', '".$about."')";
    $result = $dbh->prepare($sql);
    $result->execute();
}

function get_timeago($ptime)
{
    $estimate_time = time() - $ptime;
    if ($estimate_time < 1) {
        return '1 second ago';
    }
    $condition = array(
                12 * 30 * 24 * 60 * 60  =>  'year',
                30 * 24 * 60 * 60       =>  'month',
                24 * 60 * 60            =>  'day',
                60 * 60                 =>  'hour',
                60                      =>  'minute',
                1                       =>  'second'
    );
    foreach ($condition as $secs => $str) {
        $d = $estimate_time / $secs;
        if ($d >= 1) {
            $r = round($d);
            return ' ' . $r . ' ' . $str . ($r > 1 ? 's' : '') . ' ago';
        }
    }
}

//Gets gravatar image from email address
function get_gravatar($email, $s = 150, $d = 'mm', $r = 'g', $img = false, $atts = array())
{
    $url = 'https://www.gravatar.com/avatar/';
    $url .= md5(strtolower(trim($email)));
    $url .= "?s=$s&d=$d&r=$r";
    if ($img) {
        $url = '<img src="' . $url . '"';
        foreach ($atts as $key => $val) {
            $url .= ' ' . $key . '="' . $val . '"';
        }
        $url .= ' />';
    }
    return $url;
}

function if_gravatar($email)
{
    $email2 = md5(strtolower($email));
    $gravatar = "http://www.gravatar.com/avatar/$email2?d=404";
    $headers = get_headers($gravatar, 1);
    if (strpos($headers[0], '200')) {
        $gravatar = "true";
    } // OK
    elseif (strpos($headers[0], '404')) {
        $gravatar = "false";
    } // Not Found
    return $gravatar;
}

function membercount()
{
    $dbh = $GLOBALS['dbh'];
    $sql = "SELECT count(*) FROM `users`";
    $result = $dbh->prepare($sql);
    $result->execute();
    $member_count = $result->fetchColumn();
    echo $member_count;
}

function captcha_standard($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    echo $randomString;
}

function sendverify($name, $to, $from, $SMTP, $title, $randomvalue, $url1)
{
    ini_set("SMTP", "".$SMTP."");
    ini_set("sendmail_from", "".$from."");
    $email2 = $from;
    $to      = ''.$to.'';
    $subject = ''.$title.' - Verify account';
    $message = '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office"><head>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width">
  <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
  <title>'.$title.' - Verify account</title>
  
  
  <style id="media-query">

/*  Media Queries */
@media only screen and (max-width: 500px) {
  table[class="body"] img {
    height: auto !important;
    width: 100% !important; }
  table[class="body"] img.fullwidth {
    max-width: 100% !important; }
  table[class="body"] center {
    min-width: 0 !important; }
  table[class="body"] .container {
    width: 95% !important; }
  table[class="body"] .row {
    width: 100% !important;
    display: block !important; }
  table[class="body"] .wrapper {
    display: block !important;
    padding-right: 0 !important; }
  table[class="body"] .columns, table[class="body"] .column {
    table-layout: fixed !important;
    float: none !important;
    width: 100% !important;
    padding-right: 0px !important;
    padding-left: 0px !important;
    display: block !important; }
  table[class="body"] .wrapper.first .columns, table[class="body"] .wrapper.first .column {
    display: table !important; }
  table[class="body"] table.columns td, table[class="body"] table.column td, .col {
    width: 100% !important; }
  table[class="body"] table.columns td.expander {
    width: 1px !important; }
  table[class="body"] .right-text-pad, table[class="body"] .text-pad-right {
    padding-left: 10px !important; }
  table[class="body"] .left-text-pad, table[class="body"] .text-pad-left {
    padding-right: 10px !important; }
  table[class="body"] .hide-for-small, table[class="body"] .show-for-desktop {
    display: none !important; }
  table[class="body"] .show-for-small, table[class="body"] .hide-for-desktop {
    display: inherit !important; }
  .mixed-two-up .col {
    width: 100% !important; } }
 @media screen and (max-width: 500px) {
      div[class="col"] {
          width: 100% !important;
      }
    }

    @media screen and (min-width: 501px) {
      table[class="container"] {
          width: 500px !important;
      }
    }
  </style>
</head>
<body style="width: 100% !important;min-width: 100%;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100% !important;margin: 0;padding: 0;background-color: #FFFFFF">
  <table cellpadding="0" cellspacing="0" width="100%" class="body" border="0" style="border-spacing: 0;border-collapse: collapse;vertical-align: top;height: 100%;width: 100%;table-layout: fixed">
      <tbody><tr style="vertical-align: top">
          <td class="center" align="center" valign="top" style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;text-align: center;background-color: #FFFFFF">

              <table cellpadding="0" cellspacing="0" align="center" width="100%" border="0" style="border-spacing: 0;border-collapse: collapse;vertical-align: top">
                <tbody><tr style="vertical-align: top">
                  <td width="100%" style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;background-color: #2C2D37">
          
                    <!--[if mso]>
                    </td></tr></table>
                    <![endif]-->
                    <!--[if (IE)]>
                    </td></tr></table>
                    <![endif]-->
                  </td>
                </tr>
              </tbody></table>
              <table cellpadding="0" cellspacing="0" align="center" width="100%" border="0" style="border-spacing: 0;border-collapse: collapse;vertical-align: top">
                <tbody><tr style="vertical-align: top">
                  <td width="100%" style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;background-color: #323341">
                    <!--[if gte mso 9]>
                    <table id="outlookholder" border="0" cellspacing="0" cellpadding="0" align="center"><tr><td>
                    <![endif]-->
                    <!--[if (IE)]>
                    <table width="500" align="center" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td>
                    <![endif]-->
                    <table cellpadding="0" cellspacing="0" align="center" width="100%" border="0" class="container" style="border-spacing: 0;border-collapse: collapse;vertical-align: top;max-width: 500px;margin: 0 auto;text-align: inherit"><tbody><tr style="vertical-align: top"><td width="100%" style="word-break: break-word;border-collapse: collapse !important;vertical-align: top"><table cellpadding="0" cellspacing="0" width="100%" bgcolor="transparent" class="block-grid " style="border-spacing: 0;border-collapse: collapse;vertical-align: top;width: 100%;max-width: 500px;color: #000000;background-color: transparent"><tbody><tr style="vertical-align: top"><td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;background-color: transparent;text-align: center;font-size: 0"><!--[if (gte mso 9)|(IE)]><table width="100%" align="center" bgcolor="transparent" cellpadding="0" cellspacing="0" border="0"><tr><![endif]--><!--[if (gte mso 9)|(IE)]><td valign="top" width="500" style="width:500px;"><![endif]--><div class="col num12" style="display: inline-block;vertical-align: top;width: 100%"><table cellpadding="0" cellspacing="0" align="center" width="100%" border="0" style="border-spacing: 0;border-collapse: collapse;vertical-align: top"><tbody><tr style="vertical-align: top"><td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;background-color: transparent;padding-top: 0px;padding-right: 0px;padding-bottom: 0px;padding-left: 0px;border-top: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-left: 0px solid transparent"><table cellpadding="0" cellspacing="0" width="100%" style="border-spacing: 0;border-collapse: collapse;vertical-align: top">
  <tbody><tr style="vertical-align: top">
    <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;padding-top: 30px;padding-right: 0px;padding-bottom: 30px;padding-left: 0px">
      <div style="color:#ffffff;line-height:120%;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;">
      	<div style="font-size:12px;line-height:14px;color:#ffffff;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;text-align:left;"><p style="margin: 0;font-size: 14px;line-height: 17px;text-align: center"><span style="font-size: 18px; line-height: 33px;"><strong>'.$title.'</strong> - Thank you for signing up!</span></p></div>
      </div>
    </td>
  </tr>
</tbody></table>
</td></tr></tbody></table></div><!--[if (gte mso 9)|(IE)]></td><![endif]--><!--[if (gte mso 9)|(IE)]></td></tr></table><![endif]--></td></tr></tbody></table></td></tr></tbody></table>
                    <!--[if mso]>
                    </td></tr></table>
                    <![endif]-->
                    <!--[if (IE)]>
                    </td></tr></table>
                    <![endif]-->
                  </td>
                </tr>
              </tbody></table>
              <table cellpadding="0" cellspacing="0" align="center" width="100%" border="0" style="border-spacing: 0;border-collapse: collapse;vertical-align: top">
                <tbody><tr style="vertical-align: top">
                  <td width="100%" style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;background-color: #61626F">
                    <!--[if gte mso 9]>
                    <table id="outlookholder" border="0" cellspacing="0" cellpadding="0" align="center"><tr><td>
                    <![endif]-->
                    <!--[if (IE)]>
                    <table width="500" align="center" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td>
                    <![endif]-->
                    <table cellpadding="0" cellspacing="0" align="center" width="100%" border="0" class="container" style="border-spacing: 0;border-collapse: collapse;vertical-align: top;max-width: 500px;margin: 0 auto;text-align: inherit"><tbody><tr style="vertical-align: top"><td width="100%" style="word-break: break-word;border-collapse: collapse !important;vertical-align: top"><table cellpadding="0" cellspacing="0" width="100%" bgcolor="transparent" class="block-grid " style="border-spacing: 0;border-collapse: collapse;vertical-align: top;width: 100%;max-width: 500px;color: #333;background-color: transparent"><tbody><tr style="vertical-align: top"><td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;background-color: transparent;text-align: center;font-size: 0"><!--[if (gte mso 9)|(IE)]><table width="100%" align="center" bgcolor="transparent" cellpadding="0" cellspacing="0" border="0"><tr><![endif]--><!--[if (gte mso 9)|(IE)]><td valign="top" width="500" style="width:500px;"><![endif]--><div class="col num12" style="display: inline-block;vertical-align: top;width: 100%"><table cellpadding="0" cellspacing="0" align="center" width="100%" border="0" style="border-spacing: 0;border-collapse: collapse;vertical-align: top"><tbody><tr style="vertical-align: top"><td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;background-color: transparent;padding-top: 30px;padding-right: 0px;padding-bottom: 30px;padding-left: 0px;border-top: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-left: 0px solid transparent"><table cellpadding="0" cellspacing="0" width="100%" style="border-spacing: 0;border-collapse: collapse;vertical-align: top">
  <tbody><tr style="vertical-align: top">
    <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;padding-top: 25px;padding-right: 10px;padding-bottom: 10px;padding-left: 10px">
      <div style="color:#ffffff;line-height:120%;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;">
      	<div style="font-size:18px;line-height:22px;text-align:center;color:#ffffff;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;"><p style="margin: 0;font-size: 18px;line-height: 22px;text-align: center"><span style="font-size: 24px; line-height: 28px;">
		<strong>Hey '.$name.'!</strong></span></p></div>
      </div>
    </td>
  </tr>
</tbody></table>
<table cellpadding="0" cellspacing="0" width="100%" style="border-spacing: 0;border-collapse: collapse;vertical-align: top">
  <tbody><tr style="vertical-align: top">
    <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;padding-top: 0px;padding-right: 10px;padding-bottom: 10px;padding-left: 10px">
      <div style="color:#B8B8C0;line-height:150%;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;">
      	<div style="font-size:14px;line-height:21px;text-align:center;color:#B8B8C0;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;"><p style="margin: 0;font-size: 14px;line-height: 21px;text-align: center"><span style="font-size: 14px; line-height: 21px;">
		'.$welcome_message.'<br><br>Before you can access many features on the site, you will need to veify your email address! <br><br>You can do this by clicking or copying and pasting:<br> <a href="'.$url1.'/welcome.php?verify='.$name.'&id='.$randomvalue.'" style="color:white;">'.$url1.'/welcome.php?verify='.$name.'&id='.$randomvalue.'</a></span></p></div>
      </div>
    </td>
  </tr>
</tbody></table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-spacing: 0;border-collapse: collapse;vertical-align: top">
  <tbody><tr style="vertical-align: top">
    <td class="button-container" align="center" style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;padding-top: 15px;padding-right: 10px;padding-bottom: 10px;padding-left: 10px">
      <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="border-spacing: 0;border-collapse: collapse;vertical-align: top">
        <tbody><tr style="vertical-align: top">
          <td width="100%" class="button" align="center" valign="middle" style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
            <!--[if mso]>
              <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="" style="height:42px;   v-text-anchor:middle; width:146px;" arcsize="60%"   strokecolor="#C7702E"   fillcolor="#C7702E" >
              <w:anchorlock/>
                <center style="color:#ffffff; font-family:Arial, Helvetica Neue, Helvetica, sans-serif; font-size:16px;">
            <![endif]-->
            <!--[if !mso]><!-- -->
            <div align="center" style="display: inline-block; border-radius: 25px; -webkit-border-radius: 25px; -moz-border-radius: 25px; max-width: 35%; width: 100%; border-top: 0px solid transparent; border-right: 0px solid transparent; border-bottom: 0px solid transparent; border-left: 0px solid transparent;">
              <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-spacing: 0;border-collapse: collapse;vertical-align: top;height: 42">
                <tbody><tr style="vertical-align: top"><td valign="middle" style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;border-radius: 25px; -webkit-border-radius: 25px; -moz-border-radius: 25px; color: #ffffff; background-color: #337ab7; padding-top: 5px; padding-right: 20px; padding-bottom: 5px; padding-left: 20px; font-family: Arial, Helvetica Neue, Helvetica, sans-serif;text-align: center">
            <!--<![endif]-->
                  <a href="'.$url1.'/welcome.php?verify='.$name.'&id='.$randomvalue.'" target="_blank" style="display: inline-block;text-decoration: none;-webkit-text-size-adjust: none;text-align: center;background-color: #337ab7;color: #ffffff"> <span style="font-family:Arial, Helvetica Neue, Helvetica, sans-serif;font-size:16px;line-height:32px;"><span style="font-size: 14px; line-height: 28px;" data-mce-style="font-size: 14px;">Verify my account</span></span>
                  </a>
              <!--[if !mso]><!-- -->
                </td></tr></tbody></table>
              </div><!--<![endif]-->
              <!--[if mso]>
                    </center>
                </v:roundrect>
              <![endif]-->
          </td>
        </tr>
      </tbody></table>
    </td>
  </tr>
</tbody></table>

</td></tr></tbody></table></div><!--[if (gte mso 9)|(IE)]></td><![endif]--><!--[if (gte mso 9)|(IE)]></td></tr></table><![endif]--></td></tr></tbody></table></td></tr></tbody></table>
                    <!--[if mso]>
                    </td></tr></table>
                    <![endif]-->
                    <!--[if (IE)]>
                    </td></tr></table>
                    <![endif]-->
                  </td>
                </tr>
              </tbody></table>
           
<table cellpadding="0" cellspacing="0" width="100%" style="border-spacing: 0;border-collapse: collapse;vertical-align: top">
  <tbody><tr style="vertical-align: top">
    <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;padding-top: 15px;padding-right: 10px;padding-bottom: 10px;padding-left: 10px">
      <div style="color:#959595;line-height:150%;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;">
      	<div style="font-size:14px;line-height:21px;text-align:center;color:#959595;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;"><p style="margin: 0;font-size: 14px;line-height: 21px;text-align: center">&copy; '.date("Y").' '.$title.'</p></div>
      </div>
    </td>
  </tr>
</tbody></table>
</td></tr></tbody></table></div><!--[if (gte mso 9)|(IE)]></td><![endif]--><!--[if (gte mso 9)|(IE)]></td></tr></table><![endif]--></td></tr></tbody></table></td></tr></tbody></table>
                    <!--[if mso]>
                    </td></tr></table>
                    <![endif]-->
                    <!--[if (IE)]>
                    </td></tr></table>
                    <![endif]-->
                  </td>
                </tr>
              </tbody></table>
          </td>
      </tr>
  </tbody></table>


</body></html>
';
    $headers = "MIME-Version: 1.0\r\n" ;
    $headers .= "Content-Type: text/html; charset=\"iso-8859-1\"\r\n";
    $headers .= "From: ".$title." <".$email2.">\r\n";
    $headers .= "Reply-To: ".$email2."" . "\r\n";
    mail($to, $subject, $message, $headers);

    mail($to, $subject, $message, $headers);
}


function sendwelcomeemail($name, $to, $from, $SMTP, $title, $url1, $welcome_title2, $welcome_message2)
{
    $dbh = $GLOBALS['dbh'];

    $sql = "SELECT * FROM site_settings";
    foreach ($dbh->query($sql) as $emailtpl) {
        $stmt1 = $dbh->prepare("SELECT * FROM email_templates WHERE `id` = :id");
    }
    $stmt1->bindValue(':id', ''.$emailtpl['email_template'].'');
    $stmt1->execute();
    $emailtemplate = $stmt1->fetch();
    
    
    $stmt = $dbh->prepare("SELECT * FROM users WHERE `id` = :id");
    $stmt->bindValue(':id', $_COOKIE['id']);
    $stmt->execute();
    $in = $stmt->fetch();

    $stmt = $dbh->prepare("SELECT * FROM users WHERE `email` = :email");
    $stmt->bindValue(':id', $to);
    $stmt->execute();
    $in_email = $stmt->fetch();

    $welcome_title = $welcome_title2;
    $welcome_message = $welcome_message2;

    ini_set("SMTP", "".$SMTP."");
    ini_set("sendmail_from", "".$from."");
    $to      = ''.$to.'';
    $email2 = $from;
    $title = $emailtpl['title'];
    $subject = ''.$title.' - '.$emailtpl['welcome_title'].'';

    $message = str_replace(
            array("%site_title%","%email_title%","%email_content%","%email_footer%", "%username%", "%name%"),
            array("".$emailtpl['title']."", "".$emailtpl['welcome_title']."", "".$emailtpl['welcome_message']."", "&copy; ".date("Y")." ".$emailtpl['title']."", "".$in_email['username']."", "".$in_email['firstname'].""),
            "".$emailtemplate ['content'].""
);

    $headers = "MIME-Version: 1.0\r\n" ;
    $headers .= "Content-Type: text/html; charset=\"iso-8859-1\"\r\n";
    $headers .= "From: ".$title." <".$email2.">\r\n";
    $headers .= "Reply-To: ".$email2."" . "\r\n";
    mail($to, $subject, $message, $headers);
}



function sendemail($name, $to, $from, $SMTP, $title, $url1, $email_title2, $email_message2)
{
    $dbh = $GLOBALS['dbh'];
    $sql = "SELECT * FROM site_settings";
    foreach ($dbh->query($sql) as $emailtpl) {
        $stmt1 = $dbh->prepare("SELECT * FROM email_templates WHERE `id` = :id");
    }
    $stmt1->bindValue(':id', ''.$emailtpl['email_template'].'');
    $stmt1->execute();
    $emailtemplate = $stmt1->fetch();

    $stmt = $dbh->prepare("SELECT * FROM users WHERE `id` = :id");
    $stmt->bindValue(':id', $_COOKIE['id']);
    $stmt->execute();
    $in = $stmt->fetch();

    $stmt = $dbh->prepare("SELECT * FROM users WHERE `email` = :email");
    $stmt->bindValue(':email', $to);
    $stmt->execute();
    $in_email = $stmt->fetch();
    
    $email_title = $email_title2;
    $email_message = $email_message2;

    ini_set("SMTP", "".$SMTP."");
    ini_set("sendmail_from", "".$from."");
    $to      = ''.$to.'';
    $email2 = $from;
    $title = $emailtpl['title'];

    $email_content = str_replace(
            array("%site_title%","%email_title%","%email_content%","%email_footer%", "%username%", "%name%"),
            array("".$emailtpl['title']."", "".$email_title."", "".$email_message."", "&copy; ".date("Y")." ".$emailtpl['title']."", "".$in_email['username']."", "".$in_email['firstname'].""),
            "".$emailtemplate ['content'].""
);
    $message = str_replace(
            array("%site_title%","%email_title%","%email_content%","%email_footer%", "%username%", "%name%"),
            array("".$emailtpl['title']."", "".$email_title."", "".$email_message."", "&copy; ".date("Y")." ".$emailtpl['title']."", "".$in_email['username']."", "".$in_email['firstname'].""),
            "".$email_content.""
);

    $subject = str_replace(
            array("%site_title%","%email_title%","%email_content%","%email_footer%", "%username%", "%name%"),
            array("".$emailtpl['title']."", "".$email_title."", "".$email_message."", "&copy; ".date("Y")." ".$emailtpl['title']."", "".$in_email['username']."", "".$in_email['firstname'].""),
            "".$title." - ".$email_title.""
);

    $headers = "MIME-Version: 1.0\r\n" ;
    $headers .= "Content-Type: text/html; charset=\"iso-8859-1\"\r\n";
    $headers .= "From: ".$title." <".$email2.">\r\n";
    $headers .= "Reply-To: ".$email2."" . "\r\n";
    mail($to, $subject, $message, $headers);
}
?>

<?php
function forgotpassword($name, $to, $from, $SMTP, $title, $url1)
{
    $dbh = $GLOBALS['dbh'];
    $sql = "SELECT * FROM site_settings";
    foreach ($dbh->query($sql) as $emailtpl) {
        $stmt1 = $dbh->prepare("SELECT * FROM email_templates WHERE `id` = :id");
    }
    $stmt1->bindValue(':id', ''.$emailtpl['email_template'].'');
    $stmt1->execute();
    $emailtemplate = $stmt1->fetch();

    //Get user information
    $stmt = $dbh->prepare("SELECT * FROM users WHERE `id` = :id");
    $stmt->bindValue(':id', $_COOKIE['id']);
    $stmt->execute();
    $in = $stmt->fetch();

    $stmt = $dbh->prepare("SELECT * FROM users WHERE `email` = :email");
    $stmt->bindValue(':email', $to);
    $stmt->execute();
    $in_email = $stmt->fetch();

    //Update account number
    $randomnumber = rand();
    $sql = $dbh->prepare("UPDATE users SET forgotid='".$randomnumber ."' WHERE id=".$in_email['id']."");
    $sql->execute();
        

        
    $email_title = "".$i['title']." Password reset";
    $pagesiteurl = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}/";
    $email_message = 'Hi '.$in_email['username'].', <br><br>To reset your password please go to: <a href="'.$pagesiteurl.'forgotpass.php?p=reset&u='.$randomnumber.'">'.$pagesiteurl.'forgotpass.php?p=reset&u='.$randomnumber.'</a>';

    ini_set("SMTP", "".$SMTP."");
    ini_set("sendmail_from", "".$from."");
    $to      = ''.$to.'';
    $email2 = $from;
    $title = $emailtpl['title'];

    $email_content = str_replace(
            array("%site_title%","%email_title%","%email_content%","%email_footer%", "%username%", "%name%"),
            array("".$emailtpl['title']."", "".$email_title."", "".$email_message."", "&copy; ".date("Y")." ".$emailtpl['title']."", "".$in_email['username']."", "".$in_email['firstname'].""),
            "".$emailtemplate ['content'].""
);
    $message = str_replace(
            array("%site_title%","%email_title%","%email_content%","%email_footer%", "%username%", "%name%"),
            array("".$emailtpl['title']."", "".$email_title."", "".$email_message."", "&copy; ".date("Y")." ".$emailtpl['title']."", "".$in_email['username']."", "".$in_email['firstname'].""),
            "".$email_content.""
);

    $subject = str_replace(
            array("%site_title%","%email_title%","%email_content%","%email_footer%", "%username%", "%name%"),
            array("".$emailtpl['title']."", "".$email_title."", "".$email_message."", "&copy; ".date("Y")." ".$emailtpl['title']."", "".$in_email['username']."", "".$in_email['firstname'].""),
            "".$title." - ".$email_title.""
);

    $headers = "MIME-Version: 1.0\r\n" ;
    $headers .= "Content-Type: text/html; charset=\"iso-8859-1\"\r\n";
    $headers .= "From: ".$title." <".$email2.">\r\n";
    $headers .= "Reply-To: ".$email2."" . "\r\n";
    mail($to, $subject, $message, $headers);
}


function mailer($config, $to, $subject, $message){
    $to = $_REQUEST['email'];
    $from = $config['email'];
    $subject = $_REQUEST['subject'];
    $message = $message;
    
    //send email
    mail($to, $subject, $message, "From:" . $email);
}
