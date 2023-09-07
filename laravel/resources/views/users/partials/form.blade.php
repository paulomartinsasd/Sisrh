    <div class="col-md-6">
        <label for="name" class="form-label">Nome</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name ?? "" }}" required>
    </div>
    <div class="col-4">
        <label for="email" class="form-label">E-mail</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email ?? "" }}" required>
    </div>
    <div class="col-md-6">
        <label for="email_verified_at" class="form-label">Confirmar E-mail</label>
        <input type="email" class="form-control" id="email_verified_at" name="email_verified_at" value="{{ $user->email_verified_at ?? "" }}" required>
    </div>
    <div class="col-4">
        <label for="password" class="form-label">Senha</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <div class="col-md-4">
        <label for="tipo" class="form-label">Tipo</label>
        <select id="tipo" name="tipo" class="form-select" required>
            <option value=""></option>>
            <option value="admin" @if(isset($user->tipo)) @selected($user->tipo == "admin")@endif("")>Administrador</option>>
            <option value="usuario" @if(isset($user->tipo)) @selected($user->tipo == "usuario")@endif("")>Usuário</option>>
        </select>
    </div>
