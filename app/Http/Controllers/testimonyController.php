<?php

namespace App\Http\Controllers;

use Storage;
use Validator;
use Illuminate\Support\Str;
use Illuminate\Support\MessageBag;
use App\Models\testimony as testimonyModels;
use Illuminate\Http\Request;

class testimonyController extends Controller
{
    public function index() {
        return view('testimony.index', ['data' => testimonyModels::orderBy('id')->paginate(10)]);
    }

    private function validator($request) {
        $rules = [
            'name' => 'required|min:3|max:250',
            'position' => 'required|min:3|max:250',
            'content' => 'required|min:3|max:5000'
        ];
        $messages = [
            'name.required' => 'Tên là trường bắt buộc',
            'name.min' => 'Tên chứa ít nhất 3 ký tự',
            'name.max' => 'Tên có nhiều nhất 250 ký tự',
            'position.required' => 'Vị trí là trường bắt buộc',
            'position.min' => 'Vị trí phải chứa ít nhất 3 ký tự',
            'position.max' => 'Vị trí có nhiều nhất 250 ký tự',
            'content.required' => 'Nội dung là trường bắt buộc',
            'content.min' => 'Nội dung phải chứa ít nhất 3 ký tự',
            'content.max' => 'Nội dung có nhiều nhất 250 ký tự',
        ];

        return Validator::make($request->all(), $rules, $messages);
    }

    public function create() {
        return view('testimony.create');
    }

    public function createPost(Request $request) {
        $validator = $this->validator($request);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator)->withInput();
        }

        $post = new testimonyModels();
        if($request->hasFile('thumb')) {
            $post->thumb = Storage::url(Storage::disk('public')->put('image', $request->file('thumb')));
        }
        $post->content = $request['content'];
        $post->name = $request['name'];
        $post->position = $request['position'];
        if($post->save()) return redirect()->route('website.testimony.create')->with('success', 'Thêm thành công');

        return redirect()->back()->withInput()->with('error', 'Cập nhật thất bại');
    }

    public function delete($id) {
        $post = testimonyModels::where('id', $id)->first();
        if(is_null($post)) {
            return redirect()->route('website.testimony.index')->with('error','Không tìm thấy bài đăng');
        }

        if($post->delete())  return redirect()->route('website.testimony.index')->with('success','Xóa thành công');

        return redirect()->route('website.testimony.index')->with('error','Xóa thất bại');
    }
}
