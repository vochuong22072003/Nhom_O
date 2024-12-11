<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function encryptId($id) {
        $salt = "chuoi_noi_voi_id";
        return base64_encode($id . $salt);
    }

    public function decryptId($encryptedId) {
        $salt = "chuoi_noi_voi_id";
        $decoded = base64_decode($encryptedId);
        return str_replace($salt, '', $decoded);
    }

    public function convertMinutesToTime($minutes) {
        // Tính toán các giá trị
        $years = floor($minutes / (60 * 24 * 365));
        $minutes -= $years * 60 * 24 * 365;
    
        $months = floor($minutes / (60 * 24 * 30));
        $minutes -= $months * 60 * 24 * 30;
    
        $days = floor($minutes / (60 * 24));
        $minutes -= $days * 60 * 24;
    
        $hours = floor($minutes / 60);
        $minutes -= $hours * 60;
    
        // Kết hợp các phần tử không rỗng thành chuỗi
        $result = [];
        if ($years > 0) $result[] = "$years năm";
        if ($months > 0) $result[] = "$months tháng";
        if ($days > 0) $result[] = "$days ngày";
        if ($hours > 0) $result[] = "$hours giờ";
        if ($minutes > 0) $result[] = "$minutes phút";
    
        return implode(' ', $result);
    }
}
