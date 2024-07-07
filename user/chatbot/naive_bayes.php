<?php
// Function to preprocess input text
/*function preprocessInput($text) {
    // Add your preprocessing steps here (e.g., lowercasing, removing punctuation, etc.)
    return strtolower($text);
}*/

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

// Function to load Naive Bayes model from a file
function loadNaiveBayesModel($filePath) {
    // Load the model data from the file (e.g., JSON)
    $modelData = file_get_contents($filePath);
    return json_decode($modelData, true);
}

// Function to classify a message using the Naive Bayes model
function classifyMessage($message, $classifier) {
    $classProbabilities = $classifier['classProbabilities'];
    $wordProbabilities = $classifier['wordProbabilities'];
    
    $message = preprocessInput($message);
    $words = explode(" ", $message);
    
    $maxProbability = 0;
    $predictedClass = "";
    
    foreach ($classProbabilities as $class => $classProbability) {
        $probability = $classProbability;
        foreach ($words as $word) {
            if (isset($wordProbabilities[$word][$class])) {
                $probability *= $wordProbabilities[$word][$class];
            }
        }
        if ($probability > $maxProbability) {
            $maxProbability = $probability;
            $predictedClass = $class;
        }
    }
    
    return $predictedClass;
}
?>
