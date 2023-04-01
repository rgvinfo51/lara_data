<?php
/* @This helper is used for Common functions*/
use App\Models\MisActivity;
use App\Models\MisPhysicalProgress;
use App\Models\MisPhysicalTarget;
use App\Models\RefFinancialYear;
use App\Models\RefMember;
use App\Models\RefScheme;
use App\Models\RefState;
use App\Models\Role;
use App\Models\Zone;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Models\IndiaDirectory;


if (! function_exists('pr')) {
    function pr($request)
    {
		echo '<pre>';
		print_r($request);
        die;         
    }
}
 
//Send Mail with template
function send_mailTemplate($to, $subject, $templates, $data, $cc = null, $bcc = null, $applicationType = null)
{
    try {
        $res = Mail::send($templates, $data,
            function ($message) use ($to, $subject, $cc, $bcc) {
                $message->to($to);
                if (! empty($cc)) {
                    $message->cc($cc);
                }
                if (! empty($bcc)) {
                    $message->bcc($bcc);
                }
                $message->from('no-reply@gmail.com');

                $message->subject($subject);
            }
        );

        return true;
    } catch (\Exception $e) {
        Log::error($e);

        return true;
    }
}
/*
*send OTP
*/
if (! function_exists('generateOTP')) {
    function generateOTP()
    {
        return rand(10000, 99999);
        //return '11111';
        //return '12345';
    }
}

function random_string($str_len = 30)
{
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    $result = '';
    for ($i = 0; $i < $str_len; $i++) {
        $result .= $characters[mt_rand(0, 61)];
    }

    return $result;
}
function random_numeric($str_len = 30)
{
    $randnum = rand(1111111111, mt_getrandmax());

    return  $randnum;
}
function saveMedia($file, $repository_name = '/brochure', $str_len = 5, $file_permission = 'public')
{
    $disk_name = 'uploads';
    $filename = random_string($str_len).'_'.time().'.'.$file->getClientOriginalExtension();
    Storage::disk('uploads')->put($repository_name.'/'.$filename, file_get_contents($file->getRealPath()), $file_permission);

    return '/'.$disk_name.(($repository_name != '') ? $repository_name.'/' : '').$filename;
}
function getAmountInWords(float $number)
{
    $decimal = round($number - ($no = floor($number)), 2) * 100;
    $hundred = null;
    $digits_length = strlen($no);
    $i = 0;
    $str = [];
    $words = [0 => '', 1 => 'one', 2 => 'two',
        3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
        7 => 'seven', 8 => 'eight', 9 => 'nine',
        10 => 'ten', 11 => 'eleven', 12 => 'twelve',
        13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
        16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
        19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
        40 => 'forty', 50 => 'fifty', 60 => 'sixty',
        70 => 'seventy', 80 => 'eighty', 90 => 'ninety', ];
    $digits = ['', 'hundred', 'thousand', 'lakh', 'crore'];
    while ($i < $digits_length) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str[] = ($number < 21) ? $words[$number].' '.$digits[$counter].$plural.' '.$hundred : $words[floor($number / 10) * 10].' '.$words[$number % 10].' '.$digits[$counter].$plural.' '.$hundred;
        } else {
            $str[] = null;
        }
    }
    $Rupees = implode('', array_reverse($str));
    $paise = ($decimal > 0) ? '.'.($words[$decimal / 10].' '.$words[$decimal % 10]).' Paise' : '';

    return ($Rupees ? $Rupees.'Rupees ' : '').$paise;
}
function getGender($gen)
{
    if ($gen == 'M') {
        return 'Male';
    } elseif ($gen == 'F') {
        return 'Female';
    } elseif ($gen == 'T') {
        return 'Transgender';
    }
}

function IndMoneyFormat($number)
{
    $decimal = (string) ($number - floor($number));
    $money = floor($number);
    $length = strlen($money);
    $delimiter = '';
    $money = strrev($money);

    for ($i = 0; $i < $length; $i++) {
        if (($i == 3 || ($i > 3 && ($i - 1) % 2 == 0)) && $i != $length) {
            $delimiter .= ',';
        }
        $delimiter .= $money[$i];
    }

    $result = strrev($delimiter);
    $decimal = preg_replace("/0\./i", '.', $decimal);
    $decimal = substr($decimal, 0, 3);

    if ($decimal != '0') {
        $result = $result.$decimal;
    }

    return $result;
}

function getRoles()
{
    $result = Role::where('id', '!=', 1)->get();

    return $result;
}
 



?>

