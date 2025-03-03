<?php

namespace App\Http\Controllers\Web;

use App\Helpers\Post\PostHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;

class BladePostController extends Controller
{
    private $postHelper;

    public function __construct()
    {
        $this->postHelper = new PostHelper;
    }

    public function index(Request $request)
    {
        $filter = [
            'title' => $request->title ?? '',
            'slug' => $request->slug ?? '',
            'category_name' => $request->category_name ?? '',
        ];

        $data = $this->postHelper->getAll($filter, $request->page ?? 1, $request->item_per_page ?? 25, $request->sort ?? '');
        $posts = PostResource::collection($data['data']['data'])->resolve();

        return view('admin.post.index', compact('posts'));
    }

    public function store(PostRequest $request)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->failed($request->validator->errors());
        }

        $payload = $request->only(['title', 'slug', 'category_name', 'body', 'photo']);

        $payload['photo'] = $request->file('photo');

        $post = $this->postHelper->create($payload);

        if (! $post['status']) {
            return response()->failed($post['error']);
        }

        return back()->with('success', 'Post successfully created');
    }

    public function update(PostRequest $request)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->failed($request->validator->errors());
        }

        $payload = $request->only(['id', 'title', 'slug', 'category_name', 'body', 'photo']);

        $payload['photo'] = $request->file('photo');

        $post = $this->postHelper->update($payload, $payload['id']);

        if (! $post['status']) {
            return response()->failed($post['error']);
        }

        return back()->with('success', 'Post successfully updated');
    }

    public function destroy(string $id)
    {
        $post = $this->postHelper->delete($id);

        if (! $post['status']) {
            return response()->failed($post['error']);
        }

        return back()->with('success', 'Post successfully deleted');
    }
}
