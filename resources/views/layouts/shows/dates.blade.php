<div class="row">
    @if (isset($created_at) && $created_at)
        <div class="col-12 col-md-6">
            <div class="form-group">
                <label class="text-muted" style="font-size: 14px">Fecha de Creación</label>
                <div class="input-group input-group-alternative mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-watch-time"></i></span>
                    </div>
                    {!! Form::text('created_at', $created_at, [
                        "class" => "form-control pl-3 pr-3",
                        "disabled"
                    ]) !!}
                </div>
            </div>
        </div>
    @endif
    @if (isset($updated_at) && $updated_at)
        <div class="col-12 col-md-6">
            <div class="form-group">
                <label class="text-muted" style="font-size: 14px">Fecha de Última Actualización</label>
                <div class="input-group input-group-alternative mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-watch-time"></i></span>
                    </div>
                    {!! Form::text('updated_at', $updated_at, [
                        "class" => "form-control pl-3 pr-3",
                        "disabled"
                    ]) !!}
                </div>
            </div>
        </div>
    @endif
</div>
