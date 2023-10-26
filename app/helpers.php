<?php

use App\Models\MipoSetting;
use App\Models\EmployeeMipo;
use Illuminate\Support\Facades\Storage;

function uploadPhoto($photo, $folder)
{
    $photoName = time(). random_int(0, 1000) . '.' . $photo->getClientOriginalExtension();
    Storage::putFileAs('public/' . $folder, $photo, $photoName);
    return $photoName;
}

function inputMipo($date, $absen_in, $max_absen_in, $user_id) : void{
    // jika terlambat 1 - 10 menit
    $mipo = null;
    if($absen_in->gt($max_absen_in) && $absen_in->diffInMinutes($max_absen_in) <= 10){
        $mipo = MipoSetting::find(11);
    }elseif($absen_in->gt($max_absen_in) && $absen_in->diffInMinutes($max_absen_in) >= 11 && $absen_in->diffInMinutes($max_absen_in) <= 20){
        $mipo = MipoSetting::find(12);
    }elseif($absen_in->gt($max_absen_in) && $absen_in->diffInMinutes($max_absen_in) >= 21 && $absen_in->diffInMinutes($max_absen_in) <= 30){
        $mipo = MipoSetting::find(13);
    }elseif($absen_in->gt($max_absen_in) && $absen_in->diffInMinutes($max_absen_in) >= 31 && $absen_in->diffInMinutes($max_absen_in) <= 60){
        $mipo = MipoSetting::find(14);
    }elseif($absen_in->gt($max_absen_in) && $absen_in->diffInMinutes($max_absen_in) > 60){
        $mipo = MipoSetting::find(15);
    }
    // dd($absen_in->gt($max_absen_in), $absen_in, $max_absen_in);


    if($mipo != null)
    {
        EmployeeMipo::updateOrCreate([
            'user_id' => $user_id,
            'date' => $date ?? $date->format('Y-m-d'),
        ],[
            'mipo_setting_id' => $mipo->id,
        ]);
    }
}