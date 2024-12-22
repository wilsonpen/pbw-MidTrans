<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    // public static function all(): array
    // {
    //     return [
    //         [
    //             'id' => 1,
    //             'slug' => 'judul-artikel-1',
    //             'title' => 'Judul Artikel 1',
    //             'author' => 'Vinsesius Boido Simarmata',
    //             'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum, minima blanditiis aperiam, quisquam distinctio
    //     dolorem modi rem porro assumenda eligendi rerum iste quis! Aut, itaque.'
    //         ],
    //         [
    //             'id' => 2,
    //             'slug' => 'judul-artikel-2',
    //             'title' => 'Judul Artikel 2',
    //             'author' => 'Vinsesius Boido Simarmata',
    //             'body' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Rerum harum iure molestiae itaque quidem eos,
    //     provident ipsam, omnis recusandae laboriosam repellat. Ipsum necessitatibus tenetur voluptatem consectetur
    //     iure beatae amet nesciunt unde quaerat, mollitia id ea ut quia obcaecati dolorem soluta?.'
    //         ]
    //     ];
    // }

    // public static function find($slug): array
    // {
    //     // $post = Arr::first(static::all(), function ($post) use ($slug) {
    //     //     return $post['slug'] == $slug;
    //     // });

    //     $post = Arr::first(static::all(), fn($post) => $post['slug'] == $slug);

    //     if(!$post){
    //         abort(404);
    //     }else{
    //         return $post;
    //     }
    // }

    protected $table = "posts";
    protected $primaryKey = "id";

    protected $fillable = [
        'title',
        'author',
        'slug',
        'body'
    ];
}
;

?>