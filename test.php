<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wellmind";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


$stmt = $conn->prepare("INSERT INTO question (QNO ,QUIZ_ID, QUESTION, OPTION1, OPTION2, OPTION3, OPTION4, VALUE1, VALUE2, VALUE3, VALUE4) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param("isssssssss", $quiz_id, $question, $option1, $option2, $option3, $option4, $value1, $value2, $value3, $value4);
/*
$data = [
    [1, 'You feel rested', 'Atmost', 'Sometimes', 'Often', 'Usually', 1, 2, 3, 4],
    [1, 'You feel that too many demands are being made on you', 'Atmost', 'Sometimes', 'Often', 'Usually', 1, 2, 3, 4],
    [1, 'You are irritable or grouchy', 'Atmost', 'Sometimes', 'Often', 'Usually', 1, 2, 3, 4],
    [1, 'You have too many things to do', 'Atmost', 'Sometimes', 'Often', 'Usually', 1, 2, 3, 4],
    [1, 'You feel lonely or isolated', 'Atmost', 'Sometimes', 'Often', 'Usually', 1, 2, 3, 4],
    [1, 'You find yourself in situations of conflict', 'Atmost', 'Sometimes', 'Often', 'Usually', 1, 2, 3, 4],
    [1, 'You feel you\'re doing things you really like', 'Atmost', 'Sometimes', 'Often', 'Usually', 1, 2, 3, 4],
    [1, 'You feel tired', 'Atmost', 'Sometimes', 'Often', 'Usually', 1, 2, 3, 4],
    [1, 'You fear you may not manage to attain your goals', 'Atmost', 'Sometimes', 'Often', 'Usually', 1, 2, 3, 4],
    [1, 'You feel calm', 'Atmost', 'Sometimes', 'Often', 'Usually', 1, 2, 3, 4],
    [1, 'You have too many decisions to make', 'Atmost', 'Sometimes', 'Often', 'Usually', 1, 2, 3, 4],
    [1, 'You feel frustrated', 'Atmost', 'Sometimes', 'Often', 'Usually', 1, 2, 3, 4],
    [1, 'You are full of energy', 'Atmost', 'Sometimes', 'Often', 'Usually', 1, 2, 3, 4],
    [1, 'You feel tense', 'Atmost', 'Sometimes', 'Often', 'Usually', 1, 2, 3, 4],
    [1, 'Your problems seem to be piling up', 'Atmost', 'Sometimes', 'Often', 'Usually', 1, 2, 3, 4],
    [1, 'You feel you\'re in a hurry', 'Atmost', 'Sometimes', 'Often', 'Usually', 1, 2, 3, 4],
    [1, 'You feel safe and protected', 'Atmost', 'Sometimes', 'Often', 'Usually', 1, 2, 3, 4],
    [1, 'You have many worries', 'Atmost', 'Sometimes', 'Often', 'Usually', 1, 2, 3, 4],
    [1, 'You are under pressure from other people', 'Atmost', 'Sometimes', 'Often', 'Usually', 1, 2, 3, 4],
    [1, 'You feel discouraged', 'Atmost', 'Sometimes', 'Often', 'Usually', 1, 2, 3, 4],
    [1, 'You enjoy yourself', 'Atmost', 'Sometimes', 'Often', 'Usually', 1, 2, 3, 4],
    [1, 'You are afraid for the future', 'Atmost', 'Sometimes', 'Often', 'Usually', 1, 2, 3, 4],
    [1, 'You feel you\'re doing things because you have to
    not because you want to', 'Atmost', 'Sometimes', 'Often', 'Usually', 1, 2, 3, 4],
    [1, 'You feel criticized or judged', 'Atmost', 'Sometimes', 'Often', 'Usually', 1, 2, 3, 4],
    [1, 'You are lighthearted', 'Atmost', 'Sometimes', 'Often', 'Usually', 1, 2, 3, 4],
    [1, 'You feel mentally exhausted', 'Atmost', 'Sometimes', 'Often', 'Usually', 1, 2, 3, 4],
    [1, 'You have trouble relaxing', 'Atmost', 'Sometimes', 'Often', 'Usually', 1, 2, 3, 4],
    [1, 'You feel loaded down with responsibility', 'Atmost', 'Sometimes', 'Often', 'Usually', 1, 2, 3, 4],
    [1, 'You have enough time for yourself', 'Atmost', 'Sometimes', 'Often', 'Usually', 1, 2, 3, 4],
    [1, 'You feel under pressure from deadlines', 'Atmost', 'Sometimes', 'Often', 'Usually', 1, 2, 3, 4],

    
];
*/
/*
$data=[
    [3, 'On the whole, I am satisfied with myself.', 'Strongly Agree', 'Agree', 'Disagree', 'Strongly Disagree', 4, 3, 2, 1],
    [3, 'At times I think I am no good at all.', 'Strongly Agree', 'Agree', 'Disagree', 'Strongly Disagree', 1, 2, 3, 4],
    [3, 'I feel that I have a number of good qualities.', 'Strongly Agree', 'Agree', 'Disagree', 'Strongly Disagree', 4, 3, 2, 1],
    [3, 'I am able to do things as well as most other people.', 'Strongly Agree', 'Agree', 'Disagree', 'Strongly Disagree', 4, 3, 2, 1],
    [3, 'I feel I do not have much to be proud of.', 'Strongly Agree', 'Agree', 'Disagree', 'Strongly Disagree', 1, 2, 3, 4],
    [3, 'I certainly feel useless at times.', 'Strongly Agree', 'Agree', 'Disagree', 'Strongly Disagree', 1, 2, 3, 4],
    [3, 'I feel that I\'m a person of worth, at least on an equal plane with others.', 'Strongly Agree', 'Agree', 'Disagree', 'Strongly Disagree', 4, 3, 2, 1],
    [3, 'I wish I could have more respect for myself.', 'Strongly Agree', 'Agree', 'Disagree', 'Strongly Disagree', 1, 2, 3, 4],
    [3, 'All in all, I am inclined to feel that I am a failure.', 'Strongly Agree', 'Agree', 'Disagree', 'Strongly Disagree', 1, 2, 3, 4],
    [3, 'I take a positive attitude toward myself.', 'Strongly Agree', 'Agree', 'Disagree', 'Strongly Disagree', 4,3,2,1],

];
*/
$data=[
 [2, 'Anxious mood', 'Mild', 'Moderate', 'Severe', 'Very severe', 1, 2, 3, 4],
 [2, 'Tension', 'Mild', 'Moderate', 'Severe', 'Very severe', 1, 2, 3, 4],
 [2, 'Fears', 'Mild', 'Moderate', 'Severe', 'Very severe', 1, 2, 3, 4],
 [2, 'Insomnia', 'Mild', 'Moderate', 'Severe', 'Very severe', 1, 2, 3, 4],
 [2, 'Intellectual', 'Mild', 'Moderate', 'Severe', 'Very severe', 1, 2, 3, 4],
 [2, 'Depressed mood', 'Mild', 'Moderate', 'Severe', 'Very severe', 1, 2, 3, 4],
 [2, 'Somatic (muscular)', 'Mild', 'Moderate', 'Severe', 'Very severe', 1, 2, 3, 4],
 [2, 'Somatic (sensory)', 'Mild', 'Moderate', 'Severe', 'Very severe', 1, 2, 3, 4],
 [2, 'Cardiovascular symptoms', 'Mild', 'Moderate', 'Severe', 'Very severe', 1, 2, 3, 4],
 [2, 'Respiratory symptoms', 'Mild', 'Moderate', 'Severe', 'Very severe', 1, 2, 3, 4],
 [2, 'Gastrointestinal symptoms', 'Mild', 'Moderate', 'Severe', 'Very severe', 1, 2, 3, 4],
 [2, 'Genitourinary symptoms', 'Mild', 'Moderate', 'Severe', 'Very severe', 1, 2, 3, 4],
 [2, 'Autonomic symptoms', 'Mild', 'Moderate', 'Severe', 'Very severe', 1, 2, 3, 4],
 [2, 'Behavior at interview', 'Mild', 'Moderate', 'Severe', 'Very severe', 1, 2, 3, 4],


];


foreach ($data as $row) {
    list($quiz_id, $question, $option1, $option2, $option3, $option4, $value1, $value2, $value3, $value4) = $row;
    $stmt->execute();
}

echo "New records created successfully";

$stmt->close();
$conn->close();
?>