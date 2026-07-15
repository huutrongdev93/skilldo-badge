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