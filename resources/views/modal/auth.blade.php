<div class="modal fade" id="login-modal" tabindex="-1" aria-labelledby="login-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="login-label">Login</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-login">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="login-email" class="form-label">Email:</label>
                        <input type="text" name="username" id="login-email" placeholder="Email" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="login-password" class="form-label">Password:</label>
                        <input type="password" name="password" id="login-password" placeholder="Passowrd" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="register-modal" tabindex="-1" aria-labelledby="register-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="register-label">Register</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-register">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="register-name" class="form-label">Nama:</label>
                        <input type="text" name="username" id="register-name" placeholder="Nama" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="register-email" class="form-label">Email:</label>
                        <input type="text" name="email" id="register-email" placeholder="Email" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="register-password" class="form-label">Password:</label>
                        <input type="password" name="password" id="register-password" placeholder="Passowrd" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="confirm-password" class="form-label">Konfirmasi Password:</label>
                        <input type="password" name="confirm-password" id="confirm-password" placeholder="Konfirmasi Passowrd" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Register</button>
                </div>
            </form>
        </div>
    </div>
</div>
