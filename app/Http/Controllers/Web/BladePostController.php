<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Helpers\Post\PostHelper;
use App\Http\Requests\PostRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;

class BladePostController extends Controller
{
    private $postHelper;

    public function __construct()
    {
        $this->postHelper = new PostHelper();
    }

    public function index(Request $request)
    {
        $filter = [
            'title' => $request->title ?? '',
            'slug' => $request->slug ?? '',
            'category_name' => $request->category_name ?? '',
        ];

        $currentPage = (int)($request->page ?? 1);
        $itemPerPage = (int)($request->item_per_page ?? 25);

        $posts = $this->postHelper->getAll($filter, $currentPage, $itemPerPage, $request->sort ?? '');

        $totalItems = $posts['data']['total'] ?? 0;
        $totalPages = ceil($totalItems / $itemPerPage);

        return view('admin.post.index', [
            'posts' => $posts['data']['data'],
            'pagination' => [
                'currentPage' => $currentPage,
                'totalPages' => $totalPages,
            ]
        ]);
    }

    public function trashed(Request $request)
    {
        $filter = [
            'title' => $request->title ?? '',
            'slug' => $request->slug ?? '',
            'category_name' => $request->category_name ?? '',
        ];

        $posts = $this->postHelper->getTrashed($filter, $request->page ?? 1, $request->item_per_page ?? 25, $request->sort ?? '');

        return view('admin.post.trashed', ['posts' => $posts['data']['data']]);
    }

    public function store(PostRequest $request)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            return back()->with('error', $request->validator->errors());
        }

        $payload = $request->only(['title', 'slug', 'category_name', 'body', 'photo']);

        $payload['photo'] = $request->file('photo');

        $post = $this->postHelper->create($payload);

        if (! $post['status']) {
            return back()->with('error', $post['error']);
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
            return back()->with('error', $post['error']);
        }

        return back()->with('success', 'Post successfully updated');
    }

    public function restore(string $id)
    {
        $post = $this->postHelper->restore($id);

        if (! $post['status']) {
            return back()->with('error', $post['error']);
        }

        return back()->with('success', 'Post successfully restored');
    }

    public function destroy(string $id)
    {
        $post = $this->postHelper->delete($id);

        if (! $post['status']) {
            return back()->with('error', $post['error']);
        }

        return back()->with('success', 'Post successfully deleted');
    }

    public function forceDelete(string $id)
    {
        $post = $this->postHelper->forceDelete($id);

        if (! $post['status']) {
            return back()->with('error', $post['error']);
        }

        return back()->with('success', 'Post successfully deleted');
    }
}
