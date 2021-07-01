<?php

namespace App\Http\Controllers;

use Storage;
use Validator;
use Illuminate\Http\Request;
use App\Models\settings;
use Illuminate\Support\MessageBag;

class settingController extends Controller
{
    public function index() {
        $setting = settings::first();
        $view_bag = [
            'name_company_excel' => '',
            'address_excel' => '',
            'phone_excel' => '',
            'email_excel' => '',
            'represent_excel' => '',
            'position_excel' => '',
            'vietnam_tax' => 0,
            'us_tax' => 0,
            'exchange_rate' => 0
        ];
        if(isset($setting)) {
            $view_bag = [
                'name_company_excel' => $setting->name_company_excel,
                'address_excel' => $setting->address_excel,
                'phone_excel' => $setting->phone_excel,
                'email_excel' => $setting->email_excel,
                'represent_excel' => $setting->represent_excel,
                'position_excel' => $setting->position_excel,
                'vietnam_tax' => is_null($setting->vietnam_tax) ? 0 : intval($setting->vietnam_tax),
                'us_tax' => is_null($setting->us_tax) ? 0 : intval($setting->us_tax),
                'exchange_rate' => is_null($setting->exchange_rate) ? 0 : intval($setting->exchange_rate)
            ];
        }
            
        return view('setting.index', $view_bag);
    }

