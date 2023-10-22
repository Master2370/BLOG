<?php
$desktopFolder = $_SERVER['USERPROFILE'] . '\\Desktop\\downloaded_images';

if (!file_exists($desktopFolder)) {
    mkdir($desktopFolder);
}

$file = fopen('img.txt', 'r');

if ($file) {
    while (($line = fgets($file)) !== false) {
        $line = trim($line); // Remove leading/trailing whitespace
        $fileName = basename($line); // Get the file name from the URL
        $filePath = $desktopFolder . '\\' . $fileName;

        $imageData = file_get_contents($line);
        if ($imageData !== false) {
            file_put_contents($filePath, $imageData);
            echo "Downloaded and saved: $fileName<br>";
        } else {
            echo "Failed to download: $fileName<br>";
        }
    }

    fclose($file);
} else {
    echo "Failed to open the URL file.";
}
?>
