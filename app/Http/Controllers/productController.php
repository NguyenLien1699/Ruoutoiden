<?php

namespace App\Http\Controllers;

use Storage;
use Validator;
use Illuminate\Support\Str;
use Illuminate\Support\MessageBag;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Models\products as productModels;

class productController extends Controller
{
    public function index() {
        return view('product.index', ['data' => productModels::orderByDesc('id')->paginate(10)]);
    }

    private function validator($request) {
        $rules = [
            'title' => 'required|min:3|max:250',
            'price' => 'required|min:3|max:250',
            'short_description' => 'required|min:3|max:5000',
            'content' => 'required'
        ];
        $messages = [
            'title.required' => 'Tiêu đề là trường bắt buộc',
            'title.min' => 'Tiêu đề chứa ít nhất 3 ký tự',
            'title.max' => 'Tiêu đề có nhiều nhất 250 ký tự',
            'price.required' => 'Giá là trường bắt buộc',
            'price.min' => 'Giá phải chứa ít nhất 3 ký tự',
            'price.max' => 'Giá có nhiều nhất 250 ký tự',
            'content.required' => 'Nội dung không thể rỗng',
            'short_description.required' => 'Mô tả ngắn là trường bắt buộc',
            'short_description.min' => 'Mô tả ngắn phải chứa ít nhất 3 ký tự',
            'short_description.max' => 'Mô tả ngắn có nhiều nhất 250 ký tự',
        ];

        return Validator::make($request->all(), $rules, $messages);
    }

    public function create() {
        return view('product.create');
    }

    public function createPost(Request $request) {

        $validator = $this->validator($request);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator)->withInput();
        }

        $post = new productModels();
        if($request->hasFile('thumb')) {
            $post->thumb = Storage::url(Storage::disk('public')->put('image', $request->file('thumb')));
        }
        if($request->hasFile('thumb_large')) {
            $post->thumb_large = Storage::url(Storage::disk('public')->put('image', $request->file('thumb_large')));
        }

        $slug = Str::slug($request->all()['title'], '-');
        $dem = 0;
        $exist = false;
        do
        {
            $exist = productModels::where('slug', $slug)->exists();
            if($exist) {
                $dem++;
                $slug .= '-'.$dem;
            }
        }
        while($exist);

        $post->title = $request->all()['title'];
        $post->slug = $slug;
        $post->short_description = $request->all()['short_description'];
        $post->price = $request->all()['price'];
        $post->is_show = !is_null($request->input('is_show'));
        $post->content = $request->all()['content'];
        if($post->save()) return redirect()->route('website.product.create')->with('success', 'Thêm thành công');

        return redirect()->back()->withInput()->with('error', 'Cập nhật thất bại');
    }

    public function edit($id) {
        $product = productModels::find($id);
        if(is_null($product)) {
            return redirect()->route('website.product.index')->with('error','Không tìm thấy bài đăng');
        }
        return view('product.create', [
            'id' => $product->id,
            'thumbnail' => $product->thumb,
            'thumbnail_large' => $product->thumb_large,
            'title' => $product->title,
            'price' => $product->price,
            'short_description' => $product->short_description,
            'is_show' => $product->is_show,
            'content' => $product->content,
        ]);
    }

    public function editPost($id, Request $request) {
        $validator = $this->validator($request);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator)->withInput();
        }

        $post = productModels::find($id);
        if(is_null($post)) {
            return redirect()->route('website.product.index')->with('error','Không tìm thấy bài đăng');
        }

        if($request->hasFile('thumb')) {
            $post->thumb = Storage::url(Storage::disk('public')->put('image', $request->file('thumb')));
        }
        if($request->hasFile('thumb_large')) {
            $post->thumb_large = Storage::url(Storage::disk('public')->put('image', $request->file('thumb_large')));
        }

        $slug = Str::slug($request->all()['title'], '-');
        $dem = 0;
        $exist = false;
        do
        {
            $exist = productModels::where('slug', $slug)->exists();
            if($exist) {
                $dem++;
                $slug .= '-'.$dem;
            }
        }
        while($exist);

        $post->title = $request->all()['title'];
        $post->slug = $slug;
        $post->short_description = $request->all()['short_description'];
        $post->price = $request->all()['price'];
        $post->is_show = !is_null($request->input('is_show'));
        $post->content = $request->all()['content'];
        if($post->save()) return redirect()->route('website.product.index')->with('success', 'Thêm thành công');

        return redirect()->back()->withInput()->with('error', 'Cập nhật thất bại');
    }

    public function deletePost($id) {
        $product = productModels::find($id);
        if(is_null($product)) {
            return redirect()->route('website.product.index')->with('error','Không tìm thấy bài đăng');
        }

        if($product->delete()) return redirect()->route('website.product.index')->with('success','Xóa thành công');

        return redirect()->route('website.product.index')->with('error','Xóa thất bại');
    }
}
