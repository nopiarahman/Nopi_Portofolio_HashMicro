<?php
use Carbon\Carbon;
function greetings(){
    $now = Carbon::now()->hour;
    if($now <4){
        return "Waktunya Tidur";
    }elseif($now <9){
        return "Selamat Pagi";
    }elseif($now <14){
        return "Selamat Siang";
    }elseif($now <17){
        return "Selamat Sore";
    }elseif($now <24){
        return "Selamat Malam";
    }
}