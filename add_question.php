<?php
include("db.php");
$question=[
    
    ["I feel down-hearted and blue","A little of the time","Some of the time","Good part of the time","Most ofthe time",1,2,3,4],
    ["Morning is when I feel the best","A little of the time","Some of the time","Good part of the time","Most ofthe time",1,2,3,4],
    ["I have crying spells or feel like it","A little of the time","Some of the time","Good part of the time","Most ofthe time",1,2,3,4],
    ["I have trouble sleeping at night","A little of the time","Some of the time","Good part of the time","Most ofthe time",1,2,3,4],
    ["I eat as much as I used to","A little of the time","Some of the time","Good part of the time","Most ofthe time",1,2,3,4],
    ["I still enjoy sex","A little of the time","Some of the time","Good part of the time","Most ofthe time",1,2,3,4],
    ["I notice that I am losing weight","A little of the time","Some of the time","Good part of the time","Most ofthe time",1,2,3,4],
    ["I have trouble with constipation","A little of the time","Some of the time","Good part of the time","Most ofthe time",1,2,3,4],
    ["My heart beats faster than usual","A little of the time","Some of the time","Good part of the time","Most ofthe time",1,2,3,4],
    ["I get tired for no reason","A little of the time","Some of the time","Good part of the time","Most ofthe time",1,2,3,4],
    ["My mind is as clear as it used to be","A little of the time","Some of the time","Good part of the time","Most ofthe time",1,2,3,4],
    ["I find it easy to do the things I used to","A little of the time","Some of the time","Good part of the time","Most ofthe time",1,2,3,4],
    ["I am restless and can’t keep still","A little of the time","Some of the time","Good part of the time","Most ofthe time",1,2,3,4],
    ["I feel hopeful about the future","A little of the time","Some of the time","Good part of the time","Most ofthe time",1,2,3,4],
    ["I am more irritable than usual","A little of the time","Some of the time","Good part of the time","Most ofthe time",1,2,3,4],
    ["I feel that I am useful and needed","A little of the time","Some of the time","Good part of the time","Most ofthe time",1,2,3,4],
    ["My life is pretty full","A little of the time","Some of the time","Good part of the time","Most ofthe time",1,2,3,4],
    ["I feel that others would be better off if I were dead","A little of the time","Some of the time","Good part of the time","Most ofthe time",1,2,3,4],
    ["I still enjoy the things I used to do","A little of the time","Some of the time","Good part of the time","Most ofthe time",1,2,3,4],
    ["I find it easy to make decisions","A little of the time","Some of the time","Good part of the time","Most ofthe time",1,2,3,4],
];
for($i=0;$i<count($question);$i++){
    $sql = "INSERT INTO question (QUIZ_ID,QUESTION,OPTION1,OPTION2,OPTION3,OPTION4,VALUE1,VALUE2,VALUE3,VALUE4) VALUES (4,'".$question[$i][0]."','".$question[$i][1]."','".$question[$i][2]."','".$question[$i][3]."','".$question[$i][4]."','".$question[$i][5]."','".$question[$i][6]."','".$question[$i][7]."','".$question[$i][8]."')";
    $result = mysqli_query($db, $sql);
    if ($result) {
        echo "<script>alert('Question Added Successfully')</script>";
    } else {
        echo "<script>alert('Question Not Added')</script>";
    }
}
     
     
     
     
     
     
     
     
     
     
     
?>