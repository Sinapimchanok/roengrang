<?php
    if (isset($_POST['radios']) && isset($_POST['review'])) {
        $selectedOption = $_POST['radios'];
        $review = $_POST['review'];

        echo "Selected option: " . $selectedOption . "<br>";
        echo "Review: " . $review;
    } else {
        echo "Incomplete form submission.";
    }

?>
