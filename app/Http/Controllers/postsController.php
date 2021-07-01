<?php

namespace App\Http\Controllers;

use Storage;
use Validator;
use Illuminate\Support\Str;
use Illuminate\Support\MessageBag;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Models\posts as postModels;

class postsController extends Controller
{
    public function index() {
        if (isset($_GET['page']) && is_numeric($_GET['page'])) {
            $page_current = intval($_GET['page']);
            if ($page_current >= 1) {
                Paginator::currentPageResolver(function () use ($page_current) {return $page_current;});
            }
        }
        $recode = 10;
        $posts = postModels::orderByDesc('id')->paginate($recode);
        return view('website.posts.index', ['data' => $posts]);
    }

    public function create() {
        return view('website.posts.create');
    }

    private function validator($request) {
        $rules = [
            'title' => 'required|min:3|max:250',
            'owner' => 'required|min:3|max:250',
            'short_description' => 'required|min:3|max:5000',
            'content' => 'required'
        ];
        $messages = [
            'title.required' => 'Tiêu đề là trường bắt buộc',
            'title.min' => 'Tiêu đề chứa ít nhất 3 ký tự',
            'title.max' => 'Tiêu đề có nhiều nhất 250 ký tự',
            'owner.required' => 'Tác giả là trường bắt buộc',
            'owner.min' => 'Tác giả phải chứa ít nhất 3 ký tự',
            'owner.max' => 'Tác giả có nhiều nhất 250 ký tự',
            'content.required' => 'Nội dung không thể rỗng',
            'short_description.required' => 'Mô tả ngắn là trường bắt buộc',
            'short_description.min' => 'Mô tả ngắn phải chứa ít nhất 3 ký tự',
            'short_description.max' => 'Mô tả ngắn có nhiều nhất 250 ký tự',
        ];

        return Validator::make($request->all(), $rules, $messages);
    }

    public function createPost(Request $request) {

        $validator = $this->validator($request);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator)->withInput();
        }

        $post = new postModels();
        if($request->hasFile('thumb')) {
            $post->thumb = Storage::url(Storage::disk('public')->put('image', $request->file('thumb')));
        }
        $slug = Str::slug($request->all()['title'], '-');
        $dem = 0;
        $exist = false;
        do
        {
            $exist = postModels::where('slug', $slug)->exists();
            if($exist) {
                $dem++;
                $slug .= '-'.$dem;
            }
        }
        while($exist);

        $post->title = $request->all()['title'];
        $post->slug = $slug;
        $post->short_description = $request->all()['short_description'];
        $post->owner = $request->all()['owner'];
        $post->is_show = !is_null($request->input('is_show'));
        $post->content = $request->all()['content'];
        if($post->save()) return redirect()->route('website.posts.create')->with('success', 'Thêm thành công');

        return redirect()->back()->withInput()->with('error', 'Cập nhật thất bại');
    }

    public function deletePost($id) {
        $post = postModels::find($id);
        if(is_null($post)) {
            return redirect()->route('website.posts.index')->with('error','Không tìm thấy bài đăng');
        }

        if($post->delete())  return redirect()->route('website.posts.index')->with('success','Xóa thành công');

        return redirect()->route('website.posts.index')->with('error','Xóa thất bại');
    }

    public function edit($id) {
        $post = postModels::find($id);
        if(is_null($post)) {
            return redirect()->route('website.posts.index')->with('error','Không tìm thấy bài đăng');
        }

        return view('website.posts.create', [
            'id' => $post->id,
            'thumbnail' => Storage::disk('public')->url($post->thumb),
            'title' => $post->title,
            'short_description' => $post->short_description,
            'owner' => $post->owner,
            'is_show' => $post->is_show,
            'content' => $post->content
        ]);
    }

    public function editPost($id, Request $request) {
        $validator = $this->validator($request);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator)->withInput();
        }

        $post = postModels::find($id);
        if(is_null($post)) {
            return redirect()->route('website.posts.index')->with('error','Không tìm thấy bài đăng');
        }
        if($request->hasFile('thumb')) {
            $post->thumb = Storage::url(Storage::disk('public')->put('image', $request->file('thumb')));
        }
        $slug = Str::slug($request->all()['title'], '-');
        $dem = 0;
        $exist = false;
        do {
            $exist = postModels::where('slug', $slug)->exists();
            if($exist) {
                $dem++;
                $slug .= '-'.$dem;
            }
        } while($exist);

        $post->title = $request->all()['title'];
        $post->slug = $slug;
        $post->short_description = $request->all()['short_description'];
        $post->owner = $request->all()['owner'];
        $post->is_show = !is_null($request->input('is_show'));
        $post->content = $request->all()['content'];
        if($post->save()) return redirect()->route('website.posts.index')->with('success', 'Cập nhật thành công');

        return redirect()->back()->withInput()->with('error', 'Cập nhật thất bại');
    }
}
