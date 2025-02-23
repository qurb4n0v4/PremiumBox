<?php
function generateWhatsAppLink($phone, $message, $user = null)
{
    $userInfo = '';
    if ($user) {
        $userInfo = "\n\nUser Info:\n";
        $userInfo .= "Name: " . $user->name . "\n";
        $userInfo .= "Email: " . $user->email . "\n";
        $userInfo .= "Phone: " . $user->phone . "\n";
    }

    return 'https://wa.me/' . $phone . '?text=' . urlencode($message . $userInfo);
}