    public function indexPost(Request $request){
        $rules = [
            'name_company_excel' => 'required|min:3|max:250',
            'address_excel' => 'required|min:3|max:5000',
            'represent_excel' => 'required|min:3|max:250',
            'email_excel' => 'required|email|min:3|max:250',
            'phone_excel' => 'required|min:3|max:250',
            'position_excel' => 'required|min:3|max:250',
            'us_tax' => 'required|numeric|min:0|max:100',
            'vietnam_tax' => 'required|numeric|min:0|max:100',
            'exchange_rate' => 'required|numeric|min:0',
        ];

        $messages = [
            'name_company_excel.required' => 'Bên A là trường bắt buộc',
            'name_company_excel.min' => 'Tài khoản chứa ít nhất 3 ký tự',
            'name_company_excel.max' => 'Tài khoản có nhiều nhất 250 ký tự',
            'address_excel.required' => 'Địa chỉ là trường bắt buộc',
            'address_excel.min' => 'Địa chỉ phải chứa ít nhất 6 ký tự',
            'address_excel.max' => 'Địa chỉ có nhiều nhất 5000 ký tự',
            'represent_excel.required' => 'Đại diện là trường bắt buộc',
            'represent_excel.min' => 'Đại diện phải chứa ít nhất 6 ký tự',
            'represent_excel.max' => 'Đại diện có nhiều nhất 250 ký tự',
            'email_excel.required' => 'Email là trường bắt buộc',
            'email_excel.email' => 'Email không đúng định dạng',
            'email_excel.min' => 'Email phải chứa ít nhất 3 ký tự',
            'email_excel.max' => 'Email có nhiều nhất 250 ký tự',
            'phone_excel.required' => 'Số điện thoại là trường bắt buộc',
            'phone_excel.min' => 'Số điện thoại chứa ít nhất 3 ký tự',
            'phone_excel.max' => 'Số điện thoại có nhiều nhất 250 ký tự',
            'position_excel.required' => 'Chức vụ là trường bắt buộc',
            'position_excel.min' => 'Chức vụ chứa ít nhất 3 ký tự',
            'position_excel.max' => 'Chức vụ có nhiều nhất 250 ký tự',
            'us_tax.required' => 'Thuế mỹ là trường bắt buộc',
            'us_tax.numeric' => 'Thuế mỹ phải là số',
            'us_tax.min' => 'Thuế mỹ phải có giá trị nhỏ nhất bằng 0',
            'us_tax.max' => 'Thuế mỹ có giá trị lớn nhất 100',
            'vietnam_tax.required' => 'Thuế việt nam là trường bắt buộc',
            'vietnam_tax.numeric' => 'Thuế việt nam phải là số',
            'vietnam_tax.min' => 'Thuế việt nam phải có giá trị nhỏ nhất bằng 0',
            'vietnam_tax.max' => 'Thuế việt nam có giá trị lớn nhất 100',
            'exchange_rate.required' => 'Tỷ giá là trường bắt buộc',
            'exchange_rate.numeric' => 'Tỷ giá phải là số',
            'exchange_rate.min' => 'Tỷ giá phải có giá trị nhỏ nhất bằng 0'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $setting = settings::first();
        if(is_null($setting)) {
            $setting = new settings();
        }

        $setting->name_company_excel = $request['name_company_excel'];
        $setting->address_excel = $request['address_excel'];
        $setting->phone_excel = $request['phone_excel'];
        $setting->email_excel = $request['email_excel'];
        $setting->represent_excel = $request['represent_excel'];
        $setting->position_excel = $request['position_excel'];
        $setting->us_tax = intval($request['us_tax']);
        $setting->vietnam_tax = intval($request['vietnam_tax']);
        $setting->exchange_rate = intval($request['exchange_rate']);
        if($setting->save()) return redirect()->route('setting.index')->withErrors(new MessageBag(['success' => 'Cập nhật thành công']));

        return redirect()->route('setting.index')->withErrors(new MessageBag(['error' => 'Cập nhật thất bại']));
    }

    public function website() {
        $settings = settings::first();

        $viewBag = array(
            'fav' => is_null($settings) || empty($settings->icon) ? '/images/uploadimage.jpg' : Storage::disk('public')->url($settings->icon),
            'logo' => is_null($settings)?null:$settings->logo,
            'title' => is_null($settings)?null:$settings->title,
            'slogan' => is_null($settings)?null:$settings->slogan,
            'text_footer' => is_null($settings)?null:$settings->text_footer,
            'email' => is_null($settings)?null:$settings->email,
            'phone' => is_null($settings)?null:$settings->phone,
            'address' => is_null($settings)?null:$settings->address,
            'link_facebook' => is_null($settings)?null:$settings->link_facebook,
            'link_youtube' => is_null($settings)?null:$settings->link_youtube,
            'link_twitter' => is_null($settings)?null:$settings->link_twitter,
            'link_linkedin' => is_null($settings)?null:$settings->link_linkedin,
            'link_pinterest' => is_null($settings)?null:$settings->link_pinterest,
            'description' => is_null($settings)?null:$settings->description,
        );
        return view('setting.website', $viewBag);
    }

    private function addMessages($key, $text, $max = 250){
        return array(
            $key.'.required' => $text.' là trường bắt buộc',
            $key.'.min' => $text.' phải chứa ít nhất 6 ký tự',
            $key.'.max' => $text." có nhiều nhất $max ký tự",
        );
    }

    public function websitePost(Request $request) {
        
        $rules = [];
        $messages = [];
        if(!empty($request['logo'])) {
            $rules['logo'] = 'required|min:6|max:250';
            $messages = array_merge($messages, $this->addMessages('logo', 'Logo'));
        }

        if(!empty($request['title'])) {
            $rules['title'] = 'required|min:6|max:250';
            $messages = array_merge($messages, $this->addMessages('title', 'Tiêu đề'));
        }

        if(!empty($request['slogan'])) {
            $rules['slogan'] = 'required|min:6|max:5000';
            $messages = array_merge($messages, $this->addMessages('slogan', 'Mô tả footer', 5000));
        }

        if(!empty($request['description'])) {
            $rules['description'] = 'required|min:6|max:5000';
            $messages = array_merge($messages, $this->addMessages('description', 'Mô tả trang', 5000));
        }

        if(!empty($request['text_footer'])) {
            $rules['text_footer'] = 'required|min:6|max:250';
            $messages = array_merge($messages, $this->addMessages('text_footer', 'Text footer'));
        }

        if(!empty($request['email'])) {
            $rules['email'] = 'required|min:6|max:250';
            $messages = array_merge($messages, $this->addMessages('email', 'Email'));
        }

        if(!empty($request['phone'])) {
            $rules['phone'] = 'required|min:6|max:250';
            $messages = array_merge($messages, $this->addMessages('phone', 'Số điện thoại'));
        }

        if(!empty($request['address'])) {
            $rules['address'] = 'required|min:6|max:250';
            $messages = array_merge($messages, $this->addMessages('address', 'Địa chỉ'));
        }

        if(!empty($request['link_facebook'])) {
            $rules['link_facebook'] = 'required|min:6|max:250';
            $messages = array_merge($messages, $this->addMessages('link_facebook', 'Link facebook'));
        }

        if(!empty($request['link_youtube'])) {
            $rules['link_youtube'] = 'required|min:6|max:250';
            $messages = array_merge($messages, $this->addMessages('link_youtube', 'Link youtube'));
        }

        if(!empty($request['link_twitter'])) {
            $rules['link_twitter'] = 'required|min:6|max:250';
            $messages = array_merge($messages, $this->addMessages('link_twitter', 'Link twitter'));
        }

        if(!empty($request['link_linkedin'])) {
            $rules['link_linkedin'] = 'required|min:6|max:250';
            $messages = array_merge($messages, $this->addMessages('link_linkedin', 'Link linkedin'));
        }

        if(!empty($request['link_pinterest'])) {
            $rules['link_pinterest'] = 'required|min:6|max:250';
            $messages = array_merge($messages, $this->addMessages('link_pinterest', 'Link pinterest'));
        }
        
        if(!empty($request->all()['fav'])) {
            $rules['fav'] = 'image|mimes:jpeg,png,jpg,gif|max:2048';
            $messages['fav.image'] = 'Bạn cần chọn hình ảnh';
            $messages['fav.mimes'] = 'Hình ảnh không đúng vơi định dạng';
            $messages['fav.max'] = 'Hình ảnh quá lớn';
        }

        // if(!empty($request->all()['logo'])) {
        //     $rules['logo'] = 'image|mimes:jpeg,png,jpg,gif|max:2048';
        //     $messages['logo.image'] = 'Bạn cần chọn hình ảnh';
        //     $messages['logo.mimes'] = 'Hình ảnh không đúng vơi định dạng';
        //     $messages['logo.mimes'] = 'Hình ảnh quá lớn';
        // }

        $validator = Validator::make($request->all(), $rules, $messages);

		if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        $settings = settings::first();
        if(is_null($settings)) $settings = new settings();
        
        $settings->title = $request['title'];
        $settings->slogan = $request['slogan'];
        $settings->text_footer = $request['text_footer'];
        $settings->email = $request['email'];
        $settings->phone = $request['phone'];
        $settings->address = $request['address'];
        $settings->link_facebook = $request['link_facebook'];
        $settings->link_twitter = $request['link_twitter'];
        $settings->link_youtube = $request['link_youtube'];
        $settings->link_linkedin = $request['link_linkedin'];
        $settings->link_pinterest = $request['link_pinterest'];
        $settings->description = $request['description'];
        $settings->logo = $request['logo'];
        /* Upload Icon */
        if($request->hasFile('fav')) {
            $settings->icon = Storage::url(Storage::disk('public')->put('image', $request->file('fav')));
        }

        // /* Upload Icon */
        // if($request->hasFile('logo')) {
        //     $settings->logo = Storage::url(Storage::disk('public')->put('image', $request->file('logo')));
        // }

        if($settings->save()) return redirect()->back()->withErrors(new MessageBag(['success' => 'cập nhật thành công']));
        return redirect()->back()->withInput()->withErrors(new MessageBag(['error' => 'cập nhật thành công']));
    }
}
