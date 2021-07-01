<?php

namespace App\Http\Controllers;

use Storage;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use App\Models\pages as pageModels;

class pagesController extends Controller
{
    public function index() {
        $page = pageModels::where('slug','gioi-thieu-website')->first();
        return view('website.page.edit', [
                'thumbnail' => is_null($page) ? '' : $page->thumb,
                'year_old' => is_null($page) ? '' : $page->year_old,
                'title' => is_null($page) ? '' : $page->title,
                'owner' => is_null($page) ? '' : $page->owner,
                'is_show' => is_null($page) ? '' : $page->is_show,
                'content' => is_null($page) ? '' : $page->content,
            ]);
    }

    public function editPost(Request $request) {
        $page = pageModels::where('slug','gioi-thieu-website')->first();
        if(is_null($page)) {
            $page = new pageModels();
            $page->slug = 'gioi-thieu-website';
        }

        $rules = [
            'title' => 'required|min:3|max:250',
            'owner' => 'required|min:3|max:250',
            'year_old' => 'required|min:1|max:250',
            'content' => 'required'
        ];
        $messages = [
            'title.required' => 'Tiêu đề là trường bắt buộc',
            'title.min' => 'Tiêu đề chứa ít nhất 3 ký tự',
            'title.max' => 'Tiêu đề có nhiều nhất 250 ký tự',
            'owner.required' => 'Tiêu đề phụ là trường bắt buộc',
            'owner.min' => 'Tiêu đề phụ phải chứa ít nhất 3 ký tự',
            'owner.max' => 'Tiêu đề phụ có nhiều nhất 250 ký tự',
            'year_old.required' => 'Số năm hoạt động là trường bắt buộc',
            'year_old.min' => 'Số năm hoạt động phải chứa ít nhất 1 ký tự',
            'year_old.max' => 'Số năm hoạt động có nhiều nhất 250 ký tự',
            'content.required' => 'Nội dung không thể rỗng'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator)->withInput();
        }
        
        if($request->hasFile('thumb')) {
            $page->thumb = Storage::url(Storage::disk('public')->put('image', $request->file('thumb')));
        }
        $page->year_old = $request->all()['year_old'];
        $page->title = $request->all()['title'];
        $page->owner = $request->all()['owner'];
        $page->is_show = !is_null($request->input('is_show'));
        $page->content = $request->all()['content'];
        if($page->save()) return redirect()->route('website.pages.index')->with('success', 'Cập nhật thành công');

        return redirect()->back()->withInput()->with('error', 'Cập nhật thất bại');
    }
}
