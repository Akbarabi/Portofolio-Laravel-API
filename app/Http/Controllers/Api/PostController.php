<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Post\PostHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private $post;

    public function __construct()
    {
        $this->post = new PostHelper();
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = [
            'title' => $request->tile ?? '',
            'slug' => $request->slug ?? '',
            'category' => $request->category ?? '',
        ];

        $posts = $this->post->getAll($filter, $request->page ?? 1, $request->item_per_page ?? 25, $request->sort ?? '');

        if (! $posts['status']) {
            return response()->failed($posts['error']);
        }

        return response()->success([
            'list' => PostResource::collection($posts['data']['data']),
            'meta' => [
                'total' => $posts['data']['total'],
            ],
        ], 'Post is found');
    }

    public function getTrashed(Request $request)
    {
        $filter = [
            'title' => $request->tile ?? '',
            'slug' => $request->slug ?? '',
            'category' => $request->category ?? '',
        ];

        $posts = $this->post->getTrashed($filter, $request->page, $request->item_per_page, $request->sort ?? '');

        if (! $posts['status']) {
            return response()->failed($post['error']);
        }

        return response()->success([
            'list' => PostResource::collection($posts['data']['data']),
            'meta' => [
                'total' => $posts['data']['total'],
            ],
        ], 'Post is found');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        // Jika validasi gagal, maka tampilkan pesan error
        // agar users mengetahui apa yang salah
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->failed($request->validator->errors());
        }

        $payload = $request->only(['title', 'slug', 'category_name', 'body', 'photo']);
        $post = $this->post->store($payload);

        if (! $post['status']) {
            return response()->failed($post['error']);
        }

        return response()->success(new PostResource($post['data']), 'Post successfully created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = $this->post->getById($id);

        if (! $post['status']) {
            return response()->failed($post['error']);
        }

        return response()->success(new PostResource($post['data']), 'Post is found');
    }

    public function getBySlug(string $slug)
    {
        $post = $this->post->getBySlug($slug);

        if (! $post['status']) {
            return response()->failed($post['error']);
        }

        return response()->success(new PostResource($post['data']), 'Post is found');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->failed($request->validator->errors());
        }

        $payload = $request->only(['id', 'title', 'slug', 'category_name', 'body', 'photo']);
        $post = $this->post->update($payload, $payload['id']);

        if (! $post['status']) {
            return response()->failed($post['error']);
        }

        return response()->success(new PostResource($post['data']), 'Post successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = $this->post->delete($id);

        if (! $post['status']) {
            return response()->failed($post['error']);
        }

        return response()->success($post['data'], 'Post successfully deleted');
    }
}
