<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogPost extends Model
{
    use SoftDeletes; // НЕ выводит удаленные статьи
    /**
     * Категории статьи
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        //Статья пренадлежит категории
        return $this->belongsTo(BlogCategory::class);
    }
    /**
     * Автор статьи
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        //Статья пренадлежит пользователю
        return $this->belongsTo(User::class);
    }


}
