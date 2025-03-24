<?php

namespace App\Helpers\Post;

use App\Helpers\Venturo;
use App\Models\PostModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostHelper extends Venturo
{
    public const POST_PHOTO_DIRECTORY = 'photo-post';

    private $postModel;

    public function __construct()
    {
        $this->postModel = new PostModel();
    }

    public function getAll(array $filter, int $page = 1, int $itemPerPage = 0, string $sort = '')
    {
        try {
            $posts = $this->postModel->getAll($filter, $page, $itemPerPage, $sort);

            if (empty($posts)) {
                return [
                    'status' => false,
                    'data' => null,
                ];
            }

            return [
                'status' => true,
                'data' => $posts,
            ];
        } catch (\Throwable $th) {
            return [
                'status' => false,
                'error' => $th->getMessage(),
            ];
        }
    }

    public function getTrashed(array $filter, int $page = 1, int $itemPerPage = 0, string $sort = '')
    {
        try {
            $posts = $this->postModel->getTrashed($filter, $page, $itemPerPage, $sort);

            if (empty($posts)) {
                return [
                    'status' => false,
                    'data' => null,
                ];
            }

            return [
                'status' => true,
                'data' => $posts,
            ];
        } catch (\Throwable $th) {
            return [
                'status' => false,
                'error' => $th->getMessage(),
            ];
        }
    }

    public function getById(string $id)
    {
        try {
            $post = $this->postModel->getById($id);

            if (empty($post)) {
                return [
                    'status' => false,
                    'data' => null,
                ];
            }

            return [
                'status' => true,
                'data' => $post,
            ];
        } catch (\Throwable $th) {
            return [
                'status' => false,
                'error' => $th->getMessage(),
            ];
        }
    }

    public function getBySlug(string $slug)
    {
        try {
            $post = $this->postModel->getBySlug($slug);

            if (empty($post)) {
                return [
                    'status' => false,
                    'data' => null,
                ];
            }

            DB::table('posts')->where('id', $post->id)->increment('views');

            return [
                'status' => true,
                'data' => $post,
            ];
        } catch (\Throwable $th) {
            return [
                'status' => false,
                'error' => $th->getMessage(),
            ];
        }
    }

    public function create(array $payload)
    {
        try {
            $payload = $this->uploadGetPayload($payload);

            $post = $this->postModel->store($payload);

            return [
                'status' => true,
                'data' => $post,
            ];
        } catch (\Throwable $th) {
            return [
                'status' => false,
                'error' => $th->getMessage(),
            ];
        }
    }

    public function update(array $payload, string $id)
    {
        try {
            $payload = $this->uploadGetPayload($payload);
            $this->postModel->edit($payload, $id);

            $post = $this->postModel->getById($id);

            if (empty($post)) {
                return [
                    'status' => false,
                    'data' => null,
                ];
            }

            return [
                'status' => true,
                'data' => $post,
            ];
        } catch (\Throwable $th) {
            return [
                'status' => false,
                'error' => $th->getMessage(),
            ];
        }
    }

    public function restore(string $id)
    {
        try {
            $post = $this->getById($id);

            $this->postModel->restore($id);

            if (empty($post)) {
                return [
                    'status' => false,
                    'data' => null,
                ];
            }

            return [
                'status' => true,
                'data' => $post,
            ];

        } catch (\Throwable $th) {
            return [
                'status' => false,
                'error' => $th->getMessage(),
            ];
        }
    }

    public function delete(string $id)
    {
        try {
            $post = $this->postModel->getById($id);

            $this->postModel->drop($id);

            if (empty($post)) {
                return [
                    'status' => false,
                    'data' => null,
                ];
            }

            return [
                'status' => true,
                'data' => $post,
            ];
        } catch (\Throwable $th) {
            return [
                'status' => false,
                'error' => $th->getMessage(),
            ];
        }
    }

    public function forceDelete(string $id)
    {
        try {
            $post = $this->getById($id);

            $this->deleteImages($post);
            $this->postModel->forceDrop($id);

            if (empty($post)) {
                return [
                    'status' => false,
                    'data' => null,
                ];
            }

            return [
                'status' => true,
                'data' => $post,
            ];
        } catch (\Throwable $th) {
            return [
                'status' => false,
                'error' => $th->getMessage(),
            ];
        }
    }

    private function uploadGetPayload(array $payload)
    {

        if (! empty($payload['photo'])) {
            $fileName = $this->generateFileName($payload['photo'], 'POST_'.date('Ymdhis'));
            $photo = $payload['photo']->storeAs(self::POST_PHOTO_DIRECTORY, $fileName, 'public');
            $payload['photo'] = $photo;
        } else {
            unset($payload['photo']);
        }

        return $payload;
    }

    private function deleteImages(array $payload)
    {

        if (! empty($payload['photo'])) {
            Storage::disk('public')->delete($payload['photo']);
        }
    }
}
