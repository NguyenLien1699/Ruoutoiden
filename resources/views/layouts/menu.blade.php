<div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-3 ml-auto">
            </div>
            <div class="col-lg order-lg-first">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                    @php
                        $contact_count = App\Models\contacts::countNotViews();
                    @endphp
                    <li class="nav-item">
                        <a href="#" class="nav-link {{ empty(request()->segment(1)) ? 'active' : '' }}">
                            <i class="fe fe-home"></i> Trang chủ
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('website.setting.index') }}" class="nav-link {{ request()->segment(2) === 'settings' ? 'active' : '' }}">
                            <i class="fe fe-settings"></i> Cài đặt
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('website.posts.index') }}" class="nav-link {{ request()->segment(2) === 'posts' ? 'active' : '' }}">
                            <i class="fe fe-book"></i> 
                            Bài viết
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('website.product.index') }}" class="nav-link {{ request()->segment(2) === 'products' ? 'active' : '' }}">
                            <i class="fe fe-box"></i> 
                            Sản phẩm
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('website.testimony.index') }}" class="nav-link {{ request()->segment(2) === 'testimony' ? 'active' : '' }}">
                            <i class="fe fe-user"></i> 
                            Nhận xét
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('website.pages.index') }}" class="nav-link {{ request()->segment(2) === 'pages' ? 'active' : '' }}">
                            <i class="fe fe-terminal"></i> 
                            Giới thiệu
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('website.contacts.index') }}" class="nav-link {{ request()->segment(2) === 'contacts' ? 'active' : '' }}">
                            <i class="fe fe-mail"></i>
                            Liên hệ 
                            @if($contact_count > 0)
                                <span class="tag tag-red ml-2">{{ $contact_count }}</span>
                            @endif
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>