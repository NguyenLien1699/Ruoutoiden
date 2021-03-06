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
            'name_company_excel.required' => 'B??n A l?? tr?????ng b???t bu???c',
            'name_company_excel.min' => 'T??i kho???n ch???a ??t nh???t 3 k?? t???',
            'name_company_excel.max' => 'T??i kho???n c?? nhi???u nh???t 250 k?? t???',
            'address_excel.required' => '?????a ch??? l?? tr?????ng b???t bu???c',
            'address_excel.min' => '?????a ch??? ph???i ch???a ??t nh???t 6 k?? t???',
            'address_excel.max' => '?????a ch??? c?? nhi???u nh???t 5000 k?? t???',
            'represent_excel.required' => '?????i di???n l?? tr?????ng b???t bu???c',
            'represent_excel.min' => '?????i di???n ph???i ch???a ??t nh???t 6 k?? t???',
            'represent_excel.max' => '?????i di???n c?? nhi???u nh???t 250 k?? t???',
            'email_excel.required' => 'Email l?? tr?????ng b???t bu???c',
            'email_excel.email' => 'Email kh??ng ????ng ?????nh d???ng',
            'email_excel.min' => 'Email ph???i ch???a ??t nh???t 3 k?? t???',
            'email_excel.max' => 'Email c?? nhi???u nh???t 250 k?? t???',
            'phone_excel.required' => 'S??? ??i???n tho???i l?? tr?????ng b???t bu???c',
            'phone_excel.min' => 'S??? ??i???n tho???i ch???a ??t nh???t 3 k?? t???',
            'phone_excel.max' => 'S??? ??i???n tho???i c?? nhi???u nh???t 250 k?? t???',
            'position_excel.required' => 'Ch???c v??? l?? tr?????ng b???t bu???c',
            'position_excel.min' => 'Ch???c v??? ch???a ??t nh???t 3 k?? t???',
            'position_excel.max' => 'Ch???c v??? c?? nhi???u nh???t 250 k?? t???',
            'us_tax.required' => 'Thu??? m??? l?? tr?????ng b???t bu???c',
            'us_tax.numeric' => 'Thu??? m??? ph???i l?? s???',
            'us_tax.min' => 'Thu??? m??? ph???i c?? gi?? tr??? nh??? nh???t b???ng 0',
            'us_tax.max' => 'Thu??? m??? c?? gi?? tr??? l???n nh???t 100',
            'vietnam_tax.required' => 'Thu??? vi???t nam l?? tr?????ng b???t bu???c',
            'vietnam_tax.numeric' => 'Thu??? vi???t nam ph???i l?? s???',
            'vietnam_tax.min' => 'Thu??? vi???t nam ph???i c?? gi?? tr??? nh??? nh???t b???ng 0',
            'vietnam_tax.max' => 'Thu??? vi???t nam c?? gi?? tr??? l???n nh???t 100',
            'exchange_rate.required' => 'T??? gi?? l?? tr?????ng b???t bu???c',
            'exchange_rate.numeric' => 'T??? gi?? ph???i l?? s???',
            'exchange_rate.min' => 'T??? gi?? ph???i c?? gi?? tr??? nh??? nh???t b???ng 0'
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
        if($setting->save()) return redirect()->route('setting.index')->withErrors(new MessageBag(['success' => 'C???p nh???t th??nh c??ng']));

        return redirect()->route('setting.index')->withErrors(new MessageBag(['error' => 'C???p nh???t th???t b???i']));
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
            $key.'.required' => $text.' l?? tr?????ng b???t bu???c',
            $key.'.min' => $text.' ph???i ch???a ??t nh???t 6 k?? t???',
            $key.'.max' => $text." c?? nhi???u nh???t $max k?? t???",
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
            $messages = array_merge($messages, $this->addMessages('title', 'Ti??u ?????'));
        }

        if(!empty($request['slogan'])) {
            $rules['slogan'] = 'required|min:6|max:5000';
            $messages = array_merge($messages, $this->addMessages('slogan', 'M?? t??? footer', 5000));
        }

        if(!empty($request['description'])) {
            $rules['description'] = 'required|min:6|max:5000';
            $messages = array_merge($messages, $this->addMessages('description', 'M?? t??? trang', 5000));
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
            $messages = array_merge($messages, $this->addMessages('phone', 'S??? ??i???n tho???i'));
        }

        if(!empty($request['address'])) {
            $rules['address'] = 'required|min:6|max:250';
            $messages = array_merge($messages, $this->addMessages('address', '?????a ch???'));
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
            $messages['fav.image'] = 'B???n c???n ch???n h??nh ???nh';
            $messages['fav.mimes'] = 'H??nh ???nh kh??ng ????ng v??i ?????nh d???ng';
            $messages['fav.max'] = 'H??nh ???nh qu?? l???n';
        }

        // if(!empty($request->all()['logo'])) {
        //     $rules['logo'] = 'image|mimes:jpeg,png,jpg,gif|max:2048';
        //     $messages['logo.image'] = 'B???n c???n ch???n h??nh ???nh';
        //     $messages['logo.mimes'] = 'H??nh ???nh kh??ng ????ng v??i ?????nh d???ng';
        //     $messages['logo.mimes'] = 'H??nh ???nh qu?? l???n';
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

        if($settings->save()) return redirect()->back()->withErrors(new MessageBag(['success' => 'c???p nh???t th??nh c??ng']));
        return redirect()->back()->withInput()->withErrors(new MessageBag(['error' => 'c???p nh???t th??nh c??ng']));
    }
}
