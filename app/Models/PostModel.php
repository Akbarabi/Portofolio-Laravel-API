<?php

namespace App\Models;

use App\Http\Traits\Ulid;
use App\Models\PostModel;
use App\Helpers\SlugHelper;
use App\Repository\CrudInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PostModel extends Model implements CrudInterface
{
    use Ulid;
    use SoftDeletes;
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'title',
        'category_name',
        'slug',
        'body',
        'photo',
    ];

    public function getAll(array $filter, int $page, int $itemPerPage, string $sort)
    {
        $skip = ($page * $itemPerPage) - $itemPerPage;
        $post = $this->query();

        if (! empty($filter['title'])) {
            $post->where('title', 'LIKE', '%'.$filter['title'].'%');
        }

        if (! empty($filter['slug'])) {
            $post->where('slug', 'LIKE', '%'.$filter['slug'].'%');
        }

        if (! empty($filter['category'])) {
            $post->where('category', 'LIKE', '%'.$filter['category'].'%');
        }

        $total = $post->count();
        $sort = $sort ?: 'id DESC';
        $list = $post->skip($skip)->take($itemPerPage)->orderByRaw($sort)->get();

        return [
            'total' => $total,
            'data' => $list
        ];
    }

    public function getTrashed(array $filter, int $page, int $itemPerPage, string $sort)
    {
        $skip = ($page * $itemPerPage) - $itemPerPage;
        $post = $this->onlyTrashed()->query();

        if (! empty($filter['title'])) {
            $post->where('title', 'LIKE', '%'.$filter['title'].'%');
        }

        if (! empty($filter['slug'])) {
            $post->where('slug', 'LIKE', '%'.$filter['slug'].'%');
        }

        $total = $post->count();
        $sort = $sort ?? 'id DESC';
        $list = $post->skip($skip)->take($itemPerPage)->orderByRaw($sort)->get();

        return [
            'total' => $total,
            'list' => $list
        ];
    }

    public function getById(string $id)
    {
        return $this->find($id);
    }

    public function getBySlug(string $slug)
    {
        return $this->where('slug', $slug)->first();
    }

    public function store(array $payload)
    {
        $payload['slug'] = SlugHelper::createUniqueSlug($payload['title'], PostModel::class);
        return $this->create($payload);
    }

    public function edit(array $payload, string $id)
    {
        $model = $this->findOrFail($id);
        if ($model->getOriginal('title') != $payload['title']) {
            $payload['slug'] = SlugHelper::createUniqueSlug($payload['title'], PostModel::class);
        }
        return $model->update($payload);
    }

    public function drop(string $id)
    {
        return $this->find($id)->delete();
    }

    public function forceDrop(string $id)
    {
        return $this->find($id)->forceDelete();
    }
}
