{!! $form->open() !!}
<div class="p-2">
    <div class="row">
        {!! $form->html() !!}
    </div>
</div>
<div class="box-footer text-right">
    {!! Admin::button('save', ['type' => 'submit']) !!}
</div>
{!! $form->close() !!}

