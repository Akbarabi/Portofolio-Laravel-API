<?php

namespace App\Helpers\Post;

use App\Helpers\Venturo;
use App\Models\PostModel;
use Illuminate\Support\Facades\Hash;

class PostHelper extends Venturo
{
    public const POST_PHOTO_DIRECTORY = 'photo-post';

    private $post;
    public function __construct()
    {
        $this->post = new PostModel();
    }

    public function getAll(array $filter, int $page = 1, int $itemPerPage = 0, string $sort = '')
    {
        try {
            $posts = $this->post->getAll($filter, $page, $itemPerPage, $sort);

            if (empty($posts)) {
                return [
                    'status' => false,
                    'data' => null,
                ];
            }

            return [
                'status' => true,
                'data' => $posts
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
            $posts = $this->post->getTrashed($filter, $page, $itemPerPage, $sort);

            if (empty($posts)) {
                return [
                    'status' => false,
                    'data' => null,
                ];
            }

            return [
                'status' => true,
                'data' => $posts
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
            $post = $this->post->getById($id);

            if (empty($post)) {
                return [
                    'status' => false,
                    'data' => null,
                ];
            }

            return [
                'status' => true,
                'data' => $post
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
            $post = $this->post->getBySlug($slug);

            if (empty($post)) {
                return [
                    'status' => false,
                    'data' => null,
                ];
            }

            DB::table('post')->where('id', $post->id)->increment('views');

            return [
                'status' => true,
                'data' => $post
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

            $post = $this->post->store($payload);

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
            $this->post->edit($payload, $id);

            $post = $this->post->getById($id);

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
            $post = $this->post->getById($id);

            $this->post->drop($id);

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
            $post = $this->post->getById($id);

            $this->deleteImages($post);
            $this->post->forceDrop($id);

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

        if (!empty($payload['photo'])) {
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

        if (!empty($payload['photo'])) {
            Storage::disk('public')->delete($payload['photo']);
        }
    }
}
