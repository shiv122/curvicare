<?php

namespace App\Services\Dietician;

use App\Models\Template;

class FormatDietService
{

    public $order;
    public function __construct()
    {
        $this->order = [
            'early_morning',
            'breakfast',
            'mid_morning',
            'pre_lunch',
            'lunch',
            'post_lunch',
            'pre_snack',
            'evening_snack',
            'post_snack',
            'pre_dinner',
            'dinner',
            'post_dinner',
        ];
    }


    public function format(Template $template)
    {
        $formattedData = [];
        $orderedData = [];
        foreach ($template->recipes as $key => $res) {
            $formattedData[$res->pivot->day][$res->pivot->for][] = $res;
        }

        foreach ($formattedData as $data) {
            $orderedData[] =  $this->order($data);
        }


        return $orderedData;
    }


    public function order($data)
    {
        $orderedData = [];
        foreach ($this->order as $key => $value) {
            if (isset($data[$value])) {
                $orderedData[$value] = $data[$value];
            } else {
                $orderedData[$value] = [];
            }
        }
        return $orderedData;
    }
}
