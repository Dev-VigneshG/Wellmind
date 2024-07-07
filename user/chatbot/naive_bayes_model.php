<?php
// Function to preprocess input text
function preprocessInput($text) {
    // Add your preprocessing steps here (e.g., lowercasing, removing punctuation, etc.)
    return strtolower($text);
}

// Function to train Naive Bayes classifier
function trainNaiveBayesClassifier($trainingData) {
    $classProbabilities = array(); // Prior probabilities of each class
    $wordProbabilities = array(); // Likelihood probabilities of each word given each class
    
    // Count occurrences of each class and each word given each class
    $classCounts = array();
    $wordCounts = array();
    foreach ($trainingData as $data) {
        $class = $data['class'];
        $words = explode(" ", preprocessInput($data['message']));
        
        if (!isset($classCounts[$class])) {
            $classCounts[$class] = 0;
        }
        $classCounts[$class]++;
        
        foreach ($words as $word) {
            if (!isset($wordCounts[$word][$class])) {
                $wordCounts[$word][$class] = 0;
            }
            $wordCounts[$word][$class]++;
        }
    }
    
    // Calculate prior probabilities
    $totalMessages = count($trainingData);
    foreach ($classCounts as $class => $count) {
        $classProbabilities[$class] = $count / $totalMessages;
    }

    // Calculate likelihood probabilities
    foreach ($wordCounts as $word => $counts) {
        foreach ($counts as $class => $count) {
            $wordProbabilities[$word][$class] = ($count + 1) / ($classCounts[$class] + count($wordCounts));
        }
    }

    return array("classProbabilities" => $classProbabilities, "wordProbabilities" => $wordProbabilities);
}

// Function to save Naive Bayes model to a file
function saveNaiveBayesModel($model, $filePath) {
    // Save the model data to a file (e.g., as JSON)
    file_put_contents($filePath, json_encode($model));
}

// Example training data
$trainingData = array(
    array("class" => "positive", "message" => "I love this movie"),
    array("class" => "positive", "message" => "This movie is great"),
    array("class" => "negative", "message" => "I hate this movie"),
    array("class" => "negative", "message" => "This movie is awful")
);

// Train the Naive Bayes model
$model = trainNaiveBayesClassifier($trainingData);

// Save the model to a file
saveNaiveBayesModel($model, 'naive_bayes_model.json');
?>
