<?php

namespace App\Http\Controllers\Api\Traits;

use Parsedown;

trait Markdown {

    /**
     * 处理格式
     * @param $markdown
     * @return mixed
     */
    public function convertMarkdownToHtml($markdown)
    {
        $convertedHmtl = app(Parsedown::class)->setBreaksEnabled(true)->setSafeMode(true)->text($markdown);
        $convertedHmtl = str_replace('<pre><code>', '<pre><code class=" language-go">', $convertedHmtl);
        return $convertedHmtl;
    }

}
