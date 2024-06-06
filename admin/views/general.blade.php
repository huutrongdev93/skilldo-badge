<div class="row mb-2">
    <div class="col-md-3">
        <div class="ui-title-bar__group" style="padding-bottom:5px;">
            <h3 class="ui-title-bar__title" style="font-size:20px;">{!! $title !!}</h3>
            <p style="margin-top: 10px; margin-left: 1px; color: #8c8c8c">{{ $description }}</p>
        </div>
    </div>
    <div class="col-md-9">
        <div class="box">
            {!! $form->open() !!}
            <div class="box-content p-2" style="position: relative; min-height: 200px">
                {!! Admin::loading() !!}
                <div class="row">
                    {!! $form->html() !!}
                </div>
            </div>
            <div class="box-footer text-right">
                {!! Admin::button('save', ['type' => 'submit']) !!}
            </div>
            {!! $form->close() !!}
        </div>
    </div>
</div>