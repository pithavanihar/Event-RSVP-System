<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="card w-50">
        <div class="card-header text-center">
            <h4>Login</h4>
        </div>
        <div class="card-body">
            @if (session()->has('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <form wire:submit.prevent="login">
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" wire:model="email">
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" wire:model="password">
                </div>

                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>

            <div class="text-center mt-3">
                <p>Don't have an account? 
                    <a href="{{ route('register') }}" class="text-primary">Register here</a>
                </p>
            </div>
        </div>
    </div>
</div>
