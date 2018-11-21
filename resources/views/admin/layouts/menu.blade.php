<aside class="Hui-aside">
	<div class="menu_dropdown bk_2">
		@inject('menu', 'App\Services\MenuService')

		@foreach($menu->getParentList(Auth::guard('admin')->user()->rid) as $value)
			<dl id="menu-admin">
				<dt><i class="Hui-iconfont">&#xe61a;</i> {{ $value->name }}<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
				<dd>
					<ul>
						@foreach($menu->getSonList(Auth::guard('admin')->user()->rid) as $v)
							@if($v->pid == $value->id)
								<li><a data-href="{{ url($v->action) }}" data-title="{{ $v->name }}" href="javascript:void(0)">{{ $v->name }}</a></li>
							@endif
						@endforeach
					</ul>
				</dd>
			</dl>
		@endforeach
		
</div>
</aside>