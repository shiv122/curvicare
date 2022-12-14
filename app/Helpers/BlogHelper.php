<?php

namespace App\Helpers;


class BlogHelper
{
    public function filterPaidBlogs($blogs, $currentlySubscribed)
    {
        foreach ($blogs as $key => $blog) {
            if ($blog->is_paid === 'yes' && !$currentlySubscribed) {
                unset($blog->description);
                unset($blog->tags);
                unset($blog->dietician);
            }
        }

        return $blogs;
    }
}
