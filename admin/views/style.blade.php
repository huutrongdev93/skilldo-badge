<div class="row mb-2 js_badge_style_main" data-tab-key="{{$tabKey}}">
	<div class="col-md-3">
		<div class="ui-title-bar__group" style="padding-bottom:5px;">
			<h3 class="ui-title-bar__title" style="font-size:20px;">{!! $tab['label'] !!}</h3>
			<p style="margin-top: 10px; margin-left: 1px; color: #8c8c8c">{!! $tab['description'] !!}</p>
		</div>
	</div>
	<div class="col-md-4">
		<div class="box">
			<div class="box-content p-2">
                <hr style="margin: 5px 0;">
                <div class="clearfix"></div>
                <div class="badge-style-wrapper">
                    @foreach ($styles as $styleKey => $style)
                        <div class="badge-style-item js_badge_style_item {!! ($active == $styleKey) ? 'active' : '' !!}" data-style="{!! $styleKey !!}">
                            {!! $style->html($tab) !!}
                            <style>{!! $style->css() !!}</style>
                        </div>
					@endforeach
                </div>
			</div>
		</div>
	</div>
	<div class="col-md-5">
		<div class="box js_badge_style_form">
			{!! Admin::loading() !!}
			<div class="box-content p-0" style="position: relative; min-height: 200px">
				<div style="position: relative; min-height: 200px"></div>
				<div class="box-footer text-right">
					{!! Admin::button('save', ['type' => 'submit']) !!}
				</div>
			</div>
		</div>
	</div>
</div>