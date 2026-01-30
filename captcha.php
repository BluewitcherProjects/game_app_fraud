<?php
session_start();

// Set the content type to an image
header("Content-type: image/png");

// Generate a random code for the captcha with 4 characters
$captcha_code = substr(str_shuffle("1234567890"), 0, 4);

// Set the CAPTCHA code in a cookie (expires in 10 minutes)
setcookie('captcha_code', $captcha_code, time() + 600, "/"); // 600 seconds = 10 minutes


// Create an image with reduced size
$image = imagecreatetruecolor(80, 25); // Further reduced width and height

// Generate a random background color
$background_color = imagecolorallocate($image, rand(200, 255), rand(200, 255), rand(200, 255)); // light random color
$text_color = imagecolorallocate($image, 0, 0, 0); // black text
$line_color = imagecolorallocate($image, rand(150, 200), rand(150, 200), rand(150, 200)); // light random grey lines
$pixel_color = imagecolorallocate($image, rand(150, 200), rand(150, 200), rand(150, 200)); // light random grey dots

// Fill the background
imagefilledrectangle($image, 0, 0, 80, 25, $background_color);

// Add fewer random lines for less distraction
for ($i = 0; $i < 2; $i++) {
    imageline($image, 0, rand() % 25, 80, rand() % 25, $line_color);
}

// Add fewer random dots for clarity
for ($i = 0; $i < 80; $i++) {
    imagesetpixel($image, rand() % 80, rand() % 25, $pixel_color);
}

// Check if font file exists and add the text to the image
$font_path = __DIR__ . '/font.ttf'; // Update this path if needed
if (file_exists($font_path)) {
    // Reduced font size to 12 for compact characters
    $bbox = imagettfbbox(12, 0, $font_path, $captcha_code);
    $x = (80 - ($bbox[2] - $bbox[0])) / 2; // Center the text horizontally
    $y = (25 - ($bbox[1] - $bbox[7])) / 2 + 12; // Center the text vertically

    imagettftext($image, 12, 0, $x, $y, $text_color, $font_path, $captcha_code);
} else {
    // Fallback to a built-in font if the custom font is missing
    imagestring($image, 5, 20, 5, $captcha_code, $text_color);
}

// Output the image
imagepng($image);

// Free up memory
imagedestroy($image);
?>