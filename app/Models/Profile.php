<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTime;

class Profile extends Model
{
    use HasFactory;

    static function programmingHistory()
    {
        $startDate = new DateTime('2021-01-25');
        $today = new DateTime();
        $diff = $today->diff($startDate);

        $history = '';

        if ($diff->format('%y') != '0') {
            $history .= '%y年';
        }
        if ($diff->format('%m') != '0') {
            $history .= '%mヶ月';
        }
        if ($diff->format('%d') != '0') {
            $history .= 'と%d日';
        }

        return $diff->format($history);
    }
}
