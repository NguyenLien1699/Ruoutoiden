<?php

namespace App\Http\Controllers;

use Auth;
use Validator;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use App\Models\settings;
use Illuminate\Support\MessageBag;
use Illuminate\Pagination\Paginator;
use App\Models\pages;
use App\Models\testimony;
use App\Models\contacts;
use App\Models\posts;
use App\Models\products;


class websiteController extends Controller
{
    public function __construct() {
        $setting = settings::first();
        SEOTools::setTitle($setting->title);
        SEOTools::setDescription($setting->description);
        SEOTools::opengraph()->setUrl(URL::current());
        SEOTools::setCanonical(URL::current());
        SEOTools::jsonLd()->addImage($setting->icon);
    }

    public function index() {
        return view('frontend.index', [
            'posts' => posts::where('is_show', true)->orderByDesc('id')->limit(3)->get(),
            'testimony' => testimony::orderByDesc('id')->get(),
            'page' => pages::where('slug','gioi-thieu-website')->first(),
            'products' => products::where('is_show', true)->orderByDesc('id')->limit(3)->get(),
        ]);
    }

    public function contactPost(Request $request) {
        $rules = [
            'fname' => 'required|min:3|max:250',
            'lname' => 'required|min:3|max:250',
            'email' => 'required|email|min:6|max:250',
            'subject' => 'required|min:3|max:250',
            'message' => 'required|min:3|max:5000',
        ];
        $messages = [
            'fname.required' => 'Họ và tên lót là trường bắt buộc',
            'fname.min' => 'Họ và tên lót chứa ít nhất 3 ký tự',
            'fname.max' => 'Họ và tên lót có nhiều nhất 250 ký tự',
            'lname.required' => 'Tên là trường bắt buộc',
            'lname.min' => 'Tên chứa ít nhất 3 ký tự',
            'lname.max' => 'Tên có nhiều nhất 250 ký tự',
            'email.required' => 'Email là trường bắt buộc',
            'email.min' => 'Email phải chứa ít nhất 6 ký tự',
            'email.max' => 'Email có nhiều nhất 250 ký tự',
            'email.email' => 'Bạn cần nhập đúng định dạng email',
            'subject.required' => 'Tiêu đề là trường bắt buộc',
            'subject.min' => 'Tiêu đề chứa ít nhất 3 ký tự',
            'subject.max' => 'Tiêu đề có nhiều nhất 250 ký tự',
            'message.required' => 'Nội dung là trường bắt buộc',
            'message.min' => 'Nội dung chứa ít nhất 3 ký tự',
            'message.max' => 'Nội dung có nhiều nhất 5000 ký tự',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $result = contacts::addRow($request['fname'], $request['lname'], $request['email'], $request['subject'], $request['message']);

        $url = route('website.index');
        if($result) $url .=  '?type=success&message=Gửi thư thành công';
        else $url .=  '?type=error&message=Gửi thư thất bại';
        return redirect()->to($url.'#contact-section');
    }
}
