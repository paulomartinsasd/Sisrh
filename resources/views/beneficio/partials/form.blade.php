<div class="col-md-6">
    <label for="descricao" class="form-label">Descrição</label>
    <input type="text" class="form-control" id="descricao" name="descricao" value="{{ $beneficios->descricao ?? "" }}" required>
</div>

@if (!@empty($beneficios->status))
    <div class="col-md-6">
        <label for="status" class="form-label">Status</label>
        <select id="status" name="status" class="form-select" required>
            <option value=""></option>
            <option value="Ativo" @if(isset($beneficios->status)) @selected($beneficios->status == "on")@endif("")>Ativo</option>>
            <option value="Desativado" @if(isset($beneficios->status)) @selected($beneficios->status == "off")@endif("")>Desativado</option>>
        </select>
    </div>
@endif


