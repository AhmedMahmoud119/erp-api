<?php

namespace App\Domains\Language\Controllers;

use App\Domains\Language\Request\UpdateLanguageRequest;
use App\Domains\Language\Resources\LanguageResource;
use App\Http\Controllers\Controller;

class LanguageController extends Controller
{
    public function list()
    {
        $full_data_ar = include(base_path('lang/ar/messages.php'));
        $full_data_en = include(base_path('lang/en/messages.php'));
        $lang_data = [];
        ksort($full_data_ar);

        foreach ($full_data_ar as $key => $data) {
            array_push($lang_data, [
                'key' => $key,
                'value_ar' => $data,
                'value_en' => $full_data_en[$key]
            ]);
        }

        return LanguageResource::collection($lang_data);
    }

    public function update(UpdateLanguageRequest $request){
        $full_data_en = include(base_path('lang/en/messages.php'));

        if(!isset($full_data_en[$request['key']])){
            return response()->json([
                'message' => __('key not found')
            ]);
        }

        $full_data_en[$request['key']] = $request['value_en'];

        $full_data_ar = include(base_path('lang/ar/messages.php'));
        $full_data_ar[$request['key']] = $request['value_ar'];


        $str_ar = "<?php return " . var_export($full_data_ar, true) . ";";
        $str_en = "<?php return " . var_export($full_data_en, true) . ";";

        file_put_contents(base_path('lang/ar/messages.php'), $str_ar);
        file_put_contents(base_path('lang/en/messages.php'), $str_en);

        return response()->json([
            'message' => __('Updated Successfully')
        ]);
    }
}
