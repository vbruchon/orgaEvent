<?php

namespace App\Services;


use Carbon\Carbon;




class createSVGArray
{
    function createSvgArray()
    {
        // Replace the path with the actual path to your SVG file
        $structureSvgPath = public_path('image/structure-purple.svg');
        $partnerSvgPath = public_path('image/partners-purple.svg');
        $descriptionSvgPath = public_path('image/description.svg');
        $statuSvgPath = public_path('image/status-purple.svg');
        $participantsSvgPath = public_path('image/groups-purple.svg');
        $dateSvgPath = public_path('image/date-purple.svg');
        $needSvgPath = public_path('image/needs.svg');
        $eventSvgPath = public_path('image/event.svg');

        // Read the SVG file contents
        $structureSvgContents = file_get_contents($structureSvgPath);
        $structureSvg = str_replace('<svg', '<svg class="w-9 h-9"', $structureSvgContents);
        $partnerSvgContents = file_get_contents($partnerSvgPath);
        $partnerSvg = str_replace('<svg', '<svg class="w-9 h-9"', $partnerSvgContents);
        $descriptionSvgContent = file_get_contents($descriptionSvgPath);
        $descriptionSvg = str_replace('<svg', '<svg class="w-9 h-9 mr-2"', $descriptionSvgContent);
        $statuSvgContent = file_get_contents($statuSvgPath);
        $statuSvg = str_replace('<svg', '<svg class="w-9 h-9 mr-2"', $statuSvgContent);
        $particpantSvgContent = file_get_contents($participantsSvgPath);
        $particpantSvg = str_replace('<svg', '<svg class="w-9 h-9 mr-2"', $particpantSvgContent);
        $dateSvgContent = file_get_contents($dateSvgPath);
        $dateSvg = str_replace('<svg', '<svg class="w-9 h-9 mr-2"', $dateSvgContent);
        $needSvgContent = file_get_contents($needSvgPath);
        $needSvg = str_replace('<svg', '<svg class="w-9 h-9 mr-2"', $needSvgContent);
        $eventSvgContent = file_get_contents($eventSvgPath);
        $eventSvg = str_replace('<svg', '<svg class="w-9 h-9"', $eventSvgContent);

        return [
            'structure' => $structureSvg,
            'partners' => $partnerSvg,
            'description' => $descriptionSvg,
            'status' => $statuSvg,
            'participants' => $particpantSvg,
            'date' => $dateSvg,
            'needs' => $needSvg,
            'event' => $eventSvg
        ];
    }
}
