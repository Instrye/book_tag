<?php
$critics = [
    'Lisa Rose' => [
        'Lady in the Water' => 2.5,
        'Snakes on a Plane' => 3.5,
        'Just My Luck' => 3.0,
        'Superman Returns' => 3.5,
        'You, Me and Dupree' => 2.5,
        'The Night Listener' => 3.0
    ],
    'Gene Seymour' => [
        'Lady in the Water' => 3.0,
        'Snakes on a Plane' => 3.5,
        'Just My Luck' => 1.5,
        'Superman Returns' => 5.0,
        'The Night Listener' => 3.0,
        'You, Me and Dupree' => 3.5
    ],
    'Michael Phillips' => [
        'Lady in the Water' => 2.5,
        'Snakes on a Plane' => 3.0,
        'Superman Returns' => 3.5,
        'The Night Listener' => 4.0
    ],
    'Claudia Puig' => [
        'Snakes on a Plane' => 3.5,
        'Just My Luck' => 3.0,
        'The Night Listener' => 4.5,
        'Superman Returns' => 4.0,
        'You, Me and Dupree' => 2.5
    ],
    'Mick LaSalle' => [
        'Lady in the Water' => 3.0,
        'Snakes on a Plane' => 4.0,
        'Just My Luck' => 2.0,
        'Superman Returns' => 3.0,
        'The Night Listener' => 3.0,
        'You, Me and Dupree' => 2.0
    ],
    'Jack Matthews' => [
        'Lady in the Water' => 3.0,
        'Snakes on a Plane' => 4.0,
        'The Night Listener' => 3.0,
        'Superman Returns' => 5.0,
        'You, Me and Dupree' => 3.5
    ],
    'Toby' => [
        'Snakes on a Plane' => 4.5,
        'You, Me and Dupree' => 1.0,
        'Superman Returns' => 4.0
    ],
];

//欧几里得距离
function sim_distance($prefs, $preson1, $preson2){
    $si = 0;
    foreach($prefs[$preson1] as $key => $v){
        if(array_key_exists($key,$prefs[$preson2])){
            $si += pow($v - $prefs[$preson2][$key],2);
        }
    }
    if(count($si) == 0 ) return 0;

    return 1/(1+sqrt($si));
}

//皮尔逊相关度
function sim_pearson($prefs, $p1, $p2){
    $si = [];
    foreach($prefs[$p1] as $key => $v){
        if(array_key_exists($key,$prefs[$p2])){
            $si[] = [$v,$prefs[$p2][$key]];
        }
    }
    $n = count($si);
    if($n == 0) return 0;
    $sum1 = array_sum(array_column($si,0));
    $sum2 = array_sum(array_column($si,1));
    $sum1Sq = 0;
    foreach($si[0] as $v){
        $sum1Sq += pow($v,2);
    }
    $sum2Sq = 0;
    foreach($si[1] as $v){
        $sum2Sq += pow($v,2);
    }
    $pSum = 0;
    array_walk($si,function($v,$k) use(&$pSum){
        $pSum += $v[0] * $v[1];
    });
    $num = $pSum - ($sum1*$sum2/$n);
    $den = sqrt(($sum1Sq - pow($sum1,2) / $n) * ($sum2Sq - pow($sum2,2) / $n));
    if($den == 0) return 0;
    return $num/$den;
}

echo sim_pearson($critics,'Lisa Rose','Gene Seymour');