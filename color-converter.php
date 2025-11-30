<?php
/**
 * Convert RGB to HEX
 *
 * @param int $r  Red   (0 - 255)
 * @param int $g  Green (0 - 255)
 * @param int $b  Blue  (0 - 255)
 * @return string HEX color like "#A1B2C3"
 */
function rgbToHex(int $r, int $g, int $b): string
{
    // Clamp values between 0 and 255
    $r = max(0, min(255, $r));
    $g = max(0, min(255, $g));
    $b = max(0, min(255, $b));

    return sprintf("#%02X%02X%02X", $r, $g, $b);
}

/**
 * Convert HEX to RGB
 *
 * @param string $hex  HEX color, e.g. "#A1B2C3" or "A1B2C3" or "ABC"
 * @return array|null  [ 'r' => int, 'g' => int, 'b' => int ] or null on error
 */
function hexToRgb(string $hex): ?array
{
    // Remove # if exists
    $hex = ltrim(trim($hex), '#');

    // Support short form: e.g. "ABC" → "AABBCC"
    if (strlen($hex) === 3) {
        $hex = $hex[0].$hex[0] . $hex[1].$hex[1] . $hex[2].$hex[2];
    }

    // Must be exactly 6 hex characters
    if (!preg_match('/^[0-9A-Fa-f]{6}$/', $hex)) {
        return null;
    }

    $r = hexdec(substr($hex, 0, 2));
    $g = hexdec(substr($hex, 2, 2));
    $b = hexdec(substr($hex, 4, 2));

    return [
        'r' => $r,
        'g' => $g,
        'b' => $b,
    ];
}

/* ============================
 *  Simple usage examples
 * ============================ */

if (php_sapi_name() === 'cli') {
    // Example 1: RGB → HEX
    echo "RGB(255, 100, 50) → " . rgbToHex(255, 100, 50) . PHP_EOL;

    // Example 2: HEX → RGB
    $rgb = hexToRgb("#FF6432");
    if ($rgb !== null) {
        echo "#FF6432 → R={$rgb['r']}, G={$rgb['g']}, B={$rgb['b']}" . PHP_EOL;
    } else {
        echo "Invalid HEX value" . PHP_EOL;
    }
}