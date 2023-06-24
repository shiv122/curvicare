<?php

namespace App\Services\Editor;


class EditorHtmlParser
{
    function parseEditorJsBlocks(array $blocks)
    {
        $html = '';

        foreach ($blocks as $block) {
            switch ($block['type']) {
                case 'paragraph':
                    $text = $block['data']['text'];
                    $html .= "<p>$text</p>";
                    break;

                case 'header':
                    $level = $block['data']['level'];
                    $text = $block['data']['text'];
                    $html .= "<h$level>$text</h$level>";
                    break;

                case 'list':
                    $style = $block['data']['style'] === 'unordered' ? 'ul' : 'ol';
                    $items = '';
                    foreach ($block['data']['items'] as $item) {
                        $items .= "<li>$item</li>";
                    }
                    $html .= "<$style>$items</$style>";
                    break;

                case 'image':
                    $url = $block['data']['file']['url'];
                    $caption = $block['data']['caption'];
                    $html .= "<img class=\"img-fluid\" src=\"$url\" alt=\"$caption\">";
                    break;

                case 'table':
                    $html .= '<table class="table table-bordered mt-2">';
                    foreach ($block['data']['content'] as $key => $row) {
                        if ($key === 0) {

                            $html .= '<thead>';
                        }
                        if ($key === 1) {

                            $html .= '<tbody>';
                        }
                        $html .= '<tr>';
                        foreach ($row as $cell) {
                            $html .= '<td>' . $cell . '</td>';
                        }
                        $html .= '</tr>';

                        if ($key === 0) {

                            $html .= '</thead>';
                        }
                        if ($key === 1) {

                            $html .= '</tbody>';
                        }
                    }
                    $html .= '</table>';
                    break;

                    // Handle other block types if needed

                default:
                    // Skip unknown block types
                    break;
            }
        }

        return $html;
    }
}
