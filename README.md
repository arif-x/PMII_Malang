<p align="center"><img src="public/assets/img/favicon1.png" width="200"></p>

## PMII Malang

# Perlu Dikerjakan

- Fetch + Paginasi JSON Artikel
- Aktivitas Publik User
- Perbaikan FE + UI

# Note

- RajaOngkir API masih perlu migrasi ke database app bukan ambil dari RajaOngkir langsung

# Ganti code /vendor/laravel/ui/auth-backend/AuthenticateUser pada function attemptLogin dengan
```
$user = User::where('email', $request->email)
->where('password', $request->password)
->first();

if($user) {
	Auth::loginUsingId($user->id);
	// -- OR -- //
	Auth::login($user);
	return redirect('/home');
	} else {
		return redirect()->back()->withInput();
	}

```
