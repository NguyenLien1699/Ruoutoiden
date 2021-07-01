<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use App\Models\contacts;

class contactController extends Controller
{
    public function index() {
        if (isset($_GET['page']) && is_numeric($_GET['page'])) {
            $page_current = intval($_GET['page']);
            if ($page_current >= 1) {
                Paginator::currentPageResolver(function () use ($page_current) {return $page_current;});
            }
        }

        $recode = 20;
        $data = contacts::orderBy('id')->paginate($recode);

        return view('website.contact.index', ['data' => $data]);
    }

    public function detail($id) {
        $contact = contacts::find($id);
        if(is_null($contact)) {
            return redirect()->route('website.contacts.index')->with('error','Không tìm thấy thư');
        }
        $contact->is_views = true;
        $contact->save();
        return view('website.contact.detail',['contact' => $contact]);
    }

    public function delete($id) {
        $contact = contacts::find($id);
        if(is_null($contact)) {
            return redirect()->route('website.contacts.index')->with('error','Không tìm thấy thư');
        }

        if($contact->delete()){
            return redirect()->route('website.contacts.index')->with('success','Xóa thành công');
        }

        return redirect()->route('website.contacts.index')->with('error','Xóa thất bại');
    }
}
