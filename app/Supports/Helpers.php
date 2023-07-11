<?php

use App\Constants\Constants;

if (!function_exists('handleImage')) {
    function handleImage($fileImage): string
    {
        $imageName = "";

        if ($_FILES['image_url']['name']) {
            $image = $fileImage;
            $imageName = $image->getClientOriginalName();
            $image->move('images',  $imageName);
        }

        return $imageName;
    }
}

if (!function_exists('condition')) {
    function condition(array $conditions): array
    {
       foreach ($conditions as $key => $value) {
            if ($key == Constants::UNSET_CONDITION || in_array($value[2], Constants::UNSET)) {
                unset($conditions[$key]);
            }
       }
       return $conditions;
    }
}